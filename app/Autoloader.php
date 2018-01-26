<?php
namespace App;

/**
 * Class Atoloader
 * Charge les classes dynamiquement
 *
*/
class Autoloader{

  /**
   * Applique la fonction autoload à la classe chargée
  **/
  public static function register(){
    spl_autoload_register(array(__CLASS__, 'autoload'));
  }

  /**
   *
   * Require le fichier associé à la classe dynamiquement en fonction  de ses noms et namespaces.
   * Ne s'applique que si la classe est dans le même namespace que l'autolader.
   *
   * @param string $className
  **/
  public static function autoload($className){

    if(strpos($className, __NAMESPACE__ . '\\') === 0){
      $className = str_replace(__NAMESPACE__ . '\\', '', $className);
      $className = str_replace('\\', '/', $className);
      require __DIR__ . '/' . $className . '.php';
    }

  }


}
