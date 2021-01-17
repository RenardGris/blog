<?php 

if(Core\Auth\Session::get('auth') !== null){
    $form = $formComment[0];
    if(isset($formComment[1]) === true) {
        $notification = $formComment[1];
    }

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

<?= !empty($notification) ? filter_var($notification) : null ?>