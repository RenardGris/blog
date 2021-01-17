<?php

namespace Core;

class Config
{

    private $setting = [];
    private static $_instance;

    //recupere le dossier de configuration
    public function __construct($file)
    {

        $this->setting = require $file;
    }

    //Singleton avec le fichier config/config.php
    public static function getInstance($file)
    {
        if (self::$_instance === null) {
            self::$_instance = new Config($file);
        }

        return self::$_instance;

    }

    //getter recuperant la valeur de la clé passée en parametre
    public function get($key)
    {
        if (!isset($this->setting[$key])) {
            return null;
        }
        return $this->setting[$key];
    }

}
