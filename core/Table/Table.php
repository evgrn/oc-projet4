<?php

namespace Core\Table;

use Core\DB\DB;

/**
 * Classe parente des modèles de tables
 */
abstract class Table{

  protected $table;
  protected $db;


  /**
   * Récupère la table correspondant à la classe dans la BDD et la stocke dans l'objet courant.
   * @param DB $db Instance d'un enfant de la classe DB
   */
  public function __construct(\Core\DB\DB $db){
    $this->db = $db;
    if(!$this->table){
      $class_name = explode('\\', get_class($this));
      $class_name = end($class_name);
      $table_name = strtolower(str_replace('Table', '', $class_name)) . 's';
      $this->table = $table_name;
    }

  }

  /**
   * Récupère le post correspondant à $_GET['id'].
   * @return object Objet de l'article correspondant
   */
    public function getSingle(){
      return $this->query("SELECT * FROM " . $this->table . " WHERE id = ?",
          [$_GET['id']],
          true);
    }



  /**
   * Effectue une requête SQL et renvoie les éléments demandés.
   * @param  string       $statement          Requête SQL
   * @param  array        $statement_params   Paramètres de la requête SQL, nul par défaut
   * @param  bool         $single             True si on veut récupérer un seul objet, False sinon
   * @return array/object                     Résultat de la requête
   */
  public function query($statement, $statement_params = null, $single = null){
    if(!$statement_params){
      return $this->db->query(
          $statement,
          str_replace('Table', 'Model', get_class($this)),
          $single);
    }
    else{
      return $this->db->prepare(
          $statement,
          $statement_params,
          str_replace('Table', 'Model', get_class($this)),
          $single);
    }
  }

}