<?php
namespace App\Table;

/**
 *
 * Modèle des commentaires
 */
class CommentTable extends \Core\Table\Table{



  /**
   * Récupère les posts liés à $_GET['id']
   * @return array Tableau contenant les objets des commentaires correspondants
   */
  public function getAttachedComments(){
    return $this->query("SELECT * FROM " . $this->table . " WHERE post_id = ?",
        [$_GET['id']],
        false);
  }


}
