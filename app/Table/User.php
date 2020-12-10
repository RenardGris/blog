<?php

namespace App\Table;

use Core\Table\Table;

class User extends Table
{

    protected $table = "users";

    /**
     * recupère tous les utilisateurs (en attente de validation)
     * @return array
     */
    public function unvalideUsers()
    {
        return $this->query("
        SELECT *
        FROM users
        WHERE validate = ?",
        [0]);
    }

    public function valideUsers()
    {
        return $this->query("
        SELECT *
        FROM users
        WHERE validate = ?",
        [1]);
    }


}
