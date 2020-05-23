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

	$subject = "Conta Aceita! (EliteFxPro)";

	$message = "Olá, sua conta foi verificada pelo administrador, e você pode fazer login no Painel da EliteFxPro! Obrigado por usar nossos serviços.";

	$headers = "De:". $from;

	mail($to, $subject, $message, $headers);

	header("Location: new-users?accept=true");
?>