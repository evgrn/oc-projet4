<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>      <?= $pageTitle ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../public/css/master.css">

  </head>

  <body>
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">

                <?= $navbar ?>

      </div>
    </div>


    <div class="container">

      <div class="main-content">
          <?= $content ?>
      </div>

    </div>

  </body>


</html>
