<?php
	require_once('../inc/config.php');
	require_once('php/sessioncontrol.php');
	$session = new sessioncontrol();
	if($session->isValid('admin_id')) {
	    $session->redirect(HOME_PAGE);
	    exit;
	} else {
		$session->redirect('login.php');
	}
?>