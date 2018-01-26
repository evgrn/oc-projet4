<?php

## TODO : Configurer getExcerpt() en comptant les mots

namespace App\Table;

/**
 * Modèle des posts.
 */
class Post{

  /**
   * Remplace dynamiquement la propriété appelée par le getter de la approprié et la remplace par celui-ci,
   * puis envoie la propriété ainsi générée.
   * @param  string $param Paramètre appelé.
   * @return string        Propriété générée dynamiquement.
   */
  public function __get($param){
    $method = 'get' . ucfirst(strtolower($param));
    $this->$param = $this->$method(); // Ne pas appeler la méthode à chaque fois
    return $this->$param;

  }

  /**
   * Génère l'URL vers la version single du post.
   * @return string URL du post
   */
  public function getUrl(){
    return "index.php?page=single&amp;id={$this->id}";
  }

  /**
   * Génère un extrait du contenu du post.
   * @return string Extrait du contenu du post
   */
  public function getExcerpt(){
    $excerpt = substr($this->content, 0, 300) . ' (...)';
    $html = '<p>' . $excerpt . '</p>';
    $html .= '<p><a class="btn btn-primary" href=' . $this->getUrl() . '>Lire le chapitre</a></p>';
    return $html;
  }

  /**
   * Renvoie le titre du post.
   * @return string titre du post
   */
  public function getTitle(){
    return $this->title;
  }

  /**
   * Renvoie la date du post.
   * @return string Date du post
   */
  public function getDate(){
    return $this->date;
  }


}
