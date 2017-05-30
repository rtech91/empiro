<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
  * Class specified to handle with .xml tests storage
  */
class Storage extends CI_Model {

  public function _construct() {
    parent::_construct();
  }

  /**
    * Checks storage folder and it contents for accessibility
    */
  public function check_folder() {
    $storage_folder = APPPATH.'test_storage'.DIRECTORY_SEPARATOR;
    if(is_dir($storage_folder)) {
      // read contents of folder and return them as simple array
      $files = scandir($storage_folder);
      foreach($files as $file) {
        // omit standard files and folders
        if('.' === $file || '..' === $file || 'readme.txt' === $file) {
          continue;
        }
        $filepath = $storage_folder.$file;
        if(is_file($filepath) && is_readable($filepath) && is_writable($filepath) && 'xml' === pathinfo($filepath, PATHINFO_EXTENSION)) {
          // TODO: handle with this file
        }
      }
    }else {
      show_error('Cannot read tests storage folder!', 500);
    }
  }

}