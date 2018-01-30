<?php
$postTable = App::getInstance()->getTable('post');
if(!empty($_POST)){
  $postTable->delete($_POST['id']);
  header('location: admin.php?posts.index&success=deleted');
}
