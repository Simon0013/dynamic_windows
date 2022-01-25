<html>
	<head>
		<title>Popup Window</title>
	</head>
	<body bgcolor="#ffffff" text="#000000" link="black" vlink="gray" alink="#808040">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td>
					<?php
					// Включить файл, имя которого определяется
					// переданным параметром.
					$a=$_GET['winID'];
					INCLUDE ("$a.inc");
					?>
				</td>
			</tr>
			<tr>
				<td>
					<a href="#" onClick="self.close()">Закрыть окно</a>
				</td>
			</tr>
		</table>
	</body>
</html>