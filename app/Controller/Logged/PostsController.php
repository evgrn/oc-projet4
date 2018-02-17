<?php

namespace App\Controller\Logged;
use App;

/**
 * Contrôleur des posts pour la partie logged
 */
class PostsController extends AppController{

  /**
   * Charge les constructeurs parents (choisit la navbar en fonction du type d'utilisateur et interdit l'accès si l'utilisateur n'est pas administrateur),
   * charge les modèles de table "post", "report", et "comment".
   */
  public function __construct(){
    parent::__construct();
    $this->loadModel('post');
    $this->loadModel('comment');
    $this->loadModel('report');
  }

  /**
   * Réucupère un extrait des 4 derniers posts
   * et affiche la vue correspondante
   */
  public function index(){
    $posts = $this->post->getLast(4);
    $pageTitle = $this->completeTitle('Derniers chapitres');
    $this->render('logged.posts.index', compact('posts', 'pageTitle'));
  }

  /**
   * Récupère le post dont l'id est récupéré via la méthode GET et affiche la vue correspondante
   * comportant un formulaire de commentaires;
   * si aucun post ne correspond, affiche la page notfound;
   * si la variable POST n'est pas vide, sauvegarde le commentaire.
   */
  public function single(){
    $post = $this->post->getSingle($_GET['id']);
    $nextPost = $this->post->getNextPost($_GET['id']);


    if($post === false){
      $this->notFound();
      return;
    }
    else{
      if(!empty($_POST)){
        $result = $this->comment->create(array(
          'title' => $_POST['title'],
          'content' => $_POST['content'],
          'post_id' => $_POST['post_id'],
          'author' => $_SESSION['userName'],
        ));

        if($result){
        header('location: index.php?page=logged.posts.single&id=' . $_GET['id'] . '&success=addedcomment');
        }
      }
      $comments = $this->comment->getAttachedComments($_GET['id']);
      $commentAmount = $this->comment->getAttachedCommentSum($_GET['id'], false);

      foreach($comments as $comment){
        $comment->reportItem = $this->report->getReportButton($comment->id, $post->id);

      }

      $form = new \Core\HTML\BootstrapForm();
      $pageTitle = $this->completeTitle($post->title);
      $this->render('logged.posts.single', compact('post', 'comments', 'commentAmount', 'form', 'nextPost', 'pageTitle'));
    }

  }

  /**
   * Réucupère la liste des posts
   * et l'affiche dans la vue correspondante,
   */
  public function listAll(){
    $posts = $this->post->getAll();
    $pageTitle = $this->completeTitle('Liste des chapitres');
    $this->render('logged.posts.listall', compact('posts', 'pageTitle'));
  }

}
