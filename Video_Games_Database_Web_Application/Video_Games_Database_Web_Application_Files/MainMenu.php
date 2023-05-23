<?php
//PHP CODE
 session_start();
 
	/*
	Brandon Anup
	This is the code for the Main Menu Page of my Video Game Database Web Application. If you are not logged in the buttons to the
	four functions will send you to a blank page. If you are logged in, once you click them they will work as intended. You can 
	access this page not logged in but it is preferred that you are. 
	*/ 
 
 

	//user is logged in
	if (isset($_SESSION['username']))
	{
		$username = htmlspecialchars($_SESSION['username']);
		echo "Welcome. You are logged in as $username.<br>";
		echo <<<_END
		<!-- Log Out -->
		<a href='?logout=1'>Click here to log out</a>
		_END;
	}
	
	//user is not logged in and disable all the submits
	if (!isset($_SESSION['username']))
	{
		echo "You are not logged in. <br>";
		
		echo <<<_END
		<html>
		<body>
		<a href='loginPage.php'>Click here to log in</a>
		</body>
		</html>
		
		_END;
	}
	
	
	
	//logout
	if (isset($_GET['logout'])){
		//echo ("Log Out was Clicked");
		destroy_session_and_data();
		session_start();
		
		//echo htmlspecialchars("You are not logged in");
		die ("<p><a href='MainMenu.php'>Click here to continue to Main Menu not logged in</a></p>");
	} 
	
  function destroy_session_and_data()
  {
    $_SESSION = array();
    setcookie(session_name(), '', time() - 2592000, '/');
    session_destroy();
  }




//WEB PAGE HTML, CSS CODE
echo <<<_END
<html>
<style>
#banner{
  width: 100%;
  background-image: url(https://i.etsystatic.com/12175780/r/il/85bfa4/3427102381/il_fullxfull.3427102381_dbt1.jpg);
  height: 300px;
  background-color: green;
  background-position: center;
}

h1{
	text-align: center;
	text-decoration: underline;
	color: rgb(50,205,50)
}

#watermark{ 
	position: fixed; bottom: 0; right: 0; z-index:999; 
	color: rgb(50,205,50)
}

input[type=submit]{
	background-color: rgb(50,205,50);
	border: none;
	color: white;
	padding: 20px 40px;
	width: 250px;
	text-decoration: none;
	margin: 4px 2x;
	cursor: pointer;
}

a {
  color: rgb(50,205,50);
  position: fixed; bottom: 0; left: 0; z-index:999; 
  
}



</style>
<div id='banner'></div>
<body style='background-color:white;'>
   <h1>Video Game Database</h1>
</body>

<!-- List Records -->
<form method='post' name = 'listrecords' action='listRecords.php' enctype='multipart/form-data'><pre>
<input type='submit' id = 'list' value='LIST ALL RECORDS'></td>
</form>

<!-- Add Records -->
<form method='post' name = 'addrecords' action='addRecords.php' enctype='multipart/form-data'><pre>
<input type='submit' id = 'add' value='ADD RECORDS'></td> 
</form>

<!-- Search Records -->
<form method='post' name = 'searchrecords' action='searchRecords.php' enctype='multipart/form-data'><pre>
<input type='submit' id = 'search' value='SEARCH RECORDS'></td> 
</form>

<!-- Delete Records -->
<form method='post' name = 'deleterecords' action='deleteRecords.php' enctype='multipart/form-data'><pre>
<input type='submit' id='delete' value='DELETE RECORDS'></td> 
</form>



<div id='watermark'>Created By: Brandon Anup</div>
</form>
</html>

	
_END;


?>