<?php

namespace Core\Auth;

use Core\Database\Database;

/**
 * Class Auth
 * Permet la gestion de l'authentification (connexion et droits d'accès) des utilisateurs 
 */
class Auth
{

    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }


    /**
     * @return int|false
     */
    public function getAuthUserId()
    {
        return $this->logged() ? $_SESSION['auth'] : false;
    }

    /**
     *
     * @params $username
     * @params $password
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
     * renvoie l'id de l'utilisateur si il est connecté
     * @return int 
     */
    public function logged()
    {
        return Session::get('auth');
    }

    /**
     *
     * Permet de verifier si l'utilisateur dispose des droits d'accès
     * 
     * @params $userId int
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
     * Genère un token aléatoire basé sur le timestamp de connexion
     * @return string
     *
     */
    public function getCSRFToken()
    {
        return sha1(rand(42,619)*time());
    }


}
