<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Интерфейс БД - запросы</title>
</head>
<body>
	<table border="1" cellpadding="5">
	<?php
		$a = $_GET['winID'];
		$select = ['SELECT `book`.`name`, `genre`.`name`, `written_date` FROM `book` JOIN `genre` ON `id_genre` = `genre`.`id` WHERE `written_date` BETWEEN 1951 AND 2000;', 'SELECT `book`.`name`, `fio`, `genre`.`name` FROM `book` JOIN `genre` ON `id_genre` = `genre`.`id` JOIN `author` ON `id_author` = `author`.`id`;', 'SELECT `genre`.`name` FROM `genre` LEFT JOIN `book` ON `id_genre` = `genre`.`id` WHERE `book`.`name` IS NULL'];
		$titles = [['Книга', 'Жанр', 'Год написания'], ['Книга', 'Автор', 'Жанр'], ['Жанр']];
		$server = "localhost";
    	$username = "root";
    	$password = "root";
    	$db = "library";
     	$conn = mysqli_connect($server, $username, $password, $db);
     	mysqli_select_db($conn, $db);
     	echo '<tr>';
     	foreach ($titles[$a] as $title) {
     		echo '<th>' .$title. '</th>';
     	}
     	echo '</tr>';
     	$result = mysqli_query($conn, $select[$a]);
     	while ($row = mysqli_fetch_array($result)) {
     		echo '<tr>';
     		for ($i = 0; $i < count($row) / 2; $i++) {
     			echo '<td>' .$row[$i]. '</td>';
     		}
     		echo '</tr>';
     	}
	?>
	</table>
</body>
</html>