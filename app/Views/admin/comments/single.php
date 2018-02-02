<article class="comment-single">
  <h1 class="comment-title-single"><?= $comment->title ?></h1>
  <?= $comment->reportNotification ?>
  <form action="?page=admin.comments.delete" method="post" class="pull-right">
    <input type="hidden" name="post-id" value="<?= $post->id ?>">
    <input type="hidden" name="id" value="<?= $comment->id ?>">
    <button type="submit" class="btn btn-danger">Supprimer</button>

  </form>
  <?= $comment->unreport ?>
  <p class="comment-single-details">À propos de "<?= $post->title ?>", par <?= $comment->author ?>, le <?= $comment->date ?></p>
  <p class="comment-content-single"><?= $comment->content ?></p>
</article>
