<?php

namespace Core\Controller;

/**
 * Classe abstraite mère des classes de controleurs.
 */
abstract class Controller{
  protected $viewsPath;
  protected $template;
  protected $navbar = 'default';


  /**
   * Renvoie la page notfound si une méthode qui n'existe pas est appelée.
   * @param  string                         $method        nom de la méthode
   * @param  string/bool/object/int/array   $argument      argument(s) de la méthode
   */
  public function __call($method, $argument){
    $this->notFound();
  }

  /**
   * Génère la vue correspondant au paramètre $view, y insère les données comportées dans le paramètre $data,
   * génère la vue de la navbar en fonction de la propriété $navbar de l'objet courant.
   * @param  string $view Nom de la vue
   * @param  array  $data Données à insérer dans la vue
   */
  protected function render($view, $data = [], $viewsPath, $navbar, $template){
    extract($data);
    $viewPath = $viewsPath . str_replace('.', '/', $view) . '.php';
    $pageClass = str_replace('.', '-', $view);

    ob_start();
    require($viewPath);
    $content = ob_get_clean();

    $navViewPath = $viewsPath . 'templates/navbar/' . $navbar . '.php';
    ob_start();
    require($navViewPath);
    $navbar = ob_get_clean();

    require($viewsPath . 'templates/' . $template . '.php');
  }

  /**
   * Interdit l'accès à la page demandée.
   */
  protected function forbidden(){
    header('HTTP/1.0 403 Forbidden');
    die('Accès interdit');
  }

  /**
   * Génère la vue notFound
   * @return [type] [description]
   */
  public function notFound(){
    $this->render('notfound',[]);
  }
}
