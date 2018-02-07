<!DOCTYPE html>
<html lang="fr">
  <head>

    <meta charset="utf-8">
    <title> <?= $pageTitle ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- SCRIPTS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <script
            src="http://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
    <script src="js/pagination.js"></script>
    <script src="js/toggle.js"></script>
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=rw9lllvwivegvt1gptpquf6km3i5u8n7aynhbwhutuxe9db0"></script>

    <!-- CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../public/css/master.css">

  </head>

  <body>
    <div class="navbar navbar-inverse navbar-fixed-top">
      <a class="menu-toggle"><i class="fas fa-bars fa-2x"></i></a>
        <?= $navbar ?>
    </div>

    <div class="container <?= $containerClass ?>">
      <?= $content ?>
    </div>

    <?= $successMessage ?>

  </body>
</html>
