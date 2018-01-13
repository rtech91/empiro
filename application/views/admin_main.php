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
        <span><a class="btn-create" href="<?php echo URL::site(Route::get('create_test')->uri()); ?>"><?php echo I18n::get('Create a test'); ?></a></span>
      </div>
        <h1><?php echo I18n::get('Admin section'); ?></h1>
        <p>
        <?php echo I18n::get('You have access to such operations as creating and editing existing tests,
        you can also '); ?><a href="<?php echo URL::site(Route::get('admin_logout')->uri()); ?>"><?php echo I18n::get('end administration session.'); ?></a>
        </p>
        <div class="table">
          <?php if(!empty($tests) && is_array($tests) && count($tests) > 0): ?>
            <table>
              <tr>
                <th><?php echo I18n::get('Test name'); ?></th>
                <th><?php echo I18n::get('Number of questions'); ?></th>
                <th><?php echo I18n::get('Passage time'); ?></th>
                <th><?php echo I18n::get('Category / Discipline'); ?></th>
                <th><?php echo I18n::get('Editing'); ?></th>
              </tr>
              <?php foreach($tests as $test): ?>
                <tr>
                  <td><?php echo $test->name; ?></td>
                  <td><?php echo count($test->questions); ?></td>
                  <td><?php echo date('H:i:s', strtotime($test->time)); ?></td>
                  <td><?php echo $test->category; ?></td>
                  <td><a href="#"><?php echo I18n::get('Edit'); ?></a></td>
                </tr>
              <?php endforeach; ?>
            </table>
            <?php endif; ?>
        </div>
    </div>
  </main>