<div class="row">
    <div class="col-sm-10">
        <h1>Administrer les articles</h1>

        <p>
            <a href="newpost" class="btn btn-success">Ajouter</a>
        </p>

        <table class="table">
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
                                class="btn btn-primary"
                            >
                                Editer
                            </a>


                            <form action="<?= filter_var(App\App::getInstance()->getBaseUrl(), FILTER_SANITIZE_STRING);?>admin/dash" method="post" style="display:inline">
                                <input type="hidden" name="id" value="<?= filter_var($post->id, FILTER_SANITIZE_NUMBER_INT); ?>" />
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
    </div>
    <div class="col-sm-2">
        <h4>Autres administrations</h4>
        <ul>
            <li>
                <a href=" comments "> Commentaires </a>
            </li>
            <li>
                <a href=" posts "> Articles </a>
            </li>
            <li>
                <a href=" users "> Utilisateurs </a>
            </li>
        </ul>
    </div>
</div>

<?php
if(isset($notification)){
    require ROOT . 'app/Views/notification/show.php';
}
?>
