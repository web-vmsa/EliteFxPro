<?php require 'functions.class.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Solicitar Retirada</title>
	<meta charset="utf-8">
</head>
<body>
	<h1>Peça ao Adm a retirada de dinheiro</h1>
	<p style="color: red;">Apenas o adm pode autorizar saídas de dinheiro, abaixo você está apenas solicitando a retirada de certa quantidade.</p>

	<form method="POST">
		<h2>Diga ao adm quanto você quer retirar da sua conta.</h2>
		<hr>

		- $ <input type="text" name="amount" style="color: red;"><br><br>

		<input type="submit" value="Solicitar" style="cursor: pointer;">
	</form>
	<?php
		if (isset($_POST['amount']) && !empty($_POST['amount'])) {
			$id_user = 1;
			$amount = addslashes($_POST['amount']);

			$id = 1;
			$balanca = new PainelUser();	
			$dinheiro = $balanca->GetMoney($id);
			$dinheiro_atual = $dinheiro['has'];

			if ($amount > $dinheiro_atual) {
				echo "Você não pode retirar mais do que tem!";
				return false;
			} else {
				$quer = new PainelUser();
				$quer->Solicity($id_user, $amount);
			}
		}
	?>
</body>
</html>