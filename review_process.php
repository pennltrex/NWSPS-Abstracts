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
	

	//Grab variables from form
	$review_id		= $_POST['review_id'];
	$relevance 		= $_POST['relevance'];
	$quality 		= $_POST['quality'];
	$recommendation	= $_POST['recommendation'];
	$comments 		= $_POST['comments'];
	$topic 			= $_POST['topic'];
	$abstract_id 	= $_POST['abstract_id'];
	
	
	//Database Connection Variables
	include('db.php');
	
	
	//Connect to database
	mysql_connect($host,$username,$password);
	@mysql_select_db($database) or die( "Unable to select database");
	
	
	//Update review for this abstract
	$query = "UPDATE reviews SET relevance='$relevance', quality='$quality', recommendation='$recommendation', " .
			 "comments='$comments', status='Complete' WHERE review_id = '$review_id'";
	mysql_query($query) or die(mysql_error());
	
	
	//Update topic for this abstract
	$query2 = "UPDATE abstracts SET topic='$topic' WHERE abstract_id = '$abstract_id'"; 
	mysql_query($query2) or die(mysql_error());
	

	
	//Print confirmation
	
	echo "<br /><br /><br />" . 
			 "<div class='statusbox'>" . 
			 "<p>Thank you. Your review has successfully been submitted." .
			 "<p><a href='list.php'>Return " . $home_title . "</a></p>" .
			 "</div>". 
			 "<br /><br /><br />";
		
			 
	//Include footer template
	include('footer.php'); 


?>
