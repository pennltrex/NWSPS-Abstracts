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
		
	
		$filter = $_GET['q'];
		$filter_s = $_GET['r'];
	
		
		if ($filter_s) {
			if ($filter_s == "yes")
				$query3 = "SELECT email1, email2 FROM abstracts WHERE master_status = '" . $filter . "' AND scholarship = 'on' ORDER BY abstract_id DESC";
			else
				$query3 = "SELECT email1, email2 FROM abstracts WHERE master_status = '" . $filter . "' AND scholarship != 'on' ORDER BY abstract_id DESC";									
		}
		else 
			$query3 = "SELECT email1, email2 FROM abstracts WHERE master_status = '" . $filter . "' ORDER BY abstract_id DESC";	

				
		$result = mysql_query($query3);
		$num = mysql_numrows($result);
		$num_abstracts = $num;
		
		echo "<div style='float:right'>";
		echo "<a href='#emails_container' onclick='hide(\"emails_container\");'>x</a>";
		echo "</div>"; 
		
		echo "The following abstracts have been set with a Status of <strong>'" . $filter . "";
		if ($filter_s == "yes") echo " w/scholarship";
		echo "'</strong>.<br /><br />";
		
		echo "<blockquote style='line-height:15px;'>";
		
		$i=0;
		while ($i < $num) {
		
			$email1=mysql_result($result,$i,"email1");
			$email2=mysql_result($result,$i,"email2");
					
			if ($email1) echo $email1 . ", ";
			if ($email2) echo $email2 . ", ";
		
			$i++;
		
		} //end while loop
		
		echo "</blockquote>";
		
		
		//Close database
		mysql_close();
	
?>