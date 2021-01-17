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
                $notification = $this->notify(null, null, $error);
            }

        }

        $form = new BootstrapForm($_POST);

        isset($notification) 
            ? $this->render('users.login', compact('form', 'notification')) 
            : $this->render('users.login', compact('form'));

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

            if(!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['email']) ){

                $result = $userTable->create([
                    'firstname' => htmlentities($_POST['firstname']),
                    'lastname' => htmlentities($_POST['lastname']),
                    'username' => htmlentities($_POST['username']),
                    'password' => sha1(htmlentities($_POST['password'])),
                    'email' => htmlentities($_POST['email']),
                    'validate' => 0,
                ]);

            } else {
                $result = null;
            }

            $success = "Votre demande a bien été reçu et sera validée prochainement";
            $error = "Une erreur est survenue veuillez réessayer ultérieurement";
            $notification = $this->notify($result, $success, $error);

        }

        $form = new BootstrapForm($_POST);

        if(isset($notification)){
            $this->render('users.register', compact('form', 'notification'));
        } else {
            $this->render('users.register', compact('form'));
        }

        
    }
}
