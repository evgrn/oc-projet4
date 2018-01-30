<?php if($error == true): ?>
  <div class="alert alert-danger">
    Identifiants incorrects
  </div>
<?php endif; ?>
<form method="post">
  <?= $form->input('name', 'Identifiant')?>
  <?= $form->input('pwd', 'Mot de passe', ['type' =>'password']) ?>
  <?= $form->submit() ?>
</form>
