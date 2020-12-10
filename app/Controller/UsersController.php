<?php

namespace App\Controller;

use Core\Auth\Auth;
use App\App;
use \Core\HTML\BootstrapForm;

class UsersController extends AppController
{

    public function login()
    {

        $error = null;

        if (!empty($_POST)) {
            $auth = new Auth(App::getInstance()->getDb());

            if ($auth->login(htmlentities($_POST['username']), htmlentities($_POST['password']))) {
                header('Location: admin/dash');
            } else {
                $error = "identifiant Incorrect";
            }

        }

        $form = new BootstrapForm($_POST);

        $this->render('users.login', compact('form', 'error'));

    }

    public function logout()
    {
        if (!empty($_SESSION['auth'])) {
            session_destroy();
            header('Location: ./ ');
        }

    }

    public function register()
    {

        $error = null;
        $validate = null;

        $userTable = $this->loadModel('User');

        if (!empty($_POST)) {

            $result = $userTable->create([
                'firstname' => htmlentities($_POST['firstname']),
                'lastname' => htmlentities($_POST['lastname']),
                'username' => htmlentities($_POST['username']),
                'password' => sha1(htmlentities($_POST['password'])),
                'email' => htmlentities($_POST['email']),
                'validate' => 0,
            ]);

            if ($result) {
                $validate = "Votre demande a bien été reçu et sera validée prochainement";
            } else {
                $error = "Une erreur est survenue veuillez réessayer ultérieurement";
            }

        }

        $form = new BootstrapForm($_POST);

        $this->render('users.register', compact('form', 'error', 'validate'));

    }
}
