<div class="row view_container">

    <div class="col-sm-12">

        <div class="row justify-content-center">

                <div class="card col-sm-12 col-md-6 col-lg-3 register">
                    <div class="card-body">
                        <h5 class="card-title">Se connecter</h5>
                        <form method="post">
                            <?= filter_var($form->input('username', 'Pseudo')); ?>
                            <?= filter_var($form->input('password', 'Mot de passe', ['type' => 'password'])); ?>
                            <button class="btn btn-primary">Envoyer</button>
                        </form>
                        <a href="register">S'inscrire</a>
                    </div>
                    <?= !empty($notification) ? filter_var($notification) : null ?>
                </div>

        </div>

    </div>

</div>


