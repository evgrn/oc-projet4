<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?= \App\App::getPageTitle() ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../public/css/master.css">

  </head>


  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="navbar-brand" href="index.php?page=index">Billet Simple Pour l'Alaska</a>
            <ul class="nav">
              <li class="active"><a href="index.php?page=index">Accueil</a></li>
              <li><a href="#">Connexion</a></li>
              <li><a href="#">Liste des chapitres</a></li>
            </ul>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="main-content">
          <?= $content ?>
      </div>

    </div>

  </body>


</html>
