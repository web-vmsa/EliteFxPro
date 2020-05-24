<?php 
	session_start();
	require 'php/funcs.class.php';
	if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
		header("Location: user-panel");
	} else {
		# code...
	}
?>
<!DOCTYPE html>
<html>
<head>
	<!-- Primary Meta Tags -->
	<title>EliteFxPro - A Safe Place For Investment</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">

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
	<script type="text/javascript">
		function fechar() {
			document.getElementById('modal').style.display = "none";
		}
	</script>
	<?php
		if (isset($_GET['msg']) && !empty($_GET['msg'])) {
			echo "
				<div id='modal' class='msg-true'>
					<div class='left-msg-true'>
						<img src='images/happy.png'>
					</div>
					<div class='right-msg-true'>
						<h2>Your account has been created successfully!</h2>
						<p>You should now wait about 24 hours for adm to verify your account.</p>
					</div>
					<div class='msg-true-close'>
						<img onclick='fechar();' src='images/close.png'>
					</div>
				</div>
			";
		}
	?>

	<script type="text/javascript">
		function fecharerror() {
			document.getElementById('error-login').style.display = "none";
		}
	</script>
	<?php
		if (isset($_GET['erro']) && !empty($_GET['erro'])) {
			echo "
				<div title='Click this message to close the warning.' onclick='fecharerror();' id='error-login' class='error-login'>
					<div class='left-error-login-img'><img src='images/warning.png'></div>
					<div class='right-error-login-text'>
						<h2><r>Username</r> and <r>password</r> Don't match !</h2>
						<p>Please try another password and email, or if you recently created your account, wait for an approval email.</p>
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
			<li><a href="home">Home</a></li>
			<li><a href="services">Services</a></li>
			<li><a href="depoiments">Depoiments</a></li>
			<li><a href="about">About us</a></li>
			<li><a href="contact">Contact</a></li>
			<li><a href="login"><strong>Login</strong></a></li>
		</ul>
	</div>
	<!-- Item menumobile -->

	<!-- Top menu -->
	<div class="menu-other">
		<a id="top" name="top"></a>
		<div class="menu-other-int">
			<a href="home"><div class="item">Home</div></a>
			<a href="services"><div class="item">Services</div></a>
			<a href="depoiments"><div class="item">Depoiments</div></a>
			<a href="about"><div class="item">About us</div></a>
			<a href="contact"><div class="item">Contact</div></a>
			<a href="login"><div class="item active">Login</div></a>
		</div>
	</div>
	<!-- Top menu -->

	<!-- Login -->
	<div class="login-div">
		<img src="images/login_fundo.png">

		<div class="text-login">
			<h1>ELITEFXPRO.COM, LOGIN</h1>
		</div>

		<div class="text-login-description">
			<h2><strong>DON'T HAVE ACCOUNT?</strong></h2>
		</div>

		<div class="text-login-button">
			<a href="register">Create Account</a>
		</div>

		<script type="text/javascript">
			function validate() {
			var username = document.getElementById('username').value;
			var password = document.getElementById('password').value;

			if (username.length == "" & password.length > 0) {
				document.getElementById('error-username').style.display = 'block';
				return false;
			}
			if (password.length == "" & username.length > 0) {
				document.getElementById('error-password').style.display = 'block';
				return false;
			}
			if (username.length == "" & password.length == "") {
				document.getElementById('error-username').style.display = 'block';
				document.getElementById('error-password').style.display = 'block';
				return false
			} else {
				<?php
					if (isset($_POST['email']) && !empty($_POST['email'])) {
						$email = addslashes($_POST['email']);
						$password = addslashes($_POST['password']);

						$newlogin = new Users();
						$newlogin->Login($email, $password);
					}
				?>
			}
		}
		</script>
		<div class="form-login">
			<form method="POST">
				<h3>Login</h3>
				<p>Login in the panel user.</p>
				<hr style="border-color: white; width: 300px; margin: auto; margin-top: 20px; margin-bottom: 20px;">
				<input id="username" type="text" name="email" placeholder="@email"><br>
					<r id="error-username">This field is required !</r>
				<br>

				<input id="password" type="password" name="password" placeholder="*password"><br>
					<r id="error-password">This field is required !</r>
				<br>

				<button type="submit" onclick="return validate();">ACCESS</button>
				<hr style="border-color: white; width: 300px; margin: auto; margin-top: 20px; margin-bottom: 7px;">
				<a href="">forgot your password ?</a>
			</form>
		</div>
	</div>
	<!-- Login -->

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
				<a href="home">Home</a> <r>|</r> 
				<a href="services">Services</a> <r>|</r>
				<a href="depoiments">Depoiments</a> <r>|</r>
				<a href="about">About us</a> <r>|</r>
				<a href="contact">Contact</a> <r>|</r>
				<a href="login"><strong>Login</strong></a>
			</div>
		</div>
	</div>
	<!-- Footer -->
</body>
</html>