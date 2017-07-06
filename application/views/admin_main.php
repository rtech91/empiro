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
			<div class="button-wrap">
				<span><a class="btn-create" href="#">Створити тест</a></span>
			</div>		
				<h1>Розділ адміністратора</h1>
				<p>Вам доступні такі операції, як створення та редагування існуючих тестів.</p>
		
				<div class="table">
					<table>
						<tr>
							<th>Назва тесту</th>
							<th>Кількість запитань</th>
							<th>Час проходження</th>
							<th>Категорія / Дисципліна</th>
							<th>Пройти тест</th>
						</tr>
						<tr>
							<td>PHP</td>
							<td>20</td>
							<td>00:20:00</td>
							<td>Інформатика</td>
							<td><a href="#">Редагувати</a></td>
						</tr>
					</table>
				</div>
		</div>
	</main>