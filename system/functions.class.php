<?php

class PainelUser {
	
	private $pdo;

	public function __construct() {
		$this->pdo = new PDO("mysql:dbname=elitefxpro;host=localhost", "root", "");
	}

	public function GetUser($id) {
		$sql = "SELECT * FROM users WHERE id = :id";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(':id', $id);
		$sql->execute();
		if ($sql->rowCount() > 0) {
			return $sql->fetch();
		} else {
			echo "Não há nenhum usuário cadastrado!";
		}
	}

	public function GetMoney($id) {
		$sql = "SELECT * FROM balance WHERE id_user = :id";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(':id', $id);
		$sql->execute();
		if ($sql->rowCount() > 0) {
			return $sql->fetch();
		} else {
			echo "Não há nenhum dado na balança!";
		}
	}

	public function Deposity($id, $deposito_soma, $dinheiro_somado) {
		$sql = "UPDATE balance SET has = :dinheiro_somado, deposity = :deposito_soma WHERE id_user = :id";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(':deposito_soma', $deposito_soma);
		$sql->bindValue(':dinheiro_somado', $dinheiro_somado);
		$sql->bindValue(':id', $id);
		$sql->execute();

		header("Location: index.php");
	}

	// want = 1 quer dizer que ele quer retirar um dinheiro
	// status = 2 quer dizer que a solicitacao esta em progresso
	public function Solicity($id_user, $amount) {
		$sql = "INSERT INTO requests SET id_user = :id_user, amount = :amount, want = '1', status = '2'";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(':id_user', $id_user);
		$sql->bindValue(':amount', $amount);
		$sql->execute();

		header("Location: index.php");
	}
}