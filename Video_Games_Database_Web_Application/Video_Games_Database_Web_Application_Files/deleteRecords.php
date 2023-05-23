<?php
  require_once 'login2.php';
  session_start();

	/*
	Brandon Anup
	This is the code for the Delete Records Page of my Video Game Database Web Application. If you are not logged in, nothing will appear.
	This lists all the records in the database and lets the user decide which one they want to delete by clicking the Delete Record Button.
	*/
	
  try
  {
    $pdo = new PDO($attr, $user, $pass, $opts);
  }
  catch (PDOException $e)
  {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
  }

  if (isset($_POST['delete']) && isset($_POST['id']))
  {
    $id   = get_post($pdo, 'id');
    $query  = "DELETE FROM videogames WHERE id=$id";
    $result = $pdo->query($query);
  }
  
  $query  = "SELECT * FROM videogames";
  $result = $pdo->query($query);
  
  
  if (isset($_SESSION['username']))
	{
		$username = htmlspecialchars($_SESSION['username']);
		echo <<<_END
		<style>
		#watermark{ 
		position: fixed; bottom: 0; right: 0; z-index:999; 
		color: rgb(50,205,50);
		}
		
		a {
		color: rgb(50,205,50);
		position: fixed; bottom: 0; left: 0; z-index:999; 
		}
		</style>
		<pre>
		<h1>CHOOSE A GAME IN THE DATABASE TO DELETE: </h1>
		</pre>
		<div id='watermark'>Created By: Brandon Anup</div>
		<a href='MainMenu.php'>Click here to return to the Main Menu</a>
		
		_END;

  	  while ($row = $result->fetch())
		{
		$r0 = htmlspecialchars($row['name']);
		$r1 = htmlspecialchars($row['publisher']);
		$r2 = htmlspecialchars($row['genre']);
		$r3 = htmlspecialchars($row['year_released']);
		$r4 = htmlspecialchars($row['rating']);
		$r5 = htmlspecialchars($row['id']);
		
		
  
  		echo <<<_END
		<pre>
		Video Game: $r0
		Publisher: $r1
		Genre: $r2
		Year Released: $r3
		ESRB Rating: $r4
		ID: $r5
		</pre>
		<form action='deleteRecords.php' method='post'>
		<input type='hidden' name='delete' value='yes'>
		<input type='hidden' name='id' value='$r5'>
		<input type='submit' value='DELETE RECORD'></form>
		_END;

		}
	}

  function get_post($pdo, $var)
  {
    return $pdo->quote($_POST[$var]);
  }
?>