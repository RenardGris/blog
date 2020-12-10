<form method="post">
    <?= $form->input('titre', 'titre de l\'article'); ?>

    <?= isset($redacteur) ? $form->select('autor', 'Auteur', $redacteur) : null; ?>

    <?= $form->input('chapo', 'Chapo', ['type' => 'textarea']); ?>

    <?= $form->input('contenu', 'Contenu', ['type' => 'textarea']); ?>
    <button class="btn btn-primary">Save</button>
</form>

<?php
    if(isset($response) && $response === true) {
        echo '<div class="alert alert-success" style="margin-top:20px">Modifications sauvegardées</div>';
    }
?>