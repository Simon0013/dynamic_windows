<?php
	$a = null;
	if (isset($_GET['elemID'])) $a = $_GET['elemID'];
	else {
		echo "Не удалось определить идентификатор пользователя. Проверьте корректность ссылки.";
		die();
	}
	$server = "localhost";
    $username = "root";
    $password = "root";
    $db = "guest_book";
    $conn = mysqli_connect($server, $username, $password, $db);
    mysqli_select_db($conn, $db);
    $sql = 'DELETE FROM `user` WHERE `id` = ' .$a. ';';
    try {
    	mysqli_query($conn, $sql);
    	echo "Изменения успешно сохранены";
    }
    catch (Exception $e) {
    	echo "Ошибка: " .$e.getMessage();
    }
    echo '<br><br><a href="index.php">На главную</a>';
?>