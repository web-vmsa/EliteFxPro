<?php 
	session_start();
	require 'php/funcs.class.php';
	$login = new Users();
	$login->VerifyLogin();

	$verifyadm = new Adm();
	$verifyadm->VerifyAdm();
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
			<li><a href="adm-panel"><strong>Adm Panel</strong></a></li>
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
			<a href="user-panel"><div class="item">Home Panel</div></a>
			<a href="adm-panel"><div class="item active">Adm Panel</div></a>
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
		<h2>WELCOME BACK TO THE ADM PANEL <r style="color: #d45812; text-transform: uppercase;"><?php echo $newuser['name']; ?></r></h2>
		<p>See here your notifications</p>
	</div>
	<!-- Welcome -->

	<!-- New users to accepted -->
	<div class="new-users">
		<img src="images/add.png">
		<div class="new-count">
			<h4><?php
				$contagem = new Adm();
				$resultado = $contagem->CountNewUsers();
			?></h4>
		</div>
		<div class="title-description">
			<h2>New users</h2>
			<p>Hope you accept them</p>
		</div>
		<div class="link-add-user">
			<a href="new-users">Accept new users</a>
		</div>
	</div>
	<!-- New users to accepted -->

	<!-- New requests to accepted -->
	<div class="new-users background-dark-orange">
		<img src="images/transaction.png">
		<div class="new-count green">
			<h4><?php 
				$count = new Adm();
				$resul = $count->CountNewRequests();
			?></h4>
		</div>
		<div class="title-description">
			<h2 class="color-white">New requests</h2>
			<p class="color-lightgrey">Users are requesting</p>
		</div>
		<div class="link-add-user">
			<a href="verify-requests" style="background-color: darkgreen;">Check requests</a>
		</div>
	</div>
	<!-- New requests to accepted -->

	<!-- Update profit of uses -->
	<div class="new-users background-dark-green">
		<img src="images/data.png">
		<div class="new-count" style="background-color: firebrick;">
			<h4><?php 
				$counts = new Adm();
				$results = $counts->CountUsers();
			?></h4>
		</div>
		<div class="title-description">
			<h2 class="color-white">Update Profit</h2>
			<p class="color-lightgrey">Update your users' earnings above</p>
		</div>
		<div class="link-add-user">
			<a href="users-profit" style="background-color: firebrick;">Update Profit</a>
		</div>
	</div>
	<!-- Update profit -->

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
				<a href="adm-panel"><strong>Adm Panel</strong></a> <r>|</r>
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