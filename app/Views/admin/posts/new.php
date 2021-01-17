<div class="row view_container">

    <div class="col-sm-12">

        <div class="row justify-content-center">

            <div class="card col-sm-12 col-md-6 col-lg-6 register">
                <div class="card-body">
                    <h5 class="card-title">Ajouter un article</h5>

                    <form method="post">
                        <?= filter_var($form->input('titre', 'titre de l\'article')); ?>

                        <?= isset($author) ? filter_var($form->select('autor', 'Auteur', $author)) : null; ?>

                        <?= filter_var($form->input('chapo', 'Chapo', ['type' => 'textarea'])); ?>

                        <?= filter_var($form->input('contenu', 'Contenu', ['type' => 'textarea'])); ?>

                        <input type="hidden" name="token" value="<?= filter_var(Core\Auth\Session::get('token'), FILTER_SANITIZE_STRING); ?>" />

                        <button class="btn btn-primary">Enregister</button>
                        <a href="dash" class="btn btn-info">Retour aux articles</a>
                    </form>


                </div>
                <?= !empty($notification) ? filter_var($notification) : null ?>
            </div>

        </div>

    </div>

</div>
