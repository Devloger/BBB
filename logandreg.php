<?php

	session_start();
	
	if(isset($_SESSION['logged'])) {
		header('Location: index2.php');
		exit();
	}
	
	if(isset($_POST['log'])) {
		
		require_once("config.php");
		
		mysqli_report(MYSQLI_REPORT_STRICT);
		
		try {
			
			$connect = new mysqli($dbip, $dbuser, $dbpass, $db);
			
			if($connect->connect_errno!=0) {
				
				throw new Exception(mysqli_connect_errno());
				echo '<script type="text/javascript">alert("Mamy problem z serwerem, zajrzyj innym razem!")</script>';
				
			}
			else
			{
				$login = $_POST['login'];
				$password = $_POST['password'];
				$login = htmlentities($login, ENT_QUOTES, "UTF-8");
				if(!($names = $connect->query('SET NAMES utf8'))) {
											Throw new Exception($connect-error());
				}
				if($result = $connect->query(sprintf("SELECT * FROM user WHERE email='%s'", mysqli_real_escape_string($connect, $login))))
				{
					if($result->num_rows>0) {
						$data = $result->fetch_assoc();
						if($password==$data['haslo']);
						if(password_verify($password, $data['haslo'])) {
							$_SESSION['logged']=1;
							$_SESSION['id']=$data['id'];
							$_SESSION['email']=$data['email'];
							$_SESSION['imie']=$data['imie'];
							$_SESSION['nazwisko']=$data['nazwisko'];
							$_SESSION['wiek']=$data['wiek'];
							$_SESSION['zainteresowania']=$data['zainteresowania'];
							$_SESSION['rodzenstwo']=$data['rodzenstwo'];
							$_SESSION['zwierzatko']=$data['zwierzatko'];
							$_SESSION['muzyka']=$data['muzyka'];
							$_SESSION['avatar']=$data['avatar'];
							$result->free_result();
							header('Location: index2.php');
							exit();
						}
						else 
						{
						echo '<script type="text/javascript">alert("Zly login lub haslo!")</script>';
						}
					}
					else
					{
						echo '<script type="text/javascript">alert("Zly login lub haslo!")</script>';
					}
				}
				else
				{
				throw new Exception($connect->error);	
				echo '<script type="text/javascript">alert("Mamy problem z serwerem, zajrzyj innym razem!")</script>';
				}
			}
		}
		catch (Exception $e) {
			echo "Mamy problem z serwerem, zajrzyj pozniej!";
			echo "Informacja Deweloperska: ".$e;
		}
	}
	
	if(isset($_POST['register'])) {
		$imie = $_POST['firstname'];
		$nazwisko = $_POST['lastname'];
		$password = $_POST['password'];
		$email = $_POST['email'];
		
		$ok=1;
		$blad="";
		
		if(!(strlen($imie)>3 && strlen($imie)<15)) {
			$ok=0;
			$blad=$blad."Imie jest zbyt krotkie, min 3 znaki max 15\\n";
		}
		if(ctype_alpha($imie)==false) {
			$ok=0;
			$blad=$blad."Imie zawiera niedozwolone znaki\\n";
		}
		if(!(strlen($nazwisko)>3 && strlen($nazwisko)<15)) {
			$ok=0;
			$blad=$blad."Nazwisko jest zbyt krotkie, min 3 znaki max 15\\n";
		}
		if(ctype_alpha($nazwisko)==false) {
			$ok=0;
			$blad=$blad."Nazwisko zawiera niedozwolone znaki\\n";
		}
		$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
		if((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($email!=$emailB))
		{
			$ok=0;
			$blad=$blad."Niepoprawny adres email\\n";
		}
		if(!(strlen($password)>3 && strlen($password)<60)) {
			$ok=0;
			$blad=$blad."Niepoprawna dlugosc hasla. Min 3, max 60\\n";
		}
		if($ok==0) {
			echo '<script type="text/javascript">alert("'.$blad.'")</script>';
		}
		else
		{
			$password=password_hash($password, PASSWORD_BCRYPT);
			require_once("config.php");
			mysqli_report(MYSQLI_REPORT_STRICT);
			try
			{
				$connect = new mysqli($dbip, $dbuser, $dbpass, $db);
				if($connect->connect_errno!=0) {
					Throw new Exception(mysqli_connect_errno());
				}
				else
				{
					if(!($names = $connect->query('SET NAMES utf8'))) {
											Throw new Exception($connect-error());
					}
					if(!($result = $connect->query("SELECT id FROM user WHERE email='$email'")))
					{
						Throw new Exception($connect->error);
						echo '<script type="text/javascript">alert("Mamy problem z serwerem, zajrzyj innym razem!")</script>';
					}
					else
					{
						if($result->num_rows>0) {
							echo '<script type="text/javascript">alert("Podamy adres email juz istnieje!")</script>';
						}
						else
						{
							if(!($connect->query("INSERT INTO user (email, haslo, imie, nazwisko) VALUES ('$email', '$password', '$imie', '$nazwisko')")))
							{
								Throw new Exception($connect->error);
								echo '<script type="text/javascript">alert("Mamy problem z serwerem, zajrzyj innym razem!")</script>';
							}
							else
							{
								echo '<script type="text/javascript">alert("Pomyslnie zalozono konto! Teraz mozesz sie zalogowac!")</script>';
							}
						}
					}
				}
				$connect->close();
			}
			catch (Exception $e)
			{
				echo "Mamy problem z serwerem, zajrzyj pozniej!";
				echo "Informacja deweloperska:".$e;
			}
		}
	}
	
?>