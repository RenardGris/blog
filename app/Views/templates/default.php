<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title> <?= filter_var(App\App::getInstance()->titre, FILTER_SANITIZE_STRING); ?></title>

    <!-- Bootstrap core CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/v4-shims.css">


    <!-- Custom styles for this template -->
    <link href="<?= filter_var(App\App::getInstance()->getBaseUrl(), FILTER_SANITIZE_STRING); ?>public/css/style.css"
          rel="stylesheet" type="text/css">

</head>

<body>

<nav class="navbar navbar-expand-md navbar-dark fixed-top">
    <a class="navbar-brand" href="<?= filter_var(App\App::getInstance()->getBaseUrl(), FILTER_SANITIZE_STRING); ?>">
        <img src="<?= filter_var(App\App::getInstance()->getBaseUrl(), FILTER_SANITIZE_STRING); ?>public/css/logo.svg"
             id="nav_icon"/>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
            aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link"
                   href="<?= filter_var(App\App::getInstance()->getBaseUrl(), FILTER_SANITIZE_STRING); ?>">Home <span
                            class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link"
                   href="<?= filter_var(App\App::getInstance()->getBaseUrl(), FILTER_SANITIZE_STRING); ?>Posts">Post
                    <span class="sr-only">(current)</span></a>
            </li>
            <?php
            if (Core\Auth\Session::get('auth') === null) {
                ?>
                <li class="nav-item">
                    <a class="nav-link"
                       href="<?= filter_var(App\App::getInstance()->getBaseUrl(), FILTER_SANITIZE_STRING); ?>login">
                        Login <span class="sr-only">(current)</span></a>
                </li>
                <?php
            }
            ?>
        </ul>
    </div>
</nav>

<main role="main" id="container">
    <?= filter_var($content) ?>
</main>

<footer class="page-footer font-small bg-dark">
    <div class="footer-copyright text-center py-3">
        <?php
        if (Core\Auth\Session::get('auth') !== null) {
            ?>
            <form action="<?= filter_var(App\App::getInstance()->getBaseUrl(), FILTER_SANITIZE_STRING); ?>logout"
                  method="post" style="display:inline">
                <input type="hidden" name="id"
                       value="<?= filter_var(Core\Auth\Session::get('auth'), FILTER_SANITIZE_STRING); ?>">
                <button type="submit" class="btn btn-danger"> logout</button>
            </form>
            <a href="<?= filter_var(App\App::getInstance()->getBaseUrl(),
                FILTER_SANITIZE_STRING); ?>admin/dash">Admin</a>
            <?php
        }
        ?>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>
</html>