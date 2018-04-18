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
							<article><h1>Twoje wiadomosci <?php echo $_SESSION['imie']." ".$_SESSION['nazwisko'];?>:</h1>
							<?php
							require_once("config.php");
							mysqli_report(MYSQLI_REPORT_STRICT);
							try {
								$connect = new mysqli($dbip, $dbuser, $dbpass, $db);
								if($connect->connect_errno!=0){
									Throw new Exception(MYSQLI_CONNECT_ERRNO());
								}
								else
								{
									if(!($names = $connect->query('SET NAMES utf8'))) {
										Throw new Exception($connect-error());
									}
									if(!($query = $connect->query("SELECT * FROM wiadomosci WHERE do=".$_SESSION['id'])))
									{
										Throw new Exception($connect->error);
									}
									else
									{
										if($query->num_rows>0)
										{
											$counter = 1;
											while($data = $query->fetch_assoc())
											{
												echo '<a href="messages2.php?id='.$data['id'].'">'.$counter.'.Tytul Wiadomosci: '.$data['tytul'].' | Wiadomosc od: '.$data['od2'].'</a><br /><br />';
												$counter++;
											}
										}
										else
										{
											echo "Brak wiadomosci.";
										}
									}
								}
								$connect->close();
							}
							catch (Exception $e)
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