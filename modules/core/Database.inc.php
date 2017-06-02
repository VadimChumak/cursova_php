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
    public function Select($tableName, $fieldArray, $assocArray = null, $sortingCondotion = null)
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
        $sql = "SELECT {$fieldsString} FROM {$tableName} {$whereString} {$sortingString}";
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
        var_dump($sql);
        $st = $this->Pdo->query($sql);
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

}