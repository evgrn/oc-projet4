<?php

namespace Core\Controller;


abstract class Controller{
  protected $viewsPath;
  protected $template;

  protected function render($view, $data = []){
    extract($data);
    $viewPath = $this->viewsPath . str_replace('.', '/', $view) . '.php';
    ob_start();
    require($viewPath);
    $content = ob_get_clean();
    require($this->viewsPath . 'templates/' . $this->template . '.php');
  }

  protected function forbidden(){
    header('HTTP/1.0 403 Forbidden');
    die('Accès interdit');
  }

  protected function notFound(){

    $viewPath = $this->viewsPath . 'notfound.php';
    ob_start();
    require($viewPath);
    $content = ob_get_clean();
    require($this->viewsPath . 'templates/' . $this->template . '.php');
  }
}
