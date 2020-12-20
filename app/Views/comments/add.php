<?php 

if(isset($_SESSION['auth'])){
    $form = $formComment[0];

?>

<form method="post">
    <?= $form->input('titre', 'titre de l\'article'); ?>
    <?= $form->input('contenu', 'Contenu', ['type' => 'textarea']); ?>
    <input type="hidden" name="token" value="<?= $_SESSION['token']; ?>" />
    <button class="btn btn-primary">Commenter</button>
</form>

<?php
}
?>

<?php
    if(isset($formComment[1]) === true) {
        $notification = $formComment[1];
        if(isset($notification)){
            require ROOT . 'app/Views/notification/show.php';
        }
    }
?>