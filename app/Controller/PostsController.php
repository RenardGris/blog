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

    //Affiche tous les articles
    public function index()
    {

        $posts = $this->loadModel('Post')->last();
        $categories = $this->loadModel('Category')->all();
        $this->render('posts.index', compact('posts', 'categories'));

    }

    //Affiche l'article selectionné
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

    //affiche tous les articles de la catégorie selectionnée
    public function categorie()
    {

        $categoryId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $categorie = $this->loadModel('Category')->find($categoryId);

        if ($categorie === false) {
            $this->notFound();
        }

        $articles = $this->loadModel('Post')->lastByCategorie($categoryId);

        $categories = $this->loadModel('Category')->all();

        $this->render('posts.categorie', compact('articles', 'categories', 'categorie'));

    }

}
