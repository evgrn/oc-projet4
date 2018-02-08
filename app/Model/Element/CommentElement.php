<?php
namespace App\Model\Element;

/**
 *
 * Modèle des commentaires
 */
class CommentElement extends \Core\Model\Element\Element{

  /**
   * Affiche un extrait du commentaire
   * @return string L'etrait du commentaire
   */
  public function getExcerpt(){
    $excerpt = substr($this->content, 0, 20) . ' (...)';
    $html = '<p>' . $excerpt . '</p>';
    return $html;
  }

  /**
   * Affiche la vue correspondante au commentaire.
   * @return string Adresse du commentaire
   */
  public function getUrl(){
    return 'index.php?page=admin.comments.single&id=' . $this->id;
  }

}
