<?php

namespace App\Controller\Admin;

use Core\Auth\Session;
use Core\HTML\BootstrapForm;
use App\App;

class PostsController extends \App\Controller\Admin\AppController
{


    public function __construct()
    {
        parent::__construct();
    }

    /**
     *
     * Index all posts with notification if isset
     *
     * return render in Core\Controller\Controller with \Views\admin\posts\index
     *
     * @param null|string $notification
     */
    public function index($notification = null)
    {
        $posts = $this->loadModel('Post')->all();

        isset($notification) 
            ? $this->render('admin.posts.index', compact('posts', 'notification'))
            : $this->render('admin.posts.index', compact('posts'));
    }

    /**
     *
     * Create new post
     *
     * return render in Core\Controller\Controller with \Views\admin\posts\add
     * with success alert if true, danger alert in case of error
     *
     */
    public function add()
    {
        
        $postTable = $this->loadModel('Post');
        $data = $this->inputEscaping();

        if (!empty($data)) {
            $result = null;
            if( !empty($data['titre']) && !empty($data['chapo']) && !empty($data['contenu']) ) {

                $result = $postTable->create([
                    'titre' => $data['titre'],
                    'chapo' => $data['chapo'],
                    'contenu' => $data['contenu'],
                    'autor' => Session::get('auth'),
                    'date' => date('Y-m-d H:i:s'),

                    'categorie_id' => 1

                ]);
            }

            $success = "Article ajouté avec succès";
            $error = "Erreur lors de l'ajout de l'article";
            $notification = $this->notify($result, $success, $error);

        }

        $form = new BootstrapForm($data);

        isset($notification) 
            ? $this->render('admin.posts.new', compact('form', 'notification'))
            : $this->render('admin.posts.new', compact('form'));

    }

    /**
     *
     * Edit the post with the id = $id
     *
     * return render in Core\Controller\Controller with \Views\admin\posts\edit
     * with success alert if true, danger alert in case of error
     *
     * @param int $id
     */
    public function edit($id)
    {
        
        $postTable = $this->loadModel('Post');
        $userTable = $this->loadModel('User');

        if(!$postTable->find(htmlentities($id))){
            $this->notFound();
        }

        $data = $this->inputEscaping();
        if (!empty($data)) {
            $result = null;
            if( !empty($data['titre']) && !empty($data['chapo']) && !empty($data['contenu']) && !empty($data['autor']) ) {

                $result = $postTable->update(htmlentities($id), [
                    'titre' => $data['titre'],
                    'chapo' => $data['chapo'],
                    'contenu' => $data['contenu'],
                    'autor' => $data['autor'],
                    'date' => date('Y-m-d H:i:s')
                ]);
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

    /**
     * Delete the specified post
     *
     * return render from $this->index
     * with success alert if true, danger alert in case of error
     *
     */
    public function delete()
    {
        $postTable = $this->loadModel('Post');

        $data = $this->inputEscaping();
        if (isset($data['id'])) {

            $result = $postTable->delete($data['id']);
           
            $success = "Article supprimé avec succès";
            $error = "Erreur lors de la suppression de l'article";
            $notification = $this->notify($result, $success, $error);

            return $this->index($notification);
        }

    }

}
