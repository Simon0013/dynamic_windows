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
    	$conn = null;
     	try {
	      $conn = new PDO('MySQL: host=' .$server. '; port=3306; dbname=' .$db. '; charset=utf8', $username, $password);
	    }
	    catch (PDOException $e) {
	      echo 'Ошибка: ' .$e->getMessage(). '<br>';
	      die();
	    }
     	echo '<tr>';
     	foreach ($titles[$a] as $title) {
     		echo '<th>' .$title. '</th>';
     	}
     	echo '</tr>';
     	$result = $conn->query($select[$a]);
     	while ($row = $result->fetch()) {
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