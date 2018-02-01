<?php

namespace App\Controller\Admin;
use App;

/**
 * Contrôleur des commentaires pour la partie admin
 */
class CommentsController extends AppController{

  /**
   * Charge les constructeurs parents (choisit la navnar en fonction du type d'tilisateur et interdit l'accès si l'utilisateur n'est pas administrateur),
   * Charge les instances des modèles de table "post" et "comment" dans sa propre instance.
   *
   */
  public function __construct(){
    parent::__construct();
    $this->loadModel('post');
    $this->loadModel('comment');
  }

  /**
   * Récupère les commentaires liés à l'id d'un post récupérée par la méthode GET
   * et génère la vue associée.
   */
  public function attached(){
    $post = $this->post->getSingle($_GET['id']);
    $comments = $this->comment->getAttachedComments($_GET['id']);
    $this->render('admin.comments.attached', compact('post', 'comments'));
  }

  /**
   * Récupère un commentaire via son id récupéré par la méthode GET
   * et génère la vue associée.
   */
  public function single(){
    $comment = $this->comment->getSingle($_GET['id']);
    $post = $this->post->getSingle($comment->post_id);
    $this->render('admin.comments.single', compact('post', 'comment'));
  }

  /**
   * Enlève le statut 'signalé' d'un commentaire récupéré par la méthode GET
   * et renvoie vers la page d'où la requête a été générée.
   */
  public function unreport(){
    $result = $this->comment->update($_GET['id'], array(
      'reported' => 0
    ));
    if($result){
      header('location: ' . $_SERVER['HTTP_REFERER'] . '&success=reported');
    }
  }

  /**
   * Supprime le post dont l'id est récupéré via la méthode POST
   * et renvoie vers la page des commentaires liés au post concerné
   * en ajoutant la valeur 'deleted' à la variable $_GET['success'].
   */
  public function delete(){
    if(!empty($_POST)){
      $this->comment->delete($_POST['id']);
      header('location: index.php?page=admin.comments.attached&id=' . $_POST['post-id'] . '&success=deleted');
    }
  }


}
