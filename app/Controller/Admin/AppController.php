<?php

namespace App\Controller\Admin;

use App\App;
use Core\Auth\Auth;

class AppController extends \App\Controller\AppController
{

    public function __construct()
    {
        parent::__construct();

        $app = App::getInstance();
        $auth = new Auth($app->getDb());

        if (!$auth->logged() || !$auth->authorized($_SESSION['auth'])) {
            header('Location: ' . $app->getBaseUrl() . 'unauthorized');
            exit();
        }

    }

}
