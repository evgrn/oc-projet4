<?php
namespace App\Controller\Admin;
use App;
use \Core\Auth\DBAuth;

/**
 * Classe mère des contrôleurs de la partie admin
 *
 */
class AppController extends \App\Controller\AppController{

  /**
   * Charge le constructeur parent (choisit la navnar en fonction du type d'tilisateur),
   * interdit l'accès si l'utilisateur n'est pas administrateur.
   *
   */
  public function __construct(){
    parent::__construct();
    $app = App::getInstance();
    $auth = new DBAuth($app->getDb());
    if(!$auth->isAdmin()){
      $this->forbidden();
    }
  }

}
