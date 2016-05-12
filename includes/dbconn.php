<?php

/* The purpose of this function is to hide the database login detalis from the client.
*  The 'includes' directory is secured from clients using a .htaccess file
*/

function mysqliconn() {
	$link = new mysqli('localhost', 'root', ’CHANGE_TO_PASSWORD_OF_CHOICE’, 'EITF05');
   	if(mysqli_connect_errno()) {
   		echo "Connection Failed: " . mysqli_connect_errno();
   		exit();
    }
    return $link;
}
?>