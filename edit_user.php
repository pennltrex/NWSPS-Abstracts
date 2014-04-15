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
	
		//Grab user_id passed in
		$user_id = $_GET['x'];
	
		//Database Connection Variables
		include('db.php');
		
		//Connect to database	
		mysql_connect($host,$username,$password);
		@mysql_select_db($database) or die( "Unable to select database");
		
		//Select all users	
		$query = "SELECT * FROM users WHERE user_id = '$user_id'";
		$result = mysql_query($query);
		
		$user_id	= mysql_result($result, 0, "user_id");
		$login		= mysql_result($result, 0, "login");
		$password	= mysql_result($result, 0, "password");
		$name		= mysql_result($result, 0, "name");
		$email		= mysql_result($result, 0, "email");
		$role 		= mysql_result($result, 0, "role");
		
		//Close database
		mysql_close();
		
		//Output breadcrumbs
		echo "<div class='breadcrumbs'><a href='list.php'>" . $home_title . "</a> /<a href='list_users.php'>" . $user_mgmt_title . "</a> / " .
			 $edit_user_title . "</div>";
			 
?>

		<div class="leftcol">

            <h1><?php echo $edit_user_title; ?></h1>
    
            <p>You can edit users for the system here.</p>
            <br />
            
            <form method="post" action="edit_user_process.php" class="aform">
                <input type="hidden" class="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>" />
                <input type="hidden" class="hidden" name="login" id="login" value="<?php echo $login; ?>" />
                <label for "login2">Login</label>
                    <span id="login2"><?php echo $login; ?></span><br />
                <label for "password">Password</label>
                    <input type="text" id="pw" name="pw" size="30" value="<?php echo $password; ?>" /><br />
                <label for "name">Name</label>
                    <input type="text" id="name" name="name" size="30" value="<?php echo $name; ?>" /><br />
                <label for "email">E-mail</label>
                    <input type="text" id="email" name="email" size="30" value="<?php echo $email; ?>" /><br />
                <label for "role">Role</label>
                    <select id="role" name="role">
                    	<option <?php if ($role == "USER") echo "selected"; ?>>USER</option>
                        <option <?php if ($role == "ADMIN") echo "selected"; ?>>ADMIN</option>
                    </select><br /><br />
                <label for "submit">&nbsp;</label><input type="submit" value="Edit User" name="submit" />
            </form>
        
        </div>
        
        <div class="rightcol">
        	
            <h2>Editing Users</h2>
	        <p>An e-mail will automatically be generated and sent to the e-mail address specified, with the new login information.</p>
            <p style="font-weight:bold;">Roles</p>
            <p>Admins have the ability to assign abstracts for review, edit and delete abstracts, and set master status.</p>
            <p>Users can only view and rate the abstracts assigned to them.</p>
        
        </div>
        
        <div class="breaker">&nbsp;</div>

<?php

	} //end if

	//Include footer template
	include('footer.php');
?>