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
    protected function render(string $view, $variables = [])
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
    public function getNotification(string $message, string $type): string
    {
        $alert = new BootstrapAlert;
        return $alert->notification($message, $type);
    }

    /**
     *
     * Request the good type of alert according to params
     * (used as an abstract function to bind core classes and app)
     *
     * @param boolean|null $result
     * @param string|null $successAnswer
     * @param string|null $errorAnswer
     * @return string|null
     */
    public function notify(?bool $result, ?string $successAnswer, ?string $errorAnswer): ?string
    {
        $result === true
            ? $answer = $this->getNotification($successAnswer, 'success')
            : $answer = $this->getNotification($errorAnswer, 'danger');

        return $answer;
    }

    /**
     *
     * used as an abstract function to bind Security core class to App
     *
     * @return null|array
     */
    public function inputEscaping(): ?array
    {
        return Security::xss();
    }

    /**
     *
     * used as an abstract function to bind Security core class to App
     *
     * @return bool
     */
    public function checkTokenCSRF(): bool
    {
        return Security::csrf();
    }

}
