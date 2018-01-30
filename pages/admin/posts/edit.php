<?php
$postTable = App::getInstance()->getTable('post');
if(!empty($_POST)){
  $result = $postTable->update($_GET['id'], array(
    'title' => $_POST['title'],
    'content' => $_POST['content']
  ));
  if($result){
    ?>
    <div class="alert alert-success">
      Le chapitre a bien été modifié.
    </div>
    <?
  }
}

 ?>
<?php $post = $postTable->getSingle($_GET['id']); ?>
<?php $form = new \Core\HTML\BootstrapForm($post); ?>
<form method="post">
  <?= $form->input('title', 'Titre')?>
  <?= $form->input('content', 'Contenu', ['type' =>'textarea']) ?>
  <?= $form->submit() ?>
</form>
