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
		
		//Capture form fields to variables
		$abstract_id = $_POST['abstract_id'];
		$title=$_POST['title'];
		$author1=$_POST['author1'];
		$organization1=$_POST['organization1'];
		$author2=$_POST['author2'];
		$organization2=$_POST['organization2'];
		$author3=$_POST['author3'];
		$organization3=$_POST['organization3'];
		$author4=$_POST['author4'];
		$organization4=$_POST['organization4'];
		$author5=$_POST['author5'];
		$organization5=$_POST['organization5'];
		$author6=$_POST['author6'];
		$organization6=$_POST['organization6'];
		$format=$_POST['format'];
		$language=$_POST['language'];
		$presenter=$_POST['presenter'];
		$topic=$_POST['topic'];
		$country=$_POST['country'];
		$background=$_POST['background'];
		$purpose=$_POST['purpose'];
		$methods=$_POST['methods'];
		$findings=$_POST['findings'];
		$conclusion=$_POST['conclusion'];
		$name=$_POST['name'];
		$email1=$_POST['email1'];
		$email2=$_POST['email2'];
		$phone1=$_POST['phone1'];
		$phone2=$_POST['phone2'];
		$fax=$_POST['fax'];
		$address=$_POST['address'];
		
		$last_edit = date("F j, Y, g:i a");
		
		
		//Database Connection Variables
		include('db.php');
		
		//Connect to database
		mysql_connect($host,$username,$password);
		@mysql_select_db($database) or die( "Unable to select database");
		
		//Update details for this user
		$query = "UPDATE abstracts SET " . 
				 "title='$title', " . 
				 "author1='$author1', organization1='$organization1', " .
				 "author2='$author2', organization2='$organization2', " . 
				 "author3='$author3', organization3='$organization3', " . 
				 "author4='$author4', organization4='$organization4', " . 
				 "author5='$author5', organization5='$organization5', " . 
				 "author6='$author6', organization6='$organization6', " . 
				 "format='$format', language='$language', presenter='$presenter', topic='$topic', country='$country', " .
				 "background='$background', purpose='$purpose', methods='$methods', findings='$findings', conclusion='$conclusion', " . 
				 "name='$name', email1='$email1', email2='$email2', phone1='$phone1', phone2='$phone2', fax='$fax', address='$address', " .
				 "last_edit='$last_edit' " . 
				 "WHERE abstract_id = '$abstract_id'";
		mysql_query($query) or die(mysql_error());
		
		//Close database
		mysql_close();
		
	
		//Print confirmation
		
		echo "<br /><br /><br />" . 
				 "<div class='statusbox'>" . 
				 "<p>Abstract ID '" . $abstract_id . "' has been successfully edited.</p>" . 
				 "<p><a href='list.php'>Return " . $home_title . "</a></p>" .
				 "</div>". 
				 "<br /><br /><br />";
	
	}//end if
			 
	//Include footer template
	include('footer.php'); 


?>