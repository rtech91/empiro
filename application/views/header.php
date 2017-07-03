<!DOCTYPE html>
<html lang="ua">
<head>
  <meta charset="utf-8"/>
  <title>Empiro-index</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css?family=Ubuntu:400,700&amp;subset=cyrillic" rel="stylesheet">
  <link type="text/css" rel="stylesheet" href="<?php echo URL::base(); ?>style/style.css" />
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
</head>
<body>
  <div id="wrap">
  <header>
    <div class="header">
      <div class="logo"><a href="<?php echo URL::site('', true); ?>"><img src="<?php echo URL::base(); ?>image/logo.png" alt="logo" /></a></div>
    </div>
  </header>
  <nav>
    <ul class="nav">
      <?php if(Request::current()->action() !== 'index'): ?>
        <li><a href="<?php echo URL::base(); ?>">Головна</a></li>
      <?php endif; ?>
        <li><a href="<?php echo Route::get('admin_entrance')->url('admin_entrance'); ?>">Для адміністратора</a></li>
      <li><a href="<?php echo Route::get('contact_page')->url('contact_page'); ?>">Про нас</a></li>
    </ul>
  </nav>
