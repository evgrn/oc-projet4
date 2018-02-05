<h1>Commentaires signalés liés à <?= $post->title ?></h1>

<table class="table">
  <thead>
    <tr>
      <td>Id</td>
      <td>Auteur</td>
      <td>Date</td>
      <td>Extrait</td>
      <td>Nombre de signalements</td>
    </tr>
  </thead>
  <tbody>
<?php foreach($comments as $comment): ?>
<tr>
  <td><?= $comment->id ?> </td>
  <td><?= $comment->author ?></td>
  <td><?= $comment->date ?></td>
  <td><?= $comment->excerpt ?></td>
  <td><?= $comment->reports ?></td>
  <td>
    <a class="btn btn-primary" href="index.php?page=admin.comments.single&amp;id=<?= $comment->id ?>">Consulter</a>
    <?= $comment->unreport ?>


    <form action="?page=admin.comments.delete" method="post" style="display: inline;">
      <?= $form->input('post-id', null, $post->id, ['type' => 'hidden']) ?>
      <?= $form->input('id', null, $comment->id, ['type' => 'hidden']) ?>
      <?= $form->submit('Supprimer', 'danger')?>
    </form>
  </td>
</tr>


<?php endforeach; ?>

</tbody>
  </table>
</div><!-- .main-content>
