<?php

## TODO :
## Configurer getExcerpt() en comptant les mots


namespace App\Table;

/**
 * Modèle des posts.
 */
class PostTable extends \Core\Table\Table{

  /**
   * Récupère un nombre défini de posts, par ordre décroissant de nouveauté.
   * @param  int $number Nombre de posts que l'on veut récupérer
   * @return array       Tableau regroupant les objets demandés par ordre décroissant de nouveauté
   */
  public function getLast($number){
    return $this->query("SELECT id, title, content, DATE_FORMAT(date, 'le %d/%m/%Y à %Hh%i') AS date FROM " . $this->table . "
        ORDER BY id DESC LIMIT " . $number);
  }

  public function getAll(){
      return $this->query("SELECT id, title, content, DATE_FORMAT(date, 'le %d/%m/%Y à %Hh%i') AS date FROM " . $this->table . ' ORDER BY id DESC' );
    }

    public function getSingle($id){
      return $this->query("SELECT id, title, content, DATE_FORMAT(date, 'le %d/%m/%Y à %Hh%i') AS date FROM " . $this->table . " WHERE id = ?",
          [$id],
          true);
    }

}
