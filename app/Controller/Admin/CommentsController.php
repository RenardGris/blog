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

    /**
     *
     * list all comments waiting for verification with notification alert if isset
     *
     * return render in Core\Controller\Controller with \Views\admin\comments\index
     *
     * @param null|string $notification
     */
    public function index($notification = null)
    {
        $commentaires = $this->loadModel('Comment')->unvalideComments();
        $this->render('admin.comments.index', compact('commentaires', 'notification'));
    }

    /**
     * Valid the specified comment
     *
     * return render from $this->index
     * with notification according to result
     */
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

    /**
     * Delete the specified comment
     *
     * return render from $this->index
     * with success alert if true,
     * else with danger alert
     */
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

    /**
     *
     * Create a new comment
     *
     * return render in \Core\Controller\Controller with \Views\posts\show
     * with success alert if true, else danger alert
     *
     * @param int $postId
     */
    public function addComments($postId)
    {
        $commentaireTable = $this->loadModel('Comment');

        $data = $this->inputEscaping();

        if (!empty($data)) {
            $result = null;
            if(!empty($data['titre']) && !empty($data['contenu']) ){

                $result = $commentaireTable->create([
                    'titre' => $data['titre'],
                    'contenu' => $data['contenu'],
                    'article_id' => $postId,
                    'user_id' => Session::get('auth')
                ]);
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


        $article = $this->loadModel('Post')->findWithCategorie(htmlentities($postId));
        $comment = new \App\Controller\CommentsController();
        $commentaires = $comment->indexForArticle($postId);
        $formComment = $ressources;
        $this->render('posts.show', compact('article', 'commentaires', 'formComment'));
    }

}
