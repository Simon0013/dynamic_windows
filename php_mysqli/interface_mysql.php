<html>
<head>
  <title>Интерфейс БД</title>
  <meta charset = "utf-8">
  <script type="text/javascript">
    function navigate(elemId, winId, max, vector) {
      if (vector == 0) {
        if (elemId > 1)
          document.location = "interface_mysql.php?winID=" + winId + "&elemID=" + (elemId-1);
      }
      else
        if (elemId < max)
          document.location = "interface_mysql.php?winID=" + winId + "&elemID=" + (elemId+1);
    }
  </script>
</head>
<body>
    <?php
      $tables = ["genre", "author", "books"];
      $titles = ["Жанры", "Авторы", "Книги"];
      $atributes = [["ID", "Название"], ["ID", "ФИО", "Дата рождения", "Дата смерти", "Страна"], ["ID", "Название", "Описание", "Год написания", "Автор", "Жанр"]];
      $a=$_GET['winID'];
      $b=$_GET['elemID'];
      $form = '<form method="POST" action="save_mysql.php?mode=';
      if ($a < 10) $form = $form .'0&tableID='.($a % 10 - 1).'">';
      else if ($a < 20) $form = $form .'1&tableID='.($a % 10 - 1).'">';
      else $form = $form .'2&tableID='.($a % 10 - 1).'">';
      echo $form;
      $server = "localhost";
      $username = "root";
      $password = "root";
      $db = "library";
      $conn = mysqli_connect($server, $username, $password, $db);
      mysqli_select_db($conn, $db);
      echo '<h2>' .$titles[$a % 10 - 1]. '</h2>';
      $where_str = "";
      if ($b > 0)
        $where_str = " WHERE `id` = " .$b;
      $result = mysqli_query($conn, "SELECT * FROM " .$tables[$a % 10 - 1]. $where_str);
      $row = mysqli_fetch_array($result);
      if ($a < 10) {
        for($i = 0; $i < count($row) / 2; $i++) {
          echo '<label>' .$atributes[$a % 10 - 1][$i]. ': </label>';
          if ($i == 0)
            echo '<input name = "atr' .($i+1). '" type = "text" readonly = "readonly"></input><br>';
          else if (($i > 3) && ($i < 6) && ($a % 10 == 3)) {
            echo '<select name = "atr' .($i+1). '">';
            $res = null;
            if ($i == 4)
              $res = mysqli_query($conn, "SELECT `fio` FROM `author`");
            else
              $res = mysqli_query($conn, "SELECT `name` FROM `genre`");
            while ($auth = mysqli_fetch_array($res)) {
              echo '<option>' .$auth[0]. '</option>';
            }
            echo '</select><br>';
          }
          else
            echo '<input name = "atr' .($i+1). '" type = "text"></input><br>';
        }
      }
      else if ($row) {
        for($i = 0; $i < count($row) / 2; $i++) {
          echo '<label>' .$atributes[$a % 10 - 1][$i]. ': </label>';
          if ($i == 0)
            echo '<input name = "atr' .($i+1). '" type = "text" value = "' .$row[$i]. '" readonly = "readonly"></input><br>';
          else if (($i > 3) && ($i < 6) && ($a % 10 == 3)) {
            echo '<select name = "atr' .($i+1). '">';
            $res = null;
            if ($i == 4)
              $res = mysqli_query($conn, "SELECT `fio` FROM `author`");
            else
              $res = mysqli_query($conn, "SELECT `name` FROM `genre`");
            while ($auth = mysqli_fetch_array($res)) {
              if ($auth[0] == $row[$i])
                echo '<option selected>' .$auth[0]. '</option>';
              else
                echo '<option>' .$auth[0]. '</option>';
            }
            echo '</select><br>';
          }
          else
            echo '<input name = "atr' .($i+1). '" type = "text" value = "' .$row[$i]. '"></input><br>';
        }
      }
      if ($a > 10) {
        $res = mysqli_query($conn, "SELECT MAX(`id`) FROM " .$tables[$a % 10 - 1]);
        $maxId = mysqli_fetch_array($res);
        echo '<br><input type = "button" value = "Предыдущий" onclick = "navigate(' .$b. ', ' .$a. ', ' .$maxId[0]. ', 0)"></input>';
        echo '<input type = "button" value = "Следующий" onclick = "navigate(' .$b. ', ' .$a. ', ' .$maxId[0]. ', 1)"></input><br>';
      }
      echo '<br><br>';
      if ($a > 20) {
        echo '<input type = "submit" value = "Удалить"></input>';
      }
      else {
        echo '<input type = "submit" value = "Сохранить"></input>';
      }
    ?>
  </form>
</body>
</html>