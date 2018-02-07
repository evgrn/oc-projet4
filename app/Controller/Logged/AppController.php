<?php
namespace App\Controller\Logged;
use App;
use \Core\Auth\DBAuth;

/**
 * Classe mère des contrôleurs de la partie 'logged'
 *
 */
abstract class AppController extends \App\Controller\AppController{

  /**
   * Charge le constructeur parent (choisit la navbar en fonction du type d'tilisateur),
   * interdit l'accès si l'utilisateur n'est pas connecté.
   */
  public function __construct(){
    parent::__construct();
    $app = App::getInstance();
    $auth = new DBAuth($app->getDb());
    if(!$auth->isLogged()){
      $this->forbidden();
    }
  }

}
