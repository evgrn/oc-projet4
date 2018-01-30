<?php

namespace App\Controller\Admin;
use App;

class PostsController extends AppController{

  public function __construct(){
    parent::__construct();
    $this->loadModel('post');
    $this->loadModel('comment');
  }

  public function index(){
    $posts = $this->post->getAll();
    $this->render('admin.posts.index', compact('posts'));
  }
  public function edit(){
    if(!empty($_POST)){
      $result = $this->post->update($_GET['id'], array(
        'title' => $_POST['title'],
        'content' => $_POST['content']
      ));
      if($result){
        header('location: index.php?page=admin.posts.index');
      }
    }

    $post = $this->post->getSingle($_GET['id']);
    $form = new \Core\HTML\BootstrapForm($post);

    $this->render('admin.posts.edit', compact('form', 'success'));
  }


public function add(){

  if(!empty($_POST)){
    $result = $this->post->create(array(
      'title' => $_POST['title'],
      'content' => $_POST['content']
    ));

    if($result){
    header('location: index.php?page=admin.posts.edit&id=' . App::getInstance()->getDb()->getLastInsertedId());
    }
  }

  $form = new \Core\HTML\BootstrapForm($_POST);

  $this->render('admin.posts.edit', compact('form'));

}

public function delete(){
  if(!empty($_POST)){
    $this->post->delete($_POST['id']);
    header('location: index.php?page=admin.posts.index&success=deleted');
  }
}


}
