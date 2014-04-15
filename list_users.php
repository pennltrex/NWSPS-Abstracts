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
		
		//Select all users	
		$query2 = "SELECT * FROM users ORDER BY user_id DESC";
		$result = mysql_query($query2);
		$num = mysql_numrows($result);
		
		//Output breadcrumbs
		echo "<div class='breadcrumbs'><a href='list.php'>" . $home_title . "</a> /" . $user_mgmt_title . "</div>";
		
		//Output add new user
		echo "<div style='float:right'><img src='images/add.png' style='vertical-align:middle'> " . 
			 "<a href='create_user.php'>" . $add_user_title . "</a></div>";
		
		//Output page title
		echo "<h1>User Management</h1>";
		echo "<br />";
		
		//Output table headers
		echo "<table class='sortable' style='width:875px;' align='center'>" . 
			 "<thead><tr><th>ID</th><th>Login / Password</th><th>Name / Email</th><th>Role</th><th>Assigned</th><th>Completed</th>" . 
			 "<th>Pending</th><th class='sorttable_nosort'>&nbsp</th></tr></thead>";
		
		//Output table body
		echo "<tbody>";
		
		$i=0;
		while ($i < $num) {
		
			$user_id	= mysql_result($result, $i, "user_id");
			$login		= mysql_result($result, $i, "login");
			$password	= mysql_result($result, $i, "password");
			$name		= mysql_result($result, $i, "name");
			$email		= mysql_result($result, $i, "email");
			$role 		= mysql_result($result, $i, "role");
						
			$query3 = "SELECT * FROM reviews WHERE user_id = '$user_id'";
			$query4 = "SELECT * FROM reviews WHERE user_id = '$user_id' AND status = 'Complete'";
			$result3 = mysql_query($query3);
			$result4 = mysql_query($query4);
			$num3 = mysql_numrows($result3);
			$num4 = mysql_numrows($result4);
			
			echo "<tr><td>" . $user_id. "</td><td>" . $login . "<div class='small'>Password: " . $password . "</div></td><td> " .
				 $name . "<div class='small'>" . $email . "</div></td><td>" . $role . "</td><td>" . $num3 . "</td><td>" . $num4 . 
				 "</td><td>" . ($num3 - $num4) . "</td><td style='text-align:center;'>" . "<a href='edit_user.php?x=" . $user_id . "'>Edit</a></td></tr>";
			
			$i++;
		}
		
		echo "</tbody></table>";
	
		//Close database
		mysql_close();
	
	}
	
	
	
	//Include footer template
	include('footer.php');

?>
