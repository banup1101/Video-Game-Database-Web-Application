<?php
  require_once 'login2.php';
  
	/*
	Brandon Anup
	This is the set up database for my Video Games table. 
	*/
  
  

  try
  {
    $pdo = new PDO($attr, $user, $pass, $opts);
  }
  catch (\PDOException $e)
  {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
  }
  
//CREATE TABLE
	$query  = " CREATE TABLE IF NOT EXISTS VideoGames (
	name VARCHAR(128),
	publisher VARCHAR(128),
	genre VARCHAR(128),
	year_released SMALLINT(4),
	rating VARCHAR(1),
	id CHAR(9),
	PRIMARY KEY (id)) ENGINE InnoDB;";
 

	$result = $pdo->query($query);





function get_post($pdo, $var)
{
	return $pdo->quote($_POST[$var]);
}


?>