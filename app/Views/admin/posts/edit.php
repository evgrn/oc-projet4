
<form method="post">
  <?= $form->input('title', 'Titre')?>
  <?= $form->input('content', 'Contenu', ['type' =>'textarea']) ?>
  <?= $form->submit() ?>
</form>
