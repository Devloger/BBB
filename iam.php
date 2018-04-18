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
							<article><h1>Dane Personalne</h1>
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
											Throw new Exception($connect-error());
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
											Avatar<br />
											<img src="<?php echo $data['avatar']; ?>"/><br />
											Imie: <?php echo $data['imie'];?><br />
											Nazwisko: <?php echo $data['nazwisko'];?> <br />
											Wiek: <?php echo $data['wiek'];?><br />
											Zainteresowania:  <?php echo $data['zainteresowania'];?><br />
											Rodzenstwo:  <?php echo $data['rodzenstwo'];?><br />
											Zwierzatko:  <?php echo $data['zwierzatko'];?><br />
											Muzyka:  <?php echo $data['muzyka'];?><br />
											
											<br />
											<br />
											<a href="profile.php?id=<?php echo $data['id'];?>">Edycja Profilu</a>
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