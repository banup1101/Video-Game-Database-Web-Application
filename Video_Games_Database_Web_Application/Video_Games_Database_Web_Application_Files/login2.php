<?php // login.php 

	/*
	Brandon Anup
	Connect to Database
	*/



  $host = 'localhost';    // Change as necessary
  $data = 'bcs350sp23'; // Change as necessary
  $user = 'usersp23';         // Change as necessary
  $pass = 'passwdsp23';        // Change as necessary
  $chrs = 'utf8mb4';
  $attr = "mysql:host=$host;dbname=$data;charset=$chrs";
  $opts =
  [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
  ];
?>
