<?php

namespace Core\Controller;

use Core\HTML\BootstrapAlert;
use Core\Security\Security;

class Controller
{

    protected $viewPath;
    protected $template;

    protected function render($view, $variables = [])
    {
        ob_start();
        extract($variables);
        require $this->viewPath . str_replace('.', '/', $view) . '.php';
        $content = ob_get_clean();
        require $this->viewPath . 'templates/' . $this->template . '.php';

    }

    protected function notFound()
    {
        header("HTTP/1.0 404 Not Found");
        header('location:index.php');

    }

    public function getNotification($message, $type){

        $alert = new BootstrapAlert;
        return $alert->notification($message, $type);

    }

    public function notify($result , $successAnswer, $errorAnswer ){

        isset($result) && $result === true 
            ? $answer = $this->getNotification($successAnswer, 'success')
            : $answer = $this->getNotification($errorAnswer, 'danger');

        return $answer;
    }

}
