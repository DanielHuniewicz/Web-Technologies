<?php

	session_start();
	if ((!isset($_POST['name'])) || (!isset($_POST['password'])))
	{
		header('Location: index.php');
		exit();
	}

	require_once "db_connect.php";
	$connection = @new mysqli($host, $db_user, $db_password, $db_name);
	
	if ($connection->connect_errno!=0)
	{
		echo "Error: ".$connection->connect_errno;
	}
	else
	{
		$name = $_POST['name'];
		$password = $_POST['password'];
		$name = htmlentities($name, ENT_QUOTES, "UTF-8");
		$password = htmlentities($password, ENT_QUOTES, "UTF-8");
	
		if ($rezultat = @$connection->query(
		sprintf("SELECT * FROM users WHERE name='%s' AND password='%s'",
		mysqli_real_escape_string($connection,$name),
		mysqli_real_escape_string($connection,$password))))
		{
			$ilu_userow = $rezultat->num_rows;
			if($ilu_userow>0)
			{
				$_SESSION['login'] = true;
				
				$row = $rezultat->fetch_assoc();
				$_SESSION['id'] = $row['id'];
				$_SESSION['name'] = $row['name'];
				$_SESSION['points'] = $row['points'];
				$_SESSION['money'] = $row['money'];
				$_SESSION['days'] = $row['days'];
				$_SESSION['mail'] = $row['mail'];
				
				unset($_SESSION['error']);
				$rezultat->free_result();
				header('Location: panel.php');
				
			} else {
				$_SESSION['error'] = '<span style="color:red">Nieprawidłowe dane</span>';
				header('Location: index.php');
			}
		}
		$connection->close();
	}
?>