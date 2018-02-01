<?php
namespace App\Model;

/**
 *
 * Modèle des User
 */
class UserModel extends \Core\Model\Model{

  /**
   * Renvoie le nom de l'utilisateur.
   * @return string nom de l'utilisateur
   */
  public function getName(){
    return $this->name;
  }


}
