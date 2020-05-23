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

			// tirando do dinheiro atual dele
			$dinheiro_atual = $data['has'];
			$dinheiro_diminuido = $dinheiro_atual - $quantidade;

			// colocando dados da consulta no withdraw da tabela
			$withdraw_atual = $data['withdraw'];
			$withdraw_somado = $withdraw_atual + $quantidade;

			$sql = "UPDATE balance SET has = '$dinheiro_diminuido', withdraw = '$withdraw_somado' WHERE id_user = '$id_user'";
			$sql = $pdo->query($sql);

			header("Location: adm.php");
		}
	}
?>