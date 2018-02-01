<?php if($error == true): ?>
  <div class="alert alert-danger">
    Identifiants incorrects
  </div>
<?php endif; ?>
<h1>Connexion</h1>
<form method="post">
  <?= $form->input('name', 'Identifiant')?>
  <?= $form->input('pwd', 'Mot de passe', ['type' =>'password']) ?>
  <?= $form->submit() ?>
</form>
