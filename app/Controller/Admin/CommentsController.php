<?php

namespace App\Controller\Admin;
use App;
use \Core\HTML\BootstrapForm;

/**
 * Contrôleur des commentaires pour la partie admin
 */
class CommentsController extends AppController{

  /**
   * Charge les constructeurs parents (choisit la navbar en fonction du type d'tilisateur et interdit l'accès si l'utilisateur n'est pas administrateur),
   * Charge les instances des modèles de table "post", "comment" et "report" dans sa propre instance.
   *
   */
  public function __construct(){
    parent::__construct();
    $this->loadModel('post');
    $this->loadModel('comment');
    $this->loadModel('report');
  }

  /**
   * Récupère les commentaires liés à l'id d'un post récupéré par la méthode GET
   * et génère la vue associée.
   */
  public function attached(){
    $titleAddition= '';
    $post = $this->post->getSingle($_GET['id']);
    $comments = $this->comment->getAttachedComments($_GET['id']);
    $noCommentMessage = $comments ? '' : '<p class="help-block">Aucun commentaire à afficher</p>';

    foreach($comments as $comment){
      $comment->reports = $this->report->getAttachedReportSum($comment->id);
      $comment->unreport = $this->report->getUnReportButton($comment->id, $post->id, 'attached');
    }

    $form = new BootstrapForm($_POST);
    $pageTitle = $this->completeTitle('Commentaires de "' . $post->title . '"');

    $this->render('admin.comments.attached', compact('noCommentMessage', 'post', 'comments', 'form',  'titleAddition', 'pageTitle'));
  }

  /**
  * Récupère les commentaires signalés liés à l'id d'un post récupéré par la méthode GET
  * et génère la vue associée.
  */
  public function reported(){
    $titleAddition= 'signalés';
    $post = $this->post->getSingle($_GET['id']);
    $allComments = $this->comment->getAttachedComments($_GET['id']);
    $attachedReports = $this->report->getAllReportedAttachedCommentsId($_GET['id']);
    // Récupération des commentaires ayant été singalés
    $comments = [];
    foreach($allComments as $comment){
      if(in_array($comment->id, $attachedReports)){
        $comments[] = $comment;
      }
    }
    $noCommentMessage = $comments ? '' : '<p class="help-block">Aucun commentaire à afficher</p>';

    foreach($comments as $comment){
      $comment->reports = $this->report->getAttachedReportSum($comment->id);
      $comment->unreport = $this->report->getUnReportButton($comment->id, $post->id, 'reported');
    }

    $form = new BootstrapForm($_POST);
    $pageTitle = $this->completeTitle('Commentaires signalés de "' . $post->title . '"');
    $this->render('admin.comments.attached', compact('noCommentMessage', 'post', 'comments', 'form', 'titleAddition', 'pageTitle'));
  }

  /**
   * Récupère un commentaire via son id récupéré par la méthode GET
   * et génère la vue associée, s'il n'existe pas, renvoie la page notfound.
   */
  public function single(){
    $comment = $this->comment->getSingle($_GET['id']);
    if(!$comment){
      $this->notFound();
    }
    else{
      $post = $this->post->getSingle($comment->post_id);
      $comment->reportNotification = $this->report->getAttachedReportMessage($comment->id);
      $comment->unreport = $this->report->getUnReportButton($comment->id, $post->id, 'single');
      $form = new BootstrapForm($_POST);
      $pageTitle = $this->completeTitle('"' .$comment->title . '"');
      $this->render('admin.comments.single', compact('post', 'comment', 'form', 'pageTitle'));
    }

  }

  /**
   * Annule le signalement d'un commenaire,
   * puis renvoie vers la page depuis laquelle la méthode a élé appelée.
   */
  public function unreport(){
    $this->report->unreport($_POST['commentId']);
    if($_POST['originPage'] == 'single'){
      header('location: index.php?page=admin.comments.single&id=' . $_POST['commentId'] . '&success=unreportedcomment');
    }else{
    header('location: index.php?page=admin.comments.' . $_POST['originPage'] . '&id=' . $_POST['postId'] . '&success=unreportedcomment');
    }
  }

  /**
   * Supprime le commentaire dont l'id est récupéré via la méthode POST et les signalements associés,
   * puis renvoie vers la page des commentaires liés au post concerné
   * en ajoutant la valeur 'deleted' à la variable $_GET['success'].
   */
  public function delete(){
    if(!empty($_POST)){
      $this->comment->delete($_POST['id']);
      $this->report->unreport($_POST['id']);
      header('location: index.php?page=admin.comments.attached&id=' . $_POST['post-id'] . '&success=deletedcomment');
    }
  }


}
