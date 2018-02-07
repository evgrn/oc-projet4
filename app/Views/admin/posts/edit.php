<header>
  <h1>Éditeur de chapitres</h1>
</header>

<div class="main-content row" >
  <form method="post" id="post-form">
    <?= $form->input('title', 'Titre', null)?>
    <?= $form->input('content', 'Contenu', null, ['type' =>'textarea']) ?>
    <?= $form->submit('Sauvegarder', 'success') ?>
  </form>
</div><!--.main-content-->
