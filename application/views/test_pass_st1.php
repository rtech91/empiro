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
      <h1><?php echo I18n::get('Test passage. Stage I'); ?></h1>
      <p><?php echo I18n::get('Before beginning the test passing, fill in the data.'); ?></p>
      <div class="form-wrap stage1-wrap">
        <div class="form-style">
          <form action="" method="post" id="pass_st1_form">
            <input type="text" name="surname" value="<?php echo isset($fields->surname) ? $fields->surname : ''; ?>" placeholder="<?php echo I18n::get('Surname'); ?>">
            <input type="text" name="name" value="<?php echo isset($fields->name) ? $fields->name : ''; ?>" placeholder="<?php echo I18n::get('Name'); ?>">
            <input type="text" name="patronymic" value="<?php echo isset($fields->patronymic) ? $fields->patronymic : ''; ?>" placeholder="<?php echo I18n::get('Patronymic'); ?>">
            <input type="hidden" name="op" value="pass_st1_form">
            <select id="group" name="group">
                <?php foreach ($groups as $group) : ?>
                <option value="<?php echo $group->id; ?>">
                    <?php echo $group->name; ?>
                </option>
                <?php endforeach; ?>
            </select>
            <div class="btn">
              <input type="submit" value="<?php echo I18n::get('Continue'); ?>">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</main>