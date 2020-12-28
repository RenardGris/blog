<?php

namespace Core\Controller;

use Core\HTML\BootstrapAlert;
use Core\Security\Security;

/**
 * Class Controller
 * Manage Core Classes bind to the App
 *
 */
class Controller
{

    protected $viewPath;
    protected $template;

    /**
     *
     * Make render of the content in the view
     *
     * @param string $view
     * @param array $variables
     */
    protected function render($view, $variables = [])
    {
        ob_start();
        extract($variables);
        require $this->viewPath . str_replace('.', '/', $view) . '.php';
        $content = ob_get_clean();
        require $this->viewPath . 'templates/' . $this->template . '.php';

    }

    /**
     *
     * function used to generate a html alert from BootstrapAlert with params
     *
     * @param string $message
     * @param string $type
     * @return string
     */
    public function getNotification($message, $type){

        $alert = new BootstrapAlert;
        return $alert->notification($message, $type);

    }

    /**
     *
     * Request the good type of alert according to params
     * (used as an abstract function to bind core classes and app)
     *
     * @param boolean $result
     * @param string $successAnswer
     * @param string $errorAnswer
     * @return string
     */
    public function notify($result , $successAnswer, $errorAnswer ){

        isset($result) && $result === true 
            ? $answer = $this->getNotification($successAnswer, 'success')
            : $answer = $this->getNotification($errorAnswer, 'danger');

        return $answer;
    }

    /**
     *
     * used as an abstract function to bind Security core class to App
     *
     * @return array
     */
    public function inputEscaping(){
        return Security::xss();
    }

    /**
     *
     * used as an abstract function to bind Security core class to App
     *
     * @return bool
     */
    public function checkTokenCSRF(){
        return Security::csrf();
    }

}
