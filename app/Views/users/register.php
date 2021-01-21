<div class="row view_container">

    <div class="col-sm-12">

        <div class="row justify-content-center">

            <div class="card col-sm-12 col-md-6 col-lg-3 register">
                <div class="card-body">
                    <h5 class="card-title">S'enregister</h5>
                    <form method="post">
                        <?= filter_var($form->input('firstname', 'Prenom')); ?>
                        <?= filter_var($form->input('lastname', 'Nom')); ?>
                        <?= filter_var($form->input('username', 'Pseudo')); ?>
                        <?= filter_var($form->input('password', 'Mot de passe', ['type' => 'password'])); ?>
                        <?= filter_var($form->input('email', 'Email', ['type' => 'email'])); ?>
                        <button class="btn btn-primary">Envoyer</button>
                    </form>
                </div>
                <?= !empty($notification) ? filter_var($notification) : null ?>

            </div>

        </div>


    </div>

</div>