<h1>Bienvenue sur <strong>Billet Simple pour l'Alaska</strong></h1>
<p>Voici la liste des chapitres.</p>


<ul class="chapters-list list-group">
<?php foreach($posts as $post): ?>
  <li class="chapter-list-entry list-group-item">
  <a href="<?= $post->guestUrl ?>"><?= $post->title ?></a>, mis en ligne le <?= $post->date ?>.
  </li>
<?php endforeach; ?>
</ul>
</div><!-- .main-content>
