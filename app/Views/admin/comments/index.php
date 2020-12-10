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
        <?php foreach($commentaires as $comment) : ?>

            <tr>
                <td><?= $comment->id; ?></td>
                <td><?= $comment->titre; ?></td>
                <td><?= $comment->contenu ?></td>
                <td>

                    <form action="<?=App\App::getInstance()->getBaseUrl();?>admin/comments/validate" method="post" style="display:inline">
                        <input type="hidden" name="id" value="<?= $comment->id; ?>">
                        <button type="submit"
                                class="btn btn-primary"
                        >
                        Valider
                        </button>
                    </form>


                    <form action="<?=App\App::getInstance()->getBaseUrl();?>admin/comments/delete" method="post" style="display:inline">
                        <input type="hidden" name="id" value="<?= $comment->id; ?>">
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

<?php
if($notification){
    require ROOT . 'app/Views/notification/show.php';
}
?>
