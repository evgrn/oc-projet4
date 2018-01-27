<?php
use Core\Config;
use Core\DB\MysqlDB;


/**
 * Classe factory gérant l'application
 */
class App{

  private static $_instance;
  private $db_instance;
  private $title = "Billet Simple pour l'Alaska";

  /**
   * Ouvre la session et importe et initialise les autoloaders
   *
   */
  public static function init(){
    session_start();
    require ROOT . "/app/Autoloader.php";
    App\Autoloader::register();
    require ROOT . "/Core/Autoloader.php";
    Core\Autoloader::register();
  }

  /**
   * Récupère une instance du modèle de table correspondant au nom de la table entré en paramètres
   * @param  string $table_name     Nom de la table
   * @return Core\Table\Table       Instance du modèle de table demandé.
   */
  public function getTable($table_name){
    $class_name = '\App\Table\\' . ucfirst(strtolower($table_name)) . 'Table';
    return new $class_name($this->getDb());
  }

  /**
   * Récupère une instance de la classe MysqlDB dans l'objet courant si elle n'y est pas déjà instanciée,
   * la retourne.
   * @return \Core\DB\MysqlDB   Instance de la classe MysqlDB
   */
  public function getDb(){
    if($this->db_instance == null){
      $config = Config::getInstance(ROOT . '/config/config.php');
      $this->db_instance = new MysqlDB($config->get('db_name'), $config->get('db_host'), $config->get('db_usr'), $config->get('db_pwd'));
    }
    return $this->db_instance;
  }

  /**
   * Instancie la classe courante à l'interieur de celle-ci si ce na pas déjà été fait,
   * retourne ladite instance.
   * @return App    Instance de la classe courante
   */
  public static function getInstance(){
    if(!self::$_instance){
      self::$_instance = new App();
    }
    return self::$_instance;
  }



  /**
   * Affiche le titre.
   * @return string Titre contenu dans la classe courante
   */
  public function getPageTitle(){
    return $this->title;
  }

  /**
   * Définit le sous-titre dans la classe courante.
   * @param string $subtitle Sous-titre
   */
  public function setPageSubtitle($subtitle){
    $this->title = $subtitle . ' | ' . $this->title ;
  }



}
