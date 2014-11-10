<?php
	session_start();
	if ($_SESSION['LOGGEDIN'] != 1) {
		Header('Location: ./login.php');
	}
?>