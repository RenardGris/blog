<?php

namespace Core\Security;

use Core\Auth\Session;

/**
 * Class Security
 * Secure inputs value from user to prevent some attacks
 *
 */
class Security
{

    /**
     * filter and sanitize the input value from the user pass in $_POST
     *
     * @return array|null
     */
    public static function xss(): ?array
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
        return null;
    }

    /**
     * check if the token from forms is the same as $_SESSION
     *
     * @return bool
     */
    public static function csrf(): bool
    {
        if(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING) === filter_var(Session::get('token'), FILTER_SANITIZE_STRING )){
            return true;
        }
        return false;
    }

    /**
     *
     * Sanitize the value according to the requested type
     *
     * @param string $type
     * @param mixed $value
     * @return mixed
     */
    public static function sanitizer(string $type, $value){

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
