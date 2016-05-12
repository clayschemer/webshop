<?php
	session_start();
	if (isset($_COOKIE['item'])) {
		setcookie('item', "",time()-3600);
	}
	if(isset($_POST['credit_card'])) {
		$credit_card = strip_tags(trim($_POST['credit_card']));
		//make magic with cardnumber
	}
	session_destroy();	
?>


<!DOCTYPE html>
<html>
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="icon" href="./favicon.ico" type="image/vnd.microsoft.icon" />
	<title>Viktoria Blomén's Shop - Done!</title>

	<link href="mall.css" rel="stylesheet" type="text/css">
</head>

<body>

<table width="1000px">

<tr>
	<td align="top"><img src="../img/loggowebshop.jpg"></td>
</tr>

<tr>
	<td align=center>Thank you for shopping!</td>
</tr>
<tr>
	<td align=center><a href="shop.php">Take me out of here</a></td>
</tr>

</body>

</html>