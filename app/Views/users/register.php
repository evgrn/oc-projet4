<?php if($error != false): ?>
  <div class="alert alert-danger">
    <?= $error ?> indisponible.
  </div>
<?php endif; ?>
<h1>Incription</h1>
<form method="post">
  <?= $form->input('name', 'Nom')?>
  <?= $form->input('mail', 'Mail', ['type' =>'mail']) ?>
  <?= $form->input('pwd', 'Mot de passe', ['type' =>'password']) ?>
  <?= $form->input('pwd_confirm', 'Confirmation mot de passe', ['type' =>'password']) ?>
  <?= $form->submit() ?>
</form>
