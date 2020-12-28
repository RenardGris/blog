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

    /**
     *
     * list all users in two arrays according to the type (valid or waiting for validation)
     * foreach valid user generate a form attached to the user id
     *
     * render \Views\admin\users\index
     *
     * @param null|string $notification
     */
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

    /**
     * Valid the specified user
     *
     * return render from $this->index
     */
    public function validate()
    {

        $userTable = $this->loadModel('User');
        $data = $this->inputEscaping();
        if (isset($data['id'])) {

            $result = $userTable->update($data['id'], [
                'validate' => 1,
            ]);
            
            $success = "Utilisateur validé avec succès";
            $error = "Erreur lors de la validation de l'utilisateur";
            $notification = $this->notify($result, $success, $error);

            return $this->index($notification);
        }

    }

    /**
     * Delete the specified users
     *
     * return render from $this->index
     */
    public function delete()
    {
        $userTable = $this->loadModel('User');
        $data = $this->inputEscaping();

        if (isset($data['id'])) {

            $result = $userTable->delete($data['id']);

            $success = "Utilisateur supprimé avec succès";
            $error = "Erreur lors de la suppression de l'utilisateur";
            $notification = $this->notify($result, $success, $error);

            return $this->index($notification);
        }

    }

    /**
     * Modified the role of the specified user
     *
     * return render from $this->index
     */
    public function changeRole()
    {
        $userTable = $this->loadModel('User');
        $data = $this->inputEscaping();

        if (!empty($data)) {

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
