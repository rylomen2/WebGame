<?php
	class Baza {
		private $mysqli; //uchwyt do BD
		public function __construct($serwer, $user, $pass, $baza) {
			$this->mysqli = new mysqli($serwer, $user, $pass, $baza);
			/* sprawdz po³¹czenie */
			if ($this->mysqli->connect_errno) {
				printf("Nie uda³o sie po³¹czenie z serwerem: %s\n",
				$mysqli->connect_error);
				exit();
			}
			/* zmien kodowanie na utf8 */
			if ($this->mysqli->set_charset("utf8")) {
				//uda³o sie zmieniæ kodowanie
			}
		} //koniec funkcji konstruktora
		function __destruct() {
			$this->mysqli->close();
		}
		public function counter($sql){
			if ($result = $this->mysqli->query($sql))
				return $result->num_rows;
		}
		public function select($sql) {
			return $this->mysqli->query($sql);
		}
		public function bazar(){
			//tutaj trzeba ogarn¹æ zapytanie które modyfikuje dane w tabeli majatek w oparciu o dane z formularza
			if( $_SERVER['REQUEST_METHOD'] == 'POST'){
				$wszystko_OK = true;
				//if( !isset($_POST['bron']) || !isset($_POST['tarcza'])){
					//$wszystko_OK = false;
				//}
				if($wszystko_OK == true){
					$id = $_SESSION['id'];
					$sql = "SELECT * FROM majatek WHERE id_user = '$id'";
					if($rezultat = $this->mysqli->query($sql)){
						$wiersz = $rezultat->fetch_assoc();
					}else{
						echo "NIE UDALO SIE";
					}

					if( $wiersz['id_bron'] != $_POST['bronie'] ){
						$id_broni = $_POST['bronie'];
						//aktualizacja tabeli graczy czyli dodanie surowcow
						$sql = "UPDATE majatek SET id_bron = '$id_broni' WHERE id_user = '$id'";
										
						if(!$rezultat = $this->mysqli->query($sql)){
							echo "NIE UDALO SIE";
						}
					}else{
						$id_bron = $wiersz['id_bron'];
						$rezultat = $this->mysqli->query("SELECT nazwa_broni FROM bronie WHERE id_bron = '$id_bron'");
						$wiersz = $rezultat->fetch_assoc();
						$_SESSION['wiadomosc'] = "Masz juz te bron: " . $wiersz['nazwa_broni'] . "</br>";
					}
					if( $wiersz['id_tarczy'] != $_POST['tarcze']){
						$id_tarczy = $_POST['tarcze'];
						//aktualizacja tabeli graczy czyli dodanie surowcow
						$sql = "UPDATE majatek SET id_tarczy = '$id_tarczy' WHERE id_user = '$id'";
										
						if(!$rezultat = $this->mysqli->query($sql)){
							echo "NIE UDALO SIE";
						}
					}else{
						$id_tarcza = $wiersz['id_tarczy'];
						$rezultat = $this->mysqli->query("SELECT nazwa_tarczy FROM tarcze WHERE id_tarczy = '$id_tarcza'");
						$wiersz = $rezultat->fetch_assoc();
						$_SESSION['wiadomosc'] = "Masz juz te bron: " . $wiersz['nazwa_tarczy'] . "</br>";
					}
						header('Location: bazar.php');
				}else{
					echo "Wybierz bron";
				}
			}
		}
		public function rejestracja() {
			/*if( $this->mysqli->query($sql) ){
				echo "Pomyslnie dodano do bazy : ";
				return true;
			}else{
				echo "Niedodano do bazy : ";
				return false;
			}*/
			//Udana walidacja
			$wszystko_OK = true;
			//Sprawdz poprawnosc nickname'a
			$nick = $_POST['nick'];
			$klasa = $_POST['klasa'];
			
			//Sprawdzenie dlugosci nicka
			if((strlen($nick) < 3)|| (strlen($nick) > 20) ){
				$wszystko_OK = false;
				$_SESSION['e_nick']="Nick musi posiadaæ od 3 do 20 znaków!";
			}
			
			if(ctype_alnum($nick)==false){
				$wszystko_OK = false;
				$_SESSION['e_nick']="Nick mo¿e sk³adaæ sie tylko z liter i cyfr (bez polskich znaków)";
			}
			
			//Sprawdz poprawnoœæ has³a
			$haslo1 = $_POST['haslo1'];
			$haslo2 = $_POST['haslo2'];
			if(((strlen($haslo1) <= 8) || (strlen($haslo1) >= 20))){
				$wszystko_OK = false;
				$_SESSION['e_haslo'] = "Has³o powinno mieæ od 8 do 20 znaków!";
			}
			
			if($haslo1 != $haslo2){
				$wszystko_OK = false;
				$_SESSION['e_haslo'] = "Podane has³a s¹ ró¿ne";
			}
			
			$haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);
			
			//Sprawdzanie poprawnoœci adresu email
			$email = $_POST['email'];
			$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
			
			if((filter_var($emailB, FILTER_VALIDATE_EMAIL) == false) || ($emailB != $email)){
				$wszystko_OK = false;
				$_SESSION['e_email']="Podaj poprawny adres e-mail!";
			}
			
			//Czy zaakceptowano regulamin
			if(!isset($_POST['regulamin'])){
				$wszystko_OK = false;
				$_SESSION['e_regulamin'] = "Zakceptuj reguamin!";
			}
			
			//Jesteœ botem czy nie jesteœ botem????
			$sekret = "6Ld2VyYTAAAAAKP31h7R8u_Ge_TYcvcuhHKcyowH";
			
			$sprawdz = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$sekret.'&response='.$_POST['g-recaptcha-response']);
			$odpowiedz = json_decode($sprawdz);
			
			if($odpowiedz->success == false){
				$wszystko_OK = false;
				$_SESSION['e_bot'] = "PotwierdŸ, ¿e nie jesteœ botem!";
			}
			
			//czy email ju¿ istnieje???
			$rezultat = $this->mysqli->query("SELECT id FROM uzytkownicy WHERE email='$email'");
			
			if(!$rezultat) throw new Exception($polaczenie->error);
			
			$ile_takich_maili = $rezultat->num_rows;
			if($ile_takich_maili > 0){
				$wszystko_OK = false;
				$_SESSION['e_email'] = "Istnieje ju¿ konto przypisane do tego adresu e-mail!";
			}
			
			//Czy nick jest zarezerwowany???
			$rezultat = $this->mysqli->query("SELECT id FROM uzytkownicy WHERE user='$nick'");
			
			if(!$rezultat) throw new Exception($polaczenie->error);
			
			$ile_takich_nickow = $rezultat->num_rows;
			if($ile_takich_nickow > 0){
				$wszystko_OK = false;
				$_SESSION['e_nick'] = "Istnieje ju¿ gracz o takim nicku!";
			}
			
			if($wszystko_OK == true){
				$this->mysqli->query("INSERT INTO uzytkownicy VALUES (null, '$nick', '$haslo_hash', '$email', 14, '$klasa')");
				$_SESSION['udanarejestracja'] = true;
				mkdir("C:/xampp/htdocs/GRA/web/images/$nick");
				header('Location: witamy.php');
			}
		}
		public function zaloguj(){
			$login = $_POST['login'];
			$haslo = $_POST['haslo'];
			
			$login = htmlentities($login, ENT_QUOTES, "UTF-8");
			
			
			if($rezultat = $this->mysqli->query("SELECT * FROM uzytkownicy WHERE user = '$login'"))
				$ilu_userow = $rezultat->num_rows;
			if($ilu_userow > 0){
				$wiersz = $rezultat->fetch_assoc();
			
				if(password_verify($haslo, $wiersz['pass'])){	
					$_SESSION['zalogowany'] = true;
					$_SESSION['id'] = $wiersz['id'];
					$id = $_SESSION['id'];
					$_SESSION['user'] = $wiersz['user'];
					$_SESSION['premium'] = $wiersz['dnipremium'];
					$_SESSION['klasa'] = $wiersz['klasa'];
					
					$rezultat->free_result();
					
					if($rezultat = $this->mysqli->query("SELECT * FROM umiejetnosci WHERE id_user = '$id'"))
						$ilu_userow = $rezultat->num_rows;
					if($ilu_userow > 0){
						$wiersz = $rezultat->fetch_assoc();
						$_SESSION['zycie'] = $wiersz['zycie'];
						$_SESSION['atak'] = $wiersz['atak'];
						$_SESSION['obrona'] = $wiersz['obrona'];
					}else{
						$this->mysqli->query("INSERT INTO umiejetnosci VALUES ('$id', 100, 100, 100)");
						if($rezultat = $this->mysqli->query("SELECT * FROM umiejetnosci WHERE id_user = '$id'"))
							$ilu_userow = $rezultat->num_rows;
						if($ilu_userow > 0){
							$wiersz = $rezultat->fetch_assoc();
							$_SESSION['zycie'] = $wiersz['zycie'];
							$_SESSION['atak'] = $wiersz['atak'];
							$_SESSION['obrona'] = $wiersz['obrona'];
						}
					}
					
					$rezultat->free_result();
					
					if($rezultat = $this->mysqli->query("SELECT * FROM zasoby WHERE id_user = '$id'"))
						$ilu_userow = $rezultat->num_rows;
					if($ilu_userow > 0){
						$wiersz = $rezultat->fetch_assoc();
						$_SESSION['drewno'] = $wiersz['drewno'];
						$_SESSION['kamien'] = $wiersz['kamien'];
						$_SESSION['zboze'] = $wiersz['zboze'];
					}else{
						$this->mysqli->query("INSERT INTO zasoby VALUES ('$id', 100, 100, 100, null, null)");
						if($rezultat = $this->mysqli->query("SELECT * FROM zasoby WHERE id_user = '$id'"))
							$ilu_userow = $rezultat->num_rows;
						if($ilu_userow > 0){
							$wiersz = $rezultat->fetch_assoc();
							$_SESSION['drewno'] = $wiersz['drewno'];
							$_SESSION['kamien'] = $wiersz['kamien'];
							$_SESSION['zboze'] = $wiersz['zboze'];
						}
					}

					unset($_SESSION['blad']);
					$rezultat->free_result();
					header('Location: gra.php');
				}else{
					$_SESSION['blad'] = '<span style="color:red">Nieprawid³owy login lub has³o</span>';
					header('Location: index.php');
				}
			}else{
				$_SESSION['blad'] = '<span style="color:red">Nieprawid³owy login lub has³o</span>';
				header('Location: index.php');
			}
		}
		public function wyprawy(){
			$wszystko_OK = true;
			if( $_SERVER['REQUEST_METHOD'] == 'POST'){
				if( isset($_POST['surowiec']))
					echo $_POST['surowiec']." + 10 </br>";
				if( isset($_POST['surowiec']) ){
					$rodz_surowca = $_POST['surowiec'];
					$il_surowca = $_SESSION[$rodz_surowca] + 10;
				}else{
					$wszystko_OK = false;
				}
				if($wszystko_OK == true){
					$id = $_SESSION['id'];
					$sql = "SELECT * FROM zasoby WHERE id_user = '$id'";
					if($rezultat = $this->mysqli->query($sql)){
						$wiersz = $rezultat->fetch_assoc();
					}else{
						echo "NIE UDALO SIE";
					}
											
					if(  ((( $wiersz['czas_wyprawy'] < date("H:i:s") ) || ( $wiersz['czas_wyprawy'] == null ))&&($wiersz['data_wyruszenia'] == date("Y-m-d"))) || ($wiersz['data_wyruszenia'] < date("Y-m-d")) ){
						$godzina = date("H") + 1;
						$data = $godzina . ":" . date("i:s");
						$data_dokladna = date("Y-m-d");
						//aktualizacja tabeli graczy czyli dodanie surowcow
						$sql = "UPDATE zasoby SET $rodz_surowca = $il_surowca, czas_wyprawy = '$data', data_wyruszenia = '$data_dokladna' WHERE id_user = '$id'";
										
						if(!$rezultat = $this->mysqli->query($sql)){
							echo "NIE UDALO SIE";
						}
					}else{
						$_SESSION['wiadomosc'] = "Nie mozesz podrozowac gdyz jestes na wyprawie, powrot z wyprawy o godzinie: " . $wiersz['czas_wyprawy'] . "</br>";
					}
					//pobranie danych z tabeli aby zaktualizowac je w oknie gry
					$sql = "SELECT * FROM zasoby WHERE id_user = '$id'";
					if($rezultat = $this->mysqli->query($sql)){
						$wiersz = $rezultat->fetch_assoc();
						$_SESSION['drewno'] = $wiersz['drewno'];
						$_SESSION['kamien'] = $wiersz['kamien'];
						$_SESSION['zboze'] = $wiersz['zboze'];
							$_SESSION['premium'] = $wiersz['dnipremium'];
					}else{
						echo "NIE UDALO SIE";
					}
						header('Location: wyprawy.php');
				}else{
					echo "Wybierz surowiec";
				}
			}
		}
		public function delete($sql) {
			if($this->mysqli->query($sql))
				echo "Usunieto rekord z bazy";
			else
				echo "Nieusunieto rekordu z bazy";
		}
	} //koniec klasy Baza
?>