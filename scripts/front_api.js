// Front API scripts
function createAnswerRows(type) {
    var template = $('#field_template li');
    var count = 0;
    if('one' === type) {
        count = 3;
    }else if('multiple' === type) {
        count = 5;
    }
    $('#answers_list').html('');
    for(var i = 1; i <= count; i++) {
        var newAnswerField = $(template).clone();
        $(newAnswerField).find('.right-answer input').val(0);
        $(newAnswerField).appendTo('#answers_list');
    }
    if('multiple' === type) {
        $('#answers_list .right-answer input').each(function(){
	        $(this).attr('type', 'checkbox');
	        $(this).attr('name', 'right_answers[]');
	        $(this).removeClass('radio').addClass('checkbox');
	        $('#answers_list .radio-custom').each(function(){
	        	$(this).removeClass('radio-custom').addClass('checkbox-custom');
	        });
        });
    }
    $('#answers_list').show();
}
function parseNewQuestion() {
    var newQuestion = new Object;
    newQuestion.id = localStorage.currentQuestion;
    newQuestion.title = $('input[name="question"]').val();
    newQuestion.example = $('textarea[name="example"]').val();
    newQuestion.answer_type = $('#selector-answer-type').val();
    newQuestion.answers = new Array();
    $('#answers_list li').each(function() {
        var newAnswer = new Object;
        newAnswer.right = Boolean($(this).find('.right-answer input').prop('checked'));
        newAnswer.answer = $(this).find('input[name="answer"]').val();
        newQuestion.answers.push(newAnswer);
    });
    return newQuestion;
}
function addNewQuestion() {
    var newQuestion = parseNewQuestion();
    var storage = localStorage !== undefined ? localStorage : null;
    if(null !== storage) {
        if(undefined === storage.questionStorage) {
            storage.questionStorage = JSON.stringify([]);
        }
        if(newQuestion) {
            var questions = JSON.parse(storage.questionStorage);
            questions.push(newQuestion);
            storage.questionStorage = JSON.stringify(questions);
            localStorage.currentQuestion = parseInt(localStorage.currentQuestion) + 1;
            localStorage.lastQuestion = parseInt(localStorage.lastQuestion) + 1;
            clearFields();
        }
    }
}
function getQuestion() {
    var storedQuestions = JSON.parse(localStorage.questionStorage);
    var question = null;
    storedQuestions.forEach(function(currentQuestion, index, array) {
        if(currentQuestion.id === localStorage.currentQuestion){
            question = currentQuestion;
        }
    });
    return question;
}
function tryToActivateButtons() {
    if($('input[name="question"]').val().length > 0 && $('#selector-answer-type').val() !== 'none'){
        $('#add-question, #save-test').removeAttr('disabled').removeClass('btn-disabled').addClass('btn-active');
    }else {
        $('#add-question, #save-test').attr('disabled', 'disabled').removeClass('btn-active').addClass('btn-disabled');
    }
    if(localStorage.currentQuestion > 1) {
        $('#prev-question').removeAttr('disabled', 'disabled').removeClass('btn-disabled').addClass('btn-active');
    }else {
        $('#prev-question').attr('disabled', 'disabled').removeClass('btn-active').addClass('btn-disabled');
    }
}
function clearFields() {
    $('input[name="question"]').val('');
    $('textarea[name="example"]').val('');
    $('#selector-answer-type').val('none').change();
}
function fillAnswerFields(answers) {
    var answerFields = $('#answers_list li');
    for(var i=0; i<answers.length; i++) {
        var currentAnswer = answers[i];
        $(answerFields[i]).find('.right-answer input').prop('checked', currentAnswer.right);
        $(answerFields[i]).find('input[name="answer"]').val(currentAnswer.answer);
    }
}
/**
 * Initializes the array for questions and assigns the default 
 * question number to 1
 */
function initQuestionStorage() {
    var storage = localStorage !== undefined ? localStorage : null;
    if(null !== storage) {
        storage.questionStorage = JSON.stringify([]);
    }
    storage.currentQuestion = 1;
    storage.lastQuestion = 1;
}
function nextQuestion() {
    localStorage.currentQuestion += 1;
}
function previousQuestion() {
    localStorage.currentQuestion -= 1;
    var question = getQuestion();
    clearFields();
    $('input[name="question"]').val(question.title);
    $('textarea[name="example"]').val(question.example);
    $('#selector-answer-type').val(question.answer_type);
    createAnswerRows(question.answer_type);
    fillAnswerFields(question.answers);
}