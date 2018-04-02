<header>
<h1>Administration</h1>
</header>

<div class="main-content">
  <p><a href="?page=admin.posts.add" class="btn btn-success">Nouveau chapitre</a></p>
  <table class="table">
    <thead>
      <tr>
        <td>Id</td>
        <td>Titre</td>
        <td>Date</td>
        <td>Commentaires</td>
        <td>Commentaires signalés</td>
        <td>Actions</td>
      </tr>
    </thead>
    <tbody>
      <?php foreach($posts as $post): ?>
        <tr>
          <td><span class="mobile-table-label">Id : </span><?= $post->id ?></td>
          <td><span class="mobile-table-label">Titre : </span><a href="<?= $post->url ?>"><?= htmlspecialchars($post->title) ?></a></td>
          <td><span class="mobile-table-label">Date : </span><?= $post->date ?></td>
          <td><span class="mobile-table-label">Commentaires : </span><?= $post->commentNb ?></td>
          <td><span class="mobile-table-label">Commentaires signalés : </span><?= $post->reportedCommentNb ?></td>
          <td>
            <a class="btn btn-primary" href="index.php?page=admin.posts.edit&amp;id=<?= $post->id ?>"><i class="fas fa-edit"></i></a>
            <form action="?page=admin.posts.delete" method="post" style="display: inline;">
              <input type="hidden" name="id" value="<?= $post->id ?>">
              <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div><!-- .main-content>
