<?php

namespace App\Controller;

use Core\HTML\BootstrapForm;

class CommentsController extends AppController
{

    public function __construct()
    {
        parent::__construct();

    }

    //affiche tous les commentaires d'un article
    public function indexForArticle($postId)
    {

        $commentaires = $this->loadModel('Comment')->lastByArticle(htmlentities($postId));

        return $commentaires;
    }

}
