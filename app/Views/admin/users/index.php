<div class="row justify-content-center">

    <div class="col-sm-10 admin_dash">

        <h2>Administrer les utilisateurs</h2>

        <div class="row">
            <div class="col-sm-12 col-md-6 table_slide">
                <h5>Gestion des inscriptions</h5>
                <table class="table">
                    <thead>
                    <tr>
                        <td>Id</td>
                        <td>Username</td>
                        <td>Actions</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($unvalidateUsers as $user) : ?>

                        <tr>
                            <td><?= filter_var($user->id, FILTER_SANITIZE_NUMBER_INT); ?></td>
                            <td><?= filter_var($user->username, FILTER_SANITIZE_STRING); ?></td>
                            <td>

                                <form action="<?= filter_var(App\App::getInstance()->getBaseUrl(),
                                    FILTER_SANITIZE_STRING); ?>admin/users/validate" method="post"
                                      style="display:inline">
                                    <input type="hidden" name="id"
                                           value="<?= filter_var($user->id, FILTER_SANITIZE_NUMBER_INT); ?>"/>
                                    <input type="hidden" name="token"
                                           value="<?= filter_var(Core\Auth\Session::get('token'),
                                               FILTER_SANITIZE_STRING) ?>"/>
                                    <button type="submit"
                                            class="btn btn-primary"
                                    >
                                        Valider
                                    </button>
                                </form>


                                <form action="<?= filter_var(App\App::getInstance()->getBaseUrl(),
                                    FILTER_SANITIZE_STRING); ?>admin/users/delete" method="post" style="display:inline">
                                    <input type="hidden" name="id"
                                           value="<?= filter_var($user->id, FILTER_SANITIZE_NUMBER_INT); ?>"/>
                                    <input type="hidden" name="token"
                                           value="<?= filter_var(Core\Auth\Session::get('token'),
                                               FILTER_SANITIZE_STRING); ?>"/>
                                    <button type="submit"
                                            class="btn btn-danger"
                                    >
                                        Supprimer
                                    </button>
                                </form>

                            </td>
                        </tr>

                    <?php
                    endforeach; ?>
                    </tbody>

                </table>
            </div>
            <div class="col-sm-12 col-md-6 table_slide">
                <h5>Gestion des roles</h5>
                <table class="table">
                    <thead>
                    <tr>
                        <td>Id</td>
                        <td>Username</td>
                        <td>Role</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($users as $user) : ?>

                        <tr>
                            <td><?= filter_var($user->id, FILTER_SANITIZE_NUMBER_INT); ?></td>
                            <td><?= filter_var($user->username, FILTER_SANITIZE_STRING); ?></td>

                            <td>
                                <form action="<?= filter_var(App\App::getInstance()->getBaseUrl(),
                                    FILTER_SANITIZE_STRING); ?>admin/users/changeRole" method="post"
                                      style="display:inline">
                                    <input type="hidden" name="id"
                                           value="<?= filter_var($user->id, FILTER_SANITIZE_NUMBER_INT); ?>"/>
                                    <input type="hidden" name="token"
                                           value="<?= filter_var(Core\Auth\Session::get('token'),
                                               FILTER_SANITIZE_STRING) ?>"/>
                                    <?= filter_var($form[$user->id]->select('role', null, [
                                        'commentateur' => 'commentateur',
                                        'redacteur' => 'redacteur',
                                        'admin' => 'admin'
                                    ])); ?>
                                    <button type="submit"
                                            class="btn btn-primary"
                                    >
                                        Valider
                                    </button>
                                </form>
                            </td>
                        </tr>

                    <?php
                    endforeach; ?>
                    </tbody>

                </table>
            </div>
        </div>

    </div>

    <div class="col-sm-12 col-md-6 col-lg-3 margin_15">
        <?= !empty($notification) ? filter_var($notification) : null ?>
    </div>

</div>

<div class="row justify-content-center">
    <div class="col-sm-10">
        <a href="dash" class="btn btn-info margin_15">voir les articles</a>
        <a href="comments" class="btn btn-info margin_15">voir les commentaires</a>
    </div>
</div>

