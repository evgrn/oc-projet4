<header>
<h1>Commentaires <?= $titleAddition ?> liés à <?= $post->title ?></h1>
</header>

<div class="main-content">
  <?= $noCommentMessage ?>
  <table class="table">
    <thead>
      <tr>
        <td>Id</td>
        <td>Auteur</td>
        <td>Date</td>
        <td>Titre</td>
        <td>Nombre de signalements</td>
        <td>Actions</td>
      </tr>
    </thead>
    <tbody>
      <?php foreach($comments as $comment): ?>
        <tr>
          <td><span class="mobile-table-label">Id : </span><?= $comment->id ?></td>
          <td><span class="mobile-table-label">Auteur : </span><?= $comment->author ?></td>
          <td><span class="mobile-table-label">Date : </span><?= $comment->date ?></td>
          <td><span class="mobile-table-label">Titre : </span><a href="<?= $comment->url ?>"><?= $comment->title ?></a></td>
          <td><span class="mobile-table-label">Signalements : </span><?= $comment->reports ?></td>
          <td>
            <?= $comment->unreport ?>
            <form action="?page=admin.comments.delete" method="post" style="display: inline;">
              <input type="hidden" name="post-id" value="<?= $post->id ?>">
              <input type="hidden" name="id" value="<?= $comment->id ?>">
              <?= $form->submit('<i class="fas fa-trash-alt"></i>', 'danger')?>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div><!-- .main-content>
