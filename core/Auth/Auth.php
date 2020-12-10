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
                $_SESSION['auth'] = $user->id;
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
        return isset($_SESSION['auth']);
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

        $ressource = explode( '/', htmlentities($_GET['url']));

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

}