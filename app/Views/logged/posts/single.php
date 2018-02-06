<article class="chapter-index">
  <h1 class="chapter-title-single"><?= $post->title ?></h1>
  <p class="chapter-date-single"><?= $post->date ?></p>
  <p class="chapter-content-single"><?= $post->content ?></p>
</article>

<aside class="comments">
  <h2 class="comments-title">Commentaires <span class="comments-sum">(<?= $commentAmount ?>)</span></h2>
  <h3>Votre commentaire</h3>
  <form method="post" class="comment-form" id="comment-form">
    <?= $form->input('title', 'Titre', null, ['required' => true])?>
    <?= $form->input('content', 'Contenu', null, ['type' =>'textarea', 'required' => true]) ?>
    <?= $form->input('post_id', null, htmlspecialchars($_GET['id']), ['type' => 'hidden']) ?>
    <?= $form->input('user_id', null, htmlspecialchars($_SESSION['userName']), ['type' => 'hidden']) ?>

    <?= $form->submit() ?>
  </form>
  <div class="comments-list">
    <?php foreach($comments as $comment): ?>
    <div class="comment" id="comment-<?= $comment->id ?>">
      <h3 class="comment-title"><?= $comment->title ?></h3>
      <?= $comment->reportItem ?>
      <p class="comment-details">Par <?= $comment->author ?>, le <?= $comment->date ?></p>
      <p class="comment-content"><?= $comment->content ?></p>
    </div>
  <?php endforeach; ?>
  </div>


</aside>
