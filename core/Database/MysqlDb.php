<?php

namespace Core\Database;

use \PDO;

class MysqlDb extends Database
{

    private $dbName;
    private $dbUser;
    private $dbPass;
    private $dbHost;
    private $pdo;

    public function __construct($dbName, $dbUser, $dbPass, $dbHost)
    {
        $this->dbName = $dbName;
        $this->dbUser = $dbUser;
        $this->dbPass = $dbPass;
        $this->dbHost = $dbHost;
    }

    private function getPDO()
    {

        if ($this->pdo === null) {
            //$pdo = new PDO('mysql:dbname=blog;host=localhost', 'root', '');
            $pdo = new PDO('mysql:dbname=' . $this->dbName . ';host=' . $this->dbHost, $this->dbUser, $this->dbPass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo = $pdo;
        }
        return $this->pdo;
    }

    public function query($statement, $className = null, $one = false)
    {
        $req = $this->getPDO()->query($statement);

        if (
            strpos($statement, "UPDATE") === 0 ||
            strpos($statement, "INSERT") === 0 ||
            strpos($statement, "DELETE") === 0
        ) {
            return $req;
        }

        if ($className === null) {
            $req->setFetchMode(PDO::FETCH_OBJ);
        } else {
            $req->setFetchMode(PDO::FETCH_CLASS, $className);
        }

        if ($one) {
            $datas = $req->fetch();
        } else {
            $datas = $req->fetchAll();
        }

        return $datas;
    }

    public function exec($statement)
    {
        $req = $this->getPDO()->exec($statement);
        return $req;
    }

    public function prepare($statement, $attributes, $className = null, $one = false)
    {
        $req = $this->getPDO()->prepare($statement);
        $res = $req->execute($attributes);
        //$req->setFetchMode(PDO::FETCH_CLASS, $className);

        if (
            strpos($statement, "UPDATE") === 0 ||
            strpos($statement, "INSERT") === 0 ||
            strpos($statement, "DELETE") === 0
        ) {
            return $res;
        }

        if ($className === null) {
            $req->setFetchMode(PDO::FETCH_OBJ);
        } else {
            $req->setFetchMode(PDO::FETCH_CLASS, $className);
        }

        if ($one) {
            $datas = $req->fetch();
        } else {
            $datas = $req->fetchAll();
        }
        return $datas;
    }

    public function lastInsertId()
    {
        return $this->getPDO()->lastInsertId();
    }

}
