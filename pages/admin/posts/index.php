<h1>Administration</h1>



<p><a href="?page=admin.posts.add" class="btn btn-success">Nouveau</a></p>
<table class="table">
  <thead>
    <tr>
      <td>Id</td>
      <td>Titre</td>
      <td>Date</td>
      <td>Commentaires</td>
    </tr>
  </thead>
  <tbody>
<?php foreach(App::getInstance()->getTable('post')->getAll() as $post): ?>
<tr>
  <td><?= $post->id ?></td>
  <td><?= $post->title ?></td>
  <td><?= $post->post_date ?></td>
  <td>Commentaires</td>
  <td>
    <a class="btn btn-primary" href="admin.php?page=admin.posts.edit&id=<?= $post->id ?>">Éditer</a>

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
