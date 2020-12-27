<?php

namespace App\Controller\Admin;

use App\App;
use Core\Auth\Session;
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
        $data = $this->inputEscaping();
        if (!empty($data['id'])) {

            $result = $commentTable->update($data['id'], [
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
        $data = $this->inputEscaping();
        if (!empty($data['id'])) {

            $result = $commentTable->delete($data['id']);
            
            $success = "Commentaire supprimé avec succès";
            $error = "Erreur lors de la suppression du commentaire";
            $notification = $this->notify($result, $success, $error);
            
            return $this->index($notification);
        }

    }

    public function addComments($postId)
    {
        $commentaireTable = $this->loadModel('Comment');

        $data = $this->inputEscaping();

        if (!empty($data)) {

            if(!empty($data['titre']) && !empty($data['contenu']) ){

                $result = $commentaireTable->create([
                    'titre' => $data['titre'],
                    'contenu' => $data['contenu'],
                    'article_id' => $postId,
                    'user_id' => Session::get('auth')
                ]);

            } else {
                $result = null;
            }
            
            $success = "Commentaire en cours de vérification";
            $error = "Erreur lors de l'ajout du commentaire";
            $notification = $this->notify($result, $success, $error);
           
        }

        $form = new BootstrapForm($data);

        $ressources = [];
        $ressources[0] = $form;

        isset($notification) 
            ? $ressources[1] = $notification
            : $ressources;

        return $ressources;
    }

}
