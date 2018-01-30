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
  $page = 'admin.posts.index';
}

// Auth
$app = App::getInstance();
$auth = new \Core\Auth\DBAuth($app->getDb());
if(!$auth->isLogged()){
  $content =  $app->access(false);
}
else{



ob_start();
if($page === 'admin.posts.index'){
  require ROOT . '/pages/admin/posts/index.php';
}
elseif($page === 'admin.posts.single'){
  require '../pages/admin/posts/single.php';
}
elseif($page === 'admin.posts.edit'){
  require '../pages/admin/posts/edit.php';
}
elseif($page === 'admin.posts.add'){
  require '../pages/admin/posts/add.php';
}
elseif($page === 'admin.posts.delete'){
  require '../pages/admin/posts/delete.php';
}

else{
  require '../pages/notfound.php';
}
$content = ob_get_clean();
}
require '../pages/templates/default.php';
