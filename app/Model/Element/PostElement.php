<?php
namespace App\Model\Element;

/**
 *
 * Modèle des Posts
 */
class PostElement extends \Core\Model\Element\Element{

  /**
   * Génère l'URL vers la version single du post pour les utilisateurs connectés.
   * @return string version connectée de l'URL du post
   */
  public function getUrl(){
    return "index.php?page=logged.posts.single&id={$this->id}";
  }

  /**
   * Génère l'URL vers la version single du post pour les utilisateurs non connectés.
   * @return string version non connectée de l'URL du post
   */
  public function getGuestUrl(){
    return "index.php?page=guest.posts.single&id={$this->id}";
  }

  /**
   * Génère un extrait du contenu du post comprenant un bouton readmore.
   * @return string Extrait du contenu du post et bouton affilié
   */
  public function getExcerpt(){
    $text = strip_tags($this->content);
    $contentWordsArray = explode(' ', $text);
    $excerptWordsArray = array_slice($contentWordsArray, 0, 100);
    $excerpt = implode(' ', $excerptWordsArray) . ' (...)';

    return $excerpt;
  }

}
