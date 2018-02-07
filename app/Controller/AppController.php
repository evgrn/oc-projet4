<?php
namespace App\Controller;
use Core\Controller\Controller;
use Core\Auth\DBAuth;
use App;

/**
 * Classe mère de tous les contrôleurs de la partie App.
 */
class AppController extends Controller{

  protected $viewsPath = ROOT . '/app/Views/';
  protected $template = 'default';
  protected $siteTitle = ' | Billet Simple pour l\'Alaska';

  /**
   * Ajoute un sous-titre au titre de la page.
   * @param  string $subtitle sous-titre de la page
   */
  protected function completeTitle($subtitle){
    return $subtitle . $this->siteTitle;
  }

  /**
   * Définit la barre de navigation selon le statut de l'utilisateur lors de la construction.
   */
  public function __construct(){
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
   * Interdit l'accès à la page demandée en affichant la vue accessdenied.php.
   */
  protected function forbidden(){
    header('HTTP/1.0 403 Forbidden');
    $pageTitle = $this->completeTitle('Accès interdit');
    die($this->render('accessdenied', compact('pageTitle')));
  }

  /**
   * Affiche la page vue notfound.
   */
  public function notFound(){
    $pageTitle = $this->completeTitle('Page non trouvée');
    $this->render('notfound',compact('pageTitle'));
  }
  /**
   * Récupère le chemin de la vue et un tableau contenant les données à y insérer, et génère la vue,
   * affiche un message de succès le cas échéant,
   * affiche la navbar selon le statut de l'utilisateur.
   * @param  string $view  Chemin de la vue
   * @param  array  $data  Données à passer à la vue
   */
  protected function render($view, $data = []){
    extract($data);
    $successMessage = $this->getSuccessMessage();

    $viewPath = $this->viewsPath . str_replace('.', '/', $view) . '.php';
    $containerClass = str_replace('.', '-', $view);
    ob_start();
    require($viewPath);
    $content = ob_get_clean();

    $navViewPath = $this->viewsPath . 'templates/navbar/' . $this->navbar . '.php';
    ob_start();
    require($navViewPath);
    $navbar = ob_get_clean();

    require($this->viewsPath . 'templates/' . $this->template . '.php');
  }

  /**
   * Si la variable $_GET['success'] n'est pas vide, affiche le message de succès correspondant à son contenu.
   */
  protected function getSuccessMessage(){
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
              break;
        }

        require ROOT . '/app/Views/success.php';

    }
  }


}
