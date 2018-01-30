<?php
$postTable = App::getInstance()->getTable('post');
if(!empty($_POST)){
  $result = $postTable->create(array(
    'title' => $_POST['title'],
    'content' => $_POST['content']
  ));


  if($result){
    ?>
    <?php  header('location: admin.php?page=admin.posts.edit&id=' . App::getInstance()->getDb()->getLastInsertedId());?>
    <div class="alert alert-success">
      Le chapitre a bien été ajouté.
    </div>
    <?
  }
}

 ?>
<?php $form = new \Core\HTML\BootstrapForm($_POST); ?>
<form method="post">
  <?= $form->input('title', 'Titre')?>
  <?= $form->input('content', 'Contenu', ['type' =>'textarea']) ?>
  <?= $form->submit() ?>
</form>
