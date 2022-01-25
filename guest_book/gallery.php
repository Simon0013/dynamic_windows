<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Фотогалерея</title>
</head>
<body background="fon.jpg">
	<h1>Фотогалерея</h1>
	<?php
	  $server = "localhost";
      $username = "root";
      $password = "root";
      $db = "guest_book";
      $conn = mysqli_connect($server, $username, $password, $db);
      mysqli_select_db($conn, $db);
      $result = mysqli_query($conn, 'SELECT COUNT(*) FROM `gallery`;');
      $info = mysqli_fetch_array($result);
      if ($info[0] == 0) {
      	echo '<p>Здесь пока нет ни одного изображения... зайдите попозже</p>';
      }
      else {
      	$result = mysqli_query($conn, 'SELECT * FROM `gallery` ORDER BY `count_show` DESC;');
      	while ($info = mysqli_fetch_array($result)) {
      		echo '<a href="img_show.php?imgID=' .$info[0]. '"><img width="500" height="300" hspace="5" src="' .$info[1]. '"></a>';
      	}
      }
	?>
</body>
</html>