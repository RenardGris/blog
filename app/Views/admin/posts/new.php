<form method="post">
    <?= $form->input('titre', 'titre de l\'article'); ?>

    <?= isset($redacteur) ? $form->select('autor', 'Auteur', $redacteur) : null; ?>

    <?= $form->input('chapo', 'Chapo', ['type' => 'textarea']); ?>

    <?= $form->input('contenu', 'Contenu', ['type' => 'textarea']); ?>

    <input type="hidden" name="token" value="<?= $_SESSION['token']; ?>" />

    <button class="btn btn-primary">Save</button>
</form>

<?php
if(isset($notification)){
    require ROOT . 'app/Views/notification/show.php';
}
?>