<?php
	session_start();
	$server = "localhost";
    $username = "root";
    $password = "root";
    $db = "guest_book";
    $conn = mysqli_connect($server, $username, $password, $db);
    mysqli_select_db($conn, $db);
    $sql = '';
    if ((isset($_SESSION['login'])) && (isset($_SESSION['password']))) {
    	$sql = 'UPDATE `user` SET ';
    	if (isset($_POST['fio'])) $sql = $sql .'`fio` = "' .$_POST['fio'] .'", ';
	    else $sql = $sql .'`fio` = NULL, ';
	    if (isset($_POST['email'])) $sql = $sql .'`email` = "' .$_POST['email'] .'", ';
	    else $sql = $sql .'`email` = NULL, ';
	    if (isset($_POST['phone'])) $sql = $sql .'`phone` = "' .$_POST['phone'] .'", ';
	    else $sql = $sql .'`phone` = NULL, ';
	    if (isset($_POST['age'])) $sql = $sql .'`age` = "' .$_POST['age'] .'", ';
	    else $sql = $sql .'`age` = NULL, ';
	    if (isset($_POST['message'])) $sql = $sql .'`message` = "' .$_POST['message'] .'" ';
	    else $sql = $sql .'`message` = NULL ';
	    $select = mysqli_query($conn, 'SELECT `user_id` FROM `auth_user` WHERE `login` = "' .$_SESSION['login']. '" AND `password` = "' .$_SESSION['password']. '";');
	    $user_id = mysqli_fetch_array($select);
	    $sql = $sql .'WHERE `id` = ' .$user_id[0]. ';';
    }
    else {
    	$sql = 'INSERT INTO `user` VALUES (NULL, ';
	    if (isset($_POST['fio'])) $sql = $sql .'"' .$_POST['fio'] .'", ';
	    else $sql = $sql .'NULL, ';
	    if (isset($_POST['email'])) $sql = $sql .'"' .$_POST['email'] .'", ';
	    else $sql = $sql .'NULL, ';
	    if (isset($_POST['phone'])) $sql = $sql .'"' .$_POST['phone'] .'", ';
	    else $sql = $sql .'NULL, ';
	    if (isset($_POST['age'])) $sql = $sql .'"' .$_POST['age'] .'", ';
	    else $sql = $sql .'NULL, ';
	    if (isset($_POST['message'])) $sql = $sql .'"' .$_POST['message'] .'");';
	    else $sql = $sql .'NULL);';
    }
    try {
    	$result = mysqli_query($conn, $sql);
    	echo "Изменения успешно сохранены";
    }
    catch (Exception $e) {
    	echo "Ошибка: " .$e.getMessage();
    }
    echo '<br><br><a href="index.php">На главную</a>';
?>