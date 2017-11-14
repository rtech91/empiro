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
}