<?php

namespace App\Controller\Admin;

use Core\HTML\BootstrapForm;
use App\App;

class PostsController extends \App\Controller\Admin\AppController
{

    private $categories;

    public function __construct()
    {
        parent::__construct();
    }

    public function index($notification = null)
    {
        $posts = $this->loadModel('Post')->all();

        isset($notification) 
            ? $this->render('admin.posts.index', compact('posts', 'notification'))
            : $this->render('admin.posts.index', compact('posts'));
    }

    public function add()
    {
        
        $postTable = $this->loadModel('Post');
        $categoriesTable = $this->loadModel('Category');

        if (!empty($_POST)) {

            $data = $this->inputEscaping();

            if( !empty($data['titre']) && !empty($data['chapo']) && !empty($data['contenu']) ) {

                $result = $postTable->create([
                    'titre' => $data['titre'],
                    'chapo' => $data['chapo'],
                    'contenu' => $data['contenu'],
                    'autor' => $_SESSION['auth'],
                    'date' => date('Y-m-d H:i:s'),

                    'categorie_id' => 1
    
                ]);

            } else {
                $result = null;
            }

            $success = "Article ajouté avec succès";
            $error = "Erreur lors de l'ajout de l'article";
            $notification = $this->notify($result, $success, $error);

            if ($result) {
                $id = App::getInstance()->getDb()->lastInsertId();
            }

        }

        $form = new BootstrapForm($_POST);

        isset($notification) 
            ? $this->render('admin.posts.new', compact('form', 'notification'))
            : $this->render('admin.posts.new', compact('form'));

    }

    public function edit($id)
    {
        
        $postTable = $this->loadModel('Post');
        $userTable = $this->loadModel('User');

        if(!$postTable->find(htmlentities($id))){
            $this->notFound();
        }
           
        $response = false;

        if (!empty($_POST)) {

            $data = $this->inputEscaping();

            if( !empty($data['titre']) && !empty($data['chapo']) && !empty($data['contenu']) && !empty($data['autor']) ) {

                $result = $postTable->update(htmlentities($id), [
                    'titre' => $data['titre'],
                    'chapo' => $data['chapo'],
                    'contenu' => $data['contenu'],
                    'autor' => $data['autor'],
                    'date' => date('Y-m-d H:i:s')
                ]);

            } else {
                $result = null;
            }

            $success = "Article modifié avec succès";
            $error = "Erreur lors de la modification de l'article";
            $notification = $this->notify($result, $success, $error);

        }

        $article = $postTable->find($id);

        $valideUsers = $userTable->valideUsers();
        $redacteur = $userTable->objList('id', 'username', $valideUsers);

        $form = new BootstrapForm($article);

        isset($notification) 
        ? $this->render('admin.posts.edit', compact('redacteur', 'form', 'article', 'notification'))
        : $this->render('admin.posts.edit', compact('redacteur', 'form', 'article'));

    }

    public function delete()
    {
        $postTable = $this->loadModel('Post');
        if (!empty($_POST)) {

            $data = $this->inputEscaping();

            $result = $postTable->delete($data['id']);
           
            $success = "Article supprimé avec succès";
            $error = "Erreur lors de la suppression de l'article";
            $notification = $this->notify($result, $success, $error);

            return $this->index($notification);
        }

    }

}
