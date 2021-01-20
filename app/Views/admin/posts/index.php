<div class="row justify-content-center">

    <div class="col-sm-10 admin_dash">

        <h2>Administrer les articles</h2>

        <div class="row justify-content-between">
            <div class="col-sm-3">
                <a href="newpost" class="btn btn-success btn_margin">Ajouter</a>
            </div>
        </div>

        <div class="table_slide">
            <table class="table col-sm-12">
                <thead>
                <tr>
                    <td>Id</td>
                    <td>Titre</td>
                    <td>Actions</td>
                </tr>
                </thead>
                <tbody>
                <?php foreach($posts as $post) : ?>

                    <tr>
                        <td><?= filter_var($post->id, FILTER_SANITIZE_NUMBER_INT); ?></td>
                        <td><?= filter_var($post->titre, FILTER_SANITIZE_STRING); ?></td>
                        <td>
                            <a
                                    href=" posts/<?= filter_var($post->id, FILTER_SANITIZE_NUMBER_INT); ?>"
                                    class="btn btn-primary margin_15"
                            >
                                Editer
                            </a>


                            <form action="<?= filter_var(App\App::getInstance()->getBaseUrl(), FILTER_SANITIZE_STRING);?>admin/dash" method="post" style="display:inline">
                                <input type="hidden" name="id" value="<?= filter_var($post->id, FILTER_SANITIZE_NUMBER_INT); ?>" />
                                <input type="hidden" name="token" value="<?= filter_var(Core\Auth\Session::get('token'), FILTER_SANITIZE_STRING); ?>" />
                                <button type="submit"
                                        class="btn btn-danger margin_15"
                                >
                                    Supprimer
                                </button>
                            </form>

                        </td>
                    </tr>

                <?php endforeach; ?>
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
        <a href="comments" class="btn btn-info margin_15">voir les commentaires</a>
        <a href="users" class="btn btn-info margin_15">voir les utilisateurs</a>
    </div>
</div>


