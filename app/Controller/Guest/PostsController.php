<?php

namespace App\Controller\Guest;

/**
 * Contrôleur des posts pour la partie logged
 */
class PostsController extends AppController{

  /**
   * Charge les constructeurs parents (choisit la navbar en fonction du type d'tilisateur et interdit l'accès si l'utilisateur n'est pas administrateur),
   * charge les modèles de table "post", et "comment".
   */
  public function __construct(){
    parent::__construct();
    $this->loadModel('post');
    $this->loadModel('comment');
  }

  /**
   * Réucupère un extrait des 4 derniers posts et affiche la vue correspondante,
   * si l'utilisateur est connecté, renvoie vers la version "logged" de la page.
   */
  public function index(){
    if($this->auth->isLogged()){
      header('location: index.php?page=logged.posts.index');
    }
    $posts = $this->post->getLast(4);
    $this->render('guest.posts.index', compact('posts'));
  }

  /**
   * Réucupère le post dont l'id est récupéré via la méthode GET et affiche la vue correspondante
   */
  public function single(){
    if($this->auth->isLogged()){
      header('location: index.php?page=logged.posts.single&id=' . $_GET['id']);
    }
    $post = $this->post->getSingle($_GET['id']);
    if($post === false){
      $this->notFound();
      return;
    }
    else{
      $commentAmount = $this->comment->getAttachedCommentSum($_GET['id'], false);

      $this->render('guest.posts.single', compact('post', 'comments', 'commentAmount', 'form'));
    }

  }

  /**
   * Réucupère la liste des posts
   * et l'affiche dans la vue correspondante,
   */
  public function list(){
    if($this->auth->isLogged()){
      header('location: index.php?page=logged.posts.list');
    }
    $posts = $this->post->getAll();
    $this->render('guest.posts.list', compact('posts'));
  }

}
