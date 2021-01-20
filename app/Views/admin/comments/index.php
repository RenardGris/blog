<div class="row justify-content-center">

    <div class="col-sm-10 admin_dash">

        <h2>Administrer les commentaires</h2>

        <div class="table_slide">
            <table class="table col-sm-12">
                <thead>
                <tr>
                    <td>Id</td>
                    <td>Titre</td>
                    <td>Contenu</td>
                    <td>Actions</td>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($comments as $comment) : ?>

                    <tr>
                        <td><?= filter_var($comment->id, FILTER_SANITIZE_NUMBER_INT); ?></td>
                        <td><?= filter_var($comment->titre, FILTER_SANITIZE_STRING); ?></td>
                        <td><?= filter_var($comment->contenu, FILTER_SANITIZE_STRING); ?></td>
                        <td>

                            <form action="<?= filter_var(App\App::getInstance()->getBaseUrl(),
                                FILTER_SANITIZE_STRING); ?>admin/comments/validate" method="post"
                                  style="display:inline">
                                <input type="hidden" name="id"
                                       value="<?= filter_var($comment->id, FILTER_SANITIZE_NUMBER_INT); ?>"/>
                                <input type="hidden" name="token" value="<?= filter_var(Core\Auth\Session::get('token'),
                                    FILTER_SANITIZE_STRING); ?>"/>
                                <button type="submit"
                                        class="btn btn-primary"
                                >
                                    Valider
                                </button>
                            </form>


                            <form action="<?= filter_var(App\App::getInstance()->getBaseUrl(),
                                FILTER_SANITIZE_STRING); ?>admin/comments/delete" method="post" style="display:inline">
                                <input type="hidden" name="id"
                                       value="<?= filter_var($comment->id, FILTER_SANITIZE_NUMBER_INT); ?>"/>
                                <input type="hidden" name="token" value="<?= filter_var(Core\Auth\Session::get('token'),
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
    </div>

    <div class="col-sm-12 col-md-6 col-lg-3 margin_15">
        <?= !empty($notification) ? filter_var($notification) : null ?>
    </div>

</div>

<div class="row justify-content-center">
    <div class="col-sm-10">
        <a href="dash" class="btn btn-info margin_15">voir les articles</a>
        <a href="users" class="btn btn-info margin_15">voir les utilisateurs</a>
    </div>
</div>
