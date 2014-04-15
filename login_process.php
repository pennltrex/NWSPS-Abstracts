<?php
/********************************************************
 *
 *	phpAbstracts
 *  http://www.phpabstracts.com
 *
 *  For copyright and license information, see readme.txt
 *
*********************************************************/



	//Database Connection Variables
	include('db.php');

	
	//Connect to database
	mysql_connect($host,$username,$password);
	@mysql_select_db($database) or die( "Unable to select database");
	
	
	//Grab login and password entered from previous page
	$login = $_POST['login'];
	$password = $_POST['pw'];
	
	
	//Search for a match
	$query = "SELECT * FROM users WHERE login='$login' AND password='$password'";
	$result = mysql_query($query);
	$num = mysql_numrows($result);
	
	
	//If match is found, log-in user and set cookies
	if ($num==1) {
		$user_id 	= mysql_result($result,0,"user_id");
		$name 		= mysql_result($result,0,"name");
		$role 		= mysql_result($result,0,"role");
		
		setcookie("user", 	 "$login", 	 time()+7200);
		setcookie("user_id", "$user_id", time()+7200);
		setcookie("name", 	 "$name", 	 time()+7200);
		setcookie("role",	 "$role",	 time()+7200);
		
		header( 'Location: list.php' );
	}

	//Otherwise, return to login page with error message
	else {
		header( 'Location: login.php?x=error' );
	}


?>
