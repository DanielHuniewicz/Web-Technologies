<?php
	session_start();	

	if(isset($_POST['mail']))
	{
		$validation_successful = true;
		$user_name = $_POST['user_name'];
		$mail = $_POST['mail'];
		$mail_clear = filter_var($mail, FILTER_SANITIZE_EMAIL);
		$password = $_POST['password'];
		$password2 = $_POST['password2'];
		$password_hash = password_hash($password, PASSWORD_DEFAULT);

		$secret_key = "6LeH4eUUAAAAAOpD_H6dLEziA-uB1N5Xy-nILNHA";
		$check_key = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='
		.$secret_key.'&response='.$_POST['g-recaptcha-response']);
		$reply = json_decode($check_key);

		//walidacja dlugosci nazwy uzytkownika
		if ((strlen($user_name)<3) || (strlen($user_name)>15))
		{
			$validation_successful = false;
			$_SESSION['error_username']="Nazwa uzytkownika powinna posiadac od 3 do 15 znaków";
		}

		//walidacja alfanumeryczna nazwy uzytkownika
		if (ctype_alnum($user_name)==false)
		{
			$validation_successful = false;
			$_SESSION['error_username']="Niedozwolone znaki w nazwie użytkownika";
		}

		//walidacja poprawnosci znakow w emailu
		if((filter_var($mail_clear,FILTER_VALIDATE_EMAIL) == false) || ($mail_clear != $mail))
		{
			$validation_successful = false;
			$_SESSION['error_mail']="Niepoprawny adres e-mail";
		}

		//walidacja dlugosci hasła użytkownika
		if ((strlen($password)<8) || (strlen($password)>20))
		{
			$validation_successful = false;
			$_SESSION['error_password']="Hasło użytkownika powinno posiadac od 8 do 20 znaków";
		}

		//walidacja jednosci hasel
		if ($password != $password2)
		{
			$validation_successful = false;
			$_SESSION['error_password']="Podane hasła nie są identyczne";
		}
		
		//walidacja chceckboxa
		if (!isset($_POST['regulations']))
		{
			$validation_successful = false;
			$_SESSION['error_regulations']="Zaakceptuj regulamin";
		}
		
		//walidacja captchy
		if($reply -> success ==false)
		{
			$validation_successful = false;
			$_SESSION['error_captcha']="Potwierdz captche";
		}

		require_once "db_connect.php";

		try
		{
			$connection = new mysqli($host, $db_user, $db_password, $db_name);
			if ($connection->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{
				$result_mail = $connection->query("SELECT id FROM users WHERE mail='$mail'");
				if(!$result_mail) throw new Exception ($connection -> error);

				$result_username = $connection->query("SELECT id FROM users WHERE name='$user_name'");
				if(!$result_username) throw new Exception ($connection -> error);
				
				$num_mail = $result_mail->num_rows;
				if($num_mail>0)
				{
					$validation_successful = false;
					$_SESSION['error_mail']="Do podanego adresu e-mail przypisano już konto";
				}

				$num_username = $result_username->num_rows;
				if($num_username>0)
				{
					$validation_successful = false;
					$_SESSION['error_username']="Istnieje już taka nazwa użytkownika";
				}
			}
		}

		catch(Exception $error_server)
		{
			echo 'Błąd serwera'.$error_server;
		}

		if($validation_successful == true)
		{
			if($connection->query("INSERT INTO users VALUES (NULL,'$user_name','$password_hash','$mail',100,0,15)"))
			{
				$_SESSION['complete']=true;
				header('Location: welcome.php');
			}
			else
			{
				throw new Exception($connection->error);
			}
		}
	}
?>

<!doctype html>
<html lang="pl">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Rejestracja użytkownika</title>

		<script src="https://www.google.com/recaptcha/api.js" async defer></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>    
 		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  		<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.js"></script>
  		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		  
		<style>
			.container {
				display: flex;
				justify-content: center;
				align-items: center;
				margin-top: 200px;
				width:1000px;
			}
			.error {
				color:red;
				margin-top: 10px;
				margin-bottom: 10px;
			}
		</style>
	</head>
  	<body class="text-center" style="background-color:WhiteSmoke;">

  		<div class="container">
			<form class="form-signin" method="post">
				<h1 class="h3 mb-3 font-weight-normal">Prosze wypelnic dane</h1><br>
				<label for="inputName" class="sr-only">Nazwa użytkownika</label>
				<input id="inputName" class="form-control" name="user_name" placeholder="Nazwa użytkownika" required autofocus>
				<?php 
					if (isset($_SESSION['error_username'])) 
					{
						echo '<div class = "error">'.$_SESSION['error_username'].'</div>';
						unset($_SESSION['error_username']);
					}
				?>
				<label for="inputEmail" class="sr-only">Adres email</label>
				<input id="inputEmail" class="form-control" name="mail" placeholder="Adres email" required autofocus>
				<?php 
					if (isset($_SESSION['error_mail'])) 
					{
						echo '<div class = "error">'.$_SESSION['error_mail'].'</div>';
						unset($_SESSION['error_mail']);
					}
				?>
				<label for="inputPassword" class="sr-only">Hasło</label>
				<input type="password" id="inputPassword" class="form-control" name="password" placeholder="Hasło" required>
				<?php 
					if (isset($_SESSION['error_password'])) 
					{
						echo '<div class = "error">'.$_SESSION['error_password'].'</div>';
						unset($_SESSION['error_password']);
					}
				?>
				<label for="inputPassword2" class="sr-only">Powtórz hasło</label>
				<input type="password" id="inputPassword2" class="form-control" name="password2" placeholder="Powtórz hasło" required><br>

				<label>
					Akceptuje regulamin<input type="checkbox" class="form-control" name="regulations">
				</label>
				<?php 
					if (isset($_SESSION['error_regulations'])) 
					{
						echo '<div class = "error">'.$_SESSION['error_regulations'].'</div>';
						unset($_SESSION['error_regulations']);
					}
				?>
				<div class="g-recaptcha" data-sitekey="6LeH4eUUAAAAAF1qZU4lqoNr_fa3UBY9Eb-O5PUF"></div><br>
				<?php 
					if (isset($_SESSION['error_captcha'])) 
					{
						echo '<div class = "error">'.$_SESSION['error_captcha'].'</div>';
						unset($_SESSION['error_captcha']);
					}
				?>
				<button class="btn btn-lg btn-dark btn-block" type="submit">Zarejestruj</button>
			</form>

		<?php
			if(isset($_SESSION['error'])) echo $_SESSION['error'];
		?>
  </body>
</html>
