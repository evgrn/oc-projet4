<?php
namespace Core\HTML;

/**
* Class Form
* Permet de générer un formulaire
*/
class Form{

  /**
  *@var array Données utilisées par le formulaire
  */
  protected $data;
  /**
  *@var string Tag pour entourer les champs
  */
  public $surround = 'p';

  /**
  *@param array $data Données utilisées par le formulaire
  *@param string $surround Tag entourat chaque élément du formulaire
  */
  public function __construct($data = array()){
    $this->data = $data;
  }

  /**
  *@param string $item Element à entourer
  *@param string $surround
  *return string
  */
  protected function surround($item){
    return "<{$this->surround}>$item</{$this->surround}>";
  }

  /**
  *@param string $index Index de l'élément à récupérer dans le tableau data
  *return string
  */
  protected function getValue($index){
    if(is_object($this->data)){
      return $this->data->$index;
    }
    return isset($this->data[$index]) ? $this->data[$index] : null;
  }

  /**
  *@param string $name
  *@param $label
  *@param $options array
  *return string
  */
  public function input($name, $label, $options =[]){
    $type = isset($options[type]) ? $options[type] : 'text';

    $content = '<input type="' . $type . '" name="' . $name . '" value="' . $this->getValue($name) .'">';
    return $this->surround($content);

  }



  /**
  *return string
  */
  public function submit(){
    $content =  '<button type="submit">Envoyer</button>';
    return $this->surround($content);
  }

}
