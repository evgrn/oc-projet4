<?php

if(!empty($_POST)){
  $auth = new \Core\Auth\DBAuth(App::getInstance()->getDb());

  if($auth->login($_POST['name'], $_POST['pwd'])){
    header('location: admin.php?page=admin.posts.index');
  }
  else{
    ?>
    <div class="alert alert-danger">
      Identifiants incorrects

    </div>
    <?php
  }
}


 ?>


<?php $form = new \Core\HTML\BootstrapForm($_POST); ?>
<form method="post">
  <?= $form->input('name', 'Identifiant')?>
  <?= $form->input('pwd', 'Mot de passe', ['type' =>'password']) ?>
  <?= $form->submit() ?>
</form>
