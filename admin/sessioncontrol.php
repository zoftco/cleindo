<?php
	if(isset($_GET['token'])) {
		if($_GET['token'] != "q1w2e3") {
			header("Location:../404.php");
			exit;
		}
	} else {
		header("Location:../404.php");
		exit;
	}
?>