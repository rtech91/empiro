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
        <span><a class="btn-create" href="<?php echo URL::site(Route::get('create_test')->uri()); ?>">Create a test</a></span>
      </div>
        <h1>Admin section</h1>
        <p>
        You have access to such operations as creating and editing existing tests,
        you can also <a href="<?php echo URL::site(Route::get('admin_logout')->uri()); ?>">end administration session.</a>
        </p>
        <div class="table">
          <?php if(!empty($tests) && is_array($tests) && count($tests) > 0): ?>
            <table>
              <tr>
                <th>Test name</th>
                <th>Number of questions</th>
                <th>Passage time</th>
                <th>Category / Discipline</th>
                <th>Editing</th>
              </tr>
              <?php foreach($tests as $test): ?>
                <tr>
                  <td><?php echo $test->name; ?></td>
                  <td><?php echo count($test->questions); ?></td>
                  <td><?php echo date('H:i:s', strtotime($test->time)); ?></td>
                  <td><?php echo $test->category; ?></td>
                  <td><a href="#">Edit</a></td>
                </tr>
              <?php endforeach; ?>
            </table>
            <?php endif; ?>
        </div>
    </div>
  </main>