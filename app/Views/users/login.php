<?php if($error == true): ?>
  <div class="alert alert-danger">
    Identifiants incorrects
  </div>
<?php endif; ?>

<header>
  <h1>Connexion</h1>
</header>

<div class="main-content">
  <form method="post">
    <?= $form->input('name', 'Identifiant', null, ['required' => true])?>
    <?= $form->input('pwd', 'Mot de passe', null,['type' =>'password', 'required' => true]) ?>
    <?= $form->submit('Envoyer') ?>
  </form>
</div><!--.main-content-->
