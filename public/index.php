<?php
require '../app/Autoloader.php';

// Initialisation des objets
\App\Autoloader::register();
$db = new \App\DB('ocp4');

if(isset($_GET['page'])){
    $page = $_GET['page'];
} else {
  $page = 'index';
}

ob_start();
if($page === 'index'){
  require '../pages/index.php';
}
elseif($page === 'single'){
  require '../pages/single.php';
}
$content = ob_get_clean();

require '../pages/templates/default.php';
