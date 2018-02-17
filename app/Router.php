<?php
namespace App;
/**
 * Classe gérant le routage
 */
class Router{

  /**
   * Vérifie si le schéma de la valeur $_GET['page'] est supporté.
   * @return bool Renvoie true si oui, false sinon.
   */
  private static function checkPage(){
    $pathCategories = ['home', 'admin', 'logged', 'users', 'guest'];
    $pathCategoriesSum =  sizeof($pathCategories);
    $path = explode('.', $_GET['page']);

    if(sizeof($path) > 1){

      for ($i = 0; $i < $pathCategoriesSum; $i++){
        if($pathCategories[$i] === $path[0]){
          if($path[0] == 'admin' || $path[0] == 'logged' || $path[0] == 'guest'){
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

  /**
   * Instancie le contrôleur correspondant et sa méthode demandée en fonction de la variable $_GET['page'].
   */
  public static function route(){
    if(isset($_GET['page'])){
        if(self::checkPage()){
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
  }
}
