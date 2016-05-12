<?php session_start();
?>

<!DOCTYPE html>
<html>
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="icon" href="./favicon.ico" type="image/vnd.microsoft.icon" />
	<title>Viktoria Blomén's Shop</title>

	<link href="mall.css" rel="stylesheet" type="text/css">
</head>

<body>

<?php
	//include 'includes/dbconn.php';
	include 'dbconn.php';
	$link = mysqliconn();
?>

<table width="800px">
<tr>
	<td align="top"><img src="../img/loggowebshop.jpg"></td>
</tr>
<tr>
	<td align=center>

<?php

	$query = "SELECT * FROM Items";

	if($result = mysqli_query($link, $query)) {

		echo "<table>";
	
		while ($row = mysqli_fetch_array($result)) {
			echo "<tr align=center>";
			echo "<td>".$row['title']."&nbsp;</td>";
			echo "<td><img src=".$row['image_path']." width='75%' height='75%'></td>";
			echo "<td>".$row['price']."&nbsp;kr</td>";
			echo '<td><FORM METHOD="POST" ACTION="checkout.php"><INPUT TYPE="submit" VALUE="Buy one!"><input type="hidden" name="item" value="'.$row['title'].'"></FORM></td>';
			echo "</tr><br>";
		}
		
		echo "</table>";
		echo '<tr align=center><td><FORM METHOD="LINK" ACTION="login.php"><INPUT TYPE="submit" VALUE="Pay n leave >>"></FORM></td></tr>';

		mysqli_free_result($result);
	}

	mysqli_close($link);

?> 
	</td>
</tr>
</table>
</body>

</html>