<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#" lang="fr">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Bienvenue sur le livre numérique <strong>Billet simple pour l'Alaska</strong>">
    <meta name="keywords" content="Billet Simple Pour l'Alaska, Jean Forteroche, roman">
    <meta name="author" content="Camille Maillet">
    <link rel="icon" href="img/icons/favicon.ico" />

    <title> <?= $pageTitle ?></title>

    <!--#### iOS ####-->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-title" content="Billet Simple Pour l'Alaska">
    <link rel="apple-touch-icon" href="img/icons/favicon.ico">

    <!--#### Android ####-->
    <meta name="color" content="#004B8E">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="application-name" content="Billet Simple Pour l'Alaska">
    <link rel="icon" type="image/png" href="img/icons/favicon.ico" sizes="192x192">

    <!--#### Facebook ####-->
    <meta property="og:locale" content="fr_FR" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Billet Simple Pour l'Alaska | Le roman en ligne de Jean Forteroche" />
    <meta property="og:description" content="Bienvenue sur le livre numérique <strong>Billet simple pour l'Alaska</strong>" />
    <meta property="og:url" content="http://oc-projet4.camille-maillet.fr/" />
    <meta property="og:site_name" content="Billet Simple Pour l'Alaska" />
    <meta property="og:image" content="img/preview-social.jpg" />
    <meta property="og:image:width" content="500" />
    <meta property="og:image:height" content="500" />

    <!--#### Twitter ####-->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:description" content="Bienvenue sur le livre numérique <strong>Billet simple pour l'Alaska</strong>" />
    <meta name="twitter:title" content="Billet Simple Pour l'Alaska | Le roman en ligne de Jean Forteroche" />
    <meta name="twitter:image" content="<img/preview-social.jpg" />

    <!--#### Feuilles de style ####-->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/master.css">



    <!--#### Scripts ####-->
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <script
            src="http://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous">
    </script>

    <script src="js/scripts.js"></script>
    <script src="js/pagination.js"></script>
    <script src="js/toggle.js"></script>
    <script src="js/pwdconfirm.js"></script>
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=rw9lllvwivegvt1gptpquf6km3i5u8n7aynhbwhutuxe9db0"></script>


  </head>

  <body class="<?= $pageClass ?>">
    <div class="navbar navbar-inverse navbar-fixed-top">
      <a class="menu-toggle"><i class="fas fa-bars fa-2x"></i></a>
        <?= $navbar ?>
    </div>

    <div class="container <?= $pageClass ?>">
      <?= $content ?>
    </div>

    <?= $successMessage ?>

  </body>
</html>
