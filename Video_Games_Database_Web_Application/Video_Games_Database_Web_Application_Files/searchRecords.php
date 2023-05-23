<?php	
	//SEARCH IS STRICT
	require_once 'login2.php';
	session_start();
	
	/*
	Brandon Anup
	This is the code for the List Records Page of my Video Game Database Web Application. If you are not logged in, nothing will appear.
	This simply just lists all the records in the Video Games Database.
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
	<h1> SEARCH RECORDS </h1>
	<form method="post" action="searchRecords.php" enctype='multipart/form-data'><pre>

	<table>
	<tr><td>Select a field to search in:</tr></td>
	<tr><td><select name= "field" size="1" required>
	<option value="name">Video Game Name</option>
	<option value="publisher">Publisher</option>
	<option value="genre">Genre</option>
	<option value="year_released">Year Released</option>
	<option value="rating">Rating</option>
	<option value="id">ID</option>
	</select><tr><td>

	<tr><td>Enter a value to search for:</tr></td>
	<tr><td><input type="text" name="value"></tr></td>


	<tr><td><input type="submit" value="SEARCH RECORD"></td>


	</table>
	<div id='watermark'>Created By: Brandon Anup</div>
	<a href='MainMenu.php'>Click here to return to the Main Menu</a>
	</form>
	
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
  
	//video game name
	if(isset($_POST['field']) && $_POST['field'] == 'name' && isset($_POST['value'])){
		$name = get_post($pdo, 'value');
		$query = "SELECT * FROM VideoGames WHERE name=$name";
		$result = $pdo->query($query);
	

	
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
			Rating: $r4
			ID: $r5
		</pre>
		_END; 
	}
	
	if ($result->rowCount() == 0) {
		echo "No results found.";
	}
	}
	
	//publisher
	if(isset($_POST['field']) && $_POST['field'] == 'publisher' && isset($_POST['value'])){
		$publisher = get_post($pdo, 'value');
		$query = "SELECT * FROM VideoGames WHERE publisher=$publisher";
		$result = $pdo->query($query);
	

	
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
			Rating: $r4
			ID: $r5
		</pre>
		_END; 
	}
	
	if ($result->rowCount() == 0) {
		echo "No results found.";
	}
	}
	
	
	
	//genre
	if(isset($_POST['field']) && $_POST['field'] == 'genre' && isset($_POST['value'])){
		$genre = get_post($pdo, 'value');
		$query = "SELECT * FROM VideoGames WHERE genre=$genre";
		$result = $pdo->query($query);
	
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
			Rating: $r4
			ID: $r5
		</pre>
		_END; 
	}
	
	if ($result->rowCount() == 0) {
		echo "No results found.";
	}
	}
	
	
	//year_released
	if(isset($_POST['field']) && $_POST['field'] == 'year_released' && isset($_POST['value'])){
		$year_released = get_post($pdo, 'value');
		$query = "SELECT * FROM VideoGames WHERE year_released=$year_released";
		$result = $pdo->query($query);
	
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
			Rating: $r4
			ID: $r5
		</pre>
		_END; 
	}
	
	if ($result->rowCount() == 0) {
		echo "No results found.";
	}
	}
	
	
	//rating
	if(isset($_POST['field']) && $_POST['field'] == 'rating' && isset($_POST['value'])){
		$rating = get_post($pdo, 'value');
		$query = "SELECT * FROM VideoGames WHERE rating=$rating";
		$result = $pdo->query($query);
	
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
			Rating: $r4
			ID: $r5
		</pre>
		_END; 
	}
	
	if ($result->rowCount() == 0) {
		echo "No results found.";
	}
	}
	
	
	
	//id
	if(isset($_POST['field']) && $_POST['field'] == 'id' && isset($_POST['value'])){
		$id= get_post($pdo, 'value');
		$query = "SELECT * FROM VideoGames WHERE id=$id";
		$result = $pdo->query($query);
	
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
			Rating: $r4
			ID: $r5
		</pre>
		_END; 
	}
	
	if ($result->rowCount() == 0) {
		echo "No results found.";
	}
	}
  


	
  
  function get_post($pdo, $var)
  {
    return $pdo->quote($_POST[$var]);
  }
  
?>