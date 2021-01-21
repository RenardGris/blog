<?php

namespace App\Controller;

use Core\Auth\Auth;
use Core\Auth\Session;
use App\App;
use \Core\HTML\BootstrapForm;

class UsersController extends AppController
{

    /**
     *
     * used with the longin forms
     * check the input credentials value with login function in class \Core\Auth\Auth
     * if valid, redirect to the admin dashboard
     * else, render the view with danger alert as notification
     */
    public function login()
    {
        $error = null;
        $data = $this->inputEscaping();

        if (!empty($data)) {
            $auth = new Auth(App::getInstance()->getDb());

            $error = "identifiant Incorrect";
            $notification = $this->notify(null, null, $error);

            if ($auth->login($data['username'], $data['password'])) {
                $this->redirectTo("HTTP/1.0 303 See Other", "admin/dash");
            }
        }

        $form = new BootstrapForm($data);

        isset($notification)
            ? $this->render('users.login', compact('form', 'notification'))
            : $this->render('users.login', compact('form'));
    }

    /**
     *
     * disconnect the user
     * destroy the session and redirect to main page
     *
     */
    public function logout()
    {
        if (Session::get('auth') !== null) {
            session_destroy();
            $this->redirectTo("HTTP/1.0 303 See Other", "");
        }
    }

    /**
     *
     * Used with the register forms,
     * if all needed data are valid, save data in user table database and generate a success alert
     * else, generate danger alert
     * return a the new render of the register forms
     *
     */
    public function register()
    {
        $userTable = $this->loadModel('User');
        $data = $this->inputEscaping();

        if (!empty($data)) {
            $result = null;
            if (!empty($data['firstname']) && !empty($data['lastname']) && !empty($data['username']) && !empty($data['password']) && !empty($data['email'])) {
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

        if (isset($notification)) {
            $this->render('users.register', compact('form', 'notification'));
        } else {
            $this->render('users.register', compact('form'));
        }
    }
}
