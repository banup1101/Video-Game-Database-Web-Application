<?php
  require_once 'login2.php';
  
    /*
	Brandon Anup
	This is the code for the login page of my Video Game Database Web Application. If you do not have an account there is a link to click
	that takes you to the registration page. If you are not logged in and access the Main Menu, none of its functions will work.
  */
  

  try
  {
    $pdo = new PDO($attr, $user, $pass, $opts);
  }
  catch (\PDOException $e)
  {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
  }
    
	//check to see if the input boxes have any values in them
	if (isset($_POST['username']) &&
		isset($_POST['password']))
  {
	  $username = fix_string($_POST['username']);
	  $password = fix_string($_POST['password']);
	  
	//sql code to make sure the username is in the users database
    $query   = "SELECT * FROM users WHERE username='$username'";
    $result  = $pdo->query($query);

    if (!$result->rowCount()) die("User not found");
    $row = $result->fetch();
    $un  = $row['username'];
    $pw  = $row['password'];

	//gets what the actual password was and not the encrypted one
    if (password_verify($password, $pw))
	{
      session_start();

      $_SESSION['username'] = $un;
      $_SESSION['password']  = $pw;

      echo htmlspecialchars("You are now logged in as '$un'");
      die ("<p><a href='MainMenu.php'>Click here to continue</a></p>");
    }
    else echo("Invalid username/password combination. $un $pw $username $password");
  }
  

	$username = $password = "";

	echo <<<_END

	 <table border="0" cellpadding="2" cellspacing="5" bgcolor="#eeeeee">
		<th colspan="2" align="center">Login Form</th>
		</td></tr>

		<form method="post" action="loginPage.php" onSubmit="return validate(this)">
			</td></tr><tr><td>Username</td>
			<td><input type="text" maxlength="64" name="username" value="$username">
			</td></tr><tr><td>Password</td>
			<td><input type="text" maxlength="64" name="password" value="$password">
			</td></tr><tr><td colspan="2" align="center"><input type="submit"
			value="Login"></td></tr>
		</form>
	</table>
	<a href='registrationPage.php'>Need An Account? Click Here To Register.</a>

	_END;

  
  function sanitise($pdo, $str)
  {
    $str = htmlentities($str);
    return $pdo->quote($str);
  }
  
	function fix_string($string)
	{
	if (get_magic_quotes_gpc()) $string = stripslashes($string);
	return htmlentities ($string);
	}
  
  
  
?>