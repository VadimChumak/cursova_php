<?php
class Database
{
    protected $Pdo;
    public function __construct($host, $database, $login, $password, $type = "mysql")
    {
        $this->Pdo = new PDO("{$type}:host={$host};dbname={$database}", $login, $password);
    }
    public function DeleteById($tableName, $indexField, $indexValue)
    {
        $sql = "DELETE FROM {$tableName} WHERE {$indexField} = '$indexValue'";
        $this->Pdo->exec($sql);
    }
    public function DeleteByTwoCays($tableName, $indexField, $indexValue, $indexFieldT, $indexValueT)
    {
        $sql = "DELETE FROM {$tableName} WHERE ({$indexField} = '$indexValue') AND ({$indexFieldT} = '$indexValueT')";
        $this->Pdo->exec($sql);
    }
    public function UpdateById($tableName, $assocArray, $indexField, $indexValue)
    {
        $setArray = array();
        foreach ($assocArray as $key => $value)
            array_push($setArray, "{$key} = '{$value}'");
        $setList = implode(',', $setArray);
        $sql = "UPDATE {$tableName} SET {$setList} WHERE {$indexField} = '{$indexValue}'";
        $this->Pdo->exec($sql);
    }
    public function SelectSearch($tableName, $fieldArray, $assocArray = null)
    {
        $whereString = '';
        if (is_string($fieldArray))
            $fieldsString = $fieldArray;
        if (is_array($fieldArray))
            $fieldsString = implode(', ', $fieldArray);
        if (is_array($assocArray))
        {
            $whereArray = array();
            foreach ($assocArray as $key => $value)
                array_push($whereArray, "($key LIKE '%$value%')");
            $whereString = 'WHERE '.implode('OR', $whereArray);
        }
        $sql = "SELECT {$fieldsString} FROM {$tableName} {$whereString} ";
        $st = $this->Pdo->query($sql);
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }
    public function Select($tableName, $fieldArray, $assocArray = null, $joinTabNames = null, $joinArray = null, $groupByArray = null,
                            $orderBy = null, $desc = null)
    {
        $whereString = '';
        if (is_string($fieldArray))
            $fieldsString = $fieldArray;
        if (is_array($fieldArray))
            $fieldsString = implode(', ', $fieldArray);
        if (is_array($assocArray))
        {
            $whereArray = array();
            foreach ($assocArray as $key => $value)
                array_push($whereArray, "($key = '$value')");
            $whereString = 'WHERE '.implode('AND', $whereArray);
        }
        $joinString='';
        if (is_array($joinArray))
        {
            $key = key($joinArray);
            $val = $joinArray[$key];
            $joinString = 'INNER JOIN '.$joinTabNames.' ON '."{$key} = {$val}";
        }

        $groupByString = '';
        if(is_array($groupByArray)){
            $groupByString = 'GROUP BY '.implode(',', $groupByArray);;
        }

        $orderByString = '';
        if(is_array($orderBy)){
            $orderByString = 'ORDER BY '.implode(',', $orderBy);;
        }

        if(is_array($orderBy) && $orderByString!=''){
            $orderByString = $orderByString." DESC";
        }

        $sql = "SELECT {$fieldsString} FROM {$tableName} {$joinString} {$whereString} {$groupByString}{$orderByString}";
        $st = $this->Pdo->query($sql);
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }


    public function Insert($tableName, $assocArray)
    {
        $fieldsArray = array_keys($assocArray);
        $valuesArray = array_values($assocArray);
        $fieldsList = implode(',', $fieldsArray);
        $valuesList = "'".implode("', '", $valuesArray)."'";
        $sql = "INSERT INTO {$tableName} ($fieldsList) VALUES ($valuesList)";
        $this->Pdo->exec($sql);
        return $this->Pdo->lastInsertId("post");
    }

    public function SelectNumberOfRecords($tableName, $fieldArray, $from, $to, $assocArray = null, $sortingCondotion = null)
    {
        $whereString = '';
        if (is_string($fieldArray))
            $fieldsString = $fieldArray;
        if (is_array($fieldArray))
            $fieldsString = implode(', ', $fieldArray);
        if (is_array($assocArray))
        {
            $whereArray = array();
            foreach ($assocArray as $key => $value)
                array_push($whereArray, "($key = '$value')");
            $whereString = 'WHERE '.implode('AND', $whereArray);
        }
        $sortingString = '';
        if (is_string($sortingCondotion))
            $soringString = "ORDER BY ".$sortingCondotion;
        if (is_array($sortingCondotion))
            $sortingString = "ORDER BY ".implode(', ', $sortingCondotion);
        $sql = "SELECT {$fieldsString} FROM {$tableName} {$whereString} {$sortingString} DESC LIMIT {$from},10";
        $st = $this->Pdo->query($sql);
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }


    public function SelectJoin($tableName, $fieldArray, $assocArray = null, $orderArray = null, $orderType = null, $groupArray = null, $joinTable = null, $limit = null)
    {
        $whereString = '';
        if (is_string($fieldArray))
            $fieldsString = $fieldArray;
        if (is_array($fieldArray))
            $fieldsString = implode(', ', $fieldArray);
        if (is_array($assocArray))
        {
            $whereArray = array();
            foreach ($assocArray as $key => $value)
                array_push($whereArray, "($key = '$value')");
            $whereString = 'WHERE '.implode('AND', $whereArray);
        }
        $orderString = '';
        if (is_string($orderArray))
            $orderString = "ORDER BY ".$orderArray;
        if (is_array($orderArray))
            $orderString = "ORDER BY ".implode(', ', $orderArray);
        if(!is_null($orderType)) {
            $orderString = $orderString . " DESC ";
        }
        $groupString = '';
        if (is_string($groupArray))
            $groupString = "GROUP BY ".$groupArray;
        if (is_array($groupArray))
            $groupString = "GROUP BY ".implode(', ', $groupArray);
        $joinString = '';
        if (is_array($joinTable)) {
            $joinArray = array();
            foreach ($joinTable as $tName => $tField)
                foreach($tField as $firstField => $secondField)
                    array_push($joinArray, "$tName ON $firstField = $secondField");
            $joinString = "INNER JOIN ".implode(' INNER JOIN ', $joinArray);
        }
        $limitString = '';
        if(is_array($limit)) {
            $limitString = "LIMIT " . $limit['from'] .", " . $limit['count'];
        }
        $sql = "SELECT {$fieldsString} FROM {$tableName} {$joinString} {$whereString} {$orderString} {$groupString} {$limitString}";
        $st = $this->Pdo->query($sql);
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }
    public function SelectPosts($pageOwnerId, $pageType, $from) {
        $sql = "SELECT post.id, COUNT(bookmarks.item_id) as count, post.post_text, post.publishing_date, post.photo_url, post.page_owner_id, user_data.user_id, user_data.name, user_data.surname, user_data.image FROM post left JOIN user_data ON user_data.user_id = post.owner_id left JOIN bookmarks ON bookmarks.item_id = post.id WHERE (page_owner_id = {$pageOwnerId})AND(page_type = '{$pageType}') GROUP BY post.id ORDER BY post.publishing_date DESC LIMIT {$from}, 10";
        $st = $this->Pdo->query($sql);
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

    public function SelectMessages($firstUser, $secondUser) {
        $sql = "SELECT * FROM mesages WHERE (sender_id = {$firstUser} AND reciever_id = {$secondUser}) OR (sender_id = {$secondUser} AND reciever_id = {$firstUser}) ORDER BY Date ASC";
        $st = $this->Pdo->query($sql);
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }
}