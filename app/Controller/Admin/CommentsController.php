<?php

namespace App\Controller\Admin;

use Core\Auth\Session;
use Core\HTML\BootstrapForm;

class CommentsController extends AppController
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
        $comments = $this->loadModel('Comment')->unvalidComments();
        $this->render('admin.comments.index', compact('comments', 'notification'));
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
    public function addComments(int $postId)
    {
        $commentTable = $this->loadModel('Comment');

        $data = $this->inputEscaping();

        if (!empty($data)) {
            $result = null;
            if (!empty($data['titre']) && !empty($data['contenu'])) {
                $result = $commentTable->create([
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

        $resources = [];
        $resources[0] = $form;

        if (isset($notification)) {
            $resources[1] = $notification;
        }

        $post = $this->loadModel('Post')->findWithComments(htmlentities($postId));
        $commentController = new \App\Controller\CommentsController();
        $comments = $commentController->indexForArticle($postId);
        $formComment = $resources;
        $this->render('posts.show', compact('post', 'comments', 'formComment'));
    }

}
