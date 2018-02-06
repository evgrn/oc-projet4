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
    return $this->query("SELECT id, post_id, author, title, content, DATE_FORMAT(date, 'le %d/%m/%Y à %Hh%i') AS date FROM " . $this->table . " WHERE post_id = ? ORDER BY id DESC",
        [$id],
        false);
  }

  public function getSingle($id){
    return $this->query("SELECT id, post_id, author, title, content, DATE_FORMAT(date, 'le %d/%m/%Y à %Hh%i') AS date FROM " . $this->table . " WHERE id = ?",
        [$id],
        true);
  }


  /**
   * Affiche la somme des commentaires liés à un post dont l'id est entré en paramètre.
   * @param  int  $id           Id du post
   * @param  boolean $linked    S'il vaut true (par défaut) et que la somme des liens n'est pas nulle,  génère le résultat sous forme de lien vers lesdits commentaires, retourne seulement la somme sinon
   * @return string/int         Le nombre de commentaires liés au post, sous forme de lien ou brut.
   */
  public function getAttachedCommentSum($id, $linked = true){
    $sum =  $this->query("SELECT COUNT(*) FROM {$this->table} WHERE post_id = ?",
    [$id],
    true);
    if($sum == 0 || $linked == false){
      return $sum;
    } else{
      return '<a href="index.php?page=admin.comments.attached&amp;id=' . $id . '">' . $sum . '</a>';
    }
  }

  /**
   * Supprime tous les commentaires liés au post dont l'id est entré en paramètre.
   * @param  int $id    Id du post
   */
  public function deleteAttached($id){
      $this->query("DELETE FROM {$this->table} WHERE post_id = ?", [$id]);
  }





}
