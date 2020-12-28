<?php

namespace Core;

/**
 * Class Config
 * Manage the credentials for connection to the database with the values in \config\config.php
 *
 */
class Config
{

    /**
     * @var array
     */
    private $setting = [];
    /**
     * @var Config
     */
    private static $_instance;

    public function __construct($file)
    {
        $this->setting = require $file;
    }

    /**
     *
     * Singleton
     *
     * @param $file
     * @return Config
     */
    public static function getInstance($file)
    {
        if (self::$_instance === null) {
            self::$_instance = new Config($file);
        }

        return self::$_instance;

    }

    /**
     *
     * return the value of the $key in property setting
     *
     * @param mixed $key
     * @return mixed|null
     */
    public function get($key)
    {
        if (!isset($this->setting[$key])) {
            return null;
        }
        return $this->setting[$key];
    }

}
