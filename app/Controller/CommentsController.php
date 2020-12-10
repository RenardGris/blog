<?php

namespace App\Controller;

use Core\HTML\BootstrapForm;

class CommentsController extends AppController
{

    public function __constrcut()
    {
        parent::construct();
        // $this->loadModel('Articles');
        // $this->loadModel('Categories');

    }

    //affiche tous les commentaires d'un article
    public function indexForArticle($postId)
    {

        $commentaires = $this->loadModel('Comment')->lastByArticle(htmlentities($postId));

        return $commentaires;
    }

}
