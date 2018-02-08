<?php
namespace App\Model\Element;

/**
 *
 * Modèle des User
 */
class UserElement extends \Core\Model\Element\Element{

  /**
   * Renvoie le nom de l'utilisateur.
   * @return string nom de l'utilisateur
   */
  public function getName(){
    return $this->name;
  }


}
