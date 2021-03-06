<?php 
	session_start();
	require 'php/funcs.class.php';
	$login = new Users();
	$login->VerifyLogin();

	$verifyadm = new Adm();
	$verifyadm->VerifyAdm();

	error_reporting(0);
	ini_set(“display_errors”, 0 );
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
	<script type="text/javascript">
		function fecharerror() {
			document.getElementById('error-login').style.display = "none";
		}
	</script>
	<?php 
		if (isset($_GET['accept']) && !empty($_GET['accept'])) {
			echo "
				<div title='Click this message to close the warning.' onclick='fecharerror();' id='error-login' class='error-login'>
					<div class='left-error-login-img background-dark-green'><img src='images/accept.png'></div>
					<div class='right-error-login-text background-dark-green'>
						<h2><r>REQUEST ACCEPTED !</r></h2>
						<p style='color: lightgrey;'>You have successfully accepted a user.</p>
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

	<!-- Table users -->
	<div class="table-user">
		<img src="images/add.png">
		<div class="title-description">
			<h2>New users</h2>
			<p>Accept new users to your platform now</p>
		</div>
	</div>
	<!-- Table users -->

	<!-- Fake table -->
	<div class="fake-table">
		<table>
			<tr>
				<th><img src="images/name.png"></th>
				<th><img src="images/email.png"></th>
				<th><img src="images/padlock.png"></th>
				<th><img src="images/man.png"></th>
				<th><img src="images/interactive.png"></th>
			</tr>
			<?php
				$allnewusers = new Adm();
				$selectallnewusers = $allnewusers->SelectAllNewUsers();
				foreach($selectallnewusers as $datausers):
			?>
			<tr>
				<td><?php echo $datausers['name']; ?></td>
				<td><?php echo $datausers['email']; ?></td>
				<td><?php echo $datausers['password']; ?></td>
				<td><img src="user-images/<?php echo $datausers['image']; ?>"></td>
				<td><a style="color: green; text-decoration: none;" href="accept-user?email=<?php echo $datausers['email']; ?>&id=<?php echo $datausers['id']; ?>">Accept</a></td>
			</tr>
			<?php endforeach; ?>
		</table>
	</div>
	<!-- Fake table -->

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