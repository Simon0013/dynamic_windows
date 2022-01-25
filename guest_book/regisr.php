<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Регистрация пользователя</title>
</head>
<body background="fon.jpg">
	<p>Уже есть учётная запись? <a href="authorise.php">Авторизируйтесь</a>.</p>
	<h2>Регистрация учётной записи:</h2>
	<form method="POST">
		<label>Логин: </label>
		<input type="text" name="login"><br><br>
		<label>Пароль: </label>
		<input type="password" name="password"><br><br>
		<input type="submit" value="Зарегистрироваться">
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
		    if ($row[0] != 0) {
		    	echo "<p>Ошибка: пользователь с такими логином и паролем уже существует! Введите другой логин и пароль.</p>";
		    }
		    else {
		    	mysqli_query($conn, "INSERT INTO `user` VALUES (NULL, NULL, NULL, NULL, NULL, NULL);");
		    	$max_id_select = mysqli_query($conn, "SELECT MAX(`id`) FROM `user`;");
		    	$max_id = mysqli_fetch_array($max_id_select);
		    	mysqli_query($conn, "INSERT INTO `auth_user` VALUES (NULL, '" .$_POST['login']. "', '" .$_POST['password']. "', " .$max_id[0]. ");");
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