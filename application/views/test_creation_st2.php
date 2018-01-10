<script type="text/javascript">
  $(document).ready(function(){
    initQuestionStorage();
    setInterval(tryToActivateButtons, 150);
    $('#selector-answer-type').change(function(){
      var value = $('#selector-answer-type').val();
      createAnswerRows(value);
    });
    var currentQuestionInterval = setInterval(function(){
      $('#current_question').html(parseInt(localStorage.currentQuestion));
    }, 100);
  });
</script>
<main>
<div class="home">
    <div class="alert-wrap">
        <?php foreach($messages as $message): ?>
            <?php if($message->bits & MessageHandler::ACCESS_ADMIN): ?>
                <?php if($message->bits & MessageHandler::MH_FAILURE): ?>
                <div class="alert-failure">
                <?php elseif($message->bits & MessageHandler::MH_ERROR): ?>
                <div class="alert-error">
                <?php elseif($message->bits & MessageHandler::MH_MESSAGE): ?>
                <div class="alert-message">
                <?php endif; ?>
                    <span>
                	<?php echo $message->message; ?>
                    </span>
                </div>
             <?php endif; ?>
      <?php endforeach; ?>
    </div>
      <h1><?php __('Test creation. Stage 2. Question '); ?><span id="current_question">1</h1>
      <p><?php __('Fill in the information, according to reference data in the fields.'); ?></p>
      <div class="form-wrap stage1-wrap">
        <div class="form-style">
          <ul class="create-test-form">
            <li><input type="text" name="question" value=""
              placeholder="<?php __('Enter question name'); ?>"></li>
            <li><textarea name="example"
                placeholder="<?php __('Enter code or expression'); ?>" rows="2"></textarea></li>
            <li><select class="answer-type" id="selector-answer-type">
                <option value="none" id="none-answer-value"><?php __('Not chosen'); ?></option>
                <option value="one"><?php __('One correct answer'); ?></option>
                <option value="multiple"><?php __('Several correct answers'); ?></option>
            </select></li>
            <div id="answers_list"></div>
          </ul>
        </div>
        <div id="field_template">
          <li>
            <div class="right-answer">
              <label> <input class="radio" type="radio"
                name="right_answer" value="1"> <span
                class="radio-custom"></span>
              </label>
            </div>
            <div class="answer">
              <input type="text" name="answer" value=""
                placeholder="<?php __('Enter answer'); ?>">
            </div>
          </li>
        </div>
        <div id="save_form">
          <form
            action="<?php echo URL::site(Route::get('save_test')->uri(), true); ?>"
            method="post">
            <input type="hidden" id="test_filename" name="filename"
              value="<?php echo $filename; ?>"> <input type="hidden"
              id="questions_list" name="questions" value=""> <input
              type="submit" id="save_form_button" value="" style="display: none;">
          </form>
        </div>
        <div class="save-test-wrap">
          <button class="btn-test" id="prev-question"
            onclick="previousQuestion()" type="button" disabled><?php __('Previous'); ?></button>
          <button class="btn-test btn-disabled"
            onclick="addNewQuestion();" id="add-question" type="button"
            disabled><?php __('Add question'); ?></button>
          <button class="btn-test btn-disabled"
            onclick="saveTestData();" id="save-test" type="submit"
            disabled><?php __('Save test'); ?></button>
        </div>
      </div>
    </div>
</main>
