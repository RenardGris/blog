<form method="post">
    <?= $form->input('username', 'Pseudo'); ?>
    <?= $form->input('password', 'Mot de passe', ['type' => 'password']); ?>
    <button class="btn btn-primary">Envoyer</button>
</form>

<a href="register">S'inscrire</a>


<?php
    if(isset($error)) {
        echo '<div class="alert alert-danger" style="margin-top:20px"> '.$error.'</div>';        
    }    
?>



