  <main>
    <div class="home">
    <div class="alert-wrap">
        <?php foreach ($messages as $message) : ?>
            <?php if ($message->bits & MessageHandler::ACCESS_USER) : ?>
            <?php if ($message->bits & MessageHandler::MH_FAILURE) : ?>
              <div class="alert-failure">
            <?php elseif ($message->bits & MessageHandler::MH_ERROR) : ?>
              <div class="alert-error">
            <?php elseif ($message->bits & MessageHandler::MH_MESSAGE) : ?>
              <div class="alert-message">
            <?php endif; ?>
              <span>
                <?php echo $message->message; ?>
              </span>
            </div>
            <?php endif; ?>
        <?php endforeach; ?>
      </div>
      <h1><?php echo I18n::get('Contact information'); ?></h1>
      <div class="contact-info">
        <div class="text-block">
          <p><?php echo I18n::get('Site created by Cyber laboratory "Swarm" of IT School PDM'); ?></p>
          <span class="users-icon"></span><a href="https://www.facebook.com/groups/InformaticsPDM/?fref=ts"><?php echo I18n::get('School at Facebook'); ?></a>
        </div>
        <div class="text-block">
          <span class="placeholder-icon"></span><p><?php echo I18n::get('Palace of Children and Youth of Rivne city<br />st. Kn. Volodymyra, 10, Rivne'); ?></p>
          <span class="home-icon"></span><a href="https://pdm.org.ua"><?php echo I18n::get('PDM website'); ?></a>
        </div>
      </div>
      <div class="form-wrap">
        <div class="form-style">
        <form action="" method="post">
          <input type="text" name="contact_name" placeholder="<?php echo I18n::get('Your name'); ?>"></input>
          <input type="email" name="contact_email" placeholder="<?php echo I18n::get('Your email'); ?>"></input>
          <select id="category" name="contact_category">
            <option value="OPT_NONE"><?php echo I18n::get('Choose theme...'); ?></option>
            <option value="OPT_QUESTIONS"><?php echo I18n::get('Questions to the team'); ?></option>
            <option value="OPT_PROPOSALS"><?php echo I18n::get('Propositions'); ?></option>
          </select>
          <textarea name="contact_message" placeholder="<?php echo I18n::get('Input message text'); ?>" rows="5"></textarea>
          <input id="contact-submit" type="submit" value="<?php echo I18n::get('Send'); ?>"></input>
        </form>
        </div>
      </div>
    </div>
  </main>
