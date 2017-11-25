<?php 

class StorageTest extends Unittest_TestCase {
    
    
    public function testCheckAnswerLatin() {
        $document = new DOMDocument();
        $answer = $document->createElement('answer', 'What is C++?');
        $answer_attribute = $document->createAttribute('is_right');
        $answer_attribute->value = "true";
        $answer->appendChild($answer_attribute);
        $document->appendChild($answer);
        
        $this->assertEquals(true, Model_Storage::checkAnswer($answer));
    }
    
    public function testCheckAnswerCyrillic() {
        $document = new DOMDocument();
        $answer = $document->createElement('answer', 'Что такое С++?');
        $answer_attribute = $document->createAttribute('is_right');
        $answer_attribute->value = "true";
        $answer->appendChild($answer_attribute);
        $document->appendChild($answer);
        
        $this->assertEquals(true, Model_Storage::checkAnswer($answer));
    }

    public function testCheckQuestionEmptyTitle() {
        $document = new DOMDocument();
        $question = $document->createElement('question');
        $question_title = $document->createElement('title', '');
        $question->appendChild($question_title);
        $answers = $document->createElement('answers');
        $answers_type = $document->createAttribute('type');
        $answers_type->value = 'one';
        $answers->appendChild($answers_type);
        $question->appendChild($answers);
        $document->appendChild($question);

        $this->assertEquals(false, Model_Storage::checkQuestion($question));
    }

    public function testCheckWholeQuestion() {
        $document = new DOMDocument();
        $question = $document->createElement('question');
        $question_title = $document->createElement('title', 'What is C++?');
        $question->appendChild($question_title);
        $answers = $document->createElement('answers');
        $answers_type = $document->createAttribute('type');
        $answers_type->value = 'one';
        $answers->appendChild($answers_type);
        $question->appendChild($answers);
        $document->appendChild($question);

        $this->assertEquals(true, Model_Storage::checkQuestion($question));
    }
}