<?php
	
	// Check to see if user is logged in. If so, redirect to list page.
	if (isset($_COOKIE["user"])) 
		header( 'Location: list.php' );

	//Include commonly used variables
	include('vars.php');
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<!--
/************************************************************************
 *
 *  phpAbstracts
 *  http://www.phpabstracts.com
 *
 *  Copyright (c) 2008 Omar Qazi
 *
 *  phpAbstracts is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  phpAbstracts is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with phpAbstracts.  If not, see <http://www.gnu.org/licenses/>. 
 *
************************************************************************/
-->

<head>

    <title><?php echo $site_title; ?></title>
    <link href="css/abstracts.css" rel="stylesheet" type="text/css" />
 
</head>


<body>

    <div style="text-align:center;padding:20px;">
        <img src="<?php echo $site_logo ?>" />
    </div>
            
    <div class="centering_container" id="main_container" style="width:700px;">

        <div class="leftcol" style="width:420px;">
    
    		<h1><?php echo $site_title; ?></h1>
            
            <p>This is a password-protected system. Please log in below.</p>
			<?php
                if ($_GET['x']) {
                    echo "<div class='status'>Incorrect Login. Please try again.</div><br />";
                }
            ?>
            <br />
            <form method="post" action="login_process.php" class="aform">
                <label for "login" style="width:65px;">Login</label>
                    <input type="text" id="login" name="login" size="40" /><br />
                <label for "pw" style="width:65px;">Password</label>
                    <input type="password" id="pw" name="pw" size="40" /><br />
                <label style="width:65px;">&nbsp;</label>
                    <input type="submit" value="Login" />
            </form>
            <br /><br /><br /><br /><br />
    	</div>
    
    
    	<div class="rightcol">
                
            <h2>Log In</h2>
            <p>This is a password-protected system. If you do not have a login, please request one from your Administrator.</p>
            <p>This system is powered by phpAbstracts, a free online abstract submission and management program, licensed under the GNU GPL.</p>
        
        </div>
            
    	<div class="breaker">&nbsp;</div>
       
    </div>
   
    <div class="footer" style="margin-top:10px;">Powered by <a href="http://www.phpabstracts.com">phpAbstracts</a>, licensed under the GNU GPL.</div>

</body>


</html>