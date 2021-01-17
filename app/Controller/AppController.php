<?php

namespace App\Controller;

use Core\Controller\Controller;
use App\App;

class AppController extends Controller
{

    protected $template = 'default';

    public function __construct()
    {
        $this->viewPath = ROOT . '/app/Views/';
        $this->hasToken();
    }

    protected function loadModel($modelName)
    {
        return App::getInstance()->getTable($modelName);
    }

    protected function hasToken(){
        if(isset($_POST['token'])){
            if($this->checkTokenCSRF() !== true) {
                header('Location: ' . App::getInstance()->getBaseUrl() . 'unauthorized');
                exit();
            }
        }
    }

}
