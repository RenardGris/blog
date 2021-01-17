<?php

namespace App\Controller\Admin;

use Core\HTML\BootstrapForm;
use App\App;

class UsersController extends \App\Controller\Admin\AppController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index($notification = null)
    {
        $unvalidateUsers = $this->loadModel('User')->unvalideUsers();
        $users = $this->loadModel('User')->valideUsers();
        $form = [];
        foreach ($users as $user) {
            $form[$user->id] = new BootstrapForm($user);
        }

        $this->render('admin.users.index', compact('unvalidateUsers', 'users', 'form', 'notification'));
    }

    public function validate()
    {

        $userTable = $this->loadModel('User');
        if (!empty($_POST)) {

            $data = $this->inputEscaping();

            $result = $userTable->update($data['id'], [
                'validate' => 1,
            ]);
            
            $success = "Utilisateur validé avec succès";
            $error = "Erreur lors de la validation de l'utilisateur";
            $notification = $this->notify($result, $success, $error);

            return $this->index($notification);
        }

    }

    public function delete()
    {
        $userTable = $this->loadModel('User');
        if (!empty($_POST)) {

            $data = $this->inputEscaping();

            $result = $userTable->delete($data['id']);

            $success = "Utilisateur supprimé avec succès";
            $error = "Erreur lors de la suppression de l'utilisateur";
            $notification = $this->notify($result, $success, $error);

            return $this->index($notification);
        }

    }

    public function changeRole()
    {
        $userTable = $this->loadModel('User');
        if (!empty($_POST)) {

            $data = $this->inputEscaping();

            $result = $userTable->update($data['id'], [
                'role' => $data['role'],
            ]);

            $success = "Changement du role utilisateur validé";
            $error = "Erreur lors du changement de role utilisateur";
            $notification = $this->notify($result, $success, $error);

            return $this->index($notification);
        }
    }

}
