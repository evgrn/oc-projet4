<?php

namespace App\Model\Table;

/**
 * Modèle des users.
 */
class UserTable extends \Core\Model\Table\Table{


  /**
   * Vérifie s'il existe une entrée comportant au moins une valeur en commun avec les paramètres dans la table des utilisateurs,
   * si c'est le cas, renvoie le champ correspondant,
   * sinon renvoie false.
   * @param  string $name Nom de l'utilisateur
   * @param  string $mail Mail de l'utilisateur
   * @return bool/string       Résultat de la requête
   */
  public function exists($name, $mail){

    if($this->query("SELECT * FROM " . $this->table . " WHERE mail = ?",
        [$mail],
        true)){
      return 'mail';
    }
    elseif($this->query('SELECT * FROM ' . $this->table . ' WHERE name = ?', [$name])){
      return 'name';
    }
    return false;
  }

  /**
   * Crée un nouvel utilisareur en entrant ses informations dans la table des utilisateur.
   * @param  array $fields      Informations de l'utilisateur
   * @return bool/string        Renvoie true si l'utilisateur a été créé, renvoie le motif de l'erreur sinon.
   */
  public function create($fields){
    $error = $this->exists($fields['name'], $fields['mail']);
    if(!$error){
      $sql_indexes = [];
      $sql_values = [];

      foreach($fields as $key => $value){
          $sql_indexes[] = "$key = ?";
          $sql_values[] = $value;
        }

      $sql_indexes = implode(', ', $sql_indexes);
      return $this->query("INSERT INTO  " . $this->table . ' SET user_type = 2, ' . $sql_indexes ,  $sql_values, true );

    }
    return $error;
  }

}
