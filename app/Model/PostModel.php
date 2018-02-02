<?php
namespace App\Model;

/**
 *
 * Modèle des Posts
 */
class PostModel extends \Core\Model\Model{

  /**
   * Génère l'URL vers la version single du post.
   * @return string URL du post
   */
  public function getUrl(){
    return "index.php?page=logged.posts.single&amp;id={$this->id}";
  }

  /**
   * Génère un extrait du contenu du post comprenant un bouton readmore.
   * @return string Extrait du contenu du post et bouton affilié
   */
  public function getExcerpt(){
    $contentWordsArray = explode(' ', $this->content);
    $excerptWordsArray = array_slice($contentWordsArray, 0, 30);
    $excerpt = implode(' ', $excerptWordsArray) . ' ( ...)';

    $html = '<p>' . $excerpt . '</p>';
    return $html;
  }
  
}
