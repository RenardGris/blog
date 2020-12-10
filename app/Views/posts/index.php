


<div class="row">
    <div class="col-sm-11">

    <h2>Tous les articles</h2>

    <?php

    
    foreach($posts as $post){
        ?>

        <div class="card" style="margin-top:20px">
            <div class="card-body">
                <h5 class="card-title">
                    <a href="<?= $post->url ?>">
                        <?= $post->titre ?>
                    </a>
                </h5>
                <h6 class="card-subtitle mb-2 text-muted">date : <?= $post->date; ?></h6>
                <p class="card-text"><?= $post->chapo; ?></p>
            </div>
        </div>

        <?php
    }
    ?>
