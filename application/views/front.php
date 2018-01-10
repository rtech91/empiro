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
      <h1><?php __('Knowledge testing'); ?></h1>
      <p><?php __('You are at main knowledge testing page. Here you can choose the subject, you want to take the exam at.'); ?></p>
      <div class="table">
      <?php if(!empty($tests) && is_array($tests) && count($tests) > 0): ?>
        <table>
          <tr>
            <th><?php __('Test name'); ?></th>
            <th><?php __('Number of questions'); ?></th>
            <th><?php __('Passage time'); ?></th>
            <th><?php __('Category / Discipline'); ?></th>
            <th><?php __('Take a test'); ?></th>
          </tr>
          <?php foreach($tests as $test): ?>
          <tr>
            <td><?php echo $test->name; ?></td>
            <td><?php echo count($test->questions); ?></td>
            <td><?php echo date('H:i:s', strtotime($test->time)); ?></td>
            <td><?php echo $test->category; ?></td>
            <td><a href="<?php echo URL::site(Route::get('pass_test_st1')->uri(array('test_id' => $test->filename)), true); ?>"><?php __('Start'); ?></a></td>
          </tr>
          <?php endforeach; ?>
        </table>
        <?php endif; ?>
      </div>
    </div>
  </main>
