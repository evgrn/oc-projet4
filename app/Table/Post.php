<?php

## TODO :
## Configurer getExcerpt() en comptant les mots


namespace App\Table;
use App\App;

/**
 * Modèle des posts.
 */
class Post extends Table{

  protected static $table = 'posts';

/**
 * Récupère le post correspondant à $_GET['id'].
 * @return object Objet de l'article correspondant
 */
  public static function getSingle(){
    return self::query("SELECT * FROM " . self::$table . " WHERE id = ?",
        [$_GET['id']],
        true);
  }

  /**
   * Récupérer un nombre défini de posts, par ordre décroissant de nouveauté.
   * @param  int $number Nombre de posts que l'on veut récupérer
   * @return array       Tableau regroupant les objets demandés par ordre décroissant de nouveauté
   */
  public static function getLast($number){
    return self::query("SELECT * FROM " . self::$table . "
        ORDER BY id DESC LIMIT " . $number);
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
    $excerpt = substr($this->content, 0, 1000) . ' (...)';
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
