<?php
	session_start();
	
	if (!isset($_SESSION['login']))
	{
		header('Location: index.php');
		exit();
  }
  $welcome = "<h1>Witaj ".$_SESSION['name'].'</h1>';
  $logout = "<a href='logout.php' class='btn btn-outline-light'>Wyloguj sie</a>";
	$display_points = "<b>Punkty</b>: ".$_SESSION['points'].' ';
	$display_money = "<b>Środki</b>: ".$_SESSION['money'].'zł ';
	$display_days = "<b>Ważność konta</b>: ".$_SESSION['days'].' dni<br>';
	$display_mail = "<b>E-mail</b>: ".$_SESSION['mail'];
?>

<!doctype html>
<html lang="pl">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Panel użytkownika</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/cover/">
    <link href="../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  	<script type="text/javascript" src="https://ff.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=XR-ykRaAqG8D_VVOi5o8HFsocbzqL4k027gWL8QMwFX49Bhcbo-_pVKs729001SxvC3mvMGfd-bOIKUhd5iGH3Yvvyx2FApp7PG8iYkeI48" charset="UTF-8"></script></head>
    
    <style>
      p,h1,h3 {color: #F5F5F5;}
    </style>

  </head>

  <body class="text-center" style="background-color:#101010;">
    <div class="container" style="width:800px; margin-top: 100px;" >

        <?php echo $welcome?><br>
        <p class="lead" style="text-align: justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pelle
        risus et, vestibulum est. Etiam eget arcu lobortis, vestibulum odio id, efficitur quam. Donec viverra
        magna vitae metus maximus, in aliquet libero malesuada. Sed mi nibh, convallis eu tortor eu, egestas
        Vestibulum sed ligula eget lorem bibendum lobortis vel congue metus.</p>
        <h3>Twoje dane</h3>
        <p class="lead">
        <?php
          echo $display_points;
          echo $display_money;
          echo $display_days;
          echo $display_mail;
        ?><br><br>
        <?php echo $logout?><br>
        </p>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../bootstrap/assets/js/vendor/popper.min.js"></script>
    <script src="../bootstrap/dist/js/bootstrap.min.js"></script>

  </body>
</html>
