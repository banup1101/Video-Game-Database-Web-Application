<?php
require_once 'login2.php';
  
	/*
	Brandon Anup
	This is the code for the registration page of my Video Game Database Web Application. If you do not have an account you cannot log in.
	And if you cannot log in then you can't use the buttons on the main page. The users
	password is also salted and sanitized here. In the database it is encrypted. 
	*/
  
	$username = $password = $confirmpassword = $email = "";
	$duplicationcheck = True;

	if (isset($_POST['username']))
		$username = fix_string($_POST['username']);
  
	if (isset($_POST['password']))
		$password = fix_string($_POST['password']);
	
	 if (isset($_POST['confirmpassword']))
		$confirmpassword = fix_string($_POST['confirmpassword']);
 
	if (isset($_POST['email']))
		$email = fix_string($_POST['email']);

  $fail = validate_username($username);
  $fail .= validate_password($password);
  $fail .= validate_confirmpassword($confirmpassword);
  $fail .= validate_email($email);

  echo "<!DOCTYPE html>\n<html><head><title>Registration Page</title>";

  if ($fail == "")
  {
    echo "</head><body>Form data successfully validated:
     $username, $password, $email.</body></html>";
	
	echo " Now that you have registered, <a href='loginPage.php'>Click here to go to the log in page</a> <br>";


	//connect do db

	try {
	$pdo = new PDO($attr, $user, $pass, $opts);
	}
	catch (PDOException $e) {
	throw new PDOException($e->getMessage(),
	(int)$e->getCode());
	}
	
	//HASH THE PASSWORD
	$hashed_password = password_hash($password, PASSWORD_DEFAULT);
	
	//add what user put in form into database
	$query = "INSERT INTO users(username, password, email) VALUES ('$username', '$hashed_password', '$email')";
	try{
	$result = $pdo->query($query);
	}
	catch(PDOException $e){
		$duplicationcheck = false;
		if ($e->getCode() == "23000") { //error code 23000 is a duplicate value error
		// Duplicate entry error - handle it here
		echo "You tried to enter a username that was already taken! <a href='loginPage.php'>Please click here and try again. </a>";
	}
	}

	exit;
  
  }

  echo <<<_END

    <!-- The HTML/JavaScript section -->

    <style>
      .signup {
        border: 1px solid #999999;
      font:   normal 14px helvetica; color:#444444;
      }
    </style>

    <script>
      function validate(form)
      {
        fail += validateUsername(form.username.value)
        fail += validatePassword(form.password.value)
		fail += validateConfirmPassword(form.confirmpassword.value)
        fail += validateEmail(form.email.value)
      
        if (fail == "")     return true
        else { alert(fail); return false }
      }

	function validateUsername(field)
	{
		if (field == "") return "No Username was entered.\\n"
		else if (field.length < 5)
		return "Usernames must be at least 5 characters.\\n"
		else if (/[^a-zA-Z0-9_-]/.test(field))
		return "Only a-z, A-Z, 0-9, - and _ allowed in Usernames.\\n"

		return ""
	}

      function validatePassword(field)
      {
        if (field == "") return "No Password was entered.\\n"
        else if (field.length < 6)
          return "Passwords must be at least 6 characters.\\n"
	 	
        else if (!/[a-z]/.test(field) || ! /[A-Z]/.test(field) ||
                 !/[0-9]/.test(field))
          return "Passwords require one each of a-z, A-Z and 0-9.\\n"
        return ""
      }

		function validateConfirmPassword(field)
      {
        if (field == "") return "No Confirm Password was entered.\\n"
	  	else if(field != validatePassword(field))
			return "Password is not the same as Confirmed Password.\\n"
		
        else if (!/[a-z]/.test(field) || ! /[A-Z]/.test(field) ||
                 !/[0-9]/.test(field))
          return "Passwords require one each of a-z, A-Z and 0-9.\\n"
        return ""
      }

      function validateEmail(field)
      {
        if (field == "") return "No Email was entered.\\n"
          else if (!((field.indexOf(".") > 0) &&
                     (field.indexOf("@") > 0)) ||
                    /[^a-zA-Z0-9.@_-]/.test(field))
            return "The Email address is invalid.\\n"
        return ""
      }
    </script>
  </head>
  <body>

    <table border="0" cellpadding="2" cellspacing="5" bgcolor="#eeeeee">
      <th colspan="2" align="center">Registration Page</th>

        <tr><td colspan="2">Sorry, the following errors were found<br>
          in your form: <p><font color=red size=1><i>$fail</i></font></p>
        </td></tr>

      <form method="post" action="registrationPage.php" onSubmit="return validate(this)">
        </td></tr><tr><td>Username</td>
          <td><input type="text" maxlength="64" name="username" value="$username">
        </td></tr><tr><td>Password</td>
          <td><input type="text" maxlength="64" name="password" value="$password">
		  </td></tr><tr><td>Confirm Password</td>
          <td><input type="text" maxlength="64" name="confirmpassword" value="$confirmpassword">
        </td></tr><tr><td>Email</td>
          <td><input type="text" maxlength="64" name="email" value="$email">
        </td></tr><tr><td colspan="2" align="center"><input type="submit"
          value="Signup"></td></tr>
      </form>
    </table>
  </body>
</html>

_END;

  // The PHP Validation functions  
function validate_username($field)
{
	if ($field == "") return "No Username was entered<br>";
	else if (strlen($field) < 5)
		return "Usernames must be at least 5 characters<br>";
	else if (preg_match("/[^a-zA-Z0-9_-]/", $field))
		return "Only letters, numbers, - and _ in usernames<br>";		
	return "";		
}
  
  function validate_password($field)
  {
    if ($field == "") return "No Password was entered<br>";
    else if (strlen($field) < 6)
      return "Passwords must be at least 6 characters<br>";
  
	/*else if($password != $confirmpassword)
		return "Password is not the same as Confirmed Password.<br>"; */
  
    else if (!preg_match("/[a-z]/", $field) ||
             !preg_match("/[A-Z]/", $field) ||
             !preg_match("/[0-9]/", $field))
      return "Passwords require 1 each of a-z, A-Z and 0-9<br>";
    return "";
  }
  
    function validate_confirmpassword($field)
  {
    if ($field == "") return "No Confirm Password was entered<br>";
	else if($field != $_POST['password'])
		return "Password is not the same as Confirmed Password.<br>";
  }
  
  
  function validate_email($field)
  {
    if ($field == "") return "No Email was entered<br>";
      else if (!((strpos($field, ".") > 0) &&
                 (strpos($field, "@") > 0)) ||
                  preg_match("/[^a-zA-Z0-9.@_-]/", $field))
        return "The Email address is invalid<br>";
    return "";
  }
  
  function fix_string($string)
  {
    if (get_magic_quotes_gpc()) $string = stripslashes($string);
    return htmlentities ($string);
  }
?>
