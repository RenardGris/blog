<?php

namespace App\Controller;

use Core\HTML\BootstrapForm;

class CommentsController extends AppController
{

    public function __construct()
    {
        parent::__construct();

    }


    /**
     *
     * index all comments from the post with id = $postId
     *
     * @param int $postId
     * @return array
     */
    public function indexForArticle($postId)
    {

        $commentaires = $this->loadModel('Comment')->lastByArticle(htmlentities($postId));

        return $commentaires;
    }

}
