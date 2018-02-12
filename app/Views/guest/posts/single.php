<header>
  <h1 class="chapter-title-single"><?= $post->title ?></h1>
</header>

<div class="main-content">
  <article class="chapter-index">
    <div class="row">
        <div class="chapter-content-single col-xs-12"><?= $post->content ?></div>
    </div>
    <div class="row">
      <p class="chapter-date-single col-md-offset-10 col-md-2 col-sm-offset-9 col-sm-3 col-xs-offset-5 col-xs-6"><?= $post->date ?></p>
    </div>
    <a class="row next-chapter" href="<?= $nextPost->guestUrl?>">
      <p>Chapitre suivant : </p>
      <h4><?= $nextPost->title ?></h4>
    </a>
  </article>

  <aside class="comment">
    <h2 class="comments-title">Commentaires <span class="comments-sum"><?= $commentAmount ?></span></h2>
    <p class="help-block"><a href="index.php?page=users.login">Connectez-vous</a> pour lire et écrire des commentaires.</p>
  </aside>
</div><!--.main-content-->
