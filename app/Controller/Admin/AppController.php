<?php
namespace App\Controller\Admin;
use App;
use \Core\Auth\DBAuth;


abstract class AppController extends \App\Controller\AppController{
  public function __construct(){
    // Auth
    $app = App::getInstance();
    $auth = new DBAuth($app->getDb());
    if(!$auth->isLogged()){
      $this->forbidden();
    }
  }

}
