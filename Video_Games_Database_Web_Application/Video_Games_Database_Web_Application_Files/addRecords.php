<?php //Add Records
	require_once 'login2.php';
	session_start();
	
	/*
	Brandon Anup
	This is the code for the Add Records Page of my Video Game Database Web Application. If you are not logged in, nothing will appear.
	This simply just lets the user decide what records they want to add by filling in the values in the Input boxes and then adds them
	into the database. The data the user enters is sanitised. 
	*/
	
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
		
		
		<h1> ADD RECORDS </h1>
		<form action="addRecords.php" method="post"><pre>
		<table>
		<tr><td> Video Game Name <input type="text" name="name"> </tr></td>
		<tr><td> Publisher <input type="text" name="publisher"> </tr></td>
		<tr><td> Genre <input type="text" name="genre"> </tr></td>
		<tr><td> Year Released <input type="text" name="year_released"> </tr></td>
		<tr><td> Rating <input type="text" name="rating"> </tr></td>
		<tr><td> Game ID <input type="text" name="id"> </tr></td>
		<tr><td> <input type="submit" value="ADD RECORD"> </tr></td>
		</table>
		<div id='watermark'>Created By: Brandon Anup</div>
		<a href='MainMenu.php'>Click here to return to the Main Menu</a>
	</pre></form>
	_END;
	}

	try
	{
		$pdo = new PDO($attr, $user, $pass, $opts);
	}
	catch (PDOException $e)
	{
		throw new PDOException($e->getMessage(), (int)$e->getCode());
	}
	if (isset($_POST['name'])   &&
		isset($_POST['publisher'])    &&
		isset($_POST['genre']) &&
		isset($_POST['year_released'])     &&
		isset($_POST['rating']) &&
		isset($_POST['id']))
	{
	$name = get_post($pdo, 'name');
	$publisher = get_post($pdo, 'publisher');
	$genre = get_post($pdo, 'genre');
	$year_released = get_post($pdo, 'year_released');
	$rating = get_post($pdo, 'rating');
	$id = get_post($pdo, 'id');

	//prepared statement
	$stmt = $pdo->prepare("INSERT INTO videogames (name, publisher, genre, year_released, rating, id)
	VALUES (:name, :publisher, :genre, :year_released, :rating, :id)");
	$stmt->bindParam(':name', $name);
	$stmt->bindParam(':publisher', $publisher);
	$stmt->bindParam(':genre', $genre);
	$stmt->bindParam(':year_released', $year_released);
	$stmt->bindParam(':rating', $rating);
	$stmt->bindParam(':id', $id); 
    
	$query    = "INSERT INTO VideoGames VALUES" .
      "($name, $publisher, $genre, $year_released, $rating, $id)";
    $result = $pdo->query($query);
	}



	$query  = "SELECT * FROM VideoGames";
	$result = $pdo->query($query);  

  
  
  while ($row = $result->fetch())
  {
    $r0 = htmlspecialchars($row['name']);
    $r1 = htmlspecialchars($row['publisher']);
    $r2 = htmlspecialchars($row['genre']);
    $r3 = htmlspecialchars($row['year_released']);
    $r4 = htmlspecialchars($row['rating']);
	$r5 = htmlspecialchars($row['id']);
	
   
  /*
    echo <<<_END
  <pre>
  <h2>ALL GAMES CURRENTLY IN DATABASE: </h2>
    Video Game: $r0
    Publisher: $r1
    Genre: $r2
    Year Released: $r3
    ESRB Rating: $r4
    ID: $r5
  </pre>
  _END; */
  }
  
function get_post($pdo, $var)
{
	return $pdo->quote($_POST[$var]);
}

  
  
?>