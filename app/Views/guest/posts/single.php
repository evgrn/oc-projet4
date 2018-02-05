<article class="chapter-index">
  <h1 class="chapter-title-single"><?= $post->title ?></h1>
  <p class="chapter-date-single"><?= $post->date ?></p>
  <p class="chapter-content-single"><?= $post->content ?></p>
</article>

<aside class="comments">
  <h2 class="comments-title">Commentaires <span class="comments-sum">(<?= $commentAmount ?>)</span></h2>
  <p class="help-block"><a href="index.php?page=users.login">Connectez-vous</a> pour lire et écrire des commentaires.</p>
</aside>
