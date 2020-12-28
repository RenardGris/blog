<?php

namespace App\Controller;

use Core\Controller\Controller;
use App\App;

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
    protected function loadModel($modelName)
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
    protected function hasToken(){
        if(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING)){
            if($this->checkTokenCSRF() !== true) {
                header('Location: ' . App::getInstance()->getBaseUrl() . 'unauthorized');
            }
        }
    }

}
