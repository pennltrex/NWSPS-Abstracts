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
		$abstract_id	= $_POST['abstract_id'];
		$master_status	= $_POST['master_status'];
		$scholarship	= $_POST['scholarship'];
		
		
		//Database Connection Variables
		include('db.php');
		
		//Connect to database
		mysql_connect($host,$username,$password);
		@mysql_select_db($database) or die( "Unable to select database");
		
		//Update details for this abstract
		$query = "UPDATE abstracts SET master_status='$master_status', scholarship='$scholarship' WHERE abstract_id = '$abstract_id'";
		mysql_query($query) or die(mysql_error());
		
		//Close database
		mysql_close();
		
		
			
		//Print confirmation
		
		$goback_abstract = 	"<form method='post' action='detail.php' name='goback_abstract_form' id='goback_abstract_form'>" . 
								"<input type='hidden' id='abstract_id' name='abstract_id' value='" . $abstract_id . "' />" . 
								"<a href='list.php'>Return " . $home_title . "</a> | " .
								"<a href='#' onclick='javascript:document.goback_abstract_form.submit();'>Return to abstract</a>" .
							"</form>";
	
	
	
		echo "<br /><br /><br />" . 
				 "<div class='statusbox'>" . 
				 "<p>The status for Abstract " . $abstract_id . " has been set to " . $master_status . ".</p>" . 
				 $goback_abstract .
				 "</div>". 
				 "<br /><br /><br />";
			 
	} //if admin
			 
	//Include footer template
	include('footer.php'); 


?>
