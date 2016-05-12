<?php
	session_start();
	session_regenerate_id(true);
	
function died($error) {
        echo "Your signup couldn't be completed. Check below!<br /><br />";
        echo $error."<br /><br />";
        die();
    }

if(isset($_POST['user_name'])) {

    if(!isset($_POST['user_name']) ||
        !isset($_POST['name']) ||
        !isset($_POST['password']) ||
        !isset($_POST['rep_password']) ||
        !isset($_POST['address'])) {
        died('You must fill out all the fields.');
    }

    $user_name = strip_tags(trim($_POST['user_name']));
    //Using the php 5.5 password_hash function below with included salt
    $first_pass = strip_tags(trim($_POST['password']));
    $first_pass_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $second_pass = strip_tags(trim($_POST['rep_password']));
    $name = strip_tags(trim($_POST['name']));
    $address = strip_tags(trim($_POST['address']));
    
    if ($first_pass != $second_pass) {
    	died("You didn't write the same password.");
    }
    
    //include 'includes/dbconn.php';
    include 'dbconn.php';
    $mysqli = mysqliconn();
    
	if($stmt = $mysqli -> prepare("SELECT user_name FROM Users WHERE user_name = ?")) {

		/* Bind parameters
		s - string, b - boolean, i - int, etc */
		$stmt -> bind_param("s", $user_name);
		$stmt -> execute();
		$stmt -> bind_result($result);
		$stmt -> fetch();

		if ($user_name == $result) {
			$stmt -> close();
			died("User exists. Choose new alias.");
		}

		$stmt -> close();
	}
    
	if ($stmt = $mysqli -> prepare("INSERT INTO Users VALUES(?,?,?,?)")) {

		/* Bind parameters: s - string, b - boolean, i - int, d - double/float */
		$stmt -> bind_param("ssss", $user_name, $first_pass_hash, $name, $address);
		$stmt -> execute();
		$stmt -> close();
	}
	
	$mysqli -> close();
	$_SESSION['user'] = $db_user_name;
	$_SESSION['name'] = $name;
    //setcookie("user",$user_name . "," . $name,time()+900);
    
}
?>

<!DOCTYPE html>
<html>
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="icon" href="./favicon.ico" type="image/vnd.microsoft.icon" />
	<title>Viktoria Blomén - Kontakt</title>

	<link href="mall.css" rel="stylesheet" type="text/css">
</head>

<body>

	<table width = 800px>
		<tr><td align="top"><img src="../img/loggowebshop.jpg"></td></tr>
		<tr><td><br></tr></td>
		<tr><td align=center><h3>
		<?php
			echo "Welcome ".$_SESSION['name']."!";
		?>
		</h3></tr></td>
		<tr align=center><td>
			<FORM METHOD="LINK" ACTION="reviewOrder.php"><INPUT TYPE="submit" VALUE="I want to pay!"></FORM>
		</td></tr>
	</table>

</body>

</html>