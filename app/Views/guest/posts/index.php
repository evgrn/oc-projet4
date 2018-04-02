
<header>
<h1>Derniers chapitres</h1>
</header>

<div class="main-content">
  <?php foreach($posts as $post): ?>
    <article class="chapter">
      <div class="row">
        <h2 class="chapter-title-index"><?= htmlspecialchars($post->title) ?></h2>
      </div>
      <div class="row">
        <p class="col-md-2 col-sm-3 col-xs-6  chapter-date-index"><?= $post->date ?></p>
      </div>
      <div class="row">
          <p class="col-xs-12 chapter-content-index"><?= $post->excerpt ?></p>
      </div>
      <div class="row">
          <a class="col-sm-2 col-sm-offset-10 btn btn-primary " href="<?=$post->guestUrl  ?>">Lire le chapitre</a>
      </div>
    </article>
  <?php endforeach; ?>
</div><!--.main-content-->
