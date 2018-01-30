<?php
define('ROOT', dirname(__DIR__));
require ROOT . '/app/App.php';
App::init();
$auth = new \Core\Auth\DBAuth(App::getInstance()->getDb());
if($auth->isLogged()){
  $adminTools = '<li><a href="admin.php?page=admin.posts.index">Administration</a></li>';

}
else{
  $adminTools ='';
}



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
elseif($page === 'posts.list'){
  require '../pages/posts/list.php';
}
elseif($page === 'users.login'){
  require '../pages/users/login.php';
}

else{
  require '../pages/notfound.php';
}
$content = ob_get_clean();

require '../pages/templates/default.php';
