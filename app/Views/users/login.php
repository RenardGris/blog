<form method="post">
    <?= $form->input('username', 'Pseudo'); ?>
    <?= $form->input('password', 'Mot de passe', ['type' => 'password']); ?>
    <button class="btn btn-primary">Envoyer</button>
</form>

<a href="register">S'inscrire</a>


<?php
if(isset($notification)){
    require ROOT . 'app/Views/notification/show.php';
} 
?>



