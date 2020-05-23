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
	<meta name="title" content="EliteFxPro - A Safe Place For Investment">
	<meta name="description" content="In our environment, you have access to updated market data, and you can invest in us to invest for you. Make your money pay.">

	<!-- Favicons -->
	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
	<link rel="icon" href="images/favicon.ico" type="image/x-icon">
	
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
	<script type="text/javascript">
		function fecharerror() {
			document.getElementById('error-login').style.display = "none";
		}
	</script>
	<?php 
		if (isset($_GET['condition']) && !empty($_GET['condition'])) {
			echo "
				<div title='Click this message to close the warning.' onclick='fecharerror();' id='error-login' class='error-login'>
					<div class='left-error-login-img background-dark-green'><img src='images/check.png'></div>
					<div class='right-error-login-text background-dark-green'>
						<h2>Your data has been <r>successfully</r> displayed!</h2>
						<p>Your name, email, password and bank account data and name have been updated successfully ! Thank you for continuing to use our site.</p>
					</div>
				</div>
			";
		}
	?>

	<?php
		if (isset($_GET['edraw']) && !empty($_GET['edraw'])) {
			echo "
				<div title='Click this message to close the warning.' onclick='fecharerror();' id='error-login' class='error-login'>
					<div class='left-error-login-img'><img src='images/warning.png'></div>
					<div class='right-error-login-text'>
						<h2><r>MISTAKE</r> !</h2>
						<p style='color: white;'>There is already a request in progress. Wait for it to finish before proceeding with more actions on the user panel !</p>
					</div>
				</div>
			";
		}
	?>

	<?php 
		if (isset($_GET['request']) && !empty($_GET['request'])) {
			echo "
				<div title='Click this message to close the warning.' onclick='fecharerror();' id='error-login' class='error-login'>
					<div class='left-error-login-img background-dark-green'><img src='images/review.png'></div>
					<div class='right-error-login-text background-dark-green'>
						<h2><r>REQUEST SUCCESSFULLY!</r></h2>
						<p style='color: lightgrey;'>We are verifying your withdrawal request, we are currently analyzing it and soon you will get a return! We may send you a confirmation email.</p>
					</div>
				</div>
			";
		}
	?>

	<?php 
		if (isset($_GET['deposity']) && !empty($_GET['deposity'])) {
			echo "
				<div title='Click this message to close the warning.' onclick='fecharerror();' id='error-login' class='error-login'>
					<div class='left-error-login-img background-dark-green'><img src='images/review.png'></div>
					<div class='right-error-login-text background-dark-green'>
						<h2><r>REQUEST SUCCESSFULLY!</r></h2>
						<p style='color: lightgrey;'>We are verifying your deposity request, we are currently analyzing it and soon you will get a return! We may send you a confirmation email.</p>
					</div>
				</div>
			";
		}
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
			<li><a href="user-panel"><strong>Home Panel</strong></a></li>
			<li><?php if($_SESSION['id'] == 2) {echo "<a href='adm-panel'>Adm Panel</a>";} else {echo "<a href='services'>Services</a>";} ?></li>
			<li><a href="depoiments">Depoiments</a></li>
			<li><a href="deposity">Deposity</a></li>
			<li><a href="withdraw">Withdraw</a></li>
			<li><a href="logout">Logout</a></li>
		</ul>
	</div>
	<!-- Item menumobile -->

	<!-- Top menu -->
	<div class="menu-other">
		<a id="top" name="top"></a>
		<div class="menu-other-int">
			<a href="user-panel"><div class="item active">Home Panel</div></a>
			<?php if($_SESSION['id'] == 2) {echo "<a href='adm-panel'><div class='item'>Adm Panel</div></a>";} else {echo "<a href='services'><div class='item'>Services</div></a>";} ?>
			<a href="depoiments"><div class="item">Depoiments</div></a>
			<a href="deposity"><div class="item">Deposity</div></a>
			<a href="withdraw"><div class="item">Withdraw</div></a>
			<a href="logout"><div class="item">Logout</div></a>
		</div>
	</div>
	<!-- Top menu -->

	<!-- Welcome -->
	<div class="welcome-panel">
		<img src="user-images/<?php echo $newuser['image']; ?>">
		<h2>WELCOME BACK TO THE PANEL <r style="color: #d45812; text-transform: uppercase;"><?php echo $newuser['name']; ?></r></h2>
		<p>We missed you =)</p>
		<form method="POST" enctype="multipart/form-data">
			<r>Upload a new Foto</r><br>
			<input type="file" name="perfil"><br>
			<input type="submit" value="UPDATE">
		</form>
		<?php
		if (isset($_FILES['perfil']) && !empty($_FILES['perfil'])) {
				$extensao = strtolower(substr($_FILES['perfil']['name'], -4));
				$image = md5(time()) . $extensao;
				$diretorio = "user-images/";

				move_uploaded_file($_FILES['perfil']['tmp_name'], $diretorio.$image);

				$updatimahe = new Users();
				$updatimahe->UpdateImage($id, $image);
				}
		?>
	</div>
	<!-- Welcome -->

	<!-- Title -->
	<div class="title-description background-dark-orange">
		<h2 class="color-white">View or Update your data</h2>
		<p class="color-lightgrey">Your details are here, update them if you want below</p>
	</div>
	<!-- Title -->

	<!-- My Data -->
	<div class="data-user">
		<form method="POST">
			Update <strong>Bank account number</strong><br>
			<input type="text" name="account" value="<?php echo $newuser['account']; ?>"><br><br>

			Update <strong>Bank agency name</strong><br>
			<input type="text" name="agency" value="<?php echo $newuser['agency']; ?>"><br><br>

			Update your <strong>name</strong><br>
			<input type="text" name="nome" value="<?php echo $newuser['name']; ?>"><br><br>

			Update your <strong>email</strong><br>
			<input type="text" name="email" value="<?php echo $newuser['email']; ?>"><br><br>

			Update your <strong>password</strong><br>
			<input type="text" name="senha" value="<?php echo $newuser['password']; ?>"><br><br>

			<button type="submit">UPDATE</button>
		</form>
		<?php
			if (isset($_POST['senha']) && !empty($_POST['senha'])) {
				$account = addslashes($_POST['account']);
				$agency = addslashes($_POST['agency']);
				$name = addslashes(htmlspecialchars($_POST['nome']));
				$email = addslashes(htmlspecialchars($_POST['email']));
				$password = addslashes($_POST['senha']);

				$updateuser = new Users();
				$updateuser->Update($id, $name, $email, $account, $agency, $password);
				}
			?>
	</div>
	<!-- My Data -->

	<!-- Market -->
	<div class="market-place">
		<div class="title-description">
			<h2 class="color-white">How is the market</h2>
			<p class="color-lightgrey">See the market details for now</p>
		</div>
		<div class="leftside-market-place">
			<!-- TradingView Widget BEGIN -->
			<div class="tradingview-widget-container">
			  <div id="tradingview_dd089"></div>
			  <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/symbols/NASDAQ-AAPL/" rel="noopener" target="_blank"><span class="blue-text">AAPL Chart</span></a> by TradingView</div>
			  <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
			  <script type="text/javascript">
			  new TradingView.widget(
			  {
			  "width": 1200,
			  "height": 560,
			  "symbol": "NASDAQ:AAPL",
			  "interval": "D",
			  "timezone": "Etc/UTC",
			  "theme": "light",
			  "style": "1",
			  "locale": "en",
			  "toolbar_bg": "#f1f3f6",
			  "enable_publishing": true,
			  "withdateranges": true,
			  "hide_side_toolbar": false,
			  "allow_symbol_change": true,
			  "details": true,
			  "hotlist": true,
			  "calendar": true,
			  "news": [
			    "stocktwits",
			    "headlines"
			  ],
			  "container_id": "tradingview_dd089"
			}
			  );
			  </script>
			</div>
			<!-- TradingView Widget END -->
		</div>
	</div>
	<!-- Market -->

	<!-- Top cryptocurrencies -->
	<div class="money-cripto">
		<div class="title-description">
			<h2>Top cryptocurrencies</h2>
			<p>See the main digital currencies on the market</p>
		</div>
		<iframe src="https://br.widgets.investing.com/top-cryptocurrencies?theme=lightTheme" frameborder="0" allowtransparency="true" marginwidth="0" marginheight="0"></iframe><div class="poweredBy" style="font-family: Arial, Helvetica, sans-serif;">Desenvolvido por <a href="https://br.investing.com?utm_source=WMT&amp;utm_medium=referral&amp;utm_campaign=TOP_CRYPTOCURRENCIES&amp;utm_content=Footer%20Link" target="_blank" rel="nofollow">Investing.com</a></div>
	</div>
	<!-- Top cryptocurrencies -->

	<!-- Currency quotes -->
	<div class="money-cripto background-dark-green">
		<div class="title-description">
			<h2 class="color-white">Currency quotes</h2>
			<p class="color-lightgrey">See currency quotes in real time</p>
		</div>
		<iframe src="https://br.widgets.investing.com/live-currency-cross-rates?theme=darkTheme&roundedCorners=true&pairs=1,3,2,4,7,5,8,6,9,10,49,11,13,16,47,51,58,50" frameborder="0" allowtransparency="true" marginwidth="0" marginheight="0"></iframe><div class="poweredBy" style="font-family: Arial, Helvetica, sans-serif;">Desenvolvido por <a href="https://br.investing.com?utm_source=WMT&amp;utm_medium=referral&amp;utm_campaign=LIVE_CURRENCY_X_RATES&amp;utm_content=Footer%20Link" target="_blank" rel="nofollow">Investing.com</a></div>
	</div>
	<!-- Currency quotes -->

	<?php
		$id_user = $_SESSION['id'];

		$pegaessesdados = new MoneyUser();
		$dadosmoney = $pegaessesdados->GetMoney($id_user);
	?>
	<!-- Top cryptocurrencies -->
	<div class="money-cripto">
		<div class="title-description">
			<h2>Your money here</h2>
			<p>This is your current money</p>
		</div>
		<img src="images/money-actual.png">
		<h3>$ <?php echo $dadosmoney['has']; ?></h3>
		<a href="withdraw">
			<div class="left-money-withdraw">
				<h4>WITHDRAW</h4>
			</div>
		</a>
		<a href="deposity">
			<div class="right-money-deposity">
				<h4>DEPOSITY</h4>
			</div>
		</a>
	</div>
	<!-- Top cryptocurrencies -->

	<!-- History -->
	<div class="history-all background-dark-orange">
		<div class="title-description">
			<h2 class="color-white">Your history here</h2>
			<p class="color-lightgrey">This is your history in website</p>
		</div>
		<div class="img-history">
			<img src="images/research.png">
		</div>
		<div class="total-withdraw"><h4>Total withdraw</h4></div>
		<div class="total-deposity"><h4>Total deposity</h4></div>
		<div class="total-withdraw remove-bg color-firebrick"><h4>$ <?php echo $dadosmoney['withdraw']; ?></h4></div>
		<div class="total-deposity remove-bg color-midnightblue"><h4>$ <?php echo $dadosmoney['deposity']; ?></h4></div>
	</div>
	<!-- History -->

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
				<a href="user-panel"><strong>Home Panel</strong></a> <r>|</r> 
				<?php if($_SESSION['id'] == 2) {echo "<a href='adm-panel'>Adm Panel</a>";} else {echo "<a href='services'>Services</a>";} ?> <r>|</r>
				<a href="depoiments">Depoiments</a> <r>|</r>
				<a href="deposity">Deposity</a> <r>|</r>
				<a href="withdraw">Withdraw</a> <r>|</r>
				<a href="logout">Logout</a>
			</div>
		</div>
	</div>
	<!-- Footer -->
</body>
</html>