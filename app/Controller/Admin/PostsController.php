<?php

namespace App\Controller\Admin;

use Core\HTML\BootstrapForm;
use App\App;

class PostsController extends \App\Controller\Admin\AppController
{

    private $categories;

    public function __constrcut()
    {
        parent::construct();
    }

    public function index()
    {
        $posts = $this->loadModel('Post')->all();
        $this->render('admin.posts.index', compact('posts'));
    }

    public function add()
    {
        
        $postTable = $this->loadModel('Post');
        $categoriesTable = $this->loadModel('Category');

        if (!empty($_POST)) {

            $result = $postTable->create([
                'titre' => htmlentities($_POST['titre']),
                'chapo' => htmlentities($_POST['chapo']),
                'contenu' => htmlentities($_POST['contenu']),
                'autor' => $_SESSION['auth'],
                'date' => date('Y-m-d H:i:s'),

                'categorie_id' => 1

            ]);

            if ($result) {
                $id = App::getInstance()->getDb()->lastInsertId();
                header('Location: ./dash');
            }

        }

        $form = new BootstrapForm($_POST);

        $this->render('admin.posts.new', compact('form'));

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

            $result = $postTable->update(htmlentities($id), [
                'titre' => htmlentities($_POST['titre']),
                'chapo' => htmlentities($_POST['chapo']),
                'contenu' => htmlentities($_POST['contenu']),
                'autor' => htmlentities($_POST['autor']),
                'date' => date('Y-m-d H:i:s')
            ]);

            if ($result) {
                $response = true;
            }

        }

        $article = $postTable->find($id);

        $valideUsers = $userTable->valideUsers();
        $redacteur = $userTable->objList('id', 'username', $valideUsers);

        $form = new BootstrapForm($article);

        $this->render('admin.posts.edit', compact('redacteur', 'form', 'article', 'response'));

    }

    public function delete()
    {
        $postTable = $this->loadModel('Post');
        if (!empty($_POST)) {

            $postTable->delete(htmlentities($_POST['id']));
            header('Location: ./../dash');

        }

    }

}
