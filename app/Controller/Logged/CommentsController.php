<?php

namespace App\Controller\Logged;
use App;

/**
 * Contrôleur des commentaires pour la partie logged
 */
class CommentsController extends AppController{
  /**
   * Charge les constructeur parents (choisit la navnar en fonction du type d'tilisateur et interdit l'accès si l'utilisateur n'est pas administrateur),
   * charge le modèle de table "comment".
   */
  public function __construct(){
    parent::__construct();
    $this->loadModel('comment');
  }

  /**
   * Ajoute le statut 'signalé' à un commentaire dont l'id est récupéré par la méthode GET
   * et renvoie vers la page d'où la requête a été générée.
   */
  public function report(){
      $result = $this->comment->update($_GET['id'], array(
        'reported' => 1
      ));
      if($result){
        header('location: ' . $_SERVER['HTTP_REFERER'] . '&success=reported');
      }

  }


}
