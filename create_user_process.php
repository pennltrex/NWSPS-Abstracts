<?php
/********************************************************
 *
 *	phpAbstracts
 *  http://www.phpabstracts.com
 *
 *  For copyright and license information, see readme.txt
 *
*********************************************************/



	//Include header template
	include('header.php');
	
	//Only ADMINs can view this page
	if ($admin) {
	
		//Grab variables from form
		$login=$_POST['login'];
		$pw = $_POST['pw'];
		$name = $_POST['name'];
		$email = $_POST['email'];
		$role = $_POST['role'];
		
		
		//Database Connection Variables
		include('db.php');
		
		//Connect to database
		mysql_connect($host,$username,$password);
		@mysql_select_db($database) or die( "Unable to select database");
		
		//Insert values into database	
		$query = "INSERT INTO users VALUES ('', '$login', '$pw', '$name', '$email', '$role')";
		mysql_query($query) or die(mysql_error()); 
		
		//Close database
		mysql_close();
		
		
		//Send e-mail to new user
		$to = $email;
		$subject = "Welcome to " . $site_title;
		$body = "Welcome to " . $site_title . 
			 	"\n\nYou may login to the system at " . $site_url . 
				"\n\nYour login information is below. Please do not delete this email." .
				"\n\nLogin: " . $login . "\nPassword: " . $pw .
				"\n\nThank you for your participation.";
		$from = $site_email;
		$headers = "From: $from";
		
		mail($to, $subject, $body, $headers);
		
		
		//Print confirmation
		
		echo "<br /><br /><br />" . 
			 "<div class='statusbox'>" . 
			 "<p>User ID '" . $login . "' has been successfully created.</p>" . 
			 "<p><a href='list.php'>Return " . $home_title . "</a> | <a href='list_users.php'>Return to " . $user_mgmt_title . "</a></p>" .
			 "</div>". 
			 "<br /><br /><br />";
				 
	}//if admin			 
			 
	//Include footer template
	include('footer.php'); 


?>
