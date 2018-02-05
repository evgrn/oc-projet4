

<h1>Bienvenue sur <strong>Billet Simple pour l'Alaska</strong></h1>
<p>Je publierai ici chaque semaine une nouvelle page de mon roman éponyme.</p>



<?php foreach($posts as $post): ?>

  <article class="chapter">
    <h2 class="chapter-title-index"><?= $post->title ?></h2>
    <p class="chapter-date-index"><?= $post->date ?></p>
    <p class="chapter-content-index"><?= $post->excerpt ?></p>
    <p><a class="btn btn-primary" href="<?=$post->guestUrl  ?>">Lire le chapitre</a></p>
  </article>

<?php endforeach; ?>
