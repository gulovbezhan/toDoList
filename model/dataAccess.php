<?php

require_once 'connectDb.php';

class DataAccess 
{
    private static function getPdoConnection() 
    {
        // Get the singleton instance of ConnectDb and then get the PDO connection from it.
        return ConnectDb::getInstance()->getConnection();
    }

    public static function getAllList() 
    {
        $pdo = self::getPdoConnection();
        $statement = $pdo->prepare("SELECT * FROM list");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS, "toDoList");
    }

    public static function loginAccess($username, $password) 
    {
        $pdo = self::getPdoConnection();
        $statement = $pdo->prepare("SELECT * FROM account WHERE username = ? AND password = ?");
        $statement->execute([$username, $password]);
        return $statement->fetchAll(PDO::FETCH_CLASS, "Account");
    }

}
