<?php
	session_start();
	if((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true)){
		header('Location: gra.php');
		exit();
	}
?>
<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<head>
	<title>Fantasy Game Web Template-Logowanie</title>
	<meta  charset="utf-8">
	<link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div id="page">
		<div id="header">
			<a id="logo" href="index.html"><img src="images/logo.png" alt=""></a>
			<ul class="navigation">
				<li class="first">
					<a class="active" href="index.php">Logowanie</a>
				</li>
				<li>
					<a href="rejestracja.php">Rejestracja</a>
				</li>
			</ul>
		</div>
		<div id="body">
			<div class="featured"> <img src="images/featured-character.jpg" alt="">
				<div class="section">
					<h2><a href="index.html">Logowanie</a></h2>
					<p>
						<form action="zaloguj.php" method="post">
							<label style="color:#fbc316">Login:</label><input type="text" name="login"/> <br/>
							<label style="color:#fbc316">Hasło:</label><input type="password" name="haslo"/> <br/><br/><br/>
							<input class="readmore" type="submit" value=" ">
						</form>
						<?php
							if(isset($_SESSION['blad'])){
								echo $_SESSION['blad'];
							}
						?>
					</p>
					<!--<a class="readmore" href="index.php">&nbsp;</a> </div>-->
				<span>&nbsp;</span> </div>
			<div id="content">
				<p>
					This website template has been designed by <a href="http://www.freewebsitetemplates.com/">Free Website Templates</a> for you, for free. You can replace all this text with your own text. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismonf.
				</p>
				<p>
					Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt utUt wisi enim ad minim veniam. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum.
				</p>
				<p>
					Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. I me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium
				</p>
			</div>
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