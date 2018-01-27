<?php
namespace Core\Model;

/**
 * Classe parente des modèles de données.
 * Contient les méthodes communes à ses enfants.
 */
abstract class Model{

  /**
   * Remplace dynamiquement la propriété appelée par le getter de la approprié et la remplace par celui-ci,
   * puis envoie la propriété ainsi générée.
   * @param  string $param Paramètre appelé.
   * @return string        Propriété générée dynamiquement.
   */
  public function __get($param){
    $method = 'get' . ucfirst(strtolower($param));
    $this->$param = $this->$method(); // Ne pas appeler la méthode à chaque fois
    return $this->$param;

  }

  /**
   * Renvoie la date du post.
   * @return string Date du post
   */
  public function getDate(){
    return $this->date;
  }
}
