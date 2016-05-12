<?php session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html>
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="icon" href="./favicon.ico" type="image/vnd.microsoft.icon" />
	<title>Viktoria Blomén's Shop - Review Order</title>

	<link href="mall.css" rel="stylesheet" type="text/css">
</head>

<body>

<table width="800px">
<tr>
	<td align="top"><img src="../img/loggowebshop.jpg"></td>
</tr>
<tr>
	<td align=top><h2>Review your order:</h2><br></td>
</tr>

<?php
	function died($error) {
        echo "Your signup couldn't be completed. Check below!<br /><br />";
        echo $error."<br /><br />";
        die();
    }
	
	//include 'includes/dbconn.php';
	include 'dbconn.php';
	$link = mysqliconn();

	// Reselect items to be purchased to avoid client tampering with prices in cookies
	$query_items = "SELECT * FROM Items";
	$query_users = "SELECT name, address FROM Users WHERE user_name = ?";

	if ($result = mysqli_query($link, $query_items)) {

		echo "<table align=top>";
		$total_price = 0;
		$total_product_items = 0;
		
		if (isset($_COOKIE['item'])) {
		
			echo "<tr><td valign='top'>";
			echo "<b>Item</b></td><td><b>Price per Item</b></td><td><b>&nbsp&nbsp&nbspPrice Total</b>";
			echo "</td></tr>";
		
			while ($row = mysqli_fetch_array($result)) {
		
				$pieces = explode(",", $_COOKIE["item"]);
		
    			foreach ($pieces as $piece) {
    		
        			$name = htmlspecialchars($piece);
        		
        			if ($row['title'] == $name) {
        				$total_product_items++;
					}
        		}
        		if ($total_product_items > 0) {
        			echo "<tr><td valign='top'>";
					echo $row['title']."</td><td align=right>".$row['price']."&nbsp&nbsp&nbsp</td><td align=right>".$row['price']*$total_product_items;
					echo "</td></tr>";
					$total_price += ($total_product_items * $row['price']);
					$total_product_items = 0;
					
				}
    		}
    		echo "<tr><td><br></td></tr><tr><td valign='top'>";
			echo "<b>Sum total</b></td><td align=right>&nbsp</td><td align=right>".$total_price;
			echo "</td></tr>";
		}
		
		mysqli_free_result($result);
		mysqli_close($link);

		$link = mysqliconn();
		
		if (isset($_SESSION['user'])) {
		
			echo '<tr><td><h2>Your information:</h2></td></tr>';
		
			if ($stm = $link->prepare($query_users)) {
			
				$stm -> bind_param("s", $_SESSION['user']);
				$stm -> execute();
				$stm -> bind_result($db_result_name, $db_result_address);
				$stm -> fetch();
				
				echo '<tr><td>Name: </td><td>'.$db_result_name.'</td></tr>';
				echo '<tr><td>Address: </td><td>'.$db_result_address.'</td></tr>';
				
			}
			
		} else {
			echo "Log in or sign up before completing order";
		}
	}

	mysqli_close($link);

?>


<tr align=top><td><h2>Payment:</h2></td></tr>
<tr><td valign="top"><label for="credit_card">Credit card number: </label></td>
 	<td valign="top"><input  type="text" name="credit_card" maxlength="16" size="17">
</td></tr>
<tr align=center><td><FORM METHOD="LINK" ACTION="paymentDone.php"><INPUT TYPE="submit" VALUE="Make transaction"></FORM></td></tr>

</table>
</body>

</html>