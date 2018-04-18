<?php
	session_start();
	if(!isset($_SESSION['logged'])){
		header('Location: index.php');
		exit();
	}
	
	if(isset($_POST['submit'])) {
		if($_FILES['file']['tmp_name']==null)
		{
			header('Location: avatar.php');
			exit();
		}
		$blad = "";
		$target_dir = "av/";
		$ok=1;
		$target_file = $target_dir.rand(1,1000).basename($_FILES['file']['name']);
		$target_type = pathinfo($target_file,PATHINFO_EXTENSION);
		$check = getimagesize($_FILES['file']['tmp_name']);
		if($check === false) {
			$blad="To nie jest plik zdjecie!\\n";
			$ok=0;
		}
		if(file_exists($target_file)) {
			$blad="Istnieje juz zdjecie o takiej nazwie, prosze zmien nazwe pliku.\\n";
			$ok=0;
		}
		if($_FILES['file']['size'] > 500000) {
			$blad="Plik jest zbyt duzy.\\n";
			$ok=0;
		}
		if($target_type != "jpg" && $target_type != "jpeg" && $target_type != "png" && $target_type != "gif") {
			$blad="Nieobslugiwany format pliku.\\n";
			$ok=0;
		}
		if($ok==0) {
			echo '<script type="text/javascript">alert("'.$blad.'")</script>';
		}
		else
		{
			if(move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
				require_once("config.php");
				mysqli_report(MYSQLI_REPORT_STRICT);
				try {
					
					$connect = mysqli_connect($dbip,$dbuser,$dbpass,$db);
					if($connect->connect_errno!=0) {
						Throw new Exception(mysqli_connect_errno());
					}
					else
					{
						$id=$_SESSION['id'];
						if(!($update = $connect->query("UPDATE user SET avatar='$target_file' WHERE id='$id'"))) {
							Throw new Exception($update->error);
						}
						else
						{
							$_SESSION['avatar'] = $target_file;
							echo '<script type="text/javascript">alert("Pomyslnie zmieniono avatar!")</script>';
						}
					}
					$connect->close();
				}
				catch (Exception $e)
				{
					echo '<script type="text/javascript">alert("Nastpil blad po stronie serwera, przepraszamy!")</script>';
				}
			}
			else
			{
				echo '<script type="text/javascript">alert("Podczas uploadu nastapil blad!")</script>';
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
							<article><h1>Zmiana Avatara Użytkownika <?php echo $_SESSION['imie']." ".$_SESSION['nazwisko'];?></h1>
							Obecny avatar: <br />
							<img src="<?php echo $_SESSION['avatar'];?>" /><br />
							<br />
							<br />
							Zmień swój avatar:<br />
							<form method="post" enctype="multipart/form-data">
								Nowy avatar:<input type="file" name="file" accept="image/*" /><br />
								<input type="submit" name="submit" value="Zmien avatar!" /><br />
							</form>
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