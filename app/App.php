<?php

namespace App;

use Core\Config;
use Core\Database\MysqlDb;

class App
{

    public $titre = "Blog PhPoo";
    public $linkPath;

    private $dbInstance;
    private static $_instance;

    public static function getInstance()
    {

        if (is_null(self::$_instance)) {
            self::$_instance = new App();
        }
        return self::$_instance;
    }

    //Factorie pour les table ( classes )
    public function getTable($name)
    {

        $name = '\\App\\Table\\' . ucfirst($name);
        return new $name($this->getDb());

    }

    public function getDb()
    {

        $config = Config::getInstance(ROOT . '/config/config.php');

        if ($this->dbInstance === null) {
            $this->dbInstance = new MysqlDb($config->get('db_name'),
                $config->get('db_user'),
                $config->get('db_pass'),
                $config->get('db_host')
            );

        }

        return $this->dbInstance;

    }

    public static function load()
    {
        session_start();
    }

    public function getBaseUrl()
    {
        if($this->linkPath === null){
            $path = explode('index.php', $_SERVER['PHP_SELF']);
            $this->linkPath = $path[0];

        }
        return $this->linkPath;
    }

}