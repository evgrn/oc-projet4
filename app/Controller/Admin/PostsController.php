<?php

namespace App\Controller\Admin;
use App;
use \Core\HTML\BootstrapForm;

/**
 * Contrôleur des posts pour la partie admin
 */
class PostsController extends AppController{

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
   * Affiche tous les posts ainsi que le nombre de commentaires et de ciommentaires signalés qui leur sont associés
   */
  public function index(){
    $posts = $this->post->getAll();
    $that = $this;
    foreach($posts as $post){
      $post->commentNb = $that->comment->getAttachedCommentAmount($post->id);
      $post->reportedCommentNb = $that->comment->getReportedAttachedCommentAmount($post->id);
    }
    $this->render('admin.posts.index', compact('posts', 'commentNb', 'reportedCommentNb'));
  }

  /**
   * Affiche la page d'édition du post dont l'id est sélectionné via la méthode GET,
   * Met à jour le post si les variables $_POST['title'] et $_POST['content'] ne sont pas vides,
   * puis renvoie vers la page d'index des posts de l'admin si une modification a été faite.
   */
  public function edit(){
    if(!empty($_POST['title']) && !empty($_POST['content'])){
      $result = $this->post->update($_GET['id'], array(
        'title' => $_POST['title'],
        'content' => $_POST['content']
      ));
      if($result){
        header('location: index.php?page=admin.posts.index');
      }
    }

    $post = $this->post->getSingle($_GET['id']);
    $form = new BootstrapForm($post);

    $this->render('admin.posts.edit', compact('form', 'success'));
  }

  /**
   * Affiche la page de création de post,
   * crée un post si les variables $_POST['title'] et $_POST['content'] ne sont pas vides,
   * puis renvoie vers la page d'édition dudit post.
   */
  public function add(){

    if(!empty($_POST['title']) && !empty($_POST['content'])){
      $result = $this->post->create(array(
        'title' => $_POST['title'],
        'content' => $_POST['content']
      ));

      if($result){
      header('location: index.php?page=admin.posts.edit&id=' . App::getInstance()->getDb()->getLastInsertedId());
      }
    }

    $form = new BootstrapForm($_POST);

    $this->render('admin.posts.edit', compact('form'));

  }

  /**
   * Supprime le post dont l'id est récupéré via la méthode POST
   * et renvoie vers l'index des posts de la partie admin
   * en ajoutant la valeur 'deleted' à la variable $_GET['success'].
   */
  public function delete(){
    if(!empty($_POST)){
      $this->post->delete($_POST['id']);
      header('location: index.php?page=admin.posts.index&success=deleted');
    }
  }


}
