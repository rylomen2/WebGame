<?php
	session_start();
		if(!isset($_SESSION['zalogowany'])){
			header('Location: index.php');
			exit();
		}
	if(isset($_POST['haslo1'])){
		$old_haslo = $_POST['s_haslo'];
		$haslo1 = $_POST['haslo1'];
		$haslo2 = $_POST['haslo2'];
		$user = $_SESSION['user'];
		$wszystko_OK = true;
		//Sprawdz poprawność hasła
		if(((strlen($haslo1) <= 8) || (strlen($haslo1) >= 20))){
			$wszystko_OK = false;
			$_SESSION['e_haslo'] = "Haslo powinno miec od 8 do 20 znakow!";
		}
		
		if($haslo1 != $haslo2){
			$wszystko_OK = false;
			$_SESSION['e_haslo'] = "Podane hasla są rozne";
		}
		$haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);
		
		$old_haslo_hash = password_hash($old_haslo, PASSWORD_DEFAULT);
		
		require_once "connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);
		try{
			$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
			
			$sql = "SELECT * FROM uzytkownicy WHERE user = '$user'";
			if($rezultat = $polaczenie->query($sql)){
				$wiersz = $rezultat->fetch_assoc();
				$current_pass = $wiersz['pass'];
			}else{
				echo "NIE UDALO SIE";
				throw new Exception($polaczenie->error);
			}
			
			if($polaczenie->connect_errno != 0){
				throw new Exception(mysqli_connect_errno());
			}else{
				if(($wszystko_OK == true) && password_verify($old_haslo, $wiersz['pass'])){
					if($polaczenie->query("UPDATE uzytkownicy SET pass = '$haslo_hash' WHERE user = '$user'")){
						$_SESSION['udanazmianahasla'] = true;
						header('Location: gra.php');
					}else{
						throw new Exception($polaczenie->error);
					}
				}
			}
			$polaczenie->close();
		}
		catch(Exception $e){
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
			echo '<br/><p>Informacja developerska: '.$e;
		}
	}
?>
<!DOCTYPE html>
<head>
	<title>Fantasy Game Web Template</title>
	<meta  charset="utf-8">
	<link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div id="page">
		<div id="header">
			<a id="logo" href="index.php"><img src="images/logo.png" alt=""></a>
			<ul class="navigation">
				<li class="first">
					<a class="active" href="gra.php">Profil</a>
				</li>
				<li>
					<a href="wyprawy.php">Wyprawy</a>
				</li>
				<li>
					<a href="bazar.php">Bazar</a>
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
			<div class="featured"> <img src="images/featured-character.jpg" alt="">
				<div class="section">
					<h2>Witaj <?php echo $_SESSION['user'] ?> !</h2>
					<p>
						<div style='float: left; margin: 10px 25px 15px 15px;'>
							<?php
								$user = $_SESSION['user'];
								echo "<img style='width:128px;height:128px;' src='images/$user/profilowe.jpg' alt='Obrazek'></br>";
							?>
						</div>
						<div style="float: left;color:#fbc316"> 
							<p style="color:#fbc316">Klasa : <?php
								$klasa = $_SESSION['klasa'];
								echo "<img style='width:40px;height:40px;' src='images/klasy/$klasa.jpg' alt='Obrazek'>";
							?></p>
							<h3 style="color:#fbc316">Zasoby</h3>
							<ul>
								<li style="color:#fbc316">Zboze: <?php echo $_SESSION['zboze'] ?></li>
								<li style="color:#fbc316">Drewno: <?php echo $_SESSION['drewno'] ?></li>
								<li style="color:#fbc316">Kamien: <?php echo $_SESSION['kamien'] ?></li>
								<li style="color:#fbc316">HP: <?php echo $_SESSION['zycie'] ?></li>
								<li style="color:#fbc316">Obrona: <?php echo $_SESSION['obrona'] ?></li>
								<li style="color:#fbc316">Atak: <?php echo $_SESSION['atak'] ?></li>
							</ul>
						</div>
					</p>
				</div>
			<div style="float : left" id="sidebar"> <a class="readmore" href="archives.html">&nbsp;</a>
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
			<div style="float: right; color: #ffffff;">
				</br><p>Select avatar</p> 
				<form action="upload.php" method="post" enctype="multipart/form-data" style="float : left">
					</br>Select image to upload:</br>
					<input type="file" name= "fileToUpload" id="filetoUpload"><br/>
					<input type="submit" value="Upload image" name="submit">
				</form>
				<form action="gra.php" method="post" style="float : left">
					<label style="float: left;width: 150px;">Stare Haslo*: </label><input type="password" name="s_haslo"  value="<?php if(!isset($_POST['s_haslo'])){$s_haslo = null;}  echo $s_haslo; ?>"/> <br/>
					<label style="float: left;width: 150px;">Nowe Haslo*: </label><input type="password" name="haslo1"  value="<?php if(!isset($_POST['haslo1'])){$haslo1 = null;}  echo $haslo1; ?>"/> <br/>
					<label style="float: left;width: 150px;">Powtorz nowe haslo*: </label><input type="password" name="haslo2"  value="<?php if(!isset($_POST['haslo2'])){$haslo2 = null;} echo $haslo2; ?>"/> <br/>
					<?php
						if($haslo1 != $haslo2){
							$wszystko_OK = false;
							$_SESSION['e_haslo'] = "Podane hasła są różne";
						}
						if(isset($_SESSION['udanazmianahasla']))
							echo "<p style='color : green'>Haslo zostalo zmienione</p>";
						else
							echo "<p style='color : red'>Cos poszlo nie tak :ccc</p>";
					?>
					<input type="submit" value="update" name="submit">
				</form>
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
			<span>&copy; Copyright &copy; 2032. <a href="index.php">Company name</a> all rights reserved</span> </div>
	</div>
</body>
</html>