<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title> <?= App\App::getInstance()->titre; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/starter-template.css" rel="stylesheet">
  </head>

  <body>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="<?=App\App::getInstance()->getBaseUrl();?>">Navbar</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="<?=App\App::getInstance()->getBaseUrl();?>">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="<?=App\App::getInstance()->getBaseUrl();?>login"> Login <span class="sr-only">(current)</span></a>
          </li>
        </ul>
      </div>
    </nav>

    <main role="main" class="container" style="margin-top:100px;min-height:85vh;width:100%">

      <div class="starter-template">
            <?php echo $content ?>
      </div>

    </main><!-- /.container -->

    <footer class="page-footer font-small bg-dark" style="height:80px">
      <div class="footer-copyright text-center py-3">
      <?php 
        if(isset($_SESSION['auth']))
        {
      ?>
        <form action="<?=App\App::getInstance()->getBaseUrl();?>logout" method="post" style="display:inline">
                        <input type="hidden" name="id" value="<?= $_SESSION['auth']; ?>">
                        <button type="submit" class="btn btn-danger"> logout</button>
        </form>
        <a href="<?=App\App::getInstance()->getBaseUrl();?>admin/dash">Admin</a>
      <?php
        }
      ?>
      </div>
    </footer>


  </body>
</html>