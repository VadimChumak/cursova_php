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
    public function SelectMessages($user_id) {
        $sql = "SELECT * FROM mesages WHERE (reciever_id = '{$user_id}') AND (is_readed = '0') ORDER BY id DESC";
        $st = $this->Pdo->query($sql);
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }
}