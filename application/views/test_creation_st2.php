<script type="text/javascript">
  $(document).ready(function(){
    initQuestionStorage();
    setInterval(tryToActivateButtons, 150);
    $('#selector-answer-type').change(function(){
      var value = $('#selector-answer-type').val();
      createAnswerRows(value);
    });
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
      <h1>Створення тесту. Етап 2</h1>
      <p>Введіть інформацію, згідно із довідковими даними у полях.</p>
      <div class="form-wrap stage1-wrap">
        <div class="form-style">
          <ul class="create-test-form">
            <li><input type="text" name="question" value=""
              placeholder="Введіть назву запитання"></li>
            <li><textarea name="example"
                placeholder="Введіть код або вираз" rows="2"></textarea></li>
            <li><select class="answer-type" id="selector-answer-type">
                <option value="none" id="none-answer-value">Не обрано</option>
                <option value="one">Одна вірна відповідь</option>
                <option value="multiple">Декілька вірних відповідей</option>
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
                placeholder="Введіть відповідь">
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
            onclick="previousQuestion()" type="button" disabled>Попереднє</button>
          <button class="btn-test btn-disabled"
            onclick="addNewQuestion();" id="add-question" type="button"
            disabled>Додати запитання</button>
          <button class="btn-test btn-disabled"
            onclick="saveTestData();" id="save-test" type="submit"
            disabled>Зберегти тест</button>
        </div>
      </div>
    </div>
</main>
