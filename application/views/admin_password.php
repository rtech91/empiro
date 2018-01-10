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
      <div class="container">
        <div class="form-wrap password-wrap">
          <div class="form-style">
          <form method="post">
            <input type="password" name="password" placeholder="<?php __('Enter the password'); ?>">
            <div class="btn">
            <input id="admin-submit" type="submit" value="<?php __('Send'); ?>">
            </div>
          </form>
          </div>
        </div>
      </div>
    </div>
  </main>