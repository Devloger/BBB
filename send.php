<?php
	session_start();
	if(!isset($_SESSION['logged'])){
		header('Location: index.php');
		exit();
	}
	
	if(isset($_POST['submit'])) {
		
		$title = htmlentities($_POST['title'],ENT_QUOTES,"UTF-8");
		$text = htmlentities($_POST['text'],ENT_QUOTES,"UTF-8");
		$me = $_SESSION['id'];
		if((!isset($_GET['id'])) || $_GET['id']==null || ctype_digit($_GET['id'])==false) {
			header('Location: index2.php');
			exit();
		}
		$ok=1;
		$blad="";
		
		if(!(strlen($title)>0 && strlen($title)<51)) {
			$ok=0;
			$blad = $blad."Nieprawidlowa dlugosc tytulu, od 1 do 50 znakow\\n";
		}
		if(!(strlen($text)>0 && strlen($text)<501)) {
			$ok=0;
			$blad = $blad."Nieprawidlowa dlugosc tresci, od 1 do 500 znakow\\n";
		}
		$title = preg_replace("/[^0-9a-zA-Zżźćńąśłę€óŻŹĆŃĄŚŁĘ€Ó\p{L}?!@  -]/", "", $title);
		$text = preg_replace("/[^0-9a-zA-Zżźćńąśłę€óŻŹĆŃĄŚŁĘ€Ó\p{L}?!@  -]/", "", $text);
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
					if(!($query = $connect->query("SELECT * FROM user WHERE id=".$_GET['id']))) {
						Throw new Exception($connect->error);
					}
					else
					{
					$data = $query->fetch_assoc();
					if(!($update = $connect->query('INSERT INTO wiadomosci (od, do, tytul, tresc, od2, do2, data) VALUES ("'.$me.'", "'.$data['id'].'", "'.$title.'", "'.$text.'", "'.$_SESSION['imie'].' '.$_SESSION['nazwisko'].'", "'.$data['imie'].' '.$data['nazwisko'].'", now())'))) {
						Throw new Exception($update->error);
					}
					else
					{
						echo '<script type="text/javascript">alert("Pomyslnie wyslano wiadomosc!")</script>';
					}
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
							<article><h1>Wysylanie Wiadomosci</h1>
							<?php
							if((!isset($_GET['id'])) || $_GET['id']==null || ctype_digit($_GET['id'])==false) {
									header('Location: index2.php');
									exit();
							}
								try {
									require_once("config.php");
									$connect = new mysqli($dbip, $dbuser, $dbpass, $db);
									if($connect->connect_errno!=0) {
										Throw new Exception(mysqli_connect_errno());
									}
									else
									{
										if(!($names = $connect->query('SET NAMES utf8'))) {
											Throw new Exception($connect-error());
										}
										//$connect->query('SET CHARACTER_SET utf8_unicode_ci');
										//$connect->query("SET collation_connection = utf8_polish_ci");
										if(!($query = $connect->query("SELECT * FROM user WHERE id=".$_GET['id']))) {
												Throw new Exception($connect->error);
										}
										else
										{
											$data = $query->fetch_assoc();
										?>
								Napisz wiadomosc do uzytkownika <?php echo $data['imie']." ".$data['nazwisko'];?>
								<form method="post">
									Tytul: <input type="text" name="title" /><br />
									Tresc: <input type="text" name="text" /><br />
									<input type="submit" name="submit" value="Wyslij wiadomosc!" /><br />
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