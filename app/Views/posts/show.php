<div>
<h1><?= $article->titre; ?></h1>

<p><em><?= $article->redacteur; ?></em></p>
<p><em><?= $article->date; ?></em></p>

<p><?= $article->chapo; ?></p>

<p><?= $article->contenu; ?></p>
</div>

<div>
<?php require ROOT . '/app/Views/comments/index.php'; ?>
</div>