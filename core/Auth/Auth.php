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
     * @param string $username
     * @param string $password
     * @return boolean
     */
    public function login(string $username, string $password): bool
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
     * @return int|null
     */
    public function logged(): ?int
    {
        return Session::get('auth');
    }

    /**
     *
     * check access level needed for ressources
     *
     * @param int $userId
     * @return boolean
     */
    public function authorized(int $userId): bool
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

        $ressource = explode('/', filter_input(INPUT_GET, 'url'));
        $right = 1;
        if ($ressource[0] === 'admin') {
            $ressource = $ressource[1];
            $right = 3;

            if ($ressource === 'dash' || $ressource === 'posts' || $ressource === 'newpost') {
                $right = 2;
            }
        }

        if ($acessRight && $acessRight >= $right) {
            return true;
        }
        return false;
    }

    /***
     *
     * Generate a random token for prevent csrf
     *
     * @return string
     *
     */
    public function getCSRFToken(): string
    {
        return sha1(rand(42, 619) * time());
    }


}
