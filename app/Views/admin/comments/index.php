<h1>Administrer les commentaires</h1>

<table class="table">
    <thead>
        <tr>
            <td>Id</td>
            <td>Titre</td>
            <td>Contenu</td>
            <td>Actions</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach($comments as $comment) : ?>

            <tr>
                <td><?= filter_var($comment->id, FILTER_SANITIZE_NUMBER_INT); ?></td>
                <td><?= filter_var($comment->titre, FILTER_SANITIZE_STRING); ?></td>
                <td><?= filter_var($comment->contenu, FILTER_SANITIZE_STRING); ?></td>
                <td>

                    <form action="<?= filter_var(App\App::getInstance()->getBaseUrl(), FILTER_SANITIZE_STRING);?>admin/comments/validate" method="post" style="display:inline">
                        <input type="hidden" name="id" value="<?= filter_var($comment->id, FILTER_SANITIZE_NUMBER_INT); ?>" />
                        <input type="hidden" name="token" value="<?= filter_var(Core\Auth\Session::get('token'), FILTER_SANITIZE_STRING); ?>" />
                        <button type="submit"
                                class="btn btn-primary"
                        >
                        Valider
                        </button>
                    </form>


                    <form action="<?= filter_var(App\App::getInstance()->getBaseUrl(), FILTER_SANITIZE_STRING);?>admin/comments/delete" method="post" style="display:inline">
                        <input type="hidden" name="id" value="<?= filter_var($comment->id, FILTER_SANITIZE_NUMBER_INT); ?>" />
                        <input type="hidden" name="token" value="<?= filter_var(Core\Auth\Session::get('token'), FILTER_SANITIZE_STRING); ?>" />
                        <button type="submit"
                                class="btn btn-danger"
                        >
                        Supprimer
                        </button>
                    </form>
                
                </td>
            </tr>

        <?php endforeach; ?>
    </tbody>

</table>

<?= !empty($notification) ? filter_var($notification) : null ?>
