<?php

namespace App\Controller\Logged;
use App;

/**
 * Contrôleur des posts pour la partie logged
 */
class PostsController extends AppController{

  /**
   * Charge les constructeur parents (choisit la navnar en fonction du type d'tilisateur et interdit l'accès si l'utilisateur n'est pas administrateur),
   * charge les modèles de table "post" et "comment".
   */
  public function __construct(){
    parent::__construct();
    $this->loadModel('post');
    $this->loadModel('comment');
  }

  /**
   * Réucupère un extrait des 4 derniers posts
   * et affiche la vue correspondante
   */
  public function index(){
    $posts = $this->post->getLast(4);
    $this->render('logged.posts.index', compact('posts'));
  }

  /**
   * Réucupère le post dont l'id est récupérée via la méthode GET
   * et affiche la vue correspondante,
   * Si aucun post ne correspond, affiche la page notfound.
   */
  public function single(){
    $post = $this->post->getSingle($_GET['id']);
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
        header('location: index.php?page=logged.posts.single&id=' . $_GET['id']);
        }
      }
      $comments = $this->comment->getAttachedComments($_GET['id']);
      $commentAmount = $this->comment->getAttachedCommentAmount($_GET['id']);

      $form = new \Core\HTML\BootstrapForm($_POST);


      $app = App::getInstance();
      $auth = new \Core\Auth\DBAuth($app->getDb());

      $this->render('logged.posts.single', compact('post', 'comments', 'commentAmount', 'form'));
    }

  }

  /**
   * Réucupère la liste des posts
   * et l'affiche dans la vue correspondante,
   */
  public function list(){
    $posts = $this->post->getAll();
    $this->render('logged.posts.list', compact('posts'));
  }


}
