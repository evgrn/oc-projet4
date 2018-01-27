<?php

namespace Core;

/**
 * Classe configurant l'accès à la base de données.
 * Fait le lien avec le fichier de configuration
 */
class Config{

  private $config = [];
  private static $_instance;
  private $settings;

  /**
   * Stocke les données du fichier de configuration dans l'objet courant.
   * @param file $file Fichier de configuration
   */
  public function __construct($file){
    $this->settings = require($file);
  }

  /**
   * S'il n'y en a pas déjà une, stocke une instance de la classe courante en elle-même.
   * @param  file $file     Fichier de configuration
   * @return Config         Instance de la classe courante.
   */
  public static function getInstance($file){
    if(!self::$_instance){
      self::$_instance = new Config($file);
    }
    return self::$_instance;
  }

  /**
   * Récupère l'élément dont la clé est entrée en paramètres dans le tableau issu du fichier de configuration
   * @param string  $key Clé de l'élément à récupérer
   * @return string      Valeur du tableau issu du fichier de configuration associée à la clé
   */
  public function get($key){
    if(!isset($this->settings[$key])){
      return null;
    }
    return $this->settings[$key];
  }

}
