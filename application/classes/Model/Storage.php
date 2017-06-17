<?php defined('SYSPATH') or die('No direct script access.');

class Model_Storage extends Model {
  
  /**
   * Used to hold all addresses to test xml files in file system.
   * @var array $file_uris
   */
  public $file_uris;
  
  /**
   * Used to hold all parsed and ready to use tests.
   * @var array $parsed_tests
   */
  private $parsed_tests;
  
  /**
   * Used to hold only one instance of object
   * according to Singleton pattern.
   * @var Storage $instance
   */
  private static $instance = null;
  
  /**
   * Used when was broken common data in test file.
   * Format: List of physical absolute addresses to broken file.
   * @var array $innaccessible_files 
   */
  private $innaccessible_files;
  
  /**
   * Used when was broken additional data in test file
   * such as question or nested answer information.
   * Format: List of arrays with two params - test name and physical absolute address to broken file
   * @var array $broken_files
   */
  private $broken_files;
  
  /**
   * Used for constant physical address to test files storage
   * @var const STORAGE_FOLDER
   */
  const STORAGE_FOLDER = APPPATH.'test_storage'.DIRECTORY_SEPARATOR;
  
  private function __construct() {
    $this->file_uris = array();
    $this->innaccessible_files = array();
    $this->broken_files = array();
    $this->parsed_tests = array();
  }
  
  public function __destruct() {
    $this->file_uris = null;
    $this->innaccessible_files = null;
    $this->broken_files = null;
    $this->parsed_tests = null;
  }
  
  /**
   * Get singleton instance of Storage object.
   * @return Storage instance
   */
  public static function getInstance() {
    if(self::$instance === null){
        self::$instance = new self; 
    }
    return self::$instance;
  }
  
  /**
    * Checks storage folder and it contents for accessibility
    * @return bool true or false according to validation result
    */
  private function checkStorageFolderAccessibility() {
    try {
      if(is_dir(self::STORAGE_FOLDER)) {
        return true;
      }else {
        throw new StorageAccessException('Cannot read tests storage folder', 500);
      } 
    }catch(StorageAccessException $e) {
      MessageHandler::getInstance()->registerMessage($e->getMessage(), (MessageHandler::MH_FAILURE | MessageHandler::ACCESS_USER));
    }
  }
  
  /**
   * Read all test files with .xml extenstion and collect them
   * for future processing
   */
  private function collectTestsInStorage() {
    // read contents of folder and return them as simple array
    $files = scandir(self::STORAGE_FOLDER);
    foreach($files as $file) {
      // omit standard files and folders
      if('.' === $file || '..' === $file || 'readme.txt' === $file) {
        continue;
      }
      $filepath = self::STORAGE_FOLDER.$file;
      if(is_file($filepath) && is_readable($filepath) && is_writable($filepath) && 'xml' === pathinfo($filepath, PATHINFO_EXTENSION)) {
        array_push($this->file_uris, $filepath);
      }
    }
  }
  
  /**
   * Validate collected files with tests
   * for special rules that every tests must match
   * @throws WrontTestParametersException
   * @throws WrongQuestionParametersException
   */
  private function validateCollectedTests() {
    if(isset($this->file_uris) && !empty($this->file_uris) && is_array($this->file_uris)) {
      foreach($this->file_uris as $key => $uri) {
        $parsed = simplexml_load_file($uri);
        try{
          if(!self::checkMainTestParams($parsed)){
            throw new WrongTestParametersException();
          }
          foreach($parsed->questions->question as $question) {
            if(self::checkQuestion($question)) {
              foreach($question->answers->answer as $answer) {
                if(!self::checkAnswer($answer)) {
                  throw new WrongQuestionParametersException();
                }
              }
            }else {
              throw new WrongQuestionParametersException();
            }
          }
        }catch(WrongTestParametersException $e) {
          // if we catch this exception
          // it means that common test data is broken
          // so we suspect that the test title
          // also is not available
          array_push($this->innaccessible_files, $uri);
          unset($this->file_uris[$key]);
        }catch(WrongQuestionParametersException $e) {
          // if we catch this exception
          // it means that common test data is fine
          // but additional information as questions or answers
          // are broken and cannot be read
          $broken_file_info = new stdClass;
          $broken_file_info->name = $parsed->name;
          $broken_file_info->filepath = $uri;
          array_push($this->broken_files, $broken_file_info);
          unset($broken_file_info);
          unset($this->file_uris[$key]);
        }
      }
    }
  }
  
  /**
   * Parse and return all accessible tests for future using.
   * @return array List of parsed tests or empty array()
   */
  public function getTests() {
    if($this->checkStorageFolderAccessibility()) {
      $this->collectTestsInStorage();
      $this->validateCollectedTests();
      $this->parseCollectedTests();
      if(!empty($this->parsed_tests) && count($this->parsed_tests) > 0) {
        return $this->parsed_tests;
      }
      return array();
    }
  }
  
  /**
   * Check main parameters of test for accessibility
   * @var $parsed object with parsed xml document
   * return bool true or false value
   */
  public static function checkMainTestParams(&$parsed) {
    return
      isset(
        $parsed->name,
        $parsed->category,
        $parsed->time,
        $parsed->allowtaskreviews,
        $parsed->allowtoreanswer
      )
      && !empty((string)$parsed->name)
      && !empty((string)$parsed->category)
      && !empty((string)$parsed->time)
      && preg_match("/^[0-9]{2}:[0-9]{2}$/", $parsed->time)
      && !empty((string)$parsed->allowtoreanswer)
      && !empty((string)$parsed->allowtoreanswer);
  }
  
  /**
   * Check question for non-emptiness and additional attributes.
   * @param reference $question Link to question object
   * return bool result of validation
   */
  public static function checkQuestion(&$question) {
    $question_attr = $question->answers->attributes();
    return
        isset($question->title)
        && !empty((string)$question->title)
        && !empty((string)$question_attr['type']);
  }
  
  /**
   * Check answer for non-emptiness and additional attributes.
   * @param reference $answer Link to answer object
   * return bool result of validation
   */
  public static function checkAnswer(&$answer) {
    $answer_attr = current($answer->attributes());
    return isset($answer_attr['is_right']) && strlen(trim((string)$answer)) && !empty((string)$answer_attr['is_right']);
  }

  /**
    * Method specified to collect parsed and validated tests data
    * into common public list
    */
  private function parseCollectedTests() {
    if(!isset($this->file_uris) || empty($this->file_uris) || !is_array($this->file_uris)) {
      return array();
    }
    foreach($this->file_uris as $uri) {
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
      array_push($this->parsed_tests, $test);
    }
  }

} // End Storage