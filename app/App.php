<?php
namespace App;

/**
 * Classe gérant l'application
 */
class App{

  // Juste ça à changer si on change de serveur
  const DB_NAME = 'ocp4';
  const DB_HOST = 'localhost';
  const DB_USR = 'root';
  const DB_PWD = 'root';

  private static $db;
  private static $title = "Billet Simple pour l'Alaska";

  /**
   * S'il n'en possède pas déjà, instanciation connectée à la BDD de la classe DB dans la classe courante et la renvoie.
   * @return \App\DB  Instance de la classe DB, connectée à la BDD
   */
  public static function getDb(){
    if(!self::$db){
      self::$db = new DB(self::DB_NAME, self::DB_HOST, self::DB_USR, self::DB_PWD);
    }
    return self::$db;
  }

  /**
   * Affiche le titre.
   * @return string Titre contenu dans la classe courante
   */
  public static function getPageTitle(){
    return self::$title;
  }

  /**
   * Définit le sous-titre dans la classe courante.
   * @param string $subtitle Sous-titre
   */
  public static function setPageSubtitle($subtitle){
    self::$title = $subtitle . ' | ' . self::$title ;
  }



}
