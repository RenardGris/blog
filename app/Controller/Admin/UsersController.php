<?php

namespace App\Controller\Admin;

use Core\HTML\BootstrapForm;
use App\App;

class UsersController extends \App\Controller\Admin\AppController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $unvalidateUsers = $this->loadModel('User')->unvalideUsers();
        $users = $this->loadModel('User')->valideUsers();
        $form = [];
        foreach ($users as $user) {
            $form[$user->id] = new BootstrapForm($user);
        }

        $this->render('admin.users.index', compact('unvalidateUsers', 'users', 'form'));
    }

    public function validate()
    {

        $userTable = $this->loadModel('User');
        if (!empty($_POST)) {
            $result = $userTable->update($_POST['id'], [
                'validate' => 1,
            ]);
            return $this->index();
        }

    }

    public function delete()
    {
        $userTable = $this->loadModel('User');
        if (!empty($_POST)) {
            $userTable->delete($_POST['id']);
        }
        return $this->index();

    }

    public function changeRole()
    {
        $userTable = $this->loadModel('User');
        if (!empty($_POST)) {
            $result = $userTable->update($_POST['id'], [
                'role' => htmlentities($_POST['role']),
            ]);
            return $this->index();
        }
    }

}
