<?php

namespace App\Controller;

use Core\Auth\Auth;
use Core\Auth\Session;
use App\App;
use \Core\HTML\BootstrapForm;

class UsersController extends AppController
{

    public function login()
    {

        $error = null;
        $data = $this->inputEscaping();

        if (!empty($data)) {
            $auth = new Auth(App::getInstance()->getDb());

            $error = "identifiant Incorrect";
            $notification = $this->notify(null, null, $error);

            if ($auth->login($data['username'], $data['password'])) {
                header('Location: admin/dash');
            }

        }

        $form = new BootstrapForm($data);

        isset($notification) 
            ? $this->render('users.login', compact('form', 'notification')) 
            : $this->render('users.login', compact('form'));

    }

    public function logout()
    {
        if (Session::get('auth') !== null) {
            session_destroy();
            header('Location: ./ ');
        }

    }

    public function register()
    {

        $error = null;
        $validate = null;

        $userTable = $this->loadModel('User');
        $data = $this->inputEscaping();

        if (!empty($data)) {
            $result = null;
            if(!empty($data['firstname']) && !empty($data['lastname']) && !empty($data['username']) && !empty($data['password']) && !empty($data['email']) ){

                $result = $userTable->create([
                    'firstname' => $data['firstname'],
                    'lastname' => $data['lastname'],
                    'username' => $data['username'],
                    'password' => sha1($data['password']),
                    'email' => $data['email'],
                    'validate' => 0,
                ]);

            }

            $success = "Votre demande a bien été reçu et sera validée prochainement";
            $error = "Une erreur est survenue veuillez réessayer ultérieurement";
            $notification = $this->notify($result, $success, $error);

        }

        $form = new BootstrapForm($data);

        if(isset($notification)){
            $this->render('users.register', compact('form', 'notification'));
        } else {
            $this->render('users.register', compact('form'));
        }

        
    }
}
