<form method="post">
    <?=$form->input('firstname', 'Prenom');?>
    <?=$form->input('lastname', 'Nom');?>
    <?=$form->input('username', 'Pseudo');?>
    <?=$form->input('password', 'Mot de passe', ['type' => 'password']);?>
    <?=$form->input('email', 'Email', ['type' => 'email']);?>
    <button class="btn btn-primary">Envoyer</button>
</form>

<?php
if(isset($notification)){
    require ROOT . 'app/Views/notification/show.php';
}
?>