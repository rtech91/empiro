<?php defined('SYSPATH') or die('No direct script access.');

class SVG_DiagramSectoral {
  public static function body($passed_percentage = 0) {
    $stroke_length = 1.57 * $passed_percentage;
    $view = new View('diagrams/svg_sectoral');
    $view->stroke_length = $stroke_length;
    return $view->render();
  }
}