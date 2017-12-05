<?php
	session_start();
	if (isset($_SESSION['user_id'])) {
		unset($_SESSION['user_id']);
		unset($_SESSION['time']);
		header("Location:../index.php");
	} else {
		header("Location:../index.php");
	}
?>