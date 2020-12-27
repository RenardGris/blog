<?php

namespace Core\Auth;

class Session
{
    protected $session;

    public function __construct()
    {
        if(empty($this->session)){
            $this->session = &$_SESSION;
        }
        return $this->session;
    }


    public function put($key, $value){
        $this->session[$key] = $value;
    }

    public static function get($key){
        //return (isset($_SESSION[$key]) ? filter_var($_SESSION[$key]) : null);
        return (new Session())->getKey($key);
    }

    public function forget($key){
        unset($this->session[$key]);
    }

    public function getKey($key){
        return isset($this->session[$key]) ? $this->session[$key] : null;
    }

}
