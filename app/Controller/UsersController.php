<?php

namespace App\Controller;
use \App;

class UsersController extends AppController{

  public function login(){

    $error = false;

    if(!empty($_POST)){
      $auth = new \Core\Auth\DBAuth(App::getInstance()->getDb());

      if($auth->login($_POST['name'], $_POST['pwd'])){
        header('location: index.php?page=admin.posts.index');
      }
      else{
        $error = true;
      }
    }

    $form = new \Core\HTML\BootstrapForm($_POST);

    $this->render('users.login', compact('form', 'error'));
  }

}
