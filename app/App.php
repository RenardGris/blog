<?php

namespace App;

use Core\Config;
use Core\Database\MysqlDb;

class App
{

    /**
     * @var string
     */
    public $titre = "Blog Renard Gris";
    /**
     * @var string
     */
    public $linkPath;
    /**
     * @var MysqlDb
     */
    private $dbInstance;
    /**
     * @var null|App
     */
    private static $_instance;

    /**
     * Singleton
     *
     * @return App
     */
    public static function getInstance(): ?App
    {

        if (self::$_instance === null) {
            self::$_instance = new App();
        }
        return self::$_instance;
    }

    /**
     *
     * Factory for \Table class
     *
     * @param string $name
     * @return mixed (\Table Class)
     */
    public function getTable(string $name)
    {

        $name = '\\App\\Table\\' . ucfirst($name);
        return new $name($this->getDb());

    }

    /**
     *
     * Singleton
     * generate instance of MysqlDb with credentials in config files (\config\config.php)
     *
     * @return MysqlDb
     */
    public function getDb(): MysqlDb
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

    /**
     * Overwriting params in php.ini
     * and start php session
     */
    public static function load()
    {
        ini_set( 'session.use_only_cookies',TRUE );
        ini_set( 'session.cookie_lifetime', 900 );
        ini_set( 'session.cookie_httponly', TRUE );
        ini_set( 'session.cookie_secure', true );
        session_start();
    }

    /**
     *
     * define the path of the app
     *
     * @return string
     */
    public function getBaseUrl(): string
    {
        if($this->linkPath === null){
            $path = explode('index.php', filter_input(INPUT_SERVER, 'PHP_SELF', FILTER_SANITIZE_URL));
            $this->linkPath = $path[0];

        }
        return $this->linkPath;
    }

}
