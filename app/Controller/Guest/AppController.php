<?php
namespace App\Controller\Guest;
use App;
use \Core\Auth\DBAuth;

/**
 * Classe mère des contrôleurs de la partie 'logged'
 *
 */
abstract class AppController extends \App\Controller\AppController{

  /**
   * Charge le constructeur parent (choisit la navbar en fonction du type d'utilisateur),
   * stocke une instance de la classe \Core\Auth\DBauth dans l'objet courant.
   */
  public function __construct(){
    parent::__construct();
    $app = App::getInstance();
    $this->auth = new DBAuth($app->getDb());
    }

  }
