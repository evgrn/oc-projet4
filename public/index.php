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


$page = explode('.', $page);
if(sizeof($page) === 3){
  $controller = '\App\Controller\\' . ucfirst($page[0]) . '\\' . ucfirst($page[1]). 'Controller';
  $action = $page[2];
}else{
  $action = $page[1];
  $controller = '\App\Controller\\' . ucfirst($page[0]) . 'Controller';
}

$controller = new $controller();
$controller->$action();
