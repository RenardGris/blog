<div class="row justify-content-center" id="view_container">

    <div class="col-sm-12 col-md-10 col-lg-8">

        <div class="row">

            <div class="col-sm-12">

                <!-- Title -->
                <h1 class="mt-4"><?= filter_var($post->titre, FILTER_SANITIZE_STRING); ?></h1>

                <!-- Author -->
                <p class="lead">
                    <span> Rédacteur : <?= filter_var($post->redacteur, FILTER_SANITIZE_STRING); ?></span>
                </p>

                <hr>

                <!-- Date/Time -->
                <p> le <?= filter_var($post->date, FILTER_SANITIZE_STRING); ?></p>

                <hr>

                <!-- Summary -->
                <p>
                    <em>
                        <?= filter_var($post->chapo, FILTER_SANITIZE_STRING); ?>
                    </em>
                </p>

                <!-- Post Content -->
                <p class="lead">
                    <?= filter_var($post->contenu, FILTER_SANITIZE_STRING); ?>
                </p>

            </div>
            <div class="col-sm-12" id="comment_part">
                <hr>
                <h4>Commentaires</h4>

                <?php require ROOT . '/app/Views/comments/index.php'; ?>
            </div>

        </div>




    </div>

</div>