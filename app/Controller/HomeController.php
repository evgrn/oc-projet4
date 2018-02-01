<?php

namespace App\Controller;
use \App;
use \Core\Auth\DBAuth;

/**
 * Contrôleur de la partie Home
 */
class HomeController extends AppController{

  /**
   * Charge le constructeur parent (choisit la navnar en fonction du type d'tilisateur),
   * charge le modèle de table "post" dans sa propre instance.
   */
  public function __construct(){
    parent::__construct();
    $this->loadModel('post');
  }

  /**
   * Affiche la vue correspondante à la page d'accueil.
   */
  public function index(){
    $this->render('home.index', []);
  }


}
