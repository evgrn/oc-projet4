<?php
namespace App\Model;

/**
 *
 * Modèle des commentaires
 */
class CommentModel extends \Core\Model\Model{

  /**
   * Affiche un extrait du commentaire
   * @return string L'etrait du commentaire
   */
  public function getExcerpt(){
    $excerpt = substr($this->content, 0, 500) . ' (...)';
    $html = '<p>' . $excerpt . '</p>';
    return $html;
  }

}
