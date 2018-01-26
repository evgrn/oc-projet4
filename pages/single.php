<?php $post = $db->prepare('SELECT * FROM articles WHERE id = ?', [$_GET['id']], 'App\Table\Article', true); ?>

<h1 class="chapter-title-single"><?= $post->title ?></h1>
<p class="chapter-date-single"><?= $post->date ?></p>
<p class="chapter-content-single"><?= $post->content ?></p>
