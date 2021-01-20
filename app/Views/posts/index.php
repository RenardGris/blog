<div class="row view_container">

    <div class="col-sm-12">

        <h2>Tous les articles</h2>

        <div class="row justify-content-center">

            <?php

            foreach ($posts as $post) {
                ?>

                <div class="card col-sm-12 col-md-4 col-lg-3 post">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="<?= filter_var($post->url, FILTER_SANITIZE_SPECIAL_CHARS); ?>">
                                <?= filter_var($post->titre, FILTER_SANITIZE_SPECIAL_CHARS); ?>
                            </a>
                        </h5>
                        <h6 class="card-subtitle mb-2 text-muted">date : <?= filter_var($post->date,
                                FILTER_SANITIZE_SPECIAL_CHARS); ?></h6>
                        <p class="card-text"><?= filter_var($post->chapo, FILTER_SANITIZE_SPECIAL_CHARS); ?></p>
                    </div>
                </div>

                <?php
            }
            ?>

        </div>

    </div>

</div>
