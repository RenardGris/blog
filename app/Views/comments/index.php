<!-- Espace Commentaires -->
<div class="card text-center">
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs">
      <li class="nav-item">
        <a class="nav-link active" href="#commentsListing">Commentaires</a>
      </li>
    </ul>
  </div>
  <div class="card-body">

  <div>
  <?php isset($formComment) ? require 'add.php' : null; ?>
  </div>


  
  <?php
      foreach($commentaires as $commentaire){
    ?>

    <div class="card" id="commentsListing"> 
        <h5 class="card-title"><?= filter_var($commentaire->titre, FILTER_SANITIZE_STRING) ?></h5>
        <h5 class="card-title"><?= filter_var($commentaire->redacteur, FILTER_SANITIZE_STRING) ?></h5>
        <p class="card-text"> <?= filter_var($commentaire->contenu,FILTER_SANITIZE_STRING) ?></p>
    </div>

    <?php
        };
    ?>

  </div>
</div>