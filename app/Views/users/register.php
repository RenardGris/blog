<form method="post">
    <?=$form->input('firstname', 'Prenom');?>
    <?=$form->input('lastname', 'Nom');?>
    <?=$form->input('username', 'Pseudo');?>
    <?=$form->input('password', 'Mot de passe', ['type' => 'password']);?>
    <?=$form->input('email', 'Email', ['type' => 'email']);?>
    <button class="btn btn-primary">Envoyer</button>
</form>

<?php
    if (isset($error)) {
        echo '<div class="alert alert-danger" style="margin-top:20px"> ' . $error . '</div>';
    } else if (isset($validate)) {
        echo '<div class="alert alert-success" style="margin-top:20px"> ' . $validate . '</div>';
    }
?>