<header>
  <h1>Liste des chapitres</h1>
</header>

<div class="main-content">
    <ul class="chapters-list list-group">
      <?php foreach($posts as $post): ?>
        <li class="chapter-list-entry list-group-item">
          <?= $post->id ?>.  <a href="<?= $post->url ?>"><?= $post->title ?></a><br>Mis en ligne le <?= $post->date ?>.
        </li>
      <?php endforeach; ?>
    </ul>
</div><!--.main-content-->
