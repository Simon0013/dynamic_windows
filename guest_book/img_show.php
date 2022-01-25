<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Фотогалерея</title>
</head>
<body>
	<?php
		$a = $_GET['imgID'];
		$server = "localhost";
	    $username = "root";
	    $password = "root";
	    $db = "guest_book";
	    $conn = mysqli_connect($server, $username, $password, $db);
	    mysqli_select_db($conn, $db);
	    $result = mysqli_query($conn, 'SELECT `count_show` FROM `gallery` WHERE `id` = ' .$a. ';');
	    $info = mysqli_fetch_array($result);
	    mysqli_query($conn, 'UPDATE `gallery` SET `count_show` = ' .($info[0]+1). ' WHERE `id` = ' .$a. ';');
	    $result = mysqli_query($conn, 'SELECT `link`, `count_show` FROM `gallery` WHERE `id` = ' .$a. ';');
	    $info = mysqli_fetch_array($result);
	    echo '<img src="' .$info[0]. '"><br><br><p>Просмотров: ' .$info[1]. '</p>';
	?>
	<br><a href="gallery.php"><button>В галерею</button></a>
</body>
</html>