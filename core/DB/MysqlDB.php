<?php
namespace Core\DB;
use \PDO;

/**
 * Classe gérant la connexion et les requêtes à la base de donnée.
 */
class MysqlDB extends \Core\DB\DB{
  private $db_name;
  private $db_host;
  private $db_usr;
  private $db_pwd;
  private $pdo;

  /**
   * Récupération des identifiants de connexion à la BDD
   *
   * @param string $db_name
   * @param string $db_host
   * @param string $db_usr
   * @param string $db_pwd
   */
  public function __construct($db_name, $db_host = 'localhost', $db_usr = 'root', $db_pwd = 'root'){
    $this->db_name = $db_name;
    $this->db_host = $db_host;
    $this->db_usr = $db_usr;
    $this->db_pwd = $db_pwd;
  }

  /**
   * Instancie PDO dans l'objet DB et le renvoie.
   * @return \PDO Instance de PDO connecté à la BDD
   */
  private function getPDO(){
    if($this->pdo === null){
      $pdo = new PDO("mysql:dbname=$this->db_name;host:$this->db_host", $this->db_usr, $this->db_pwd);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->pdo = $pdo;
    }

    return $this->pdo;

  }

  /**
   * Effectue une requête non préparée et renvoie le résultat sous forme d'objets de la classe désirée.
   * @param  string   $statement  Requête SQL
   * @param  string   $class_name Nom de la classe dont doivent être issus les objets retournés, nul par défaut.
   * @param  boolean  $single     True si on veut récupérer un seul objet, False sinon. False par défaut.
   * @return array                Tableau contenant les objets générés en fonction du résultat
   */
  public function query($statement, $class_name = null, $single = false){
    $req = $this->getPDO()->query($statement);
    if(
      strpos($statement, 'UPDATE') === 0 ||
      strpos($statement, 'INSERT') === 0 ||
      strpos($statement, 'DELETE') === 0
    ){
      return $req;
    }
    if($class_name != null){
      $req->setFetchMode(PDO::FETCH_CLASS, $class_name);
    }
    else{
        $req->setFetchMode(PDO::FETCH_OBJ);
    }
    if($single){
        $data = $req->fetch();
    }
    else{
        $data = $req->fetchAll();
    }

    return $data;
  }

  /**
   * Effectue une requête préparée et renvoie le resultat sous forme d'objets de la classe désirée.
   * @param  string  $statement        Requête SQL
   * @param  array  $statement_params  Paramètres de la requête SQL
   * @param  string  $class_name       Nom de la classe dont doivent être issus les objets retournés
   * @param  boolean $single           True si on veut récupérer un seul objet, False sinon
   * @return array/object              Résultat de la requête
   */
  public function prepare($statement, $statement_params, $class_name = null, $single = false){
    $req = $this->getPDO()->prepare($statement);
    $result = $req->execute($statement_params);

    if(
      strpos($statement, 'UPDATE') === 0 ||
      strpos($statement, 'INSERT') === 0 ||
      strpos($statement, 'DELETE') === 0
    ){
      return $result;
    }
    elseif( strpos($statement, 'SELECT COUNT(*)') === 0){
      $req->setFetchMode(PDO::FETCH_NUM);
      return intval($req->fetch()[0]);
    }
    if($class_name != null){
      $req->setFetchMode(PDO::FETCH_CLASS, $class_name);
    }
    else{
        $req->setFetchMode(PDO::FETCH_OBJ);
    }

    if(!$single == true){
      $data = $req->fetchAll();
    }
    else{
      $data = $req->fetch();
    }

    return $data;
  }


  /**
   * Affiche l'id de la dernière ligne insérée dans la table.
   * @return int id de la dernière ligne insérée dans la table
   */
  public function getLastInsertedId(){
    return $this->getPDO()->lastInsertId();
  }


}
