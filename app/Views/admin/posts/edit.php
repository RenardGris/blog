<!-- <h3>Modifier l'article N° <?= $article->id ?></h3> -->


<form method="post">
    <?= $form->input('titre', 'titre de l\'article'); ?>

    <?= isset($redacteur) ? $form->select('autor', 'Auteur', $redacteur) : null; ?>

    <?= $form->input('chapo', 'Chapo', ['type' => 'textarea']); ?>

    <?= $form->input('contenu', 'Contenu', ['type' => 'textarea']); ?>
    <button class="btn btn-primary">Save</button>
</form>

<?php
if(isset($notification)){
    require ROOT . 'app/Views/notification/show.php';
}
?>