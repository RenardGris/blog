<?php

namespace App\Controller;

use Core\Auth\Session;
use Core\HTML\BootstrapForm;

class PostsController extends AppController
{

    public function __construct()
    {
        parent::__construct();

    }

    /**
     * Index all the PostEntity
     * return render in \Views\post\index
     *
     */
    public function index()
    {

        $posts = $this->loadModel('Post')->last();
        $this->render('posts.index', compact('posts'));

    }


    /**
     * Show the selected PostEntity
     * with its comments and new comment form if user is logged
     * return render in \Views\post\show
     *
     * @param int $postId
     */
    public function show($postId)
    {

        $article = $this->loadModel('Post')->findWithCategorie(htmlentities($postId));

        if(!$article){
            $this->notFound();
        }

        $commentary = new CommentsController();
        $commentaires = $commentary->indexForArticle($postId);

        if(Session::get('auth') !== null){
            $formComment = array(new BootstrapForm());
            $this->render('posts.show', compact('article', 'commentaires', 'formComment'));
        } else {
           $this->render('posts.show', compact('article', 'commentaires')); 
        }

    }

}
