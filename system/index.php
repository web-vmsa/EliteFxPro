<?php require 'functions.class.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Painel do Usuário</title>
	<meta charset="utf-8">
</head>
<body>
	<?php
		$id = 1;
		$usuario = new PainelUser();
		$dados = $usuario->GetUser($id);
	?>
	<h1>Painel do <?php echo $dados['name']; ?></h1>

	<img src="../images/<?php echo $dados['image']; ?>" width="150" height="150">

	<p><strong>E-mail:</strong> <?php echo $dados['email']; ?></p>

	<p><strong>Senha:</strong> <?php echo $dados['password']; ?></p>

	<p><strong>Entrou:</strong> <?php echo $dados['date_enter']; ?></p>
	<hr>
	<h2><?php echo $dados['name']; ?> tem na balança:</h2>

	<?php 
		$balanca = new PainelUser();
		$dinheiro = $balanca->GetMoney($id);
	?>
	<h3 style="color: green;">$ <?php echo $dinheiro['has']; ?></h3>

	<a href="retirar.php" style="color: blue; text-decoration: none;">[SACAR DINHEIRO]</a>

	<hr>
	<h2><?php echo $dados['name']; ?> já retirou um total de:</h2>

	<h3 style="color: red;">$ <?php echo $dinheiro['withdraw']; ?></h3>	

	<hr>
	<h2><?php echo $dados['name']; ?> já depositou um total de:</h2>

	<h3 style="color: yellow;">$ <?php echo $dinheiro['deposity']; ?></h3>

	<a href="depositar.php" style="color: blue; text-decoration: none;">[DEPOSITAR DINHEIRO]</a>	
</body>
</html>