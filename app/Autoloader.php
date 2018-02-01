<?php
namespace App;

/**
 * Charge les classes dynamiquement
 */
class Autoloader{

  /**
   * Applique la fonction autoload à la classe chargée.
  */
  public static function register(){
      spl_autoload_register(array(__CLASS__, 'autoload'));
  }

  /**
   *
   * Requiert dynamiquement le fichier associé à la classe en fonction de ses noms et namespaces.
   * Ne s'applique que si la classe est dans le même namespace que l'autolader.
   *
   * @param string $class_name
  */
  public static function autoload($class_name){

    if(strpos($class_name, __NAMESPACE__ . '\\') === 0){
      $class_name = str_replace(__NAMESPACE__ . '\\', '', $class_name);
      $class_name = str_replace('\\', '/', $class_name);
      require __DIR__ . '/' . $class_name . '.php';
    }

  }


}
