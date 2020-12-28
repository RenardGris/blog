<?php


namespace App\Controller;


class ErrorController extends AppController
{

    /**
     * ErrorController constructor.
     */
    public function __construct()
    {
        parent::__construct();

    }

    /**
     *
     * used to show an error msg in \View\error\index
     * (As a 401 if the user haven't access right
     * or 404 if the request ressource is undefined)
     *
     * @param string $error
     */
    public function index (string $error) {

        $this->render('error.index', compact('error'));

    }

}