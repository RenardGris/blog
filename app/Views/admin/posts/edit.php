<!-- <h3>Modifier l'article N° <?= filter_var($article->id, FILTER_SANITIZE_NUMBER_INT); ?></h3> -->


<form method="post">
    <?= filter_var($form->input('titre', 'titre de l\'article')); ?>

    <?= isset($redacteur) ? filter_var($form->select('autor', 'Auteur', $redacteur)) : null; ?>

    <?= filter_var($form->input('chapo', 'Chapo', ['type' => 'textarea'])); ?>

    <?= filter_var($form->input('contenu', 'Contenu', ['type' => 'textarea'])); ?>

    <input type="hidden" name="token" value="<?= filter_var(Core\Auth\Session::get('token'), FILTER_SANITIZE_STRING); ?>" />

    <button class="btn btn-primary">Save</button>
</form>

<?php
if(isset($notification)){
    require ROOT . 'app/Views/notification/show.php';
}
?>