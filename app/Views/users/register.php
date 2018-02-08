
<header>
  <h1>Incription</h1>
</header>

<div class="main-content">
  <form id="register-form" method="post">
    <?= $form->input('name', 'Nom', null, ['required' => true, 'minlength' => 5])?>
    <?= $form->input('mail', 'Mail',  null, ['type' =>'email', 'required' => true]) ?>
    <?= $form->input('pwd', 'Mot de passe',  null, ['type' =>'password', 'required' => true, 'minlength' => 5]) ?>
    <?= $form->input('pwd_confirm', 'Confirmation mot de passe',  null, ['type' =>'password', 'required' => true, 'minlength' => 5]) ?>
    <?= $form->submit('S\'inscrire') ?>
  </form>
</div><!--.main-content-->
