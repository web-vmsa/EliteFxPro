<?php 
	session_start();
	require 'php/funcs.class.php';
	$login = new Users();
	$login->VerifyLogin();
?>
<!DOCTYPE html>
<html>
<head>
	<!-- Primary Meta Tags -->
	<title>EliteFxPro - A Safe Place For Investment</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	
	<!-- Style -->
	<link rel="stylesheet" type="text/css" href="css/style.css">

	<!-- Fonts google -->
	<link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@300&display=swap" rel="stylesheet">

	<!-- Javascript -->
	<script type="text/javascript" src="javascript/script.js"></script>
	<!-- Javascript -->
</head>
<body>	
	<?php
		$id = $_SESSION['id'];
		$user = new Users();
		$newuser = $user->GetUser($id);
	?>
	<!-- Logotipo -->
	<div class="logotipo">
		<img src="images/EliteFxPro.png">
	</div>
	<!-- Logotipo -->

	<!-- Menumobile -->
	<div class="menu-mobile">
		<img src="images/show.png" onclick="abrirmenu();">
	</div>
	<!-- Menumobile -->

	<!-- Item menumobile -->
	<div class="item-menumobile" id="menu">
		<ul>
			<li><a href="user-panel">Home Panel</a></li>
			<li><a href="services">Services</a></li>
			<li><a href="depoiments">Depoiments</a></li>
			<li><a href="deposity"><strong>Deposity</strong></a></li>
			<li><a href="withdraw">Withdraw</a></li>
			<li><a href="logout">Logout</a></li>
		</ul>
	</div>
	<!-- Item menumobile -->

	<!-- Top menu -->
	<div class="menu-other">
		<a id="top" name="top"></a>
		<div class="menu-other-int">
			<a href="user-panel"><div class="item">Home Panel</div></a>
			<a href="services"><div class="item">Services</div></a>
			<a href="depoiments"><div class="item">Depoiments</div></a>
			<a href="deposity"><div class="item active">Deposity</div></a>
			<a href="withdraw"><div class="item">Withdraw</div></a>
			<a href="logout"><div class="item">Logout</div></a>
		</div>
	</div>
	<!-- Top menu -->

	<!-- Title -->
	<div class="title-description">
		<h2>Request deposity</h2>
		<p>Below you are asking the administrator to deposity money, remember: only one request at a time</p>
	</div>
	<!-- Title -->

	<!-- Rules -->
	<div class="rules-deposity background-lightgrey">
		<div class="img-rules"><img src="images/warning.png"></div>
		<h2>READ THE RULES !!!</h2>
		<p><strong>REMEMBER:</strong> below you are just requesting a deposit from the<br>administrator, to actually deposit so that he knows, send the donor to this account:</p>
		<br>
		<r>1qwWbkkL9m4Dok8PDxPVVAYMP2boPeWhQ</r><br><br>
		<img src="images/bitcoin.png">
		<h2>BITCOIN ONLY !!!</h2>
		<p><strong>REMEMBER:</strong> the money you put in the account below, must be placed in the form on<br>this page too, if you put a different money in the form below and deposit another one in the<br>account above, this request will be canceled and the money deposited manually by the<br>administrator. But still try to put the same money here and when depositing.</p>
		<br>
		<r>Good Luck !</r>
	</div>
	<!-- Rules -->

	<?php 
		$id_user = $_SESSION['id'];
		$moenynow = new MoneyUser();
		$result = $moenynow->GetMoney($id_user);
	?>
	<!-- Withdrawal -->
	<div class="solicit-withdraw">
		<div class="left-solicit"><img src="images/money-actual.png"><h3>You have</h3><h2>$ <?php echo $result['has']; ?></h2></div>
		<div class="right-solicit">
			<h2>REQUEST NOW</h2>
			<p>Don't use dots '.' or commas ',' to separate the money, instead of 20,000 type 20000 ! And use dots '.' to separate the decimal places: 20000.05</p>
			<form method="POST">
				<input type="text" name="val" placeholder="Money"><br><br>

				<?php if($newuser['agency'] == NULL) {echo "<p>Fill in your bank branch name and account number on the main panel !</p>";} else {echo "<button type='submit'>REQUEST</button>";} ?>
			</form>
			<?php
				if (isset($_POST['val']) && !empty($_POST['val'])) {
					$amount = addslashes(htmlspecialchars($_POST['val']));

					$novodeposito = new MoneyUser();
					$novodeposito->RequestDeposity($id_user, $amount);
				}
			?>
		</div>
	</div>
	<!-- Withdrawal -->

	<!-- Withdraw History -->
	<div class="table-history">
		<div class="title-description">
			<h2 class="color-white">Deposity history</h2>
			<p class="color-lightgrey">See all of your money deposity requests below</p>
		</div>
		<table class="table">
			<tr>
				<th><img src="images/receive-amount.png" width="60" height="60">Amount</th>
				<th>Withdraw<img src="images/withdraw.png" width="60" height="60"> Deposity<img src="images/receive-amount.png" width="60" height="60"></th>
				<th><img src="images/project.png" width="60" height="60">Status</th>
			</tr>
			<?php
			$id_user = $_SESSION['id'];
			$pdo = new PDO("mysql:dbname=elitefxpro;host=localhost", "root", "");
			$sql = "SELECT * FROM requests WHERE id_user = '$id_user'";
			$sql = $pdo->query($sql);
			if ($sql->rowCount() > 0) {
				$dados = $sql->fetchAll();
				foreach($dados as $lista) { 
					echo "
						<tr>
							<td><img src='images/money.png' width='50' height='50'><r style='color: lightgreen;'>".$lista['amount']."</r></td>
							";if ($lista['want'] == 1) {
								echo "<td style='border-left: 1px solid black; border-right: 1px solid black;'><img title='Withdraw method' src='images/withdraw.png' width='60' height='60'></td>";
							} elseif ($lista['want'] == 0) {
								echo "<td style='border-left: 1px solid black; border-right: 1px solid black;'><img src='images/receive-amount.png' width='60' height='60'></td>";
							};"
							";if ($lista['status'] == 2) {
								echo "<td><img title='In progress' src='images/sand-clock.png' width='60' height='60'></td>
								";
							} elseif ($lista['status'] == 1) {
								echo "<td><img title='Accepted' src='images/cash.png' width='60' height='60'></td>";
							} elseif ($lista['status'] == 0) {
								echo "<td><img title='Refused' src='images/refuse.png' width='60' height='60'></td>";
							};"		
						</tr>
					";
				}
			}
			?>
		</table>
	</div>
	<!-- Withdraw History -->

	<!-- Footer -->
	<div class="footer">
		<div class="top-footer">
			<div class="left">
				<img src="images/copyright.png">
				<div class="top-description"><h5>2020</h5><br><p><strong>Site developed by </strong><em>Victor Miguel</em></p></div>
			</div>
			<div class="right">
				<div class="top-description"><p>Back to the top</p></div>
				<a href="#top"><img src="images/double-up-arrow-angles.png"></a>
			</div>
		</div>
		<div class="middle-footer">
			<a href=""><img src="images/facebook.png"></a>
			<a href=""><img src="images/instagram.png"></a>
			<a href=""><img src="images/linkedin.png"></a>
			<a href=""><img src="images/twitter.png"></a>
		</div>
		<div class="bottom-footer">
			<div class="left">
				<div class="bottom-description"><p>All rights reserved <strong>elitefxpro.com</strong></p></div>
			</div>
			<div class="right">
				<a href="user-panel">Home Panel</a> <r>|</r> 
				<a href="services">Services</a> <r>|</r>
				<a href="depoiments">Depoiments</a> <r>|</r>
				<a href="deposity"><strong>Deposity</strong></a> <r>|</r>
				<a href="withdraw">Withdraw</a> <r>|</r>
				<a href="logout">Logout</a>
			</div>
		</div>
	</div>
	<!-- Footer -->
</body>
</html>