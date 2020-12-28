<?php

namespace Core\Auth;

use Core\Database\Database;

/**
 * Class Auth
 * Manage authentication, access rights
 *
 */
class Auth
{

    /**
     * @var Database
     */
    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    /**
     *
     * verify the credentials and generate new session with user id and token if valid
     *
     * @params string $username
     * @params string $password
     * @return boolean
     *
     */
    public function login($username, $password)
    {

        $user = $this->db->prepare(
            'SELECT * FROM users WHERE username = ?',
            [$username],
            null,
            true
        );

        if ($user) {
            if ($user->password === sha1($password) && $user->validate == 1) {
                session_regenerate_id(true);

                $session = new Session();
                $session->put('auth', $user->id);
                $session->put('token', $this->getCSRFToken());
                return true;
            }
        }

        return false;

    }

    /**
     * 
     * return the id from the user if logged
     *
     * @return int 
     */
    public function logged()
    {
        return Session::get('auth');
    }

    /**
     *
     * check access level needed for ressources
     * 
     * @params int $userId
     * @return boolean
     */
    public function authorized($userId)
    {
        $userRole = $this->db->prepare(
            'SELECT role FROM users WHERE id = ?',
            [$userId],
            null,
            true
        );

        $acessRight = null;
        if ($userRole->role === 'commentateur') {
            $acessRight = 1;
        } elseif ($userRole->role === 'redacteur') {
            $acessRight = 2;
        } elseif ($userRole->role === 'admin') {
            $acessRight = 3;
        }

        $ressource = explode( '/', filter_input(INPUT_GET, 'url'));

        if($ressource[0] === 'admin'){
            $ressource = $ressource[1];
            $ressource === 'dash' ? $right = 2 : $right = 3;
        } else {
            $right = 1;
        }
        
        if($acessRight){
            if ($acessRight >= $right) {
                return true;
            } else {
                return false;
            }  
        }

    }

    /***
     *
     * Generate a random token for prevent csrf
     *
     * @return string
     *
     */
    public function getCSRFToken()
    {
        return sha1(rand(42,619)*time());
    }


}
