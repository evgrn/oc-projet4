<?php
namespace Core\HTML;

/**
* Permet de générer un formulaire
*/
class Form{


  protected $data;

  /**
   * Récupère les données passées en paramètre et les stocke dans son instance.
  *@param array $data Données utilisées par le formulaire
  *@param string $surround Tag entourat chaque élément du formulaire
  */
  public function __construct($data = array()){
    $this->data = $data;
  }

  /**
  * Récupère les données du tableau stocké dans son instance lors de sa construction.
  *@param string $index Index de l'élément à récupérer dans le tableau data
  *@return string La valeur du tableau correspondant à l'index
  */
  protected function getValue($index){
    if(is_object($this->data)){
      return htmlspecialchars($this->data->$index);
    }
    return isset($this->data[$index]) ? htmlspecialchars($this->data[$index]) : null;
  }


}
