<?php
	session_start();
		if(!isset($_SESSION['zalogowany'])){
			header('Location: index.php');
			exit();
		}			
?>
<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<head>
	<title>Myths of d'roga - Fantasy Game Web Template</title>
	<meta  charset="utf-8">
	<link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div id="page">
		<div id="header">
			<a id="logo" href="index.php"><img src="images/logo.png" alt=""></a>
			<ul class="navigation">
				<li class="first">
					<a href="gra.php">Profil</a>
				</li>
				<li>
					<a href="wyprawy.php">Wyprawy</a>
				</li>
				<li>
					<a href="bazar.php">Bazar</a>
				</li>
				<li>
					<a class="active" href="budynki.php">Budynki</a>
				</li>
				<li>
					<a href="logout.php">Wyloguj</a>
				</li>
			</ul>
		</div>
		<div id="body">
			<div class="content">
				<ul>
					<li>
						<a href="budynki.php"><img src="images/myths-of-droga-character.png" alt=""></a>
						<div style="color: #ffffff;">
							Puste miejsce
						</div>
					</li>
				</ul>
			</div>
		</div>
		<div id="footer">
			<ul>
				<li>
					<a href="about.html" class="video">&nbsp;</a>
					<p>
						This website template has been designed by <a href="http://www.freewebsitetemplates.com/">Free Website Templates</a> for you, for
					</p>
				</li>
				<li>
					<a href="myths.html" class="myths">&nbsp;</a>
					<p>
						This website template has been designed by <a href="http://www.freewebsitetemplates.com/">Free Website Templates</a> for you, for
					</p>
				</li>
				<li class="last">
					<a href="archives.html" class="archives">&nbsp;</a>
					<p>
						This website template has been designed by <a href="http://www.freewebsitetemplates.com/">Free Website Templates</a> for you, for
					</p>
				</li>
			</ul>
			<span>&copy; Copyright &copy; 2032. <a href="index.html">Company name</a> all rights reserved</span> </div>
	</div>
</body>
</html>