<?php if($error != false): ?>
  <div class="alert alert-danger">
    <?= $error ?> indisponible.
  </div>
<?php endif; ?>
<h1>Incription</h1>
<form method="post">
  <?= $form->input('name', 'Nom', null, ['required' => true])?>
  <?= $form->input('mail', 'Mail',  null, ['type' =>'email', 'required' => true]) ?>
  <?= $form->input('pwd', 'Mot de passe',  null, ['type' =>'password', 'required' => true]) ?>
  <?= $form->input('pwd_confirm', 'Confirmation mot de passe',  null, ['type' =>'password', 'required' => true]) ?>
  <?= $form->submit('S\'inscrire') ?>
</form>
