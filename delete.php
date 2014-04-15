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
	
		//Database Connection Variables
		include('db.php');
		
		//Connect to database
		mysql_connect($host,$username,$password);
		@mysql_select_db($database) or die( "Unable to select database");
		
		
		//Grab id of abstract to be deleted
		$abstract_id = $_POST['abstract_id'];
		
		
		//Delete abstract from database
		$query = "DELETE FROM abstracts WHERE abstract_id = $abstract_id";
		mysql_query($query) or die(mysql_error()); 
		
		$query2 = "DELETE FROM reviews WHERE abstract_id = $abstract_id";
		mysql_query($query2) or die(mysql_error()); 
		
		mysql_close();
		
		
		//Print confirmation
		echo "<br /><br /><br />" . 
			 "<div class='statusbox'>" . 
			 "<p>Abstract #" . $abstract_id . " has been successfully deleted.</p>" . 
			 "<p><a href='list.php'>Return " . $home_title . "</a></p>" .
			 "</div>". 
			 "<br /><br /><br />";	
	
	}//if admin


	//Include footer template
	include('footer.php');
?>