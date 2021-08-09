<?php
class db
{

    private $serverNme = "localhost";
    private $dbName = "finalproject";
    private $dbUser = "root";
    private $dbPassword = "";


    public function connect()
    {

        $pdo = new PDO(
            "mysql:host=$this->serverNme;dbname=$this->dbName",
            $this->dbUser,
            $this->dbPassword
        );
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    }


    function disconnect()
    {
        $pdo = NULL;
        return $pdo;
    }
}
