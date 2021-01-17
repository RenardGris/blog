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

        if (self::$_instance === null) {
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
        ini_set( 'session.use_only_cookies',TRUE );
        ini_set( 'session.cookie_lifetime', 900 );
        ini_set( 'session.cookie_httponly', TRUE );
        ini_set( 'session.cookie_secure', true );
        session_start();
    }

    public function getBaseUrl()
    {
        if($this->linkPath === null){
            $path = explode('index.php', filter_input(INPUT_SERVER, 'PHP_SELF', FILTER_SANITIZE_URL));
            $this->linkPath = $path[0];

        }
        return $this->linkPath;
    }

}
