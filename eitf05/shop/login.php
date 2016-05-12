<?php session_start();
	session_regenerate_id(true);
?>
<!DOCTYPE html>
<html>
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="icon" href="./favicon.ico" type="image/vnd.microsoft.icon" />
	<title>Viktoria Blomén's Shop - Login/Signup</title>

	<link href="mall.css" rel="stylesheet" type="text/css">
</head>

<body>

<table width="800px" align="center">
<tr>
	<td align="top"><img src="../img/loggowebshop.jpg"></td>
</tr>
<tr>
<td>
<h2>Login to continue!</h2>

<form name="htmlform" method="post" action="form_login.php">
<table width="450px">
<tr>
 <td valign="top">
  <label for="user_name">User name: </label>
 </td>
 <td valign="top">
  <input  type="text" name="user_name" maxlength="30" size="30">
 </td>
</tr>
 
<tr>
 <td valign="top"">
  <label for="password">Password: </label>
 </td>
 <td valign="top">
  <input type="password" name="password">
 </td>
</tr>

<tr>
 <td colspan="2" style="text-align:center">
  <input type="submit" value="Login!">
 </td>
</tr>

</table>
</form>

<br><hr></br>

<h2>New customer? Sign up below!</h2>

<form name="htmlform" method="post" action="form_signup.php" align=center>
<table width="450px">
<tr>
 <td valign="top">
  <label for="user_name">Desired user name: </label>
 </td>
 <td valign="top">
  <input  type="text" name="user_name" maxlength="30" size="30">
 </td>
</tr>
 
<tr>
 <td valign="top"">
  <label for="password">Choose password: </label>
 </td>
 <td valign="top">
  <input type="password" name="password">
 </td>
</tr>

<tr>
 <td valign="top"">
  <label for="rep_password">Repeat password: </label>
 </td>
 <td valign="top">
  <input type="password" name="rep_password">
 </td>
</tr>

<tr>
 <td valign="top">
  <label for="name">Name: </label>
 </td>
 <td valign="top">
  <input  type="text" name="name" maxlength="50" size="30">
 </td> 
</tr>

<tr>
 <td valign="top">
  <label for="address">Address: </label>
 </td>
 <td valign="top">
  <input  type="text" name="address" maxlength="50" size="30">
 </td>
</tr>

<tr>
 <td colspan="2" style="text-align:center">
  <input type="submit" value="Sign up!">
 </td>
</tr>
</table>
</form>

</td>
</tr>
</table>

</body>

</html>