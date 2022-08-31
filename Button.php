<?php 
class Button {
 public $value;
 public $width;
 public function RenderHTML(){
  return '<input type="button" value="'.
          $this->value.'" style="width:'.
          $this->width.'px" />';
 }    
}