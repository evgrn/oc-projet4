<?php
namespace App\Table;

/**
 *
 * Modèle de table des commentaires
 */
class CommentTable extends \Core\Table\Table{

  /**
   *  Récupère les commentaires liés au post ayant l'id passé en paramètre.
   * @param  string   $id  Id du post
   * @return array       Liste des commentaires liés au post
   */
  public function getAttachedComments($id){
    return $this->query("SELECT * FROM " . $this->table . " WHERE post_id = ? ORDER BY id DESC",
        [$id],
        false);
  }

  /**
   * Récupère la somme des commentaires liés au post ayant l'id passé en paramètre.
   * @param  string   $id   Id du post
   * @return int            somme des commentaires liés au post ayant l'id passé en paramètre
   */
  public function getAttachedCommentAmount($id){
    return $this->query("SELECT COUNT(*) FROM {$this->table} WHERE post_id = ?",
    [$id],
    true);
  }

  /**
   * Récupère la somme des commentaires signalés liés au post ayant l'id passé en paramètre.
   * @param  string   $id   Id du post
   * @return int            somme des commentaires signalés liés au post ayant l'id passé en paramètre
   */
  public function getReportedAttachedCommentAmount($id){
    return $this->query("SELECT COUNT(*) FROM {$this->table} WHERE post_id = ? AND reported > 0",
    [$id],
    true);
  }





}
