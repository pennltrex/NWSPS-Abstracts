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

		//Output breadcrumbs
		echo "<div class='breadcrumbs'><a href='list.php'>" . $home_title . "</a> /<a href='list_users.php'>" . $user_mgmt_title . "</a> / " .
			 $add_user_title . "</div>";

?>

		<div class="leftcol">

        	<h1><?php echo $add_user_title; ?></h1>
    
            <p>You can create users for the system here.</p>
            <br />
            
            <form method="post" action="create_user_process.php" class="aform">
                <label for "login">Login</label><input type="text" id="login" name="login" size="30" /><br />
                <label for "password">Password</label><input type="text" id="pw" name="pw" size="30" /><br />
                <label for "name">Name</label><input type="text" id="name" name="name" size="30" /><br />
                <label for "email">E-mail</label><input type="text" id="email" name="email" size="30" /><br />
                <label for "role">Role</label><select id="role" name="role"><option>USER</option><option>ADMIN</option></select><br /><br />
                <label for "submit">&nbsp;</label><input type="submit" value="Create User" name="submit" />
            </form>
        
        </div>
        
        <div class="rightcol">
        	
            <h2>Adding Users</h2>
	        <p>An e-mail will automatically be generated and sent to the e-mail address specified, with login information.</p>
            <p style="font-weight:bold;">Roles</p>
            <p>Admins have the ability to assign abstracts for review, edit and delete abstracts, and set master status.</p>
            <p>Users can only view and rate the abstracts assigned to them.</p>
        
        </div>
        
        <div class="breaker">&nbsp;</div>
        

<?php

	}//if admin
	
	//Include footer template
	include('footer.php');
?>