<?php defined('SYSPATH') or die('No direct script access.');

class SVG_Diagram {

  const TYPE_SECTORAL = 1;

  const TYPE_CHART = 2;

  const TYPE_QUADRATIC = 3;

  private $markup;

  public function createDiagramBody($type) {
    switch($type) {
      case self::TYPE_SECTORAL:
        $this->markup = SVG_DiagramSectoral::body(63);
      break;
    }
  }
  
  public function save() {
    return $this->markup;
  }

}
