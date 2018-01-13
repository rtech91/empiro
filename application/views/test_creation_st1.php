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
	<h1><?php echo I18n::get('Test creation. Stage I'); ?></h1>
	<p><?php echo I18n::get('Fill in main information before creating the test.'); ?></p>
		<div class="form-wrap stage1-wrap">
			<div class="form-style">
			<ul class="create-test-form">
			<form action="" method="post" id="st1_form">
				<li><input type="text" name="name" required value="<?php echo isset($data, $data->name) ? $data->name : ''; ?>" placeholder="<?php echo I18n::get('Test name'); ?>" ></li>
				<li><input type="text" name="category" required value="<?php echo isset($data, $data->category) ? $data->category : ''; ?>" placeholder="<?php echo I18n::get('Category / Discipline'); ?>"></li>
				<li><input  type="number" name="total_time" required value="<?php echo isset($data, $data->total_time) ? $data->total_time : ''; ?>" min="1" placeholder="<?php echo I18n::get('Total test passage time in minutes'); ?>"></li>
				<li><div class="comment"><?php echo I18n::get('Example: 30 (in minutes)'); ?></div></li>
				<li><input type="number" name="min_right_answers" required id="mr_answers" value="<?php echo isset($data, $data->min_right_answers) ? $data->min_right_answers : ''; ?>" placeholder="<?php echo I18n::get('Minimum number of right answers to pass the test'); ?>"></li>
				<li><div class="comment"><?php echo I18n::get('Example: 15'); ?></div></li>
				<li><div class="btn">
				<input type="button" onclick="setMinRightAnswers();" value="<?php echo I18n::get('Save'); ?>">
				</div></li>
			</form>
			</ul>
			</div>
		</div>
	</div>
</div>
</main>