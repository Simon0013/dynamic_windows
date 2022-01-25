<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Выход из учётной записи</title>
</head>
<body background="fon.jpg">
	<?php
		session_start();
		session_destroy();
	?>
	<p>Выход из учётной записи выполнен успешно!</p>
	<a href="authorise.php">Авторизироваться</a><br>
	<a href="index.php">На главную</a>
</body>
</html>