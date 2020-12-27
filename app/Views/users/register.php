<form method="post">
    <?=filter_var($form->input('firstname', 'Prenom'));?>
    <?=filter_var($form->input('lastname', 'Nom'));?>
    <?=filter_var($form->input('username', 'Pseudo'));?>
    <?=filter_var($form->input('password', 'Mot de passe', ['type' => 'password']));?>
    <?=filter_var($form->input('email', 'Email', ['type' => 'email']));?>
    <button class="btn btn-primary">Envoyer</button>
</form>

<?php
if(isset($notification)){
    require ROOT . 'app/Views/notification/show.php';
}
?>