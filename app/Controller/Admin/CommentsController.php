<?php

namespace App\Controller\Admin;

use App\App;
use Core\HTML\BootstrapForm;
use App\Controller\ArticlesController;

class CommentsController extends \App\Controller\Admin\AppController
{

    public function __constrcut()
    {
        parent::construct();
    }

    public function index()
    {
        $commentaires = $this->loadModel('Comment')->unvalideComments();
        $this->render('admin.comments.index', compact('commentaires'));
    }

    public function validate()
    {

        $commentTable = $this->loadModel('Comment');
        if (!empty($_POST)) {
            $result = $commentTable->update($_POST['id'], [
                'valide' => 1,
            ]);
            return $this->index();
        }

    }

    public function delete()
    {
        $commentTable = $this->loadModel('Comment');
        if (!empty($_POST)) {

            $commentTable->delete($_POST['id']);
            return $this->index();

        }

    }

    public function addComments($postId)
    {
        $commentaireTable = $this->loadModel('Comment');

        if (!empty($_POST)) {

            $result = $commentaireTable->create([
                'titre' => htmlentities($_POST['titre']),
                'contenu' => htmlentities($_POST['contenu']),
                'article_id' => htmlentities($postId),
            ]);

        }

        $form = new BootstrapForm($_POST);

        return $form;
    }

}
