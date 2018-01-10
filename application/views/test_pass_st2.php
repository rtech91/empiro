<main>
<div class="home">
	<div class="alert-wrap">
		<div class="alert-failure"><span><?php __('Test HTML/CSS damaged'); ?></span></div>
	</div>
	<h1>HTML/CSS</h1>
	<div class="test-wrap">
		<div class="test-info">
			<div class="question-number"><?php __('Question'); ?>: 1/20</div>
			<div class="test-time"><?php __('Time left'); ?>: 00:14:27/00:30:00</div>
		</div>
		<div class="question">
			<h3>You have to make a numbered list, which of the tags should you use?</h3>
		</div>
		<div class="test-block">
			<form>
			<label>
				<input class="radio" type="radio" name="question" value="var1">
				<span class="radio-custom"></span>
				<div class="label">&lt;ol&gt;</div>
			</label>
			<label>
				<input class="radio" type="radio" name="question" value="var2">
				<span class="radio-custom"></span>
				<div class="label">&lt;tr&gt;</div>
			</label>
			<label>		
				<input class="radio" type="radio" name="question" value="var3">
				<span class="radio-custom"></span>
				<div class="label">&lt;ul&gt;</div>
			</label>
			<label>		
				<input class="radio" type="radio" name="question" value="var4">
				<span class="radio-custom"></span>
				<div class="label">&lt;list&gt;</div>
				
			</label>	
			</form>
		</div>
		<div class="result-block">
			<button class="btn-test" id="prev-page" type="button"  disabled><?php __('Previous'); ?></button>
			<button class="btn-test btn-disabled" id="next-page" type="submit" disabled><?php __('Next'); ?></button>
		</div>
	</div>
</div>
</main>