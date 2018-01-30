<?php
namespace App\Controller;
use Core\Controller\Controller;
use App;


abstract class AppController extends Controller{
  protected $viewsPath = ROOT . '/app/Views/';
  protected $template = 'default';


  protected function loadModel($modelName){
      $this->$modelName = App::getInstance()->getTable($modelName);
  }

}
