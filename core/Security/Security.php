<?php

namespace Core\Security;

class Security
{

    public static function csrf()
    {
        if($_POST['token'] === $_SESSION['token']){
            return true;
        }
        return false;
    }

}
