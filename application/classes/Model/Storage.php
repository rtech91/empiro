<?php defined('SYSPATH') or die('No direct script access.');

class Model_Storage extends Model {
	
	/**
    * Checks storage folder and it contents for accessibility
    */
  public function check_folder() {
    $storage_folder = APPPATH.'test_storage'.DIRECTORY_SEPARATOR;
    if(is_dir($storage_folder)) {
      // read contents of folder and return them as simple array
      $files = scandir($storage_folder);
      $approved_files_uris = array();
      foreach($files as $file) {
        // omit standard files and folders
        if('.' === $file || '..' === $file || 'readme.txt' === $file) {
          continue;
        }
        $filepath = $storage_folder.$file;
        if(is_file($filepath) && is_readable($filepath) && is_writable($filepath) && 'xml' === pathinfo($filepath, PATHINFO_EXTENSION)) {
          array_push($approved_files_uris, $filepath);
        }
      }
      return $this->collect_parsed_tests($approved_files_uris);
    }else {
			throw new StorageAccessException('Cannot read tests storage folder', 500);
    }
  }

  /**
    * Method specified to collect parsed and validated tests data
    * into common public list
    * @param $file_uris array of absolute xml file uris
    */
  private function collect_parsed_tests($file_uris) {
    foreach($file_uris as $uri) {
      $parsed = simplexml_load_file($uri);
      $all_tests = array();
      $test = new stdClass;
      $test->name = (string)$parsed->name;
      $test->category = (string)$parsed->category;
      $test->time = (string)$parsed->time;
      $test->allowtaskreviews = (bool)$parsed->allowtaskreviews;
      $test->allowtoreanswer = (bool)$parsed->allowtoreanswer;
      $test->questions = array();
      foreach($parsed->questions->question as $question) {
        $new_question = new stdClass;
        $question_attr = current($question->answers->attributes());
        $new_question->title = (string)$question->title;
        $new_question->type = (bool)$question_attr['type'];
        $new_question->answers = array();
        foreach($question->answers->answer as $answer) {
          $answer_attr = current($answer->attributes());
          $new_answer = new stdClass;
          $new_answer->is_right = (bool)$answer_attr['is_right'];
          $new_answer->title = (string)$answer;
          array_push($new_question->answers, $new_answer);
        }
        array_push($test->questions, $new_question);
      }
      array_push($all_tests, $test);
    }
    return $all_tests;
  }
	
} // End Storage