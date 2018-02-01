<?php
namespace App\Controller;
use Core\Controller\Controller;
use Core\Auth\DBAuth;
use App;

/**
 * Classe mère de tous les contrôleurs de la partie App,
 *
 */
abstract class AppController extends Controller{

  protected $viewsPath = ROOT . '/app/Views/';
  protected $template = 'default';

  /**
   * Définit la barre de navigation selon le statut de l'utilisateur
   */
  public function __construct(){
    $app = App::getInstance();
    $auth = new DBAuth($app->getDb());
    if(!$auth->isLogged()){
      $this->navbar = "default";
    }
    elseif(!$auth->isAdmin()){
      $this->navbar = "user";
    }
    else{
        $this->navbar = "admin";
    }
  }

  /**
   * Charge le modèle de table dont le nom correspond au paramètre et l'instancie dans sa propre instance
   * @param  string $modelName    Nom du modèle de table
   */
  protected function loadModel($modelName){
      $this->$modelName = App::getInstance()->getTable($modelName);
  }


}
