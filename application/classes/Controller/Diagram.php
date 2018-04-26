<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Diagram extends Controller {
  
  private $tests;

	public function action_index()
	{
		header("Content-type: text/xml; charset=utf-8");
		$diagram = new SVG_Diagram();
		$diagram->createDiagramBody(SVG_Diagram::TYPE_SECTORAL);
		$markup = $diagram->save();
		echo $markup;
	}

} // End Diagram
