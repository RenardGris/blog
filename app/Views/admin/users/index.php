
<div class="row">
    <div class="col-sm-6">

        <h1>Demandes d'enregistrement</h1>

        <table class="table">
            <thead>
                <tr>
                    <td>Id</td>
                    <td>Username</td>
                    <td>Actions</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach($unvalidateUsers as $user) : ?>

                    <tr>
                        <td><?= $user->id; ?></td>
                        <td><?= $user->username; ?></td>
                        <td>

                            <form action="<?=App\App::getInstance()->getBaseUrl();?>admin/users/validate" method="post" style="display:inline">
                                <input type="hidden" name="id" value="<?= $user->id; ?>">
                                <button type="submit"
                                        class="btn btn-primary"
                                >
                                Valider
                                </button>
                            </form>


                            <form action="<?=App\App::getInstance()->getBaseUrl();?>admin/users/delete" method="post" style="display:inline">
                                <input type="hidden" name="id" value="<?= $user->id; ?>">
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
    <div class="col-sm-6">
    
    <h1>Role des utilisateurs</h1>

    <table class="table">
        <thead>
            <tr>
                <td>Id</td>
                <td>Username</td>
                <td>Role</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach($users as $user) : ?>

                <tr>
                    <td><?= $user->id; ?></td>
                    <td><?= $user->username; ?></td>

                    <td>
                        <form action="<?=App\App::getInstance()->getBaseUrl();?>admin/users/changeRole" method="post" style="display:inline">
                        <input type="hidden" name="id" value="<?= $user->id; ?>">
                        <?= $form[$user->id]->select('role', null, ['commentateur' => 'commentateur', 'redacteur' => 'redacteur', 'admin' => 'admin']); ?>
                        <button type="submit"
                                class="btn btn-primary"
                        >
                        Valider
                        </button>
                    </form>
                    </td>
                </tr>

            <?php endforeach; ?>
        </tbody>

    </table>

    </div>
</div>
