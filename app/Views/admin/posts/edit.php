
<form method="post" id="post-form">
  <?= $form->input('title', 'Titre', null)?>
  <?= $form->input('content', 'Contenu', null, ['type' =>'textarea']) ?>
  <?= $form->submit('Sauvegarder', 'success') ?>
</form>
