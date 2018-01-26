<?php
namespace App\Table;
use App\App;

/**
 *
 * Modèle des commentaires
 */
class Comment extends Table{

  protected static $table = "comments";

  /**
   * Récupère les posts liés à $_GET['id']
   * @return array Tableau contenant les objets des commentaires correspondants
   */
  public static function getAttachedComments(){
    return self::query("SELECT * FROM " . self::$table . " WHERE post_id = ?",
        [$_GET['id']],
        false);
  }


}
