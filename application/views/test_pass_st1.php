<main>
<div class="home">
	<div class="alert-wrap">
		<div class="alert-error"><span>У тест HTML/CSS внесена зміна</span></div>
	</div>
	<h1>Проходження тесту. Етап I</h1>
	<p>До початку проходження тесту, заповніть дані.</p>
		<div class="form-wrap stage1-wrap">
			<div class="form-style">
			<form>
				<input type="text" placeholder="Прізвище">
				<input type="text" placeholder="Ім'я">
				<input type="text" placeholder="По-батькові">
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
	</div>
</div>
</main>