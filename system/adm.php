<!DOCTYPE html>
<html>
<head>
	<title>Painel do Administrador</title>
	<meta charset="utf-8">
</head>
<body>
	<h1>Veja as solicitações de retirada de dinheiro</h1>
	<p><strong>Hoje é:</strong> <?php echo date("y/m/d"); ?></p>
	<hr>

	<table width="700" border="1">
		<tr>
			<td># id</td>
			<td>Nome do usuário</td>
			<td>Quantidade</td>
			<td>Pedido</td>
			<td>Status</td>
			<td>Ações</td>
		</tr>

		<?php
			$pdo = new PDO("mysql:dbname=elitefxpro;host=localhost", "root", "");
			$sql = "SELECT users.id, users.name, requests.id, requests.id_user, requests.amount, requests.want, requests.status FROM requests INNER JOIN users ON users.id = requests.id_user WHERE requests.status = 2 ORDER BY requests.id DESC";
			$sql = $pdo->query($sql);
			if ($sql->rowCount() > 0) {
				$dados = $sql->fetchAll();
				foreach($dados as $lista) { 
					echo "
						<tr>
							<td>".$lista['id']."</td>
							<td>".$lista['name']."</td>
							<td>".$lista['amount']."</td>
							";if ($lista['want'] == 1) {
								echo "<td>Retirar</td>";
							} elseif ($lista['want'] == 0) {
								echo "<td>Sacar</td>";
							};"
							";if ($lista['status'] == 2) {
								echo "<td>Em progresso</td>
									 <td><a href='add.php?id=".$lista['id']."' style='color: green;'>Aceitar</a>
									 <a href='refuse.php?id=".$lista['id']."' style='color: red;'>Recusar</a>
									 </td>
								";
							};"		
						</tr>
					";
				}
			}
		?>
	</table>

	<hr>

	<h2>Veja os usuários que aguardam uma verificação sua</h2>
	<p>Verifique os usuários que solicitam login abaixo.</p>

	<table width="800" border="1">
		<tr>
			<td># ID</td>
			<td>Nome do usuário</td>
			<td>E-mail do usuário</td>
			<td>Senha do usuário</td>
			<td>Foto</td>
			<td>Entrou dia</td>
			<td>Ações</td>
		</tr>

		<?php
		$pdo = new PDO("mysql:dbname=elitefxpro;host=localhost", "root", "");
		$sql = "SELECT * FROM users WHERE status = '0'";
		$sql = $pdo->query($sql);
		if ($sql->rowCount() > 0) {
			$dados = $sql->fetchAll();
			foreach ($dados as $usuario) {
				echo "
					<tr>
						<td>".$usuario['id']."</td>
						<td>".$usuario['name']."</td>
						<td>".$usuario['email']."</td>
						<td>".$usuario['password']."</td>
						<td><img src='../user-images/".$usuario['image']."' width='80' height='80'></td>
						<td>".$usuario['date_enter']."</td>
						<td><a style='color: green;' href='aceitar-usuario?email=".$usuario['email']."&id=".$usuario['id']."'>Aceitar</a></td>
					</tr>
				";
			}
		}
		?>
	</table>
</body>
</html>