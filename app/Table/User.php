<?php

namespace App\Table;

use Core\Table\Table;

class User extends Table
{

    protected $table = "users";

    /**
     *
     * list all the users waiting for validation
     *
     * @return array
     */
    public function unvalidUsers(): array
    {
        return $this->query("
        SELECT *
        FROM users
        WHERE validate = ?",
        [0]);
    }

    /**
     *
     * list all the valide users
     *
     * @return array
     */
    public function validUsers(): array
    {
        return $this->query("
        SELECT *
        FROM users
        WHERE validate = ?",
        [1]);
    }


}
