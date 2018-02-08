<?php

namespace Core\Model\Table;

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
   * Récupère la ligne correspondant à $_GET['id'].
   * @return object Objet de l'article correspondant
   */
    public function getSingle($id){
      return $this->query("SELECT * FROM " . $this->table . " WHERE id = ?",
          [$id],
          true);
    }

  /**
   * Récupère toutes les lignes de la table.
   * @return array   Ensemble des lignes de la table
   */
  public function getAll(){
      return $this->query("SELECT * FROM " . $this->table . ' ORDER BY id DESC' );
    }

  /**
   * Effectue une requête SQL et renvoie les éléments demandés.
   * @param  string       $statement          Requête SQL
   * @param  array        $statement_params   Paramètres de la requête SQL, nul par défaut
   * @param  bool         $single             True si on veut récupérer un seul objet, False sinon
   * @return array/object                     Résultat de la requête
   */
  public function query($statement, $statement_params = null, $single = null){
    if(strpos($statement, 'SELECT COUNT(*)') === 0){
      return $this->db->prepare(
          $statement,
          $statement_params,
          null,
          $single);
    }
    else if(!$statement_params){
      return $this->db->query(
          $statement,
          str_replace('Table', 'Element', get_class($this)),
          $single);
    }
    else{
      return $this->db->prepare(
          $statement,
          $statement_params,
          str_replace('Table', 'Element', get_class($this)),
          $single);
    }
  }

  /**
   * Met à jour une ligne de la table en fonction des champs fournis.
   * @param  int $id        Id de la ligne à modifier
   * @param  array $fields  Champs à modifier et leurs valeurs
   * @return bool           Résultat de la requête
   */
  public function update($id, $fields){
    $sql_indexes = [];
    $sql_values = [];

    foreach($fields as $key => $value){
        $sql_indexes[] = "$key = ?";
        $sql_values[] = $value;
      }
      $sql_values[] = $id;
      $sql_indexes = implode(', ', $sql_indexes);


    return $this->query("UPDATE  " . $this->table . ' SET ' . $sql_indexes . ' WHERE id = ?', $sql_values, true );

  }

  /**
   * Crée une ligne de la table en fonction des champs fournis.
   * @param  string $fields Champs à créer et leurs valeurs
   * @return bool            Résultat de la requête
   */
  public function create($fields){
    $sql_indexes = [];
    $sql_values = [];

    foreach($fields as $key => $value){
        $sql_indexes[] = "$key = ?";
        $sql_values[] = $value;
      }

      $sql_indexes = implode(', ', $sql_indexes);


    return $this->query("INSERT INTO  " . $this->table . ' SET date = NOW(), ' . $sql_indexes ,  $sql_values, true );

  }

  /**
   * Supprime une ligne de la table
   * @param  int $id    Id de la ligne à supprimer
   */
  public function delete($id){
    $this->query("DELETE FROM {$this->table} WHERE id = ?", [$id]);
  }

}
