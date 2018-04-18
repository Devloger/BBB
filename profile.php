<?php
	session_start();
	if(!isset($_SESSION['logged'])){
		header('Location: index.php');
		exit();
	}
	
	if(isset($_POST['submit'])) {
		
		$imie = htmlentities($_POST['imie'],ENT_QUOTES,"UTF-8");
		$nazwisko = htmlentities($_POST['nazwisko'],ENT_QUOTES,"UTF-8");
		$wiek = htmlentities($_POST['wiek'],ENT_QUOTES,"UTF-8");
		$zainteresowania = htmlentities($_POST['zainteresowania'],ENT_QUOTES,"UTF-8");
		$rodzenstwo = htmlentities($_POST['rodzenstwo'],ENT_QUOTES,"UTF-8");
		$zwierzatko = htmlentities($_POST['zwierzatko'],ENT_QUOTES,"UTF-8");
		$muzyka = htmlentities($_POST['muzyka'],ENT_QUOTES,"UTF-8");
		$ok=1;
		$blad="";
		
		if(!(strlen($imie)>3 && strlen($imie)<31)) {
			$ok=0;
			$blad = $blad."Nieprawidlowa dlugosc imienia, od 3 do 30 znakow\\n";
		}
		if(!(ctype_alpha($imie))) {
			$ok=0;
			$blad = $blad."Imie moze skladac sie tylko z samych liter!\\n";
		}
		if(!(strlen($nazwisko)>3 && strlen($nazwisko)<31)) {
			$ok=0;
			$blad = $blad."Nieprawidlowa dlugosc nazwiska, od 3 do 30 znakow\\n";
		}
		if(!(ctype_alpha($nazwisko))) {
			$ok=0;
			$blad = $blad."Nazwisko moze skladac sie tylko z samych liter!\\n";
		}
		if(!($wiek>0 && $wiek<150)) {
			$ok=0;
			$blad = $blad."Niepoprawny wiek!\\n";
		}
		if(!(strlen($zainteresowania)<256)) {
			$ok=0;
			$blad = $blad."Niepoprawna ilosc tekstu ;zainteresowania; Dozwolona ilosc znakow to maks 255\\n";
		}
		if(!(strlen($rodzenstwo)<256)) {
			$ok=0;
			$blad = $blad."Niepoprawna ilosc tekstu ;rodzenstwo; Dozwolona ilosc znakow to maks 255\\n";
		}
		if(!(strlen($zwierzatko)<256)) {
			$ok=0;
			$blad = $blad."Niepoprawna ilosc tekstu ;zwierzatko; Dozwolona ilosc znakow to maks 255\\n";
		}
		if(!(strlen($muzyka)<256)) {
			$ok=0;
			$blad = $blad."Niepoprawna ilosc tekstu ;muzyka; Dozwolona ilosc znakow to maks 255\\n";
		}
		$zainteresowania = preg_replace("/[^0-9a-zA-Zżźćńąśłę€óŻŹĆŃĄŚŁĘ€Ó\p{L}  -]/", "", $zainteresowania);
		$rodzenstwo = preg_replace("/[^0-9a-zA-Zżźćńąśłę€óŻŹĆŃĄŚŁĘ€Ó\p{L}  -]/", "", $rodzenstwo);
		$zwierzatko = preg_replace("/[^0-9a-zA-Zżźćńąśłę€óŻŹĆŃĄŚŁĘ€Ó\p{L}  -]/", "", $zwierzatko);
		$muzyka = preg_replace("/[^0-9a-zA-Zżźćńąśłę€óŻŹĆŃĄŚŁĘ€Ó\p{L}  -]/", "", $muzyka);
		if($ok==0) {
			echo '<script type="text/javascript">alert("'.$blad.'")</script>';
		}
		else
		{
			require_once("config.php");
			mysqli_report(MYSQLI_REPORT_STRICT);
			try
			{
				$connect = new mysqli($dbip,$dbuser,$dbpass,$db);
				if($connect->connect_errno!=0)
				{
					Throw new Exception(mysqli_connect_errno());
				}
				else
				{
					if(!($update = $connect->query('SET NAMES utf8')))
					{
						Throw new Exception($update->erorr);
					}
					if(!($update = $connect->query("UPDATE user SET imie='$imie', nazwisko='$nazwisko', wiek='$wiek', zainteresowania='$zainteresowania', rodzenstwo='$rodzenstwo', zwierzatko='$zwierzatko', muzyka='$muzyka' WHERE id=".$_SESSION['id']))) {
						Throw new Exception($update->error);
					}
					else
					{
						echo '<script type="text/javascript">alert("Pomyslnie zmieniono dane!")</script>';
						$_SESSION['imie']=$imie;
						$_SESSION['nazwisko']=$nazwisko;
					}
				}
				$connect->close();
			}
			catch (Exception $e)
			{
				
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="UTF-8">
		<title>BBB - The Social Network</title>
		<meta name="description" content="Strona społecznościowa.">
		<meta name="keywords" content="BBB, Social, Network, Facebook">
		<meta name="author" content="BBB">
		
		<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
		
		<link rel="stylesheet" href="style.css"  type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&amp;subset=latin-ext" rel="stylesheet">
	</head>
	<body>
		<header>
			<div id="container-top">
				<nav>
					<ul id="top-menu" class="flexbox">
						<li><a href="index2.php">
							<div class="top-menu-icon"><img src="img/logo.png" alt="" width="55px" height="40px"></div>
							<div class="top-menu-text" class="text">Stronga główna</div>
						</a></li>				
						<li><a href="iam.php"><div class="top-menu-text"><?php echo $_SESSION['imie']." ".$_SESSION['nazwisko'];?></div></a></li>
						<li><a href="users.php"><div class="top-menu-text">Użytkownicy</div></a></li>
						<li><a href="messages.php"><div class="top-menu-text">Wiadomosci</div></a></li>
						<li><a href="profile.php"><div class="top-menu-text">Edycja Profilu</div></a></li>
						<li><a href="avatar.php"><div class="top-menu-text">Zmiana Avatara</div></a></li>
						<li><a href="chatbox.php"><div class="top-menu-text">Chatbox</div></a></li>
						<li><a href="logout.php"><div class="top-menu-text">Wyloguj</div></a></li>
					</ul>
				</nav>
			</div>
		</header>
		
		<div id="container">
			<div id="container-center">
				<main>
					<div id="center-page">
						<div class="center-page-post">
							<article><h1>Edycja Profilu</h1>
								Formularz zmiany danych personalnych
								<?php
								try {
									require_once("config.php");
									$connect = new mysqli($dbip, $dbuser, $dbpass, $db);
									if($connect->connect_errno!=0) {
										Throw new Exception(mysqli_connect_errno());
									}
									else
									{
										if(!($names = $connect->query('SET NAMES utf8'))) {
											Throw new Exception($connect->error);
										}
										//$connect->query('SET CHARACTER_SET utf8_unicode_ci');
										//$connect->query("SET collation_connection = utf8_polish_ci");
										if(!($query = $connect->query("SELECT * FROM user WHERE id=".$_SESSION['id']))) {
												Throw new Exception($connect->error);
										}
										else
										{
											$data = $query->fetch_assoc();
											?>
								<form method="post">
									Imie: <input type="text" name="imie" value="<?php echo $data['imie'];?>" /><br />
									Nazwisko: <input type="text" name="nazwisko" value="<?php echo $data['nazwisko'];?>" /><br />
									Wiek: <input type="text" name="wiek" value="<?php echo $data['wiek'];?>" /><br />
									Zainteresowania: <input type="text" name="zainteresowania" value="<?php echo $data['zainteresowania'];?>" /><br />
									Rodzenstwo: <input type="text" name="rodzenstwo" value="<?php echo $data['rodzenstwo'];?>" /><br />
									Zwierzatko: <input type="text" name="zwierzatko" value="<?php echo $data['zwierzatko'];?>" /><br />
									Muzyka: <input type="text" name="muzyka" value="<?php echo $data['muzyka'];?>" /><br />
									<input type="submit" name="submit" value="Zmien moje dane!" /><br />
								</form>
								<?php
										}
									}
									$connect->close();
								}
								catch(Exception $e)
								{
									echo "Mamy problem z serwerem, zajrzyj pozniej!";
									echo "Informacja Deweloperska: ".$e;
								}
								?>
							</article>
						</div>
					</div>
				</main>
			</div>
			
			<footer>
				<div id="container-bottom">
					<nav>
						<ul id="bottom-menu">
							
							<li>&copy;2017 BBB</li>
						</ul>
					</nav>
				</div>
			</footer>
		</div>
	</body>
</html>