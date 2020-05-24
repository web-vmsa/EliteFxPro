<?php
	$id = $_GET['id'];
	$email = $_GET['email'];

	$pdo = new PDO("mysql:dbname=elitefxpro;host=localhost", "root", "");
	$sql = "UPDATE users SET status = '1' WHERE id = '$id'";
	$sql = $pdo->query($sql);

	$pdo = new PDO("mysql:dbname=elitefxpro;host=localhost", "root", "");
	$sql = "INSERT INTO balance SET id_user = '$id', has = '0', withdraw = '0', deposity = '0'";
	$sql = $pdo->query($sql);

	$from = "vmsa03@gmail.com";

	$to = $email;

	$subject = "Account accepted (EliteFxPro)";

	$message = "Hello, your account has been accepted by the administrator, login now to our EliteFxPro.com website and access the panel to earn a lot of money!";

	$headers = "From:". $from;

	mail($to, $subject, $message, $headers);

	header("Location: new-users?accept=true");
?>