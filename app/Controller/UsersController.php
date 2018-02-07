<?php

namespace App\Controller;
use \App;
use \Core\Auth\DBAuth;
use \Core\HTML\BootstrapForm;

/**
 * Contrôleur de la partie Users
 */
class UsersController extends AppController{

  /**
   * Charge le constructeur parent (choisit la navbar en fonction du type d'tilisateur),
   * charge le modèle de table "user" dans sa propre instance. // utile ?
   */
  public function __construct(){
    parent::__construct();
    $this->loadModel('user'); // utile ?
  }

  /**
   * Affiche un formulaire de connexion,
   * si la variable $_POST n'est pas vide, tente la connexion,
   * si la connexion échoue, donne la valeur "true" à l'erreur envoyée à la vue,
   * sinon, si l'utilisateur est administrateur, redirige vers l'index d'administration des posts, sinon vers l'accueil,
   * à chaque fois en ajoutant la valeur "loggedin" à la variable $_GET['success'].
   */
  public function login(){

    $error = false;

    if(!empty($_POST)){
      $auth = new DBAuth(App::getInstance()->getDb());

      if($auth->login(htmlspecialchars($_POST['name']),htmlspecialchars( $_POST['pwd']))){
        if($auth->isAdmin()){

          header('location: index.php?page=admin.posts.index&success=loggedin&username=' . $_POST['name']);
        }
        else{
          header('location: index.php?page=logged.posts.index&success=loggedin&username=' . $_POST['name']);
        }

      }
      else{
        $error = true;
      }
    }

    $form = new BootstrapForm($_POST);
    $pageTitle = $this->completeTitle('Connexion');
    $this->render('users.login', compact('form', 'error', 'pageTitle'));
  }

  /**
   * Déconnecte l'utilisateur
   * et le renvoie vers la page d'accueil publique en donnant la valeur "loggedout" à la variable $_GET['success'].
   */
  public function logout(){
          $auth = new DBAuth(App::getInstance()->getDb());
          $auth->logout();
          header('location: index.php?success=loggedout');
  }

  /**
   * Affiche un formulaire d'inscription,
   * si la variable $_POST n'est pas vide, tente l'inscription,
   * si l'inscription réussit, redirige vers l'index en donnant la valeur "registered" à la variable $_GET['success'],
   * sinon, renvoie le motif de l'échec dans la variable $error.
   */
  public function register(){

    $error = false;

    if(!empty($_POST)){
      $result = $this->user->create(array(
        'name' => htmlspecialchars($_POST['name']),
        'pwd' => password_hash($_POST['pwd'], PASSWORD_DEFAULT),
        'mail' => htmlspecialchars($_POST['mail'])
      ));

      if($result === true){
      header('location: index.php?success=registered');
      }
      else{
        if($result == 'name'){
          $error = 'Nom d\'utilisateur';
        }elseif($result == 'mail'){
          $error = 'Adresse mail';
        }
      }
    }

    $form = new BootstrapForm($_POST);
    $pageTitle = $this->completeTitle('Inscription');
    $this->render('users.register', compact('form', 'error', 'pageTitle'));
  }

}
