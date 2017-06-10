	<main>
		<div class="home">
			<h1>Тестування знань</h1>
			<p>Ви знаходитесь на головній сторінці тестування знань. Тут ви можете обрати предмет, за яким хочете скласти іспит.</p>
			<div class="table">
			<?php if(!empty($tests) && is_array($tests) && count($tests) > 0): ?>
				<table>
					<tr>
						<th>Назва тесту</th>
						<th>Кількість запитань</th>
						<th>Час проходження</th>
						<th>Категорія / Дисципліна</th>
						<th>Пройти тест</th>
					</tr>
					<?php foreach($tests as $test): ?>
					<tr>
						<td><?php echo $test->name; ?></td>
						<td><?php echo count($test->questions); ?></td>
						<td><?php echo date('H:i:s', strtotime($test->time)); ?></td>
						<td><?php echo $test->category; ?></td>
						<td><a href="#">Розпочати</a></td>
					</tr>
					<?php endforeach; ?>
				</table>
				<?php endif; ?>
			</div>
		</div>
	</main>