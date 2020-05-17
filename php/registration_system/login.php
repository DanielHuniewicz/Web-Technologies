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
	
		if ($result = @$connection->query(
		sprintf("SELECT * FROM users WHERE name='%s'",
		mysqli_real_escape_string($connection,$name))))
		{
			$num_users = $result->num_rows;
			if($num_users>0)
			{
				$row = $result->fetch_assoc();
				if (password_verify($password, $row['password']))
				{
					$_SESSION['login'] = true;	
					$_SESSION['id'] = $row['id'];
					$_SESSION['name'] = $row['name'];
					$_SESSION['points'] = $row['points'];
					$_SESSION['money'] = $row['money'];
					$_SESSION['days'] = $row['days'];
					$_SESSION['mail'] = $row['mail'];
					unset($_SESSION['error']);			

					$result->free_result();
					header('Location: panel.php');

				}
				else {
					$_SESSION['error'] = '<span style="color:red">Nieprawidłowe dane</span>';
					header('Location: index.php');
				} 
			}
			else {
				$_SESSION['error'] = '<span style="color:red">Nieprawidłowe dane</span>';
				header('Location: index.php');
			}
		$connection->close();
		}
	}
?>