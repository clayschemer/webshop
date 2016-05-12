<?php
	session_start();
	session_regenerate_id(true);


function died($error, $mysqli_link) {
		$mysqli_link -> close();
        echo "You couldn't login. Check below!<br /><br />";
        echo $error."<br /><br />";
        echo '<a href="login.php">TRY AGAIN</a>';
        die();
    }

if(isset($_POST['user_name'])) {

    if(!isset($_POST['user_name']) ||
        !isset($_POST['password'])) {
        died('You must fill out all the fields!');
    }

    $user_name = strip_tags(trim($_POST['user_name']));
    $password = strip_tags(trim($_POST['password']));
    
    $error_message = "";
    $exp_user_name = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
    
    //include 'includes/dbconn.php';
    include 'dbconn.php';
    $mysqli = mysqliconn();
    
    $name = "";
    
	if($stmt = $mysqli -> prepare("SELECT user_name, pass_hash, name, login_attempts, locked_until FROM Users WHERE user_name = ?")) {

		/* Bind parameters
		s - string, b - boolean, i - int, etc */
		$stmt -> bind_param("s", $user_name);
		$stmt -> execute();
		$stmt -> bind_result($db_user_name, $db_pass_hash, $db_name, $login_attempts, $locked_until);
		$stmt -> fetch();
		
		if ($locked_until > microtime(true)) {
			$stmt -> close();
			died("You have been blocked from the system for a couple of minutes, because too many failed login attempts.", $mysqli);
		}
		if ($db_user_name == "") {
			$stmt -> close();
			died("Unknown user name!", $mysqli);
		}
		if (!password_verify($password, $db_pass_hash)) {
			$stmt -> close();
			if ($login_attempts > 2) {
				$stmt = $mysqli -> prepare("UPDATE Users SET login_attempts = 0, locked_until = ? WHERE user_name = ?");
				$lock_until = microtime(true) + 60.0*2.0;
				$stmt -> bind_param("ds", $lock_until, $user_name);
				$stmt -> execute();
				$stmt -> close();
			}
			if ($login_attempts < 3) {
				$sum_of_attempts = $login_attempts + 1;
				$stmt = $mysqli -> prepare("UPDATE Users SET login_attempts = ? WHERE user_name = ?");
				$stmt -> bind_param("is", $sum_of_attempts, $user_name);
				$stmt -> execute();
				$stmt -> close();
			}
			died("You entered the wrong password.", $mysqli);
		}

		$stmt -> close();
	}

	$mysqli -> close();
	$_SESSION['user'] = $db_user_name;
	$_SESSION['name'] = $db_name;
    //setcookie("user",$db_user_name . "," . $db_name,time()+900);
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
	
	<table width=800px>
		<tr><td align="center"><img src="../img/loggowebshop.jpg"></td></tr>
		<tr><td><br></tr></td>
		<tr><td align=center><h3>
		<?php
			echo "Welcome ".$_SESSION['name']."!<br>";
		?>
		</h3></tr></td>
		<tr align=center><td>
			<FORM METHOD="LINK" ACTION="reviewOrder.php"><INPUT TYPE="submit" VALUE="I want to pay!"></FORM>
		</td></tr>
	</table>

</body>

</html>