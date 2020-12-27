<form method="post">
    <?= filter_var($form->input('username', 'Pseudo')); ?>
    <?= filter_var($form->input('password', 'Mot de passe', ['type' => 'password'])); ?>
    <button class="btn btn-primary">Envoyer</button>
</form>

<a href="register">S'inscrire</a>


<?php
if(isset($notification)){
    require ROOT . 'app/Views/notification/show.php';
} 
?>



