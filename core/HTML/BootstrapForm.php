<?php
namespace Core\HTML;

// pas besoin de rappeler le namespace vu qu'on est dans le même
class BootstrapForm extends Form{

  protected function surround($item){
    return "<div class=\"form-group\">$item</div>";
  }

  public function input($name, $label = null, $value = null, $options = []){
    $inputValue = $value != null ? $value : $this->getValue($name);



    $required = (isset($options['required']) && $options['required'] == true) ? 'required' : '';
    $type = isset($options['type']) ? $options['type'] : 'text';
    if($type === 'textarea'){
      $input = '<textarea  name="' . $name . '" class="form-control" ' . $required . ' > ' . $inputValue . '</textarea>';
    }else {
      $input = '<input type="' . $type . '" name="' . $name . '" value="' .  $inputValue .'" class="form-control" ' . $required . '>';
    }

    if($label === null){
      return $this->surround($input);
    }

      $label = '<label class="form-label">' . $label . '</label>';

      $content = $label . $input;



    return $this->surround($content);

  }

  public function submit($title = 'Envoyer', $buttonColor = 'primary'){
    $content =  '<button type="submit" class="btn btn-' . $buttonColor . '">' . $title . '</button>';
    return $content;
  }

  public function select($name, $label, $options){
    $label = '<label class="form-label">' . $label . '</label>';
    $input = '<select class="form-control " name="' . $name . '">';
    foreach($options as $k => $v){

      $attributes = '';
      if(strval($k) == $this->getValue($name)){
        $attributes = ' selected';
      }
      $input .= "<option value='$k'$attributes>$v</option>";
    }
    $input .= '</select>';
    return $this->surround($label . $input);

  }
}
