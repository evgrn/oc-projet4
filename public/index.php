<?php
define('ROOT', dirname(__DIR__));
require ROOT . '/app/App.php';
App::init();
$auth = new \Core\Auth\DBAuth(App::getInstance()->getDb());



// Routeur
function checkPage(){
  $pathCategories = ['home', 'admin', 'logged', 'users'];
  $results = false;
  $pathCategoriesSum =  sizeof($pathCategories);
  $path = explode('.', $_GET['page']);

  if(sizeof($path) > 1){

    for ($i = 0; $i < $pathCategoriesSum; $i++){
      if($pathCategories[$i] === $path[0]){
        if($path[0] == 'admin' || $path[0] == 'logged'){
          if(sizeof($path) == 3 ){
            if($path[1] == 'comments' || $path[1] == 'posts'){
              return true;
            }

          }

        }
        elseif(sizeof($path) < 3){
          return true;
        }
        return false;
      }
    }

  }


}

if(isset($_GET['page'])){
    if(checkPage()){
      $page = $_GET['page'];
    }
    else{
      $page = 'home.notfound';
    }
} else {
  $page = 'home.index';
}


$page = explode('.', $page);
if(sizeof($page) < 2){
  $page = ['home', 'notfound'];
}
if(sizeof($page) === 3){
  $controller = '\App\Controller\\' . ucfirst($page[0]) . '\\' . ucfirst($page[1]). 'Controller';
  $action = $page[2];
}else{
  $action = $page[1];
  $controller = '\App\Controller\\' . ucfirst($page[0]) . 'Controller';
}

$controller = new $controller();
$controller->$action();
