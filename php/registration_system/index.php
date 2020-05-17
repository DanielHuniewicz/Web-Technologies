<?php

	session_start();	
	
	if ((isset($_SESSION['login'])) && ($_SESSION['login']==true))
	{
		header('Location: panel.php');
		exit();
	}
?>

<!doctype html>
<html lang="pl">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>System logowania</title>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>    
  		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
 		<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.js"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

		<style>
			.container {
				display: block;
				justify-content: center;
				align-items: center;
				margin-top: 200px;
				width:300px;
			}
		</style>
	</head>

  	<body class="text-center" style="background-color:WhiteSmoke;">
		
		<div class="container">
		
			<form class="form-signin" action="login.php" method="post";>
				<img class="mb-4" src="https://cdn0.iconfinder.com/data/icons/mini-icon-2-2/16/login_in-512.png" alt="" width="80" height="80">
				<h1 class="h3 mb-3 font-weight-normal">Prosze się zalogować</h1><br>
				<label for="inputEmail" class="sr-only">Nazwa użytkownika</label>
				<input id="inputEmail" class="form-control" name="name"  placeholder="Nazwa użytkownika" required autofocus>
				<label for="inputPassword" class="sr-only">Hasło</label>
				<input type="password" id="inputPassword" class="form-control" name="password" placeholder="Hasło" required><br>
				<button class="btn btn-lg btn-dark btn-block" type="submit">Zaloguj</button><br>
			</form>
			
			<form action="registration.php" method="post">
				<button class="btn btn-lg btn-dark btn-block" type="submit">Rejestracja</button>
			</form>
		</div>

		<?php
			if(isset($_SESSION['error'])) echo $_SESSION['error'];
			unset($_SESSION['error']);
		?>
 	</body>
</html>
