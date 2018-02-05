<?php
namespace App\Controller;
use Core\Controller\Controller;
use Core\Auth\DBAuth;
use App;

/**
 * Classe mère de tous les contrôleurs de la partie App.
 */
abstract class AppController extends Controller{

  protected $viewsPath = ROOT . '/app/Views/';
  protected $template = 'default';

  /**
   * Initialise le système de messages de succès et définit la barre de navigation selon le statut de l'utilisateur
   */
  public function __construct(){
    $this->successMessagesInit();
    $this->navbarSelect();
  }

  /**
   * Sélectionne le type de barre de navigation en fonction du statut de l'utilisateur
   */
  protected function navbarSelect(){
    $app = App::getInstance();
    $auth = new DBAuth($app->getDb());
    if(!$auth->isLogged()){
      $this->navbar = "default";
    }
    elseif(!$auth->isAdmin()){
      $this->navbar = "user";
    }
    else{
        $this->navbar = "admin";
    }
  }

  /**
   * Charge le modèle de table dont le nom correspond au paramètre et l'instancie dans sa propre instance
   * @param  string $modelName    Nom du modèle de table
   */
  protected function loadModel($modelName){
      $this->$modelName = App::getInstance()->getTable($modelName);
  }

  /**
   * Interdit l'accès à la page demandée en affichant la page accessdenied.php.
   */
  protected function forbidden(){
    header('HTTP/1.0 403 Forbidden');
    die($this->render('accessdenied', []));
  }

  /**
   * Si la variable $_GET['success'] n'est pas vide, affiche le message de succès correspondant à son contenu.
   */
  protected function successMessagesInit(){
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
          case 'updatedpost':
              $message = 'Le chapitre a bien été modifié.';
              break;
          default:
              break;
        }

        $this->render('success', compact('message'));

    }
  }


}
