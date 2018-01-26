<?php $post = \App\Table\Post::getSingle(); ?>
<?php $comments = \App\Table\Comment::getAttachedComments(); ?>
<?php \App\App::setPageSubtitle($post->title); ?>


<article class="chapter-index">
  <h1 class="chapter-title-single"><?= $post->title ?></h1>
  <p class="chapter-date-single"><?= $post->post_date ?></p>
  <p class="chapter-content-single"><?= $post->content ?></p>
</article>

<aside class="comments">
  <h2 class="comments-title">Commentaires</h2>
  <?php foreach($comments as $comment): ?>
  <div class="comment">
    <h3 class="comment-title"><?= $comment->title ?></h3>
    <p class="comment-details">Par <?= $comment->author ?>, le <?= $comment->comment_date ?></p>
    <p class="comment-content"><?= $comment->content ?></p>
  </div>
<?php endforeach; ?>
</aside>
