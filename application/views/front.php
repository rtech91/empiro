<!DOCTYPE html>
<html lang="ua">
<head>
	<meta charset="utf-8"/>
	<title>Empiro-index</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css?family=Crimson+Text:400,700|Ubuntu:400,700&amp;subset=cyrillic" rel="stylesheet"> 
	<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>style/style.css" />
</head>
<body>
	<header>
		<div class="header">
			<div class="logo"><a href="index.html">Empiro</a></div>
		</div>
	</header>
	<nav>
		<ul class="nav">
			<li><a href="admin.html">Для адміністратора</a></li>
			<li><a href="contact.html">Про нас</a></li>
		</ul>
	</nav>
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
	<footer>
		<div class="footer">
			<div class="copyright">
				<p>&#9400; Copyright 2017 <br /> Школа інформатики ПДМ. Усі права збережені</p>
			</div>
			<div class="contact">
				<p>Рівненський міський Палац дітей та молоді <br /> Адреса <br /> вул. Кн. Володимира, 10, Рівне</p>
			</div>
		</div>
	</footer>
</body>
</html>