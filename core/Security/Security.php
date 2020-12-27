<?php

namespace Core\Security;

class Security
{

    public static function xss()
    {
        $data = [];

        if(filter_input_array(INPUT_POST) !== null){
            foreach(filter_input_array(INPUT_POST) as $key => $input){
                $cleanInput = strip_tags($input);
                $sanitizedInput = Security::sanitizer($key,$cleanInput);
                $data[$key] = htmlspecialchars($sanitizedInput, ENT_QUOTES);
            }
            return $data;
        }
    }

    public static function csrf()
    {
        if($_POST['token'] === $_SESSION['token']){
            return true;
        }
        return false;
    }

    public static function sanitizer($type, $value){

        $inputs = [ FILTER_SANITIZE_STRING => ['firstname','lastname','username','password','titre','chapo','contenu'],
                    FILTER_SANITIZE_NUMBER_INT => ['role', 'article_id', 'user_id', 'id'],
                    FILTER_SANITIZE_EMAIL => ['email']
                ];

        foreach ($inputs as $key => $genders){
            foreach ($genders as $gender){
                if($gender === $type){
                    return $value = filter_var($value, $key);
                }
            }
        }
    }
}
