<!-- Espace Commentaires -->
<div class="row">

    <!-- form new comment -->
    <div class="col-sm-12 col-md-6 col-lg-4">

        <div class="row">

            <div class="card my-4" id="comment_form">
                <h5 class="card-header">Poster un commentaire</h5>
                <div class="card-body">
                    <?php
                    if (isset($formComment)) {
                        $form = $formComment[0];
                        if (isset($formComment[1]) === true) {
                            $notification = $formComment[1];
                        }
                        ?>
                        <form method="post">
                            <?= filter_var($form->input('titre', 'titre de l\'article')); ?>
                            <?= filter_var($form->input('contenu', 'Contenu', ['type' => 'textarea'])); ?>
                            <input type="hidden" name="token"
                                   value="<?= filter_var(Core\Auth\Session::get('token'), FILTER_SANITIZE_STRING); ?>"/>
                            <button class="btn btn-primary">Commenter</button>
                        </form>
                        <?php
                    } else {
                        ?>
                        <span>
                            Veuillez vous <a href="../login">connecter</a> pour commenter
                        </span>
                        <?php
                    }
                    ?>
                    <?= !empty($notification) ? filter_var($notification) : null ?>
                </div>
            </div>
        </div>
    </div>

    <!--listing comments -->
    <div class="col-sm-12 col-md-6 col-lg-8">

        <div id="comment_slide">
        <?php
        if (!$comments) {
            ?>
            <div class="media mb-4">
                <div class="media-body">
              <span>
                Oh non ! Il n'y a aucun commentaire pour cet article.
              </span>
                </div>
            </div>

            <?php
        } else {
            foreach ($comments as $comment) {
                ?>
                <div class="media mb-4">
                    <div class="media-body">
                        <h5 class="mt-0">Commentateur
                            : <?= filter_var($comment->redacteur, FILTER_SANITIZE_STRING) ?></h5>
                        <p>
                            titre : <?= filter_var($comment->titre, FILTER_SANITIZE_STRING) ?>
                        </p>
                        <span>
                            <?= filter_var($comment->contenu, FILTER_SANITIZE_STRING) ?>
                        </span>
                    </div>
                </div>
                <hr>

                <?php
            }
        }
        ?>
        </div>
    </div>

</div>


