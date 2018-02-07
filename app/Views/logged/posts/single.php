<header>
  <h1 class="chapter-title-single"><?= $post->title ?></h1>
</header>

<div class="main-content">
  
  <article class="chapter-index">
    <div class="row">
        <div class="chapter-content-single col-xs-12"><?= $post->content ?></div>
    </div>
    <div class="row">
      <p class="chapter-date-single col-sm-offset-10 col-sm-2 col-xs-offset-5 col-xs-6"><?= $post->date ?></p>
    </div>
    <a class="row next-chapter" href="<?= $nextPost->url?>">
      <p>Chapitre suivant : </p>
      <h4><?= $nextPost->title ?></h4>
    </a>
  </article>

  <aside class="comments">
    <h2 class="comments-title">Commentaires <span class="comments-sum"><?= $commentAmount ?></span></h2>
    <div class="add-comment row">
      <h3>Votre commentaire</h3>
      <form method="post" class="comment-form" id="comment-form">
        <?= $form->input('title', 'Titre', null, ['required' => true])?>
        <?= $form->input('content', 'Contenu', null, ['type' =>'textarea', 'required' => true]) ?>
        <?= $form->input('post_id', null, htmlspecialchars($_GET['id']), ['type' => 'hidden']) ?>
        <?= $form->input('user_id', null, htmlspecialchars($_SESSION['userName']), ['type' => 'hidden']) ?>
        <?= $form->submit() ?>
      </form>
    </div>

    <div class="comments-list">
      <?php foreach($comments as $comment): ?>
        <div class="comment-block row" id="comment-<?= $comment->id ?>">
          <div class="comment col-sm-9">
            <h3 class="comment-title"><?= $comment->title ?></h3>
            <p class="comment-details">Par <?= $comment->author ?>, le <?= $comment->date ?></p>
            <p class="comment-content"><?= $comment->content ?></p>
          </div>
          <div class="comment-report col-sm-offset-1 col-sm-2">
            <?= $comment->reportItem ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div><!--.comments-list-->
  </aside>
</div><!--.main-content-->
