<?php

namespace App;

class AlertManager{

  /**
   * Si la variable $_GET['success'] n'est pas vide, affiche le message de succès correspondant à son contenu,
   * Si la variable $_GET['error'] n'est pas vide, affiche le message d'erreur correspondant à son contenu.
   */
  public static function getAlert(){
    if(isset($_GET['success'])){
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
          case 'registered':
              $message = 'Votre inscription est à présent effective. Veuillez vous connecter pour lire et écrire des commentaires.';
              break;
          case 'updatedpost':
              $message = 'Le chapitre a bien été modifié.';
              break;
          default:
              $message= 'Aucun message disponible pour ce succès';
              break;
        }

        require ROOT . '/app/Views/success.php';

    }

    else if(isset($_GET['error'])){
      switch ($_GET['error']) {
          case 'forbidden':
              $message = "Vous n'avez pas l'autorisation d'accéder à cette page.";
              require ROOT . '/app/Views/errors.php';
              break;
          case 'notfound':
              $message = "La page demandée n'existe pas.";
              require ROOT . '/app/Views/errors.php';
              break;
          case 'mailtaken':
              $message = "L'adresse mail que vous avez renseigné est déjà utilisée.";
              require ROOT . '/app/Views/errors.php';
              break;
          case 'nametaken':
              $message = "Le nom d'utilisateur que vous avez choisi est déjà utilisé.";
              require ROOT . '/app/Views/errors.php';
              break;
          case 'nametaken':
              $message = "Le nom d'utilisateur que vous avez choisi est déjà utilisé.";
              require ROOT . '/app/Views/errors.php';
              break;
          case 'wronglogin':
              $message = "Identifiants incorrects.";
              require ROOT . '/app/Views/errors.php';
              break;
          default:
              $message= 'Aucun message disponible pour cette erreur';
              break;
        }
    }
  }
}
