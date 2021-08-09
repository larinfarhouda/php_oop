<?php
class db
{

    private $serverNme = "enter you server Name ";
    private $dbName = "enter you db Name";
    private $dbUser = "enter you db User";
    private $dbPassword = "enter you db Password";


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
