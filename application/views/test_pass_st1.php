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
    <?php if(count($messages) == 0): ?>
      <h1>Проходження тесту. Етап I</h1>
      <p>До початку проходження тесту, заповніть дані.</p>
      <div class="form-wrap stage1-wrap">
        <div class="form-style">
          <form action="" method="post" id="pass_st1_form">
            <input type="text" name="surname" placeholder="Прізвище">
            <input type="text" name="name" placeholder="Ім'я">
            <input type="text" name="patronymic" placeholder="По-батькові">
            <input type="hidden" name="op" value="pass_st1_form">
            <select id="group" name="group">
                <?php foreach($groups as $group): ?>
                <option value="<?php echo $group->id; ?>">
                  <?php echo $group->name; ?>
                </option>
                <?php endforeach; ?>
            </select>
            <div class="btn">
              <input type="submit" value="Продовжити">
            </div>
          </form>
        </div>
      </div>
    <?php endif; ?>
    </div>
  </div>
</main>