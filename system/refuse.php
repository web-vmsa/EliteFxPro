<?php
	$id = $_GET['id'];

	$pdo = new PDO("mysql:dbname=elitefxpro;host=localhost", "root", "");
	$sql = "UPDATE requests SET status = '0' WHERE id = '$id'";
	$sql = $pdo->query($sql);

	header("Location: adm.php");
?>