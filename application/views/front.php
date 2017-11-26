  <main>
    <div class="home">
      <div class="alert-wrap">
        <?php foreach($messages as $message): ?>
          <?php if($message->bits & MessageHandler::ACCESS_USER): ?>
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
      <h1>Тестування знань</h1>
      <p>Ви знаходитесь на головній сторінці тестування знань. Тут ви можете обрати предмет, за яким хочете скласти іспит.</p>
      <div class="table">
      <?php if(!empty($tests) && is_array($tests) && count($tests) > 0): ?>
        <table>
          <tr>
            <th>Назва тесту</th>
            <th>Кількість запитань</th>
            <th>Час проходження</th>
            <th>Категорія / Дисципліна</th>
            <th>Пройти тест</th>
          </tr>
          <?php foreach($tests as $test): ?>
          <tr>
            <td><?php echo $test->name; ?></td>
            <td><?php echo count($test->questions); ?></td>
            <td><?php echo date('H:i:s', strtotime($test->time)); ?></td>
            <td><?php echo $test->category; ?></td>
            <td><a href="<?php echo URL::site(Route::get('pass_test_st1')->uri(array('test_id' => $test->filename)), true); ?>">Розпочати</a></td>
          </tr>
          <?php endforeach; ?>
        </table>
        <?php endif; ?>
      </div>
    </div>
  </main>
