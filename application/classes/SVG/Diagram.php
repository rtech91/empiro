<?php defined('SYSPATH') or die('No direct script access.');

class SVG_Diagram {

  const TYPE_SECTORAL = 1;

  const TYPE_CHART = 2;

  const TYPE_QUADRATIC = 3;
  
  private $markup;

  public function createBasicTemplate($type, $width, $height) {
      $this->markup = new stdClass;
      $this->markup->open = "<svg width=\"$width\" height=\"$height\">";
      $this->markup->body 	= '';
      $this->markup->close = "</svg>";
  }
  
  public function save() {
    $layout = '';
    $layout .= $this->markup->open;
    $layout .= $this->markup->body;
    $layout .= $this->markup->close;
    
    return $layout;
  }

}
