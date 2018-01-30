<?php
namespace Core\Auth;
class DBAuth{
  private $db;

  public function __construct(\Core\DB\DB $db){
    $this->db = $db;
  }

  public function getUsrId(){
    if($this->isLogged()){
      return $_SESSION['loggedAs'];
    }
    return false;

  }

  // return boolean
  public function login($usrname, $pwd){
    $usr = $this->db->prepare('SELECT * FROM users WHERE name = ?', [$usrname], null, true);
    // On ne fait pas une recherche avec mdp pour pouvpoir changer la méthode d'encryptage plus tard
    if($usr){
      if($usr->pwd == sha1($pwd)){
        $_SESSION['loggedAs'] = $usr->id;
        return true;
      };
    }
    return false;
  }

  public function isLogged(){
    if(isset($_SESSION['loggedAs'])){
      return ($_SESSION['loggedAs'] == 1);
    }
    return false;
  }
}
