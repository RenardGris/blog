<?php

namespace Core\Security;

class Security
{

    public static function xss()
    {
        $data = [];
        foreach($_POST as $key => $input){
            $data[$key] = htmlentities($input);
        }
        return $data;
    }

    public static function csrf()
    {
        if($_POST['token'] === $_SESSION['token']){
            return true;
        }
        return false;
    }

}
