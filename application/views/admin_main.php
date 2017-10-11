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
      <div class="button-wrap">
        <span><a class="btn-create" href="<?php echo URL::site(Route::get('create_test')->uri()); ?>">Створити тест</a></span>
      </div>
        <h1>Розділ адміністратора</h1>
        <p>
        Вам доступні такі операції, як створення та редагування існуючих тестів,
        а також ви можете <a href="<?php echo URL::site(Route::get('admin_logout')->uri()); ?>">завершити сеанс адміністрування.</a>
        </p>
        <div class="table">
          <?php if(!empty($tests) && is_array($tests) && count($tests) > 0): ?>
            <table>
              <tr>
                <th>Назва тесту</th>
                <th>Кількість запитань</th>
                <th>Час проходження</th>
                <th>Категорія / Дисципліна</th>
                <th>Редагування</th>
              </tr>
              <?php foreach($tests as $test): ?>
                <tr>
                  <td><?php echo $test->name; ?></td>
                  <td><?php echo count($test->questions); ?></td>
                  <td><?php echo date('H:i:s', strtotime($test->time)); ?></td>
                  <td><?php echo $test->category; ?></td>
                  <td><a href="#">Редагувати</a></td>
                </tr>
              <?php endforeach; ?>
            </table>
            <?php endif; ?>
        </div>
    </div>
  </main>