<?php

namespace App\Table;
use App\App;

/**
 * Classe parente des Modèles
 */
abstract class Table{

  protected static $table;

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
   * Effectue une requête SQL et renvoie les éléments demandés.
   * @param  string       $statement          Requête SQL
   * @param  array        $statement_params   Paramètres de la requête SQL, nul par défaut
   * @param  bool         $single             True si on veut récupérer un seul objet, False sinon
   * @return array/object                     Résultat de la requête
   */
  public static function query($statement, $statement_params = null, $single = null){
    if(!$statement_params){
      return App::getDb()->query($statement, get_called_class(), $single);
    }
    else{
      return App::getDb()->prepare($statement, $statement_params, get_called_class(), $single);
    }
  }

}
