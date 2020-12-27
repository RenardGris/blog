<form method="post">
    <?= filter_var($form->input('username', 'Pseudo')); ?>
    <?= filter_var($form->input('password', 'Mot de passe', ['type' => 'password'])); ?>
    <button class="btn btn-primary">Envoyer</button>
</form>

<a href="register">S'inscrire</a>


<?= !empty($notification) ? filter_var($notification) : null ?>


