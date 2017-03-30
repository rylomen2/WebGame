<?php
	session_start();
	require_once "connect.php";
	if(isset($_POST['email'])){
		require_once "Bazy.php";
		$uzytkownicy = new Baza($host, $db_user, $db_password, $db_name);
		$uzytkownicy->rejestracja();
	}
	
?>
<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<head>
	<title>Fantasy Game Web Template-Rejestracja</title>
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<meta  charset="utf-8">
	<link href="css/style.css" rel="stylesheet" type="text/css">
	<style>
		.error{
			color: red;
			margin-top: 10px;
			margin-bottom: 10px;
		}
	</style>
</head>
<body>
	<div id="page">
		<div id="header">
			<a id="logo" href="index.html"><img src="images/logo.png" alt=""></a>
			<ul class="navigation">
				<li class="first">
					<a href="index.php">Logowanie</a>
				</li>
				<li>
					<a class="active" href="rejestracja.php">Rejestracja</a>
				</li>
			</ul>
		</div>
		<div id="body">
			<div class="featured"> <img src="images/featured-character.jpg" alt="">
				<div class="section">
					<h2><a href="index.html">Rejestracja</a></h2>
					<p>
						<form method="post">
							<div style="float: left">
								<label style="color:#fbc316;float: left;width: 110px;">Nickname*: </label><input type="text" name="nick"  value="<?php if(!isset($_POST['nick'])){$nick = null;} echo $nick; ?>"/> <br/>
								<?php
									if(isset($_SESSION['e_nick'])){
										echo '<div class="error">'.$_SESSION['e_nick'].'</div>';
										unset($_SESSION['e_nick']);
									}
								?>
								<label style="color:#fbc316;float: left;width: 110px;">Hasło*: </label><input type="password" name="haslo1"  value="<?php if(!isset($_POST['haslo1'])){$haslo1 = null;}  echo $haslo1; ?>"/> <br/>
								<label style="color:#fbc316;float: left;width: 110px;">Powtórz hasło*: </label><input type="password" name="haslo2"  value="<?php if(!isset($_POST['haslo2'])){$haslo2 = null;} echo $haslo2; ?>"/> <br/>
								<?php
									if(isset($_SESSION['e_haslo'])){
										echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
										unset($_SESSION['e_haslo']);
									}
								?>
								<label style="color:#fbc316;float: left;width: 110px;">E-mail*: </label><input type="text" name="email"  value="<?php if(!isset($_POST['email'])){$email = null;} echo $email; ?>"/> <br/><br/>
								<?php
									if(isset($_SESSION['e_email'])){
										echo '<div class="error">'.$_SESSION['e_email'].'</div>';
										unset($_SESSION['e_email']);
									}
								?>
								<label style="color:#fbc316; float: left;width: 110px;"></label><input type="checkbox" name="regulamin"/> Akceptuję regulamin *</label><br/><br/>
								<?php
									if(isset($_SESSION['e_regulamin'])){
										echo '<div class="error">'.$_SESSION['e_regulamin'].'</div>';
										unset($_SESSION['e_regulamin']);
									}
								?>
								<div style="color:#fbc316;">* - wartość obowiązkowa</div>
								<div style="float: left" class="g-recaptcha" data-sitekey="6Ld2VyYTAAAAANiH7OG-p3laTR90g1Umi_b31j3y"></div><br/>
								<?php
									if(isset($_SESSION['e_bot'])){
										echo '<div class="error">'.$_SESSION['e_bot'].'</div>';
										unset($_SESSION['e_bot']);
									}
								?>
							</div>
							<div style="float: left; height: 200px">
								<label><input type="radio" name="klasa" value="wojo" checked><img style='width:128px;height:128px;' src='images/klasy/wojo.jpg' alt='Obrazek' title='Wojo'></label>
								<label><input type="radio" name="klasa" value="smok"><img style='width:128px;height:128px;' src='images/klasy/smok.jpg' alt='Obrazek' title='Other'></label>
								<label><input type="radio" name="klasa" value="other"><img style='width:128px;height:128px;' src='images/klasy/other.jpg' alt='Obrazek' title='Smok'></label></br>
							</div>
							<input style="float: left" class="przycisk" type="submit" value=" ">
							</br></br>
						</form>
					</p>
					<a class="readmore" href="index.php">&nbsp;</a> </div>
				<span>&nbsp;</span> </div>
			<div id="sidebar"> <a class="readmore" href="archives.html">&nbsp;</a>
				<ul class="connect">
					<li>
						Follow Us Here:
					</li>
					<li>
						<a class="twitter" href="http://www.freewebsitetemplates.com/go/twitter/">&nbsp;</a>
					</li>
					<li>
						<a class="facebook" href="http://www.freewebsitetemplates.com/go/facebook/">&nbsp;</a>
					</li>
					<li>
						<a class="googleplus" href="http://freewebsitetemplates.com/go/googleplus/">&nbsp;</a>
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