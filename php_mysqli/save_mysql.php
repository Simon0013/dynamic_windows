<?php
	$sql = '';
	$mode = $_GET['mode'];
	$tableID = $_GET['tableID'];
	$tables = ["genre", "author", "book"];
	$atributes = [["id", "name"], ["id", "fio", "birth", "death", "country"], ["id", "name", "description", "written_date", "id_author", "id_genre"]];
	$server = "localhost";
    $username = "root";
    $password = "root";
    $db = "library";
    $conn = mysqli_connect($server, $username, $password, $db);
    mysqli_select_db($conn, $db);
	if ($mode == 0) {
		$sql = $sql .'INSERT INTO ' .$tables[$tableID]. ' VALUES (NULL, ';
		if (isset($_POST['atr2'])) $sql = $sql .'"' .$_POST['atr2']. '"';
		else $sql = $sql .'NULL';
		if ($tableID == 0) {
			$sql = $sql .');';
		}
		else {
			$sql = $sql .', ';
			if (isset($_POST['atr3'])) $sql = $sql .'"' .$_POST['atr3']. '", ';
			else $sql = $sql .'NULL, ';
			if ((isset($_POST['atr4'])) && ($tableID == 1))
				$sql = $sql .'"' .$_POST['atr4']. '", ';
			else if (isset($_POST['atr4']))
				$sql = $sql .$_POST['atr4']. ', ';
			else $sql = $sql .'NULL, ';
			if ((isset($_POST['atr5'])) && ($tableID == 2)) {
				$select_id = mysqli_query($conn, 'SELECT `id` FROM `author` WHERE `fio` = "' .$_POST['atr5']. '"');
				$id = mysqli_fetch_array($select_id);
				$sql = $sql .$id[0];
			}
			else if (isset($_POST['atr5'])) {
				$sql = $sql .'"' .$_POST['atr5']. '"';
			}
			else $sql = $sql .'NULL';
			if ($tableID == 1) {
				$sql = $sql .');';
			}
			else {
				if (isset($_POST['atr6'])) {
					$select_id = mysqli_query($conn, 'SELECT `id` FROM `genre` WHERE `name` = "' .$_POST['atr6']. '"');
					$id = mysqli_fetch_array($select_id);
					$sql = $sql .', ' .$id[0]. ');';
				}
				else $sql = $sql .'NULL);';
			}
		}
	}
	else if ($mode == 1) {
		$sql = $sql .'UPDATE ' .$tables[$tableID]. ' SET ';
		if (isset($_POST['atr2'])) $sql = $sql .$atributes[$tableID][1].' = "' .$_POST['atr2']. '"';
		if (isset($_POST['atr3'])) $sql = $sql .', ' .$atributes[$tableID][2].' = "' .$_POST['atr3']. '"';
		if (isset($_POST['atr4'])) {
			if ($tableID == 1) $sql = $sql .', ' .$atributes[$tableID][3].' = "' .$_POST['atr4']. '"';
			else $sql = $sql .', ' .$atributes[$tableID][3].' = ' .$_POST['atr4'];
		}
		if (isset($_POST['atr5'])) {
			if ($tableID == 1)
				$sql = $sql .', ' .$atributes[$tableID][4].' = "' .$_POST['atr5']. '"';
			else {
				$select_id = mysqli_query($conn, 'SELECT `id` FROM `author` WHERE `fio` = "' .$_POST['atr5']. '"');
				$id = mysqli_fetch_array($select_id);
				$sql = $sql .', ' .$atributes[$tableID][4].' = ' .$id[0];
			}
		}
		if (isset($_POST['atr6'])) {
			$select_id = mysqli_query($conn, 'SELECT `id` FROM `genre` WHERE `name` = "' .$_POST['atr6']. '"');
			$id = mysqli_fetch_array($select_id);
			$sql = $sql .', ' .$atributes[$tableID][5].' = ' .$id[0];
		}
		$sql = $sql .' WHERE `id` = '.$_POST['atr1'].';';
	}
	else {
		$sql = $sql .'DELETE FROM ' .$tables[$tableID]. ' WHERE `id` = '.$_POST['atr1'].';';
	}
    $result = mysqli_query($conn, $sql);
    if ($result == false) {
    	$ecode = mysqli_errno();
    	$etext = mysqli_error();
    	die("Ошибка MySQL $ecode: $etext<br>при выполнении SQL запроса:<br>" .$sql);
    }
    echo 'Изменения успешно сохранены';
?>