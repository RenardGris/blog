<?php 

if(Core\Auth\Session::get('auth') !== null){
    $form = $formComment[0];
    if(isset($formComment[1]) === true) {
        $notification = $formComment[1];
    }

?>
<div class="row">

    <div class="col-sm-12">

        <div class="row">

            <div class="card my-4">
                <h5 class="card-header">Poster un commentaire</h5>
                <div class="card-body">
                    <form method="post">
                        <?= filter_var($form->input('titre', 'titre de l\'article')); ?>
                        <?= filter_var($form->input('contenu', 'Contenu', ['type' => 'textarea'])); ?>
                        <input type="hidden" name="token" value="<?= filter_var(Core\Auth\Session::get('token'), FILTER_SANITIZE_STRING); ?>" />
                        <button class="btn btn-primary">Commenter</button>
                    </form>
                </div>
            </div>

        </div>

    </div>

</div>

<?php
}
?>

<?= !empty($notification) ? filter_var($notification) : null ?>