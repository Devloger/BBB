<?php
	session_start();
	if(!isset($_SESSION['logged'])){
		header('Location: index.php');
		exit();
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
							<article><h1>Witamy w serwisie BBB! <?php echo $_SESSION['imie']." ".$_SESSION['nazwisko'];?></h1>
							<h2>Świeże newsy ze świata:</h2>
							Krystyna Janda apeluje o gorące przywitanie Donalda Tuska w Warszawie, dziennikarz TVP Cezary Gmyz organizuje kontrwydarzenie, KOD "bije się" o kawałek chodnika z inną organizacją, a posłanka PiS Krystyna Pawłowicz apeluje o zabieranie "niemieckich flag". Czy 19 kwietnia w centrum Warszawy dojdzie do awantur i co myśli o tym wszystkim sam Donald Tusk?
							<br />
							<br />
							Owsiak nie wytrzymał, ostro krytykuje prezydenta Dudę: Nie jest Pan „ludzkim panem”
Jerzy Owsiak ma żal do prezydenta Andrzeja Dudy za podpisanie ustawy o tzw. sieci szpitali. "Nie znam Pańskich rodziców, nie wiem, jak Pana wychowywali. Jednak także ich los był w Pana rękach" - pisze rozgoryczony.
							<br />
							<br />
							Dawno tak źle nie było - rozkład jazdy polskich napastników
Szykuje się jeden z najsłabszych weekendów dla polskich napastników. Robert Lewandowski nie dość, że jest kontuzjowany, to i zawieszony za kartki. Sytuacja z pozostałymi graczami przednich formacji również nie wygląda zbyt dobrze. <br />
								<!--<applet archive="snake.jar" code="start.class" width=400 height=200></applet>-->
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