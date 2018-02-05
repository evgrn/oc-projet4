<?php if($error == true): ?>
  <div class="alert alert-danger">
    Identifiants incorrects
  </div>
<?php endif; ?>
<h1>Connexion</h1>
<form method="post">
  <?= $form->input('name', 'Identifiant', null, ['required' => true])?>
  <?= $form->input('pwd', 'Mot de passe', null,['type' =>'password', 'required' => true]) ?>
  <?= $form->submit('Envoyer') ?>
</form>
