<?php
	session_start();
	require 'php/funcs.class.php';
	$destruct = new Users();
	$destruct->Logout();
?>