<?php
namespace Core\Auth;

/**
 * Classe gérant l'authentification via la base de donnée
 */
class DBAuth{

  private $db;

  /**
   * Instancie un objet d'une classe enfant de la classe abstraite DB en son sein.
   * @param Core\DB\DB  $db instance d'une classe enfant de la classe abstraite DB
   */
  public function __construct(\Core\DB\DB $db){
    $this->db = $db;
  }

  /**
   * Récupère l'ID de l'utilisateur de puis la variable $_SESSION
   * @return int/bool l'ID de l'utilisateur s'il existe, sinon false
   */
  public function getUsrId(){
    if($this->isLogged()){
      return $_SESSION['loggedAs'];
    }
    return false;

  }

  /**
   * Authentifie l'utilisateur en vérifiant s'il existe dans la table des utilisateurs,
   * puis vérifie si le mot de passe est correct.
   * @param  string $usrname Nom d'utilisateur
   * @param  string $pwd     Mot de passe de l'utilisateur
   * @return bool            True si la connexion a réussi, false sinon
   */
  public function login($usrname, $pwd){
    // Pas une recherche avec mdp pour pouvoir changer la méthode d'encryptage plus tard
    $usr = $this->db->prepare('SELECT * FROM users WHERE name = ?', [$usrname], null, true);

    if($usr){
      if($usr->pwd == sha1($pwd)){
        $_SESSION['loggedAs'] = $usr->id;
        $_SESSION['userType'] = $usr->user_type;
        $_SESSION['userName'] = $usr->name;
        return true;
      };
    }
    return false;
  }

  /**
   * Déconnexion de l'utilisateur en vidant la variable $_SESSION[];
   */
  public function logout(){
    $_SESSION = [];
  }

  /**
   * Définit si l'utilisateur est connecté en vérifiant si la variable $_SESSION['loggedAs'] n'est pas nulle.
   * @return boolean  True si l'utilisateur est connecté, false sinon
   */
  public function isLogged(){
    return isset($_SESSION['loggedAs']);
  }

  /**
   * Définit si l'utilisateur est administrateur en vérifiant si la variable $_SESSION['userType'] est égale à 1.
   * @return boolean  True si l'utilisateur a le statut d'administrateur, false sinon
   */
  public function isAdmin(){
    if(isset($_SESSION['userType'])){
      return $_SESSION['userType'] == 1;
    }
    return false;

  }

  /**
   * Récupère l'id de l'utilisateur via la variable $_SESSION['loggedAs'] s'il est connecté.
   * @return int/boolean  L'id de l'utilisateur s'il est connecté, false sinon
   */
  public function getUserId(){
    if($this->isLogged()){
      return $_SESSION['loggedAs'];
    }
    return false;
  }
}
