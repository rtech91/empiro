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
			<h1>Контактна інформація</h1>
			<div class="contact-info">
				<div class="text-block">
					<p>Сайт створений Кібернетичною лабораторією "Swarm" Школи Інформатики ПДМ</p>
					<span class="users-icon"></span><a href="https://www.facebook.com/groups/InformaticsPDM/?fref=ts">Школа у Facebook</a>
				</div>
				<div class="text-block">
					<span class="placeholder-icon"></span><p>Рівненський міський Палац дітей та молоді<br />вул. кн. Володимира, 10, Рівне</p>
					<span class="home-icon"></span><a href="https://pdm.org.ua">Сайт ПДМ</a>
				</div>
			</div>
			<div class="form-wrap">
				<div class="form-style">
				<form action="" method="post">
					<input type="text" name="contact_name" placeholder="Ваше ім'я"></input>
					<input type="email" name="contact_email" placeholder="Ваш email"></input>
					<select id="category" name="contact_category">
						<option value="OPT_NONE">Оберіть тематику...</option>
						<option value="OPT_QUESTIONS">Запитання до команди</option>
						<option value="OPT_PROPOSALS">Пропозиції</option>
					</select>
					<textarea name="contact_message" placeholder="Введіть текст повідомлення" rows="5"></textarea>
					<input id="contact-submit" type="submit" value="Надіслати"></input>
				</form>
				</div>
			</div>	
		</div>
	</main>