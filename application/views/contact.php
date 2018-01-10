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
      <h1><?php __('Contact information'); ?></h1>
      <div class="contact-info">
        <div class="text-block">
          <p><?php __('Site created by Cyber laboratory "Swarm" of IT School PDM'); ?></p>
          <span class="users-icon"></span><a href="https://www.facebook.com/groups/InformaticsPDM/?fref=ts"><?php __('School at Facebook'); ?></a>
        </div>
        <div class="text-block">
          <span class="placeholder-icon"></span><p><?php __('Palace of Children and Youth of Rivne city<br />st. Kn. Volodymyra, 10, Rivne'); ?></p>
          <span class="home-icon"></span><a href="https://pdm.org.ua"><?php __('PDM website'); ?></a>
        </div>
      </div>
      <div class="form-wrap">
        <div class="form-style">
        <form action="" method="post">
          <input type="text" name="contact_name" placeholder="<?php __('Your name'); ?>"></input>
          <input type="email" name="contact_email" placeholder="<?php __('Your email'); ?>"></input>
          <select id="category" name="contact_category">
            <option value="OPT_NONE"><?php __('Choose theme...'); ?></option>
            <option value="OPT_QUESTIONS"><?php __('Questions to the team'); ?></option>
            <option value="OPT_PROPOSALS"><?php __('Propositions'); ?></option>
          </select>
          <textarea name="contact_message" placeholder="<?php __('Input message text'); ?>" rows="5"></textarea>
          <input id="contact-submit" type="submit" value="<?php __('Send'); ?>"></input>
        </form>
        </div>
      </div>
    </div>
  </main>
