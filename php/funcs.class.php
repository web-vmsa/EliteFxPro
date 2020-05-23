<?php

/**
 * Login, logout, register and user data
 */
class Users {
	
	private $pdo;

	// connecting the database
	public function __construct() {
		$this->pdo = new PDO("mysql:dbname=elitefxpro;host=localhost", "root", "");
	}

	// Get user data
	public function GetUser($id) {
		$sql = "SELECT * FROM users WHERE id = :id";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(':id', $id);
		$sql->execute();
		if ($sql->rowCount() > 0) {
			return $sql->fetch();
		}
	}

	// register function
	public function Register($name, $email, $image, $password, $date_enter) {
		$sql = "INSERT INTO users SET name = :name, email = :email, image = :image, password = :password, date_enter = :date_enter, status = '0'";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(':name', $name);
		$sql->bindValue(':email', $email);
		$sql->bindValue(':image', $image);
		$sql->bindValue(':password', $password);
		$sql->bindValue(':date_enter', $date_enter);
		$sql->execute();

		header("Location: login?msg=true");
	}

	// register function
	public function Update($id, $name, $email, $account, $agency, $password) {
		$sql = "UPDATE users SET name = :name, email = :email, account = :account, agency = :agency, password = :password WHERE id = :id";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(':name', $name);
		$sql->bindValue(':email', $email);
		$sql->bindValue(':account', $account);
		$sql->bindValue(':agency', $agency);
		$sql->bindValue(':password', $password);
		$sql->bindValue(':id', $id);
		$sql->execute();

		header("Location: user-panel?condition=true");
	}

	// update a image
	public function UpdateImage($id, $image) {
		$sql = "UPDATE users SET image = :image WHERE id = :id";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(':image', $image);
		$sql->bindValue(':id', $id);
		$sql->execute();

		header("Location: user-panel");
	}

	// Check login data
	public function Login($email, $password) {
		$sql = "SELECT * FROM users WHERE email = :email AND password = :password AND status = '1'";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(':email', $email);
		$sql->bindValue(':password', $password);
		$sql->execute();
		if ($sql->rowCount() > 0) {
			$dados = $sql->fetch();

			$_SESSION['id'] = $dados['id'];

			header("Location: user-panel");
			return true;
		} else {
			header("Location: login?erro=true");
			return false;
		}
	}

	// Check for active session
	public function VerifyLogin() {
		if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
			# code...
		} else {
			header("Location: login");
		}
	} 

	// Logout user
	public function Logout() {
		if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
			session_destroy();
			header("Location: login");
		} else {
			# code....
		}
	} 
}

/**
 * Has, solicity withdraw and solicity deposity
 */
class MoneyUser {
	
	private $pdo;

	// connecting the database
	public function __construct() {
		$this->pdo = new PDO("mysql:dbname=elitefxpro;host=localhost", "root", "");
	}

	// Get money user
	public function GetMoney($id_user) {
		$sql = "SELECT * FROM balance WHERE id_user = :id_user";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(':id_user', $id_user);
		$sql->execute();
		if ($sql->rowCount() > 0) {
			return $sql->fetch();
		}
	}

	// Solicit request withdraw
	public function RequestWithdraw($id_user, $amount) {
		$sql = "INSERT INTO requests SET id_user = :id_user, amount = :amount, want = '1', status = '2'";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(':id_user', $id_user);
		$sql->bindValue(':amount', $amount);
		$sql->execute();

		header("Location: user-panel?request=true");
	}

	// Solicit request withdraw
	public function RequestDeposity($id_user, $amount) {
		$sql = "INSERT INTO requests SET id_user = :id_user, amount = :amount, want = '0', status = '2'";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(':id_user', $id_user);
		$sql->bindValue(':amount', $amount);
		$sql->execute();

		header("Location: user-panel?deposity=true");
	}

	// Verify if exist request
	public function VerifyRequest($id_usuario) {
		$sql = "SELECT * FROM requests WHERE status = '2' AND id_user = :id_usuario";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(':id_usuario', $id_usuario);
		$sql->execute();
		if ($sql->rowCount() > 0) {
			header("Location: user-panel?edraw=true");
		} else {
			# code...
		}
	}
}

/**
 * Panel adm functions
 */
class Adm {
		
	private $pdo;

	// connecting the database
	public function __construct() {
		$this->pdo = new PDO("mysql:dbname=elitefxpro;host=localhost", "root", "");
	}

	// Verify if the adm is only
	public function VerifyAdm() {
		if ($_SESSION['id'] == 2) {
			# code...
		} else {
			header("Location: user-panel");
		}
	}

	// Count new users
	public function CountNewUsers() {
		$select = $this->pdo->query("SELECT * FROM users WHERE status = '0'")->fetchAll();
		$count = count($select);
		print $count;
	}

	// Count users
	public function CountUsers() {
		$select = $this->pdo->query("SELECT * FROM users WHERE status = '1'")->fetchAll();
		$count = count($select);
		print $count;
	}

	// Count new requests
	public function CountNewRequests() {
		$select = $this->pdo->query("SELECT * FROM requests WHERE status = '2'")->fetchAll();
		$count = count($select);
		print $count;
	}

	// Select requests
	public function SelectAllRequestsWaiting() {
		$sql = "SELECT users.id, users.name, users.account, users.agency, requests.id, requests.id_user, requests.amount, requests.want, requests.status FROM requests INNER JOIN users ON users.id = requests.id_user WHERE requests.status = 2 ORDER BY requests.id DESC";
		$sql = $this->pdo->query($sql);
		if ($sql->rowCount() > 0) {
			return $sql->fetchAll();
		} else {
			# code...
		}
	}

	// Select all new users
	public function SelectAllNewUsers() {
		$sql = "SELECT * FROM users WHERE status = '0' ORDER BY id DESC";
		$sql = $this->pdo->query($sql);
		if ($sql->rowCount() > 0) {
			return $sql->fetchAll();
		} else {
			# code...
		}
	}

	// Find a user
	public function SelectAUser($nome) {
		$sql = "SELECT users.id, users.name, users.email, balance.id, balance.id_user, balance.has FROM balance INNER JOIN users ON users.id = balance.id_user WHERE users.name = :nome";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(':nome', $nome);
		$sql->execute();
		if ($sql->rowCount() > 0) {
			return $sql->fetchAll();
		}
	}

	// Profit money user
	public function InsertProfit($id_do_usuario, $dinheiro_profitado_insert) {
		$sql = "UPDATE balance SET has = :dinheiro_profitado_insert WHERE id_user = :id_do_usuario";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(':dinheiro_profitado_insert', $dinheiro_profitado_insert);
		$sql->bindValue(':id_do_usuario', $id_do_usuario);
		$sql->execute();

		header("Location: users-profit?update=true");
	}
}