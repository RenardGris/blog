<?php 

if(isset($_SESSION['auth'])){
?>

<form method="post">
    <?= $form->input('titre', 'titre de l\'article'); ?>
    <?= $form->input('contenu', 'Contenu', ['type' => 'textarea']); ?>
    <button class="btn btn-primary">Commenter</button>
</form>

<?php
}
?>

<?php
    if(isset($result) === true) {
        echo '<div class="alert alert-success" style="margin-top:20px">Modifications sauvegardées</div>';
    }
?>