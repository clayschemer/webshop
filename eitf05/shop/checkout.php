<?php session_start();
	//Strips manipulation of POST value
	$value = strip_tags(trim($_POST['item']));
	if (isset($_COOKIE["item"])) {
		//Strips manipulation of existing cookie value
		$old = strip_tags(trim($_COOKIE["item"])); 
		$with_comma = $old . ",";
		$new = $with_comma . $value;
		setcookie("item",$new,time()+3600);
	} else {
		setcookie("item",$value,time()+3600);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="icon" href="./favicon.ico" type="image/vnd.microsoft.icon" />
	<title>Viktoria Blomén's Shop - Checkout</title>

	<link href="mall.css" rel="stylesheet" type="text/css">
	
</head>

<body>

<table width="800px">
<tr>
	<td align="center"><img src="../img/loggowebshop.jpg"></td>
</tr>
<tr>
	<td align=center>
	<?php
		echo $_POST['item'];
	?>
		was added to your cart. <br><br>What do you want?<br>
	</td>
</tr>
<tr align=center>
	<td><FORM METHOD="LINK" ACTION="shop.php"><INPUT TYPE="submit" VALUE="<< Back to shop!"></FORM>
	<FORM METHOD="LINK" ACTION="login.php"><INPUT TYPE="submit" VALUE="Pay and leave >>"></FORM></td>
</tr>

</table>

</body>

</html>