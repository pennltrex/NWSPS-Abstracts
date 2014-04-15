<?php
/********************************************************
 *
 *	phpAbstracts
 *  http://www.phpabstracts.com
 *
 *  For copyright and license information, see readme.txt
 *
*********************************************************/



	include('header.php');
	
	if ($admin) {
		
		//Database Connection Variables
		include('db.php');
	
		//Connect to database	
		mysql_connect($host,$username,$password);
		@mysql_select_db($database) or die( "Unable to select database");
		
		$review_id = $_GET['x'];
		$abstract_id = $_GET['y'];
		
		$query = "DELETE FROM reviews WHERE review_id = $review_id";
		mysql_query($query) or die(mysql_error()); 
		mysql_close();
	
		
		//Print confirmation
		
		$goback_abstract = 	"<form method='post' action='detail.php' name='goback_abstract_form' id='goback_abstract_form'>" . 
								"<input type='hidden' id='abstract_id' name='abstract_id' value='" . $abstract_id . "' />" . 
								"<a href='list.php'>Return " . $home_title . "</a> | " .
								"<a href='#' onclick='javascript:document.goback_abstract_form.submit();'>Return to abstract</a>" .
							"</form>";
							
		echo "<br /><br /><br />" . 
			 "<div class='statusbox'>" . 
			 "<p>This assignment has been successfully removed.</p>" . 
			 $goback_abstract .
			 "</div>". 
			 "<br /><br /><br />";
	
	}
	
	include('footer.php');

?>