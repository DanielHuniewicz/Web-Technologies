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

		<link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sign-in/">
		<link href="../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
		<script type="text/javascript" src="https://ff.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=ehD5VdAsTHYbFyIc7pSt5in9NfvyRjc3x1mD7mwkH9DHYlJAOL8C7u8CNQ4V1dMSJwNzw-ZF3so3A0s93IMrmjpbXG15nCv_gfaMtuXG57Y" charset="UTF-8"></script></head>
		
		<style>
			.container {
				display: flex;
				justify-content: center;
				align-items: center;
				margin-top: 200px;
				width:1000px;
			}
		</style>
	</head>
  <body class="text-center" style="background-color:WhiteSmoke;">
  <div class="container">
    <form class="form-signin" action="login.php" method="post">
      <img class="mb-4" src="https://cdn0.iconfinder.com/data/icons/mini-icon-2-2/16/login_in-512.png" alt="" width="80" height="80">
      <h1 class="h3 mb-3 font-weight-normal">Prosze się zalogować</h1>
      <label for="inputEmail" class="sr-only">Nazwa użytkownika</label>
      <input id="inputEmail" class="form-control" name="name" placeholder="Nazwa użytkownika" required autofocus>
      <label for="inputPassword" class="sr-only">Hasło</label>
      <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Hasło" required><br>
      <button class="btn btn-lg btn-dark btn-block" type="submit">Zaloguj</button>
    </form>
	</div>

	<?php
	if(isset($_SESSION['error'])) echo $_SESSION['error'];
	?>

  </body>
</html>
