<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Взаимодействие PHP и MySQL</title>
</head>
<body background="fon.jpg">
	<h1>Гостевая книга</h1>
	<form method="POST" action="save_record.php">
	<?php
	  session_start();
	  $server = "localhost";
      $username = "root";
      $password = "root";
      $db = "guest_book";
      $conn = mysqli_connect($server, $username, $password, $db);
      mysqli_select_db($conn, $db);
	  if ((isset($_SESSION['login'])) && (isset($_SESSION['password']))) {
	  	$info = mysqli_query($conn, 'SELECT `user_id` FROM `auth_user` WHERE `login` = "' .$_SESSION['login']. '" AND password = "' .$_SESSION['password']. '";');
	  	$user_id = mysqli_fetch_array($info);
	  	$info = mysqli_query($conn, 'SELECT * FROM `user` WHERE `id` = ' .$user_id[0]. ';');
	  	$inf = mysqli_fetch_array($info);
	  	echo '<label>Ваше ФИО:</label>';
		echo '<input type="text" name="fio" value="' .$inf[1]. '"><br><br>';
		echo '<label>Ваш E-mail:</label>';
		echo '<input type="text" name="email" value="' .$inf[2]. '"><br><br>';
		echo '<label>Ваш телефон:</label>';
		echo '<input type="text" name="phone" value="' .$inf[3]. '"><br><br>';
		echo '<label>Ваш возраст:</label>';
		echo '<input type="text" name="age" value="' .$inf[4]. '"><br><br>';
      	echo '<label>Сообщение:</label><textarea name="message">' .$inf[5]. '</textarea><br><br>';
      }
      else {
      	echo '<label>Ваше ФИО:</label>';
		echo '<input type="text" name="fio"><br><br>';
		echo '<label>Ваш E-mail:</label>';
		echo '<input type="text" name="email"><br><br>';
		echo '<label>Ваш телефон:</label>';
		echo '<input type="text" name="phone"><br><br>';
		echo '<label>Ваш возраст:</label>';
		echo '<input type="text" name="age"><br><br>';
      }
      echo '<input type="submit" value="Добавить"></form><br>';
      $result = mysqli_query($conn, "SELECT COUNT(*) FROM `user`;");
      $row = mysqli_fetch_array($result);
      echo "<p>Записей в гостевой книге: " .$row[0]. "</p><br>";
      if ($row[0] != 0) {
      	echo '<table border = "1">';
      	$result = mysqli_query($conn, "SELECT * FROM `user`;");
      	while ($row = mysqli_fetch_assoc($result)) {
      		echo '<tr><td><a href = "malito:' .$row['email']. '">' .$row['fio']. '</a><br><p>' .$row['message']. '</p><p>Tel.: ' .$row['phone']. '</p></td><td><a href = "delete_record.php?elemID=' .$row['id']. '">Удалить</a></td></tr>';
      	}
      	echo '</table>';
      }
      if ((isset($_SESSION['login'])) && (isset($_SESSION['password']))) {
      	echo '<br><a href="logout.php"><button>Выйти</button></a>';
      }
      else {
      	echo '<br><p>Обратите внимание: оставлять сообщения (комментарии) могут только <a href="authorise.php">авторизированные</a> пользователи.</p>';
      }
	?>
</body>
</html>