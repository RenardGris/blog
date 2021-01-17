<?php

namespace App\Controller\Admin;

use App\App;
use Core\HTML\BootstrapForm;
use App\Controller\ArticlesController;

class CommentsController extends \App\Controller\Admin\AppController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index($notification = null)
    {
        $commentaires = $this->loadModel('Comment')->unvalideComments();
        $this->render('admin.comments.index', compact('commentaires', 'notification'));
    }

    public function validate()
    {

        $commentTable = $this->loadModel('Comment');
        if (!empty($_POST)) {
            $result = $commentTable->update($_POST['id'], [
                'valide' => 1,
            ]);

            $success = "Commentaire validé avec succès";
            $error = "Erreur lors de la validation du commentaire";
            $notification = $this->notify($result, $success, $error);

            return $this->index($notification);
        }

    }

    public function delete()
    {
        $commentTable = $this->loadModel('Comment');
        if (!empty($_POST)) {

            $result = $commentTable->delete($_POST['id']);
            
            $success = "Commentaire supprimé avec succès";
            $error = "Erreur lors de la suppression du commentaire";
            $notification = $this->notify($result, $success, $error);
            
            return $this->index($notification);
        }

    }

    public function addComments($postId)
    {
        $commentaireTable = $this->loadModel('Comment');

        if (!empty($_POST)) {

            if(!empty($_POST['titre']) && !empty($_POST['contenu']) ){

                $result = $commentaireTable->create([
                    'titre' => htmlentities($_POST['titre']),
                    'contenu' => htmlentities($_POST['contenu']),
                    'article_id' => htmlentities($postId),
                    'user_id' => htmlentities($_SESSION['auth'])
                ]);

            } else {
                $result = null;
            }
            
            $success = "Commentaire en cours de vérification";
            $error = "Erreur lors de l'ajout du commentaire";
            $notification = $this->notify($result, $success, $error);
           
        }

        $form = new BootstrapForm($_POST);

        $ressources = [];
        $ressources[0] = $form;

        isset($notification) 
            ? $ressources[1] = $notification
            : $ressources;

        return $ressources;
    }

}
