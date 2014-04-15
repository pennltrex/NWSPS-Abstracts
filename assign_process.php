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
		$abstract_id=$_POST['abstract_id'];
		$user_id = $_POST['user_id'];
		
		
		//Database Connection Variables
		include('db.php');
		
		
		//Connect to database
		mysql_connect($host,$username,$password);
		@mysql_select_db($database) or die( "Unable to select database");
		
		
		//Add assignment to database
		$query = "INSERT INTO reviews VALUES ('', '$abstract_id', '$user_id', 'Assigned', '', '', '', '') ";
		mysql_query($query) or die(mysql_error()); 
		
		
		//Find e-mail address for assignee
		$query2 = "SELECT email FROM users WHERE user_id = '$user_id'";
		$result = mysql_query($query2);
		
		$email = mysql_result($result,0,"email");
		
		
		//Close database
		mysql_close();
		
		
		//Send e-mail to assignee
		$to = $email;
		$subject = "Abstract Review Assignment: " . $abstract_id;
		$body = $site_title . "\n\n" . 
				"Abstract " . $abstract_id . " has been assigned for your review.\n\n" . 
				"Please complete the review online at " . $site_url . 
				"\n\nThank you for your participation!";
		
		$from = $site_email;
		$headers = "From: $from";
		
		mail($to, $subject, $body, $headers);
		
		
		
		//Print confirmation
		
		$goback_abstract = 	"<form method='post' action='detail.php' name='goback_abstract_form' id='goback_abstract_form'>" . 
								"<input type='hidden' id='abstract_id' name='abstract_id' value='" . $abstract_id . "' />" . 
								"<a href='list.php'>Return " . $home_title . "</a> | " .
								"<a href='#' onclick='javascript:document.goback_abstract_form.submit();'>Return to abstract</a>" .
							"</form>";
				
		echo "<br /><br /><br />" . 
				 "<div class='statusbox'>" . 
				 "<p>Abstract ID #" . $abstract_id . " has been successfully assigned.</p>" . 
 				 $goback_abstract .
				 "</div>". 
				 "<br /><br /><br />";
	
	}//if admin			 
			 
	//Include footer template
	include('footer.php'); 

?>
