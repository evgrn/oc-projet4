<?php
##TODO:
##Modifier report() pour repartir sur la page correspondante
##
 
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
    $this->loadmodel('report');
  }

  /**
   * Signale le commentaire correspondant aux variables commentId et postId récupérées via la méthode POST,
   * puis renvoie vers la page d'index des commentaires correspondant au post lié, donnant la valeur "reportedcomment" à la variable $_GET['success'].
   */
  public function report(){
      $result = $this->report->create(array($_POST['commentId'], $_POST['postId']));
      if($result){
        header('location: index.php?page=logged.posts.single&id=' . $_POST['postId'] . '&success=reportedcomment');
      }
}


}
