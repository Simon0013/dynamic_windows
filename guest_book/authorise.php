<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Авторизация пользователя</title>
</head>
<body background="fon.jpg">
	<p>Для получения полного доступа к контенту сайта авторизируйтесь или <a href="regisr.php">зарегистрируйтесь</a></p>
	<h2>Вход в учётную запись:</h2>
	<form method="POST">
		<label>Логин: </label>
		<input type="text" name="login"><br><br>
		<label>Пароль: </label>
		<input type="password" name="password"><br><br>
		<input type="submit" value="Войти">
	</form><br>
	<?php
		if ((isset($_POST['login'])) && (isset($_POST['password']))) {
			$server = "localhost";
		    $username = "root";
		    $password = "root";
		    $db = "guest_book";
		    $conn = mysqli_connect($server, $username, $password, $db);
		    mysqli_select_db($conn, $db);
		    $result = mysqli_query($conn, "SELECT COUNT(*) FROM `auth_user` WHERE `login` = '" .$_POST['login']. "' AND `password` = '" .$_POST['password']. "';");
		    $row = mysqli_fetch_array($result);
		    if ($row[0] == 0) {
		    	echo "<p>Ошибка: неверный логин или пароль. Проверьте логин-пароль или зарегистрируйтесь</p>";
		    }
		    else {
		    	session_start();
		    	$_SESSION['login'] = $_POST['login'];
		    	$_SESSION['password'] = $_POST['password'];
		    	header("location: /index.php");
		    }
		}
	?>
	<a href="index.php"><button>На главную</button></a>
</body>
</html>