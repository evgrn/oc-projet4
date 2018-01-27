<?php
define('ROOT', dirname(__DIR__));
require ROOT . '/app/App.php';
App::init();


if(isset($_GET['page'])){
    $page = $_GET['page'];
} else {
  $page = 'posts.index';
}

ob_start();
if($page === 'posts.index'){
  require ROOT . '/pages/posts/index.php';
}
elseif($page === 'posts.single'){
  require '../pages/posts/single.php';
}
else{
  require '../pages/notfound.php';
}
$content = ob_get_clean();

require '../pages/templates/default.php';
