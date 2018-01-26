<?php $posts = \App\Table\Post::getLast(3); ?>

<h1>Bienvenue sur <strong>Billet Simple pour l'Alaska</strong></h1>
<p>Je publierai ici chaque semaine une nouvelle page de mon roman éponyme.</p>


</div>
<?php foreach($posts as $post): ?>

  <article class="chapter">
    <h2 class="chapter-title-index"><?= $post->title ?></h2>
    <p class="chapter-date-index"><?= $post->post_date ?></p>
    <p class="chapter-content-index"><?= $post->excerpt ?></p>
  </article>

<?php endforeach; ?>

</div><!-- .main-content>
