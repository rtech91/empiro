<main>
		<div class="home">
			<div class="alert-wrap">
				<div class="alert-error"><span>Тест HTML/CSS успішно додано</span></div>
			</div>
			<h1>Створення тесту. Етап 2</h1>
			<p>Введить інформацію, згідно із довідковими даними у полях.</p>
				<div class="form-wrap stage1-wrap">
					<div class="form-style">
						<ul class="create-test-form">
							<form>
								<li><input type="text" name="question" value="" placeholder="Введіть назву запитання"></li>
								<li><textarea placeholder="Введіть код або вираз" rows="2"></textarea></li>
								<li>
									<div class="right-answer">
									<label>
										<input class="checkbox" type="radio" name="question" value="var1">
										<span class="checkbox-custom"></span>
									</label>	
									</div>
									<div class="answer"><input type="text" name="answer" value="" placeholder="Введіть відповідь"></div>
									<div class="add-answer">									
										<div class="plus-answer"></div>
									</div>
								</li>
							</form>
						</ul>	
					</div>
					<div class="save-test-wrap">
						<button class="btn-test" id="prev-page" type="button"  disabled>Попереднє</button>				
						<button class="btn-test btn-disabled" id="next-page" type="submit" disabled>Додати запитання</button>
						<button class="btn-test btn-disabled" id="next-page" type="submit" disabled>Зберегти тест</button>
					</div>
				</div>
		</div>
	</main>