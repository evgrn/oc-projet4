<article class="comment-single">
  <h1 class="comment-title-single"><?= $comment->title ?></h1>
  <?= $comment->reportNotification ?>
  <form action="?page=admin.comments.delete" method="post" class="pull-right">
    <?= $form->input('post-id', null, $post->id, ['type' => 'hidden']) ?>
    <?= $form->input('id', null, $comment->id, ['type' => 'hidden']) ?>
    <?= $form->submit('Supprimer', 'danger')?>

  </form>
  <?= $comment->unreport ?>
  <p class="comment-single-details">À propos de "<?= $post->title ?>", par <?= $comment->author ?>, le <?= $comment->date ?></p>
  <p class="comment-content-single"><?= $comment->content ?></p>
</article>
