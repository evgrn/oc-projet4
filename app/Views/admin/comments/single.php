<header>
    <h1 class="comment-title-single"><?= $comment->title ?></h1>
</header>

<div class="main-content">
  <article class="comment-single">
    <?= $comment->reportNotification ?>
    <div class="row">
      <div class="comment-content col-sm-8">
        <p class="comment-single-details">À propos de <em><a href="<?= $post->url ?>">"<?= $post->title ?>"</a></em></strong>, par <?= $comment->author ?>, le <?= $comment->date ?> : </p>
        <p class="comment-content-single"><?= $comment->content ?></p>
      </div>
      <div class="comment-tools col-sm-offset-1 col-sm-2">
        <form action="?page=admin.comments.delete" method="post" style="display: inline;">
          <input type="hidden" name="post-id" value="<?= $post->id ?>">
          <input type="hidden" name="id" value="<?= $comment->id ?>">
          <?= $form->submit('<i class="fas fa-trash-alt"></i>', 'danger')?>
        </form>
        <?= $comment->unreport ?>
      </div>
    </div><!--.row-->
  </article>
</div><!--.main-content-->
