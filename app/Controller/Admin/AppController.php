<?php

namespace App\Controller\Admin;

use App\App;
use Core\Auth\Auth;
use Core\Auth\Session;

class AppController extends \App\Controller\AppController
{

    /**
     * AppController constructor.
     *
     * check if user is logged and if has access right,
     * if not, redirect with unauthorized error
     *
     * also check tokens if isset
     *
     */
    public function __construct()
    {
        parent::__construct();

        $app = App::getInstance();
        $auth = new Auth($app->getDb());

        if (!$auth->logged() || !$auth->authorized(Session::get('auth'))) {
            header('Location: ' . $app->getBaseUrl() . 'unauthorized');
        }

        $this->hasToken();
    }

}
