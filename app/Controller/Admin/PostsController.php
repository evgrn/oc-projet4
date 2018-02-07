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
   * Charge les instances des modèles de table "post", "comment" et "comment" dans sa propre instance.
   */
  public function __construct(){
    parent::__construct();
    $this->loadModel('post');
    $this->loadModel('comment');
    $this->loadModel('report');
  }

  /**
   * Affiche tous les posts ainsi que le nombre de commentaires et de commentaires signalés qui leur sont associés
   */
  public function index(){
    $posts = $this->post->getAll();
    $that = $this;
    foreach($posts as $post){
      $post->commentNb = $that->comment->getAttachedCommentSum($post->id);
      $post->reportedCommentNb = $that->report->getReportedAttachedCommentSum($post->id);
    }
    $pageTitle = $this->completeTitle('Administration - index');
    $this->render('admin.posts.index', compact('posts', 'commentNb', 'reportedCommentNb', 'pageTitle'));
  }

  /**
   * Affiche la page d'édition du post dont l'id est sélectionné via la méthode GET,
   * Met à jour le post si les variables $_POST['title'] et $_POST['content'] ne sont pas vides,
   * puis renvoie vers la page d'index des posts de l'admin si une modification a été faite.
   */
  public function edit(){
    if(!empty($_POST['title']) && !empty($_POST['content'])){
      $result = $this->post->update(htmlspecialchars($_GET['id']), array(
        'title' => htmlspecialchars(htmlspecialchars($_POST['title'])),
        'content' => $_POST['content']
      ));
      if($result){
        header('location: index.php?page=admin.posts.index&success=updatedpost');
      }
    }

    $post = $this->post->getSingle(htmlspecialchars($_GET['id']));
    $form = new BootstrapForm($post);
    $pageTitle = $this->completeTitle('Editer un chapitre');
    $this->render('admin.posts.edit', compact('form', 'success', 'pageTitle'));
  }

  /**
   * Affiche la page de création de post,
   * crée un post si les variables $_POST['title'] et $_POST['content'] ne sont pas vides,
   * puis renvoie vers la page d'édition dudit post.
   */
  public function add(){

    if(!empty($_POST['title']) && !empty($_POST['content'])){
      $result = $this->post->create(array(
        'title' => htmlspecialchars($_POST['title']),
        'content' => $_POST['content']
      ));

      if($result){
      header('location: index.php?page=admin.posts.index&success=addedpost');
      }
    }

    $form = new BootstrapForm($_POST);
    $pageTitle = $this->completeTitle('Nouveau chapitre');
    $this->render('admin.posts.edit', compact('form', 'pageTitle'));

  }

  /**
   * Supprime le post dont  l'id est récupéré par la méthode POST et les commentaires et signalements qui y sont associés,
   * puis renvoie vers la page d'administration des posts en donnant la valeur "deletedpost" à la variable $_GET['succes'].
   */
  public function delete(){
    if(!empty($_POST)){
      $this->post->delete($_POST['id']);
      $this->comment->deleteAttached($_POST['id']);
      $this->report->deleteAttachedToPost($_POST['id']);
      header('location: index.php?page=admin.posts.index&success=deletedpost');
    }
  }


}
