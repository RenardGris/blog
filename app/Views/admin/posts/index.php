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
                        <td><?= $post->id; ?></td>
                        <td><?= $post->titre; ?></td>
                        <td>
                            <a 
                                href=" posts/<?= $post->id; ?>" 
                                class="btn btn-primary"
                            >
                                Editer
                            </a>


                            <form action="<?=App\App::getInstance()->getBaseUrl();?>admin/dash" method="post" style="display:inline">
                                <input type="hidden" name="id" value="<?= $post->id; ?>" />
                                <input type="hidden" name="token" value="<?= $_SESSION['token']; ?>" />
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
        
    <li>
        <a href=" comments "> Commentaires </a>
    </li>
    <li>
        <a href=" posts "> Articles </a>
    </li>
    <li>
        <a href=" users "> Utilisateurs </a>
    </li>

    </div>
</div>

<?php
if(isset($notification)){
    require ROOT . 'app/Views/notification/show.php';
}
?>
