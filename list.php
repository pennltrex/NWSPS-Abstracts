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

	
	//Grab user_id cookie	
	$user_id = $_COOKIE["user_id"];
		
	
	//Check to see if a filter was selected
	if ($_GET['by']) {
		$filter = $_GET['by'];
		$filter_s = $_GET['s'];
	}
	if ($_GET['s']) {
		$filter_s = $_GET['s'];
	}
		
	
	//Database Connection Variables
	include('db.php');

	//Connect to database	
	mysql_connect($host,$username,$password);
	@mysql_select_db($database) or die( "Unable to select database");
	
	
	//Create view selecting all abstract IDs assigned to current user
	$query2 = "CREATE OR REPLACE VIEW abstracts_view AS SELECT abstract_id FROM reviews WHERE user_id='$user_id'";
	mysql_query($query2) or die(mysql_error()); 
	
	
	//Select all abstracts from the view, but if admin is logged in, just select all abstracts
	if ($admin) {
		if ($filter) {
			if ($filter_s) {
				if ($filter_s == "yes")
					$query3 = "SELECT * FROM abstracts WHERE master_status = '" . $filter . "' AND scholarship = 'on' ORDER BY abstract_id DESC";
				else
					$query3 = "SELECT * FROM abstracts WHERE master_status = '" . $filter . "' AND scholarship != 'on' ORDER BY abstract_id DESC";									
			}
			else 
				$query3 = "SELECT * FROM abstracts WHERE master_status = '" . $filter . "' ORDER BY abstract_id DESC";	
		}
		else    $query3 = "SELECT * FROM abstracts ORDER BY abstract_id DESC";
	}
	else {
		$query3 = "SELECT * FROM abstracts INNER JOIN abstracts_view WHERE abstracts.abstract_id = abstracts_view.abstract_id " .
			  "ORDER BY abstracts.abstract_id DESC";
	}		  
	
	$result = mysql_query($query3);
	$num = mysql_numrows($result);
	$num_abstracts = $num;
	
	
	//Output breadcrumbs
	echo "<div class='breadcrumbs'>" . $home_title . " /</div>";
	
	//Output filters icon and user management icon
	if ($admin) {
		echo "<div style='float:right;'>" . 
			 "<img src='images/user.png' style='vertical-align:middle;'> " .
			 "<a href='list_users.php'>User Management</a>" . 
			 "&nbsp;&nbsp; | &nbsp;&nbsp;" .
			 "<img src='images/filters.png' style='vertical-align:middle;'> " . 
			 "<a href='#' onClick='show(\"filters\");'>Status Filters</a>" . 
			 "</div>";
	}
	
	//Output header
	echo "<h1>List of Abstracts</h1>";
	
	//Output filter list
	if ($admin) {
		if ($filter) 
			echo "<div id='filters' style='display:block;visibility:visible;'>";
		else
			echo "<div id='filters'>";
		
		echo "<div style='float:right'><a href='#' onClick='hide(\"filters\");'>x</a></div>";
		
				
		echo "<div class='master_column'><br />";
		if ($filter != "") echo "<a href='list.php'>All</a><br />";
			else echo "<strong>All</strong><br />";
		if ($filter != "Unfiled") echo "<a href='list.php?by=Unfiled&s=no'>Unfiled</a><br />";
			else echo "<strong>Unfiled</strong><br />";
		if ($filter !="Rejected") echo "<a href='list.php?by=Rejected&s=no'>Rejected</a>";
			else echo "<strong>Rejected</strong>";
		echo "</div>";	
		
		echo "<div class='master_column'>";	
		echo "[ all ]<br />";
		if (($filter == "Poster") && (!$filter_s)) echo "<strong>Poster</strong><br />";
			else echo "<a href='list.php?by=Poster'>Poster</a><br />";
		if (($filter == "Panel") && (!$filter_s)) echo "<strong>Panel</strong><br />";
			else echo "<a href='list.php?by=Panel'>Panel</a><br />";		
		if (($filter == "Roundtable") && (!$filter_s)) echo "<strong>Roundtable</strong>";
			else echo "<a href='list.php?by=Roundtable'>Roundtable</a>";		
		echo "</div>";
		
		echo "<div class='master_column'>";
		echo "[ with scholarship ]<br />";
		if (($filter == "Poster") && ($filter_s == "yes")) echo "<strong>Poster</strong><br />";
			else echo "<a href='list.php?by=Poster&s=yes'>Poster</a><br />";
		if (($filter == "Panel") && ($filter_s == "yes")) echo "<strong>Panel</strong><br />";
			else echo "<a href='list.php?by=Panel&s=yes'>Panel</a><br />";		
		if (($filter == "Roundtable") && ($filter_s == "yes")) echo "<strong>Roundtable</strong>";
			else echo "<a href='list.php?by=Roundtable&s=yes'>Roundtable</a>";
		echo "</div>";	
		
		echo "<div class='master_column'>";
		echo "[ without scholarship ]<br />";
		if (($filter == "Poster") && ($filter_s == "no")) echo "<strong>Poster</strong><br />";
			else echo "<a href='list.php?by=Poster&s=no'>Poster</a><br />";
		if (($filter == "Panel") && ($filter_s == "no")) echo "<strong>Panel</strong><br />";
			else echo "<a href='list.php?by=Panel&s=no'>Panel</a><br />";		
		if (($filter == "Roundtable") && ($filter_s == "no")) echo "<strong>Roundtable</strong>";
			else echo "<a href='list.php?by=Roundtable&s=no'>Roundtable</a>";
		echo "</div>";	
			
		echo "<div style='clear:both;'>&nbsp;</div>";	
		echo "</div>";
		echo "<br />";
	}
	
	
	
	//Output table headers
	echo "<table class='sortable' style='width:875px;' align='center'><thead><tr><th>ID</th><th>Title</th><th>Organization</th>";
	if ($admin) {
		echo "<th width='25'><img src='images/checkmark.gif' style='border:0px;' alt='Accepted' /></th>" . 
			 "<th width='25'><img src='images/check_x.gif' style='border:0px;' alt='Rejected' /></th>";
	}
	echo "<th>Status</th><th class='sorttable_nosort'>&nbsp;</th>";
	echo "</tr></thead>";
	
	
	//Output table body
	echo "<tbody>";
	
	$i=0;
	while ($i < $num) {
	
		$abstract_id=mysql_result($result,$i,"abstract_id");
		$date=mysql_result($result,$i,"date");
		$title=mysql_result($result,$i,"title");
		$length=mysql_result($result,$i,"length");
		//$author1=mysql_result($result,$i,"author1");
		$clinic=mysql_result($result,$i,"clinic");
		$city=mysql_result($result,$i,"city");
		$state=mysql_result($result,$i,"state");
		//$topic = mysql_result($result,$i,"topic");
		//$country = mysql_result($result,$i,"country");
		$master_status = mysql_result($result,$i,"master_status");
		$scholarship = mysql_result($result,$i,"scholarship");
				
		//search for reviews for this abstract if admin is logged in
		if ($admin) {
			$query5 = "SELECT * FROM reviews WHERE abstract_id='$abstract_id'";
			$result5 = mysql_query($query5);
			$num5 = mysql_numrows($result5);
			
			$accept = 0;
			$reject = 0;
			
			//calculate number of accepted and rejected
			$j=0;
			while ($j < $num5) {
				if ((mysql_result($result5,$j,"recommendation") == "Panel") || 
					(mysql_result($result5,$j,"recommendation") == "Poster") || 
					(mysql_result($result5,$j,"recommendation") == "Roundtable")) {
					$accept = $accept + 1;
				}
				elseif (mysql_result($result5,$j,"recommendation") == "Reject") {
					$reject = $reject + 1;
				}
			$j++;
			}
			
			//calculate status based on criteria (-- DISABLED --)
			/*if ($num5 < 3) $status = "Unassigned";	
			elseif (($accept > 2) && ($reject == 0)) $status = "Accepted";
			elseif (($accept == 0) && ($reject > 2)) $status = "Rejected";
			elseif ($accept + $reject < 3) $status = "Assigned";
			else $status = "TBD";*/
			
			
			//MASTER STATUS UPDATE
			$status = $master_status;
			if ($scholarship == "on") $status = $status . " w/sch.";
			
			
			//set outputs for admin	
			$view = "View";	
		}
		
		//if admin is not logged in
		else { 
			//check if user has completed this abstract
			$user_id = $_COOKIE["user_id"];
			$query6 = "SELECT * FROM reviews WHERE abstract_id='$abstract_id' AND user_id='$user_id'";
			$result6 = mysql_query($query6);
			$status = mysql_result($result6,0,"status");

			//set output for user with big blue REVIEW button
			if ($status == "Assigned")
				$view = "Review";
			else
				$view = "View";
		}
		
		$view = "<form method='post' action='detail.php' id='detail_form'>" . 
				"<input type='hidden' id='abstract_id' name='abstract_id' value='" . $abstract_id . "' />" . 
				"<input type='submit' value='" . $view . "' class='detail_" . $view . "' />" . 
				"</form>";
		
		
		//Output data for table
		echo "<tr><td>" . $abstract_id. "</td><td>" . $title . "<div class='small'>" . $date . "</div></td>";
		
		if ($admin) echo "<td>" . $clinic . "<div class='small'>" . $city . ", " . $state . "</td>" . 
					     "<td>" .$accept . "</td><td>" . $reject; "</td>";
		
		echo "<td>" . $status . "</td><td>" . $view . "</td></tr>";
		
		$i++;
	
	} //end while loop
	
	
	//End table
	echo "</tbody></table>";
	echo "<br /><p>Hint: You can sort by clicking on the column headers.</p>";
	if ($admin) echo "<p>Number of Abstracts: " . $num_abstracts;
	
	//List e-mails
	if ($admin && $filter) {
		echo " | <script src='js/list_emails.js'></script>";
		echo "<a href='#emails_container' onclick='showemails(\"" . $filter . "\", \"" . $filter_s . "\");'>Click here</a> to show e-mail addresses.</p>";
		echo "<div id='emails_container' style='padding:10px;'>&nbsp;</div>";
	}
	
	
	//Close database
	mysql_close();
	
	
	//Include footer template
	include('footer.php');
?>