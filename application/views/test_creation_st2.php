<script type="text/javascript">
  $(document).ready(function(){
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
          $(newAnswerField).find('.right-answer input').val(i);
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
    $('#selector-answer-type').change(function(){
      var value = $('#selector-answer-type').val();
      createAnswerRows(value);
    });
  });
</script>
<main>
<div class="home">
  <div class="alert-wrap">
    <div class="alert-error">
      <span>Тест HTML/CSS успішно додано</span>
    </div>
  </div>
  <h1>Створення тесту. Етап 2</h1>
  <p>Введить інформацію, згідно із довідковими даними у полях.</p>
  <div class="form-wrap stage1-wrap">
    <div class="form-style">
      <ul class="create-test-form">
        <form>
          <li><input type="text" name="question" value=""
            placeholder="Введіть назву запитання"></li>
          <li><textarea placeholder="Введіть код або вираз" rows="2"></textarea></li>
          <li><select class="answer-type" id="selector-answer-type">
              <option value="none">Не обрано</option>
              <option value="one">Одна вірна відповідь</option>
              <option value="multiple">Декілька вірних
                відповідей</option>
          </select></li>
          <div id="answers_list">
          </div>
        </form>
      </ul>
    </div>
    <div id="field_template">
    <li>
      <div class="right-answer">
        <label> <input class="radio" type="radio" name="right_answer"
          value="1"> <span class="radio-custom"></span>
        </label>
      </div>
      <div class="answer">
        <input type="text" name="answer" value=""
          placeholder="Введіть відповідь">
      </div>
    </li>
    </div>
    <div class="save-test-wrap">
      <button class="btn-test" id="prev-page" type="button" disabled>Попереднє</button>
      <button class="btn-test btn-disabled" id="next-page" type="submit"
        disabled>Додати запитання</button>
      <button class="btn-test btn-disabled" id="next-page" type="submit"
        disabled>Зберегти тест</button>
    </div>
  </div>
</div>
</main>
