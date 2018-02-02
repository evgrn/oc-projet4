

<?php
if(isset($_GET['success'])){
  $message = '';
  switch ($_GET['success']) {
      case 'loggedin':
          if(isset($_GET['username'])){
            $message = 'Bienvenue <strong>' . $_GET['username'] . '</strong>. Vous êtes à présent connecté.';
          }
          break;
      case 'loggedout':
          $message = 'Vous êtes à présent déconnecté.';
          break;
      case 'reportedcomment':
          $message = 'Vous avez bien signalé le commentaire.';
          break;
      case 'addedcomment':
          $message = 'Votre commentaire a bien été ajouté.';
          break;
      case 'deletedcomment':
          $message = 'Le commentaire a bien été supprimé.';
          break;
      case 'addedpost':
          $message = 'Le chapitre a bien été ajouté.';
          break;
      case 'deletedpost':
          $message = 'Le chapitre a bien été supprimé.';
          break;
      case 'unreportedcomment':
          $message = 'Le signalement du commentaire a bien été supprimé.';
          break;
      case 'updatedpost':
          $message = 'Le chapitre a bien été modifié.';
          break;
    }
    ?>
        <div class="alert alert-success">
          <?= $message ?>
        </div>

    <?php

}
