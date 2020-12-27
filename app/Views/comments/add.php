<?php 

if(Core\Auth\Session::get('auth') !== null){
    $form = $formComment[0];

?>

<form method="post">
    <?= filter_var($form->input('titre', 'titre de l\'article')); ?>
    <?= filter_var($form->input('contenu', 'Contenu', ['type' => 'textarea'])); ?>
    <input type="hidden" name="token" value="<?= filter_var(Core\Auth\Session::get('token'), FILTER_SANITIZE_STRING); ?>" />
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