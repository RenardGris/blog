<div>
<h1><?= filter_var($post->titre, FILTER_SANITIZE_STRING); ?></h1>

<p><em><?= filter_var($post->redacteur, FILTER_SANITIZE_STRING); ?></em></p>
<p><em><?= filter_var($post->date, FILTER_SANITIZE_STRING); ?></em></p>

<p><?= filter_var($post->chapo, FILTER_SANITIZE_STRING); ?></p>

<p><?= filter_var($post->contenu, FILTER_SANITIZE_STRING); ?></p>
</div>

<div>
<?php require ROOT . '/app/Views/comments/index.php'; ?>
</div>