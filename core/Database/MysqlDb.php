<?php

namespace Core\Database;

use \PDO;

/**
 * Class MysqlDb
 * Manage Connection to Mysql database and SQL request with PDO
 *
 */
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

    /**
     * @return PDO
     */
    private function getPDO(): PDO
    {

        if ($this->pdo === null) {
            $option = array(
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                PDO::ATTR_EMULATE_PREPARES => false
            );
            $pdo = new PDO('mysql:dbname=' . $this->dbName . ';host=' . $this->dbHost, $this->dbUser, $this->dbPass, $option);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo = $pdo;
        }
        return $this->pdo;
    }

    /**
     *
     * Make PDO query
     * that can return an object or directly instant of class specify in params $classname
     *
     * @param string $statement
     * @param null|string $className
     * @param bool $one
     * @return array|false|mixed|\PDOStatement
     */
    public function query(string $statement, $className = null, $one = false)
    {
        $req = $this->getPDO()->query($statement);

        if(
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


    /**
     *
     * Make PDO prepare statement
     * that can return an object or directly instant of class specify in params $classname
     * according to the result of the statement
     *
     * @param string $statement
     * @param array $attributes
     * @param null|string $className
     * @param bool $one
     * @return array|bool|mixed
     */
    public function prepare(string $statement, array $attributes, $className = null, $one = false)
    {
        $req = $this->getPDO()->prepare($statement);
        $res = $req->execute($attributes);

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

}
