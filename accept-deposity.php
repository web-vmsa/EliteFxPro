<?php
	$pdo = new PDO("mysql:dbname=elitefxpro;host=localhost", "root", "");

	// pega id da requisicao
	$id = $_GET['id'];

	// seleciona dados da requisicao por id
	$sql = "SELECT * FROM requests WHERE id = '$id'";
	$sql = $pdo->query($sql);
	if ($sql->rowCount()) {
		$dados = $sql->fetch();
		$quantidade = $dados['amount'];
		$id_user = $dados['id_user'];

		$sql = "UPDATE requests SET status = '1' WHERE id = '$id'";
		$sql = $pdo->query($sql);

		$sql = "SELECT * FROM balance WHERE id_user = '$id_user'";
		$sql = $pdo->query($sql);
		if ($sql->rowCount() > 0) {
			$data = $sql->fetch();

			// somando do dinheiro atual dele
			$dinheiro_atual = $data['has'];
			$dinheiro_somado = $dinheiro_atual + $quantidade;

			// colocando dados da consulta no deposity da tabela
			$deposity_atual = $data['deposity'];
			$deposity_somado = $deposity_atual + $quantidade;

			$sql = "UPDATE balance SET has = '$dinheiro_somado', deposity = '$deposity_somado' WHERE id_user = '$id_user'";
			$sql = $pdo->query($sql);

			header("Location: verify-requests?accept=true");
		}
	}
?>