<?php

namespace App\Controller;
use \App;

class PostsController extends AppController{

  public function __construct(){
    $this->loadModel('post');
    $this->loadModel('comment');
  }

  public function index(){
    $posts = $this->post->getLast(4);
    $this->render('posts.index', compact('posts'));
  }
  public function single(){
    $post = $this->post->getSingle();

    if($post === false){
      $this->notFound();
      return;
    }
    else{
      $comments = $this->comment->getAttachedComments();
      $this->render('posts.single', compact('post', 'comments'));
    }

  }

public function list(){
  $posts = $this->post->getAll();
  $this->render('posts.list', compact('posts'));
}

}
