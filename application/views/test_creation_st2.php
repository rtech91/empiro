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
          <li><select class="answer-type">
              <option value="Не обрано">Не обрано</option>
              <option value="Одна вірна відповідь">Одна вірна відповідь</option>
              <option value="Декілька вірних відповідей">Декілька вірних
                відповідей</option>
          </select></li>
          <div id="answers_list">
            <li>
              <div class="right-answer">
                <label> <input class="checkbox" type="radio" name="question"
                  value="1"> <span class="checkbox-custom"></span>
                </label>
              </div>
              <div class="answer">
                <input type="text" name="answer" value=""
                  placeholder="Введіть відповідь">
              </div>
            </li>
          </div>
        </form>
      </ul>
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
