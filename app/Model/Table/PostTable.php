<?php
namespace App\Model\Table;

/**
 * Modèle de table des posts.
 */
class PostTable extends \Core\Model\Table\Table{

  /**
   * Récupère un nombre défini de posts, par ordre décroissant de nouveauté.
   * @param  int $number Nombre de posts que l'on veut récupérer
   * @return array       Tableau regroupant les objets demandés par ordre décroissant de nouveauté
   */
  public function getLast($number){
    return $this->query("SELECT id, title, content, DATE_FORMAT(date, 'le %d/%m/%Y à %Hh%i') AS date FROM " . $this->table . "
        ORDER BY id DESC LIMIT " . $number);
  }

  /**
   * Récupère tous les posts.
   * @return array     Tableau contenant tous les posts
   */
  public function getAll(){
      return $this->query("SELECT id, title, content, DATE_FORMAT(date, 'le %d/%m/%Y à %Hh%i') AS date FROM " . $this->table . ' ORDER BY id ASC' );
    }

  /**
   * Récupère le post dons l'id est passé en paramètre
   * @param  int $id Id du post à récupérer
   * @return \App\Model\PostModel     Post dont l'id est passé en paramètre
   */
  public function getSingle($id){
    return $this->query("SELECT id, title, content, DATE_FORMAT(date, 'le %d/%m/%Y à %Hh%i') AS date FROM " . $this->table . " WHERE id = ?",
        [$id],
        true);
  }

  /**
   * S'il existe, récupère le post ayant l'id supérieur le plus proche suivant, sinon, renvoie le post courant et remplace son titre par "En cours d'écriture".
   * @param  int $id Id du post
   * @return \App\Model\PostModel  Post suivant ou post courant, selon le cas.
   */
  public function getNextPost($id){
    $nextPost = $this->query("SELECT id, title, content, DATE_FORMAT(date, 'le %d/%m/%Y à %Hh%i') AS date FROM " . $this->table . " WHERE id > ? ORDER BY id ASC LIMIT 0, 1",
        [$id],
        true);
    if(!$nextPost){
      $nextPost = $this->getSingle($id);
      $nextPost->title = 'En cours d\'écriture.';
    }

    return $nextPost;
  }

}
