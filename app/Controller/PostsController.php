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
    public function show(int $postId)
    {

        $post = $this->loadModel('Post')->findWithComments(htmlentities($postId));

        if(!$post){
            $this->ressourceNotFound();
        }

        $commentController = new CommentsController();
        $comments = $commentController->indexForArticle($postId);

        if(Session::get('auth') !== null){
            $formComment = array(new BootstrapForm());
            $this->render('posts.show', compact('post', 'comments', 'formComment'));
        } else {
           $this->render('posts.show', compact('post', 'comments'));
        }

    }

}
