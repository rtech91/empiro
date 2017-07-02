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
      <h1>Створення тесту. Етап I</h1>
      <p>Заповніть основну інформацію перед створенням тесту.</p>
        <div class="form-wrap stage1-wrap">
          <div class="form-style">
          <ul class="create-test-form">
          <form action="" method="post">
            <li><input type="text" name="name" value="<?php echo isset($data, $data->name) ? $data->name : ''; ?>" placeholder="Назва тесту"></li>
            <li><input type="text" name="category" value="<?php echo isset($data, $data->category) ? $data->category : ''; ?>" placeholder="Категорія / Дисципліна"></li>
            <li><input  type="text" name="total_time" value="<?php echo isset($data, $data->total_time) ? $data->total_time : ''; ?>" placeholder="Загальний час проходження тесту"></li>
            <li><div class="comment">Приклад: 30 (у хвилинах)</div></li>
            <li><input type="text" name="min_right_answers" value="<?php echo isset($data, $data->min_right_answers) ? $data->min_right_answers : ''; ?>" placeholder="Мінімальна кількість вірних відповідей"></li>
            <li><div class="comment">Приклад: 15</div></li>
            <li><div class="btn">
            <input type="submit" value="Зберегти">
            </div></li>
          </form>
          </ul>
          </div>
        </div>
      </div>
    </div>
  </main>
