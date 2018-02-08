<?php
namespace Core\HTML;

/**
* Permet de générer un formulaire BootStrap
*/
class BootstrapForm extends Form{



  /**
   * Entoure l'élément entré en paramètre par une balise de classe '.form-group'.
   * @param  string $item Élément à entourer
   * @return string       Élément entouré
   */
  protected function surround($item){
    return "<div class=\"form-group\">$item</div>";
  }

  /**
   * Génère un input ou un textarea.
   * @param  string $name    Nom du champ
   * @param  string $label   Label du champ
   * @param  string $value   Valeur du champ
   * @param  array  $options Tableau associatif contenant les valeurs du champ
   * @return string          Champ(s) généré(s), entouré par un conteneur de la clase '.form-group'
   */
  public function input($name, $label = null, $value = null, $options = []){

    $inputValue = $value != null ? $value : $this->getValue($name);
    $required = (isset($options['required']) && $options['required'] == true) ? 'required' : '';
    $minlength = (isset($options['minlength']) && is_int($options['minlength'])) ? "minlength=\"{$options['minlength']}\"" : '';
    $type = isset($options['type']) ? $options['type'] : 'text';

    if($type === 'textarea'){
      $input = '<textarea  id="' . $name . '" name="' . $name . '" class="form-control" ' . $required . $minlength . ' > ' . $inputValue . '</textarea>';
    }
    else {
      $input = '<input id="' . $name . '" type="' . $type  . '" name="' . $name . '" value="' .  $inputValue .'" class="form-control" ' . $required . ' ' . $minlength . '>';
    }

    if($label === null){
      return $this->surround($input);
    }

    $label = '<label class="form-label">' . $label . '</label>';
    $content = $label . $input;
    return $this->surround($content);

  }

  /**
   * Génère un bouton "submit".
   * @param  string $title       Texte du bouton
   * @param  string $buttonColor Couleur bootstrap du bouton
   * @return string              Le bouton généré
   */
  public function submit($title = 'Envoyer', $buttonColor = 'primary'){
    $content =  '<button type="submit" class="btn btn-' . $buttonColor . '">' . $title . '</button>';
    return $content;
  }

}
