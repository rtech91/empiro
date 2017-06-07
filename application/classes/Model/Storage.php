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
      if(!isset($parsed->name) || empty($parsed->name)){
        throw new WrongTestParametersException();
      }
      $test->name = (string)$parsed->name;
      if(!isset($parsed->category) || empty($parsed->category)){
        throw new WrongTestParametersException();
      }
      $test->category = (string)$parsed->category;
      if(!isset($parsed->time) || empty($parsed->time) || !preg_match("/^[0-9]{2}:[0-9]{2}$/", $parsed->time)){
        throw new WrongTestParametersException();
      }
      $test->time = (string)$parsed->time;
      if(!isset($parsed->allowtaskreviews) || empty($parsed->allowtaskreviews)){
        throw new WrongTestParametersException();
      }
      $test->allowtaskreviews = (bool)$parsed->allowtaskreviews;
      if(!isset($parsed->allowtoreanswer) || empty($parsed->allowtoreanswer)){
        throw new WrongTestParametersException();
      }
      $test->allowtoreanswer = (bool)$parsed->allowtoreanswer;
      $test->questions = array();
      foreach($parsed->questions->question as $question) {
        $new_question = new stdClass;
        $question_attr = current($question->answers->attributes());
        if(!isset($question->title) || empty($question->title)){
          throw new WrongQuestionParametersException();
        }
        $new_question->title = (string)$question->title;
        if(!isset($question_attr['type']) || empty($question_attr['type'])){
          throw new WrongQuestionParametersException();
        }
        $new_question->type = (bool)$question_attr['type'];
        $new_question->answers = array();
        foreach($question->answers->answer as $answer) {
          $answer_attr = current($answer->attributes());
          $new_answer = new stdClass;
          if(!isset($answer_attr['is_right']) || empty($answer_attr['is_right'])){
            throw new WrongQuestionParametersException();
          }
          $new_answer->is_right = (bool)$answer_attr['is_right'];
          if(!isset($answer) || empty($answer)){
            throw new WrongQuestionParametersException();
          }
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