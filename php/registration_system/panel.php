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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>    
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
 		<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.js"></script>
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
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
  </body>
</html>
