<?php
//put this file on a server find the URL of the file
// and put it into the correct cs file

// information for the server
//--------------------------------
	$host = "104.196.199.63";
	$username = "GroupAccess";
	$password = "theBestPassword";
	$dbname = "GameDB";
//--------------------------------

//information to be inserted into the database
//--------------------------------
	$name = $_GET['name']; 
    $kills = $_GET['kills'];
    $deaths = $_GET['deaths']; 
    $hash = $_GET['hash']; 
//--------------------------------

//security code MUST match
//--------------------------------
    $secretKey="mySecretKey"; # Change this value to match the value stored in the client javascript below 
//--------------------------------

//initializing connection to database
//-------------------------------
	$dsn = "mysql:host=$host; dbname=$dbname";
	$pdo = new PDO($dsn,$username,$password);
//-------------------------------

// md5 is for security and makes a hash code out of the
// name, kills, deaths, and secretKey.
//------------------------------- 
	$real_hash = md5($name . $kills. $deaths . $secretKey);
//-------------------------------

//checks if the connection was good
//-------------------------------
	if(!$pdo){
		die("connection Failed. ". mysqli_connect_error());
	}
//-------------------------------

// checks if the given hash matches the generated hash
//-------------------------------
	if($real_hash == $hash) 
	{ 
		$stmt = $pdo->query("INSERT INTO leaderboards VALUES(NULL,'$name','$kills','$deaths')");
	}
//-------------------------------
?>