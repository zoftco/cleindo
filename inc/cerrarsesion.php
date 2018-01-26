<?php
	session_start();
    session_unset();
	if (isset($_SESSION['user_id'])) {
		unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
		unset($_SESSION['time']);
		header("Location:../index.php");
	} else {
		header("Location:../index.php");
	}
?>