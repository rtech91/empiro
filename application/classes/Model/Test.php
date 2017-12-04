<?php defined('SYSPATH') or die('No direct script access.');

class Model_Test extends Model {

    /**
     * Validate initial test data
     * @param stdClass $data
     */
    public static function validateInitialData($data){
        $mh = MessageHandler::getInstance();
        $is_correct = true;
        if(!Valid::not_empty($data->name)){
            $mh->registerMessage('Name is empty or forbidden symbols detected!', (MessageHandler::MH_ERROR | MessageHandler::ACCESS_ADMIN));
            $is_correct = false;
        }
        if(!Valid::max_length($data->name, 32)){
            $mh->registerMessage('Max name length is 32 symbols!', (MessageHandler::MH_ERROR | MessageHandler::ACCESS_ADMIN));
            $is_correct = false;
        }
        if(!empty($data->name) && preg_match("[(a-zA-Z0-9-&\s.+)]", $data->name)){
            $mh->registerMessage('Invalid symbols in name!', (MessageHandler::MH_ERROR | MessageHandler::ACCESS_ADMIN));
            $is_correct = false;
        }
        if(!Valid::not_empty($data->category)){
            $mh->registerMessage('Category is empty or forbidden symbols detected!', (MessageHandler::MH_ERROR | MessageHandler::ACCESS_ADMIN));
            $is_correct = false;
        }
        if(!Valid::max_length($data->category, 16)){
            $mh->registerMessage('Max category length is 16 symbols!', (MessageHandler::MH_ERROR | MessageHandler::ACCESS_ADMIN));
            $is_correct = false;
        }
        if(!empty($data->category) && preg_match("[(a-zA-Z0-9-&\s.+)]", $data->category)){
            $mh->registerMessage('Invalid symbols in category!', (MessageHandler::MH_ERROR | MessageHandler::ACCESS_ADMIN));
            $is_correct = false;
        }
        if(!Valid::not_empty($data->total_time)){
            $mh->registerMessage('Total time is empty or forbidden symbols detected!', (MessageHandler::MH_ERROR | MessageHandler::ACCESS_ADMIN));
            $is_correct = false;
        }
        if(!Valid::max_length($data->total_time, 3)){
            $mh->registerMessage('Max total time length is 3 symbols!', (MessageHandler::MH_ERROR | MessageHandler::ACCESS_ADMIN));
            $is_correct = false;
        }
        if(!empty($data->total_time) && !Valid::digit($data->total_time, true)){
            $mh->registerMessage('Not allowed to use anything but numbers in total time!', (MessageHandler::MH_ERROR | MessageHandler::ACCESS_ADMIN));
            $is_correct = false;
        }
        if(!Valid::not_empty($data->min_right_answers)){
            $mh->registerMessage('Minimum right answers is empty or forbidden symbols detected!', (MessageHandler::MH_ERROR | MessageHandler::ACCESS_ADMIN));
            $is_correct = false;
        }
        if(!Valid::max_length($data->min_right_answers, 2)){
            $mh->registerMessage('Max minimum right answers length is 2 symbols!', (MessageHandler::MH_ERROR | MessageHandler::ACCESS_ADMIN));
            $is_correct = false;
        }
        if(!empty($data->min_right_answers) && !Valid::digit($data->min_right_answers, true)){
            $mh->registerMessage('Not allowed to use anything but numbers in minimum right answers!', (MessageHandler::MH_ERROR | MessageHandler::ACCESS_ADMIN));
            $is_correct = false;
        }
        return $is_correct;
    }

    /**
     * Retrieve fully parsed test for test passing process.
     * @param string $filename Name of test file in storage
     * @param bool $as_json Convert stdClass result into JSON representation. Default value is 'false'
     */
    public static function getFullTest($filename, $as_json = false) {
        $storage = Model_Storage::getInstance();
        $have_access = $storage->checkStorageFolderAccessibility();
        $test_uri = Model_Storage::STORAGE_FOLDER.$filename.Model_Storage::FILE_EXT;
        try {
            if($have_access && $storage->checkFileAccessibility($test_uri)) {
                $storage->addFileURIToParse($test_uri);
                $tests = $storage->getParsedTests();
                if(count($tests) == 1 && $tests[0] instanceof stdClass) {
                    $test_to_return = $tests[0];
                    return $as_json ? json_encode($test_to_return) : $test_to_return;
                }else {
                    throw new Exception_ParsingTestFileFailure('Critical error was occured while parsing test file', 500);
                }
            }else {
                throw new Exception_StorageAccessError('Cannot read tests storage folder', 500);
            }
        }catch(Exception_StorageAccessError $e) {
          MessageHandler::getInstance()->registerMessage($e->getMessage(), MessageHandler::MH_FAILURE | MessageHandler::ACCESS_USER);
        }catch(Exception_ParsingTestFileFailure $e) {
          MessageHandler::getInstance()->registerMessage($e->getMessage(), MessageHandler::MH_FAILURE | MessageHandler::ACCESS_USER);
        }
    }

    /**
     * Save test with full data complectation
     * @param stdClass $data Data collection for test
     */
    public static function saveFullTest($data) {
        $storage = Model_Storage::getInstance();
        $have_access = $storage->checkStorageFolderAccessibility();
        $test_uri = Model_Storage::STORAGE_FOLDER.$data->filename.Model_Storage::FILE_EXT;
        if($have_access && $storage->checkFileAccessibility($test_uri)) {
            $document = new DOMDocument();
            $document->load($test_uri);
            $collected_questions = json_decode($data->questions);
            $root = $document->getElementsByTagName('test')->item(0);
            $questionsNode = $document->createElement('questions');
            foreach($collected_questions as $question) {
                $questionNode = $document->createElement('question');
                $titleNode = $document->createElement('title', $question->title);
                $questionNode->appendChild($titleNode);
                $exampleNode = $document->createElement('example', $question->example);
                $questionNode->appendChild($exampleNode);
                $answersNode = $document->createElement('answers', $question->example);
                $answerTypeAttr = $questionNode->appendChild($answersNode);
                $answerTypeAttr->setAttribute('type', $question->answer_type);
                foreach($question->answers as $answer) {
                    $answerNode = $document->createElement('answer', $answer->answer);
                    $answerNodeAttr = $answersNode->appendChild($answerNode);
                    $is_right = (empty($answer->is_right)) ? 'true' : 'false';
                    $answerNodeAttr->setAttribute('is_right', $is_right);
                }
                $questionsNode->appendChild($questionNode);
            }
            $root->appendChild($questionsNode);
            $document->save($test_uri);
        }
    }
}