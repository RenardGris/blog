<?php

namespace App\Controller;

use Core\Controller\Controller;
use App\App;
use Core\HTML\BootstrapForm;

class AppController extends Controller
{

    protected $template = 'default';

    /**
     * AppController constructor.
     *
     * define path to views
     * and check token if isset before launch the requested function
     *
     */
    public function __construct()
    {
        $this->viewPath = ROOT . '/app/Views/';
        $this->hasToken();
    }

    /**
     * Factory to obtain an instance of \Table Class $modelName
     *
     * @param string $modelName
     * @return mixed (\Table Class $modelName)
     */
    protected function loadModel(string $modelName)
    {
        return App::getInstance()->getTable($modelName);
    }

    /**
     *
     * Check token in forms
     * if tokens can't match, redirect with unauthoried error msg
     * else, continue
     *
     */
    protected function hasToken()
    {
        if (filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)) {
            if ($this->checkTokenCSRF() !== true) {
                header('Location: ' . App::getInstance()->getBaseUrl() . 'unauthorized');
            }
        }
    }

    /**
     * in case the request ressource is undefined
     * redirect with notfound error msg
     *
     */
    protected function ressourceNotFound()
    {
        header("HTTP/1.0 404 Not Found");
        header('location:' . App::getInstance()->getBaseUrl() . 'notfound');
    }


    public function home()
    {
        $data = $this->inputEscaping();

        if (!empty($data)) {
            $result = null;
            if (!empty($data['firstname']) &&
                !empty($data['lastname']) &&
                !empty($data['email']) &&
                !empty($data['content']) &&
                !empty($data['subject'])) {
                $contact = "Nom : " . $data['lastname'] . "\r\n" .
                    "Prenom : " . $data['firstname'] . "\r\n" .
                    "Mail : " . $data['email'];
                $content = "Contact : " . $contact . "\r\n" .
                    "Message : " . $data['content'];
                $header = "From: " . $data['email'] . "\r\n";

                $result = mail(
                    "rick.srz4@gmail.com",
                    $data['subject'],
                    $content,
                    $header
                );
            }

            $success = "C'est dans la boite !";
            $error = "Une erreur est survenue veuillez réessayer ultérieurement";
            $notification = $this->notify($result, $success, $error);
        }

        $form = new BootstrapForm();

        if (isset($notification)) {
            $this->render('home.home', compact('form', 'notification'));
        } else {
            $this->render('home.home', compact('form'));
        }
    }


}
