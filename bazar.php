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
					<a class="active" href="bazar.php">Bazar</a>
				</li>
				<li>
					<a href="budynki.php">Budynki</a>
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
						<a href="myths.html"><img src="images/myths-of-droga-character.png" alt=""></a>
						<div style="color:red;">
							Witaj <b> <?php echo $_SESSION['user'] ?></b>!
							<form method='post'>
								<p>Bronie:</p>
								<input type='radio' name='bronie' value='1'><label> Palka</label></br>
								<input type='radio' name='bronie' value='2'><label> Noz</label></br>
								<input type='radio' name='bronie' value='3'><label> Siekiera</label></br>
								<input type='radio' name='bronie' value='4'><label> Maczeta</label></br>
								<input type='radio' name='bronie' value='5'><label> Miecz</label></br>
								<p>tarcze:</p>
								<input type='radio' name='tarcze' value='1'><label> Tarcza z lisci</label></br>
								<input type='radio' name='tarcze' value='2'><label> Tarcza ze skory</label></br>
								<input type='radio' name='tarcze' value='3'><label> Tarcza z drewna</label></br>
								<input type='radio' name='tarcze' value='4'><label> Tarcza z metalu</label></br>
								</br> <?php if(isset($_SESSION['wiadomosc'])){echo '<p style="color:red" >'.$_SESSION['wiadomosc'].'</p>';} ?>
								</br></br><input class="przycisk" type="submit" value=" ">
							</form>
							<?php
								require_once "connect.php";
								require_once "Bazy.php";
								$uzytkownicy = new Baza($host, $db_user, $db_password, $db_name);
								$uzytkownicy->bazar();
							?>
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