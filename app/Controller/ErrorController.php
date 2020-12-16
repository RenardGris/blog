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

    public function index ($error) {

        $this->render('error.index', compact('error'));

    }

}