<article class="chapter-index">
  <h1 class="chapter-title-single"><?= $post->title ?></h1>
  <p class="chapter-date-single"><?= $post->date ?></p>
  <p class="chapter-content-single"><?= $post->content ?></p>
</article>

<aside class="comments">
  <h2 class="comments-title">Commentaires <span class="comments-sum">(<?= $commentAmount ?>)</span></h2>
  <h3>Votre commentaire</h3>
  <form method="post" class="comment-form">
    <?= $form->input('title', 'Titre')?>
    <?= $form->input('content', 'Contenu', ['type' =>'textarea']) ?>
    <input type="hidden" name="post_id" value="<?= $_GET['id'] ?>">
    <input type="hidden" name="user_id" value="<?= $_SESSION['userName'] ?>">

    <?= $form->submit() ?>
  </form>
  <?php foreach($comments as $comment): ?>
  <div class="comment">
    <h3 class="comment-title"><?= $comment->title ?></h3>
     <?= $comment->reportButton ?>
    <p class="comment-details">Par <?= $comment->author ?>, le <?= $comment->date ?></p>
    <p class="comment-content"><?= $comment->content ?></p>
  </div>
<?php endforeach; ?>

</aside>
