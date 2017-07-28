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
    newQuestion.title = $('input[name="question"]').val();
    newQuestion.example = $('textarea[name="example"]').val();
    newQuestion.answer_type = $('#selector-answer-type').val();
    newQuestion.answers = new Array();
    $('#answers_list li').each(function(){
        var newAnswer = new Object;
        newAnswer.right = Boolean($(this).find('.right-answer input').prop('checked'));
        newAnswer.answer = $(this).find('input[name="answer"]').val();
        newQuestion.answers.push(newAnswer);
    });
    addNewQuestion(newQuestion);
}
function addNewQuestion(newQuestion){
    var storage = localStorage !== undefined ? localStorage : null;
    if(null !== storage) {
        if(undefined === storage.questionStorage) {
            storage.questionStorage = JSON.stringify([]);
        }
        var questions = JSON.parse(storage.questionStorage);
        questions.push(newQuestion);
        storage.questionStorage = JSON.stringify(questions);
    }
}
function tryToActivateButtons() {
    if($('input[name="question"]').val().length > 0 && $('#selector-answer-type').val() !== 'none'){
        $('#add-question, #save-test').removeAttr('disabled');
    }else {
        $('#add-question, #save-test').attr('disabled', 'disabled');
    }
}