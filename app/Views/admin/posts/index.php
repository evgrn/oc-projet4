<h1>Administration</h1>



<p><a href="?page=admin.posts.add" class="btn btn-success">Nouveau</a></p>
<table class="table">
  <thead>
    <tr>
      <td>Id</td>
      <td>Titre</td>
      <td>Date</td>
      <td>Commentaires</td>
      <td>Commentaires signalés</td>
    </tr>
  </thead>
  <tbody>
<?php foreach($posts as $post): ?>
<tr>
  <td><?= $post->id ?></td>
  <td><?= $post->title ?></td>
  <td><?= $post->date ?></td>
  <td><a href="index.php?page=admin.comments.attached&amp;id=<?=$post->id?>"><?= $post->commentNb ?></a></td>
  <td><?= $post->reportedCommentNb ?></td>
  <td>
    <a class="btn btn-primary" href="index.php?page=admin.posts.edit&amp;id=<?= $post->id ?>">Éditer</a>

    <form action="?page=admin.posts.delete" method="post" style="display: inline;">
      <input type="hidden" name="id" value="<?= $post->id ?>">
      <button type="submit" class="btn btn-danger">Supprimer</button>
    </form>
  </td>
</tr>


<?php endforeach; ?>

</tbody>
  </table>
</div><!-- .main-content>
