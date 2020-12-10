<?php

namespace App\Controller;

class PostsController extends AppController
{

    public function __constrcut()
    {
        parent::construct();

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

        if(isset($_SESSION['auth'])){
            $addComment = new Admin\CommentsController();
            $form = $addComment->addComments($postId);

            $this->render('posts.show', compact('article', 'commentaires', 'form'));

        } else {
           $this->render('posts.show', compact('article', 'commentaires')); 
        }

    }

    //affiche tous les articles de la catégorie selectionnée
    public function categorie()
    {

        $categorie = $this->loadModel('Category')->find($_GET['id']);

        if ($categorie === false) {
            $this->notFound();
        }

        $articles = $this->loadModel('Post')->lastByCategorie($_GET['id']);

        $categories = $this->loadModel('Category')->all();

        $this->render('posts.categorie', compact('articles', 'categories', 'categorie'));

    }

}
