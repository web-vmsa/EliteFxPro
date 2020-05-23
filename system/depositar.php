<?php
	require 'functions.class.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Solicitar Deposito</title>
	<meta charset="utf-8">
</head>
<body>
	<h1>Depositar dinheiro</h1>
	<p>Preencha os dados abaixo para depositar dinheiro a sua conta.</p>
	<hr>

	<form method="POST">
		<?php 
			$id = 1;
			$balanca = new PainelUser();
			$dinheiro = $balanca->GetMoney($id);
		?>
		<h2>Você tem: <r style="color: green;">$<?php echo $dinheiro['has']; ?></r> na sua conta</h2>

		Quero depositar mais:<br>
		<p style="color: red;">Não use pontos e vírgulas no dinheiro, coloque-os todos os números juntos.</p>
		<br>
		$ <input type="text" name="depositar"><br><br>

		<input type="submit" value="Depositar" style="cursor: pointer;">
	</form>

	<?php
		if (isset($_POST['depositar']) && !empty($_POST['depositar'])) {
			$dinheiro_depositado = addslashes($_POST['depositar']);
			$dinheiro_atual = $dinheiro['has'];
			$dinheiro_somado = $dinheiro_depositado + $dinheiro_atual;
			///

			$deposito_atual = $dinheiro['deposity'];
			$deposito_soma = $deposito_atual + $dinheiro_depositado;

			$deposity = new PainelUser();
			$deposity->Deposity($id, $deposito_soma, $dinheiro_somado);
		}
	?>
</body>
</html>