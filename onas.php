<?php
require_once("logandreg.php");
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
						<li><a href="index.php">
							<div class="top-menu-icon"><img src="img/logo.png" alt="" width="55px" height="40px"></div>
							<div class="top-menu-text" class="text">Strona główna</div>
						</a></li>				
						<li><a href="onas.php"><div class="top-menu-text">O nas</div></a></li>
						<li><a href="regulamin.php"><div class="top-menu-text">Regulamin</div></a></li>
					</ul>
				</nav>
			</div>
		</header>
			
		<div id="container">
			<div id="container-center">
				<div id="center-welcome">
					<div id="center-welcome-page">
						<h1>BBB</h1>
						
						<p>Team BBB:<br />
						Krystian Bogucki<br />
						Patryk Bogusz<br />
						Bartosz Brosławski<br />
						<br />
						Kontakt: 594029150 (nr. kom.)<br />
						</p>
					</div>
					<div class="front-signin">
						<form class="front-signin-form" action="?action=logowanie" method="post">
							<input class="front-signin-login" type="text" name="login" placeholder="e-mail"><br>
							<input class="front-signin-password" type="password" name="password" placeholder="hasło"><br>
							<input class="front-signin-remember" type="checkbox" name="remember">
							Zapamiętaj mnie!<br>
							<input class="front-signin-submit" type="submit" name="log" value="Zaloguj się">
						</form>
					</div>

					<div class="front-signup">
						<form class="front-signup-form" action="?action=rejestracja" method="post">
							<span>Nie masz konta? Zarejestruj się</span>
							<input class="front-signup-firstname" type="text" name="firstname" placeholder="imię"><br>
							<input class="front-signup-lastname" type="text" name="lastname" placeholder="nazwisko"><br>
							<input class="front-signup-password" type="password" name="password" placeholder="hasło"><br>
							<input class="front-signup-lastname" type="text" name="email" placeholder="e-mail"><br>
							<input class="front-signup-submit" type="submit" name="register" value="Zarejestruj się">
						</form>				
					</div>
					
					<div style="clear: both;"></div>
				</div>
			</div>				
			
			<footer>
				<div id="container-bottom">
					<nav>
						<ul id="bottom-menu">
							<li><a href="onas.php">O nas</a></li>
							<li><a href="regulamin.php">Regulamin</a></li>
							<li>&copy;2017 BBB</li>
						</ul>
					</nav>
				</div>
			</footer>
		</div>
	</body>
</html>