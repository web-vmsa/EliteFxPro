<?php require 'php/funcs.class.php'; ?>
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
			<li><a href="login">Login</a></li>
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
			<a href="login"><div class="item">Login</div></a>
		</div>
	</div>
	<!-- Top menu -->

	<!-- Title register -->
	<div class="title-description">
		<h2>Register now</h2>
		<p>To access our services, register below.</p>
	</div>
	<!-- Title register -->

	<script type="text/javascript">
		function validateregister() {
			var nome = document.getElementById('nome').value;
			var email = document.getElementById('email').value;
			var perfil = document.getElementById('file').value;
			var password = document.getElementById('password').value;

			if (nome.length > 0 & email.length == "" & password.length == "") {
				document.getElementById('errortwo').style.display = 'block';
				document.getElementById('errorfour').style.display = 'block';
				return false;
			}
			if (nome.length > 0 & email.length > 0 & password.length == "") {
				document.getElementById('errorfour').style.display = 'block';
				return false;
			}
			if (nome.length > 0 & email.length == "" & password.length > 0) {
				document.getElementById('errortwo').style.display = 'block';
				return false;
			}
			if (nome.length == "" & email.length > 0  & password.length == "") {
				document.getElementById('errorone').style.display = 'block';
				document.getElementById('errorfour').style.display = 'block';
				return false;
			}
			if (nome.length == "" & email.length > 0  & password.length > 0) {
				document.getElementById('errorone').style.display = 'block';
				return false;
			}
			if (nome.length == "" & email.length == "" & password.length > 0) {
				document.getElementById('errorone').style.display = 'block';
				document.getElementById('errortwo').style.display = 'block';
				return false;
			}
			if (nome.length == "" & email.length == "" & password.length == "") {
				document.getElementById('errorone').style.display = 'block';
				document.getElementById('errortwo').style.display = 'block';
				document.getElementById('errorfour').style.display = 'block';
				return false;
			} 
			<?php
			if (isset($_FILES['perfil']) && !empty($_FILES['perfil'])) {
				$name = addslashes(htmlspecialchars($_POST['nome']));
				$email = addslashes(htmlspecialchars($_POST['email']));
				$password = addslashes($_POST['password']);
				$extensao = strtolower(substr($_FILES['perfil']['name'], -4));
				$image = md5(time()) . $extensao;
				$diretorio = "user-images/";
				$date_enter = date("y/m/d");

				move_uploaded_file($_FILES['perfil']['tmp_name'], $diretorio.$image);

				$usuario = new Users();
				$usuario->Register($name, $email, $image, $password, $date_enter);
				return true;
				}
			?>
		}
	</script>
	<!-- Data form -->
	<div class="form-register">
		<form method="POST" enctype="multipart/form-data">
			<div class="item-register">
				<img src="images/name.png">
				<h3>Name</h3>
				<p>Your real name</p>
				<input id="nome" type="text" name="nome" placeholder="First and second">
				<h4 id="errorone">This field is required !</h4>
			</div>
			<div class="item-register">
				<img src="images/email.png">
				<h3>E-mail</h3>
				<p>Your best e-mail</p>
				<input id="email" type="text" name="email" placeholder="@email">
				<h4 id="errortwo">This field is required !</h4>
			</div>
			<div class="item-register">
				<img src="images/man.png">
				<h3>Image</h3>
				<p>A recent image of you</p>
				<input id="file" type="file" name="perfil">
				<h4 id="errorthree">This field is required !</h4>
			</div>
			<div class="item-register">
				<img src="images/padlock.png">
				<h3>Password</h3>
				<p>Password other than email</p>
				<input id="password" type="password" name="password" placeholder="*****">
				<h4 id="errorfour">This field is required !</h4>
			</div>
			<button type="submit" onclick="return validateregister();">REGISTER</button>
		</form>
	</div>
	<!-- Data form -->

	<!-- About the services -->
	<div class="about-services-register">
		<div class="title-description">
			<h2 class="color-white">Registering now</h2>
			<p class="color-lightgrey">You will have access to our services. See the explanatory video below.</p>
		</div>

		<iframe frameborder="0" src="https://biteable.com/watch/embed/elitefxpro-2564110" allowfullscreen="true" allow="autoplay"></iframe>
			<br><br><br><br>
		<a href="services">SEE ALL SERVICES</a>
	</div>
	<!-- About the services -->

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
				<a href="login">Login</a>
			</div>
		</div>
	</div>
	<!-- Footer -->
</body>
</html>