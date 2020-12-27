<div>
<h1><?= filter_var($article->titre, FILTER_SANITIZE_STRING); ?></h1>

<p><em><?= filter_var($article->redacteur, FILTER_SANITIZE_STRING); ?></em></p>
<p><em><?= filter_var($article->date, FILTER_SANITIZE_STRING); ?></em></p>

<p><?= filter_var($article->chapo, FILTER_SANITIZE_STRING); ?></p>

<p><?= filter_var($article->contenu, FILTER_SANITIZE_STRING); ?></p>
</div>

<div>
<?php require ROOT . '/app/Views/comments/index.php'; ?>
</div>