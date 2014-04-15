<?php 
/********************************************************
 *
 *	phpAbstracts
 *  http://www.phpabstracts.com
 *
 *  For copyright and license information, see readme.txt
 *
*********************************************************/



	
	// If form was submitted
	if ($_POST['DBHost']) 
	{
		//If admin variables were submitted
		if ($_POST['admin_user'] && $_POST['admin_email'] && $_POST['admin_pass']) 
		{
			// Check that their config file is writable
			if(is_writable('db.php'))
			{
				// Test the connection
				if(@mysql_connect($_POST['DBHost'], $_POST['DBUser'], $_POST['DBPass']))
				{
					if(@mysql_select_db($_POST['DBName']))
					{
						$status = "Success";
										
								// Content that will be written to the config file
								$content = "<?php\n";
								$content.= "\$host = '".addslashes($_POST['DBHost'])."';\n";
								$content.= "\$database = '".addslashes($_POST['DBName'])."';\n";
								$content.= "\$username = '".addslashes($_POST['DBUser'])."';\n";
								$content.= "\$password = '".addslashes($_POST['DBPass'])."';\n";
								$content.= "\n";
								$content.= "?>";
							
								// Open the includes/config.php for writting
								$handle = fopen('db.php', 'w');
								// Write the config file
								fwrite($handle, $content);
								// Close the file
								fclose($handle);
	
mysql_query("CREATE TABLE `abstracts` ( 
	`abstract_id` int(11) NOT NULL auto_increment, 
	`date` varchar(40) NOT NULL default '', 
	`name` varchar(100) NOT NULL default 'none', 
	`clinic` varchar(100) NOT NULL default 'none',
	`address` varchar(100) NOT NULL default 'none',
	`city` varchar(100) NOT NULL default 'none',
	`state` char(2) NOT NULL default '',
	`zip` varchar(10) NOT NULL default 'none',
	`email` varchar(60) NOT NULL default 'none',
	`phone` varchar(30) NOT NULL default 'none',
	`title` varchar(255) NOT NULL default 'none', 
	`length` varchar(20) NOT NULL default 'none', 
	`summary` text NOT NULL, 
	`gap` text NOT NULL, 
	`need` text NOT NULL, 
	`change` text NOT NULL, 
	`presentation` varchar(80) NOT NULL default 'none', 
	`disclosure` varchar(80) NOT NULL default 'none', 
	`word_count` int(3) NOT NULL default '0', 
	`master_status` varchar(40) NOT NULL default 'Unfiled', 
	`scholarship` varchar(20) NOT NULL, 
	`last_edit` varchar(50) NOT NULL, 
	PRIMARY KEY  (`abstract_id`)
	) 
ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1418 ;");			
								
								mysql_query("CREATE TABLE `reviews` (  `review_id` int(11) NOT NULL auto_increment,  `abstract_id` int(11) NOT NULL default '0',  `user_id` int(11) NOT NULL default '0',  `status` varchar(20) NOT NULL,  `relevance` varchar(15) NOT NULL default '0',  `quality` varchar(15) NOT NULL default '0',  `comments` text NOT NULL,  `recommendation` varchar(25) NOT NULL,  PRIMARY KEY  (`review_id`)) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=749 ;");

								mysql_query("CREATE TABLE `users` (  `user_id` int(11) NOT NULL auto_increment,  `login` varchar(40) NOT NULL default '',  `password` varchar(40) NOT NULL default '',  `name` varchar(75) NOT NULL default '',  `email` varchar(40) NOT NULL default '',  `role` varchar(10) NOT NULL default '',  PRIMARY KEY  (`user_id`)) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=62 ;");
								
								mysql_query("CREATE TABLE `disclosure` (
	`disclosure_id` int(11) NOT NULL auto_increment,
	`activity` varchar(100) NOT NULL default '',
	`activity_date` varchar(40) NOT NULL default '',
	`activity_role` varchar(90) NOT NULL default '',
	`interest` int(1) NOT NULL default '',
	`commercial_prod` int(1) NOT NULL default '',
	`signature` varchar(80) NOT NULL default '',
	`sig_date` varchar(40) NOT NULL default ''
	PRIMARY KEY (`disclosure_id`)
	)
ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;");
								
								mysql_query("CREATE TABLE `interest` (
	`interest_id` int(11) NOT NULL auto_increment,
	`disclosure_id` int(11) NOT NULL,
	`interest` varchar(100) NOT NULL default '',
	`compensation` varchar(100) NOT NULL default '',
	`role` text NOT NULL default '',
	PRIMARY KEY (`interest_id`)
	FOREIGN KEY (disclosure_id) REFERENCES disclosure (disclosure_id)
	)
ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;");
								
								mysql_query("CREATE TABLE `commercial_product` (
	`commercial_prod_id` int(11) NOT NULL auto_increment,
	`disclosure_id` int(11) NOT NULL,
	`product` varchar(120) NOT NULL default '',
	`description` text NOT NULL default '',
	PRIMARY KEY (`commerical_prod_id`)
	FOREIGN KEY (disclosure_id) REFERENCES disclosure (disclosure_id)
	)
ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;");
								
								mysql_query("INSERT INTO `users` VALUES (1, '".addslashes($_POST['admin_user'])."', '" . 
									addslashes($_POST['admin_pass']) . "', 'Administrator', '" . 
									addslashes($_POST['admin_email']) . "', 'ADMIN');");
									
								$status = "Complete!";
					}//dbname
					else 
						$status = "This database does not exist.";
				}//dbhost etc
				else 
					$status = "Connection failed.";
			}//writable
			else 
				$status = "The file db.php is not writable.";
		}//If admin variables
		else
			$status = "Please enter an admin user";
	}//If form was submitted
		
		
			
?>





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">


<head>

    <title><?php echo $site_title; ?></title>
    <link href="css/abstracts.css" rel="stylesheet" type="text/css" />
    
</head>


<body>
    
    <div id="header" class="top_container">
        <img src="<?php echo $site_logo ?>">
    </div>
    
            
    <div class="centering_container" id="main_container" >

        <div class="leftcol">
        
        <h1>Setup</h1>
        
        <? 
			if ($status) 
				echo "<div class='status'>" . $status . "</div>";
							
			if ($status == "Complete!") {
				echo "<p>Your system is now properly setup. You may <a href='login.php'>login</a> to begin using it.</p>";
			}
			else {
					
        
		?>
        
        
        
        <p style="width:420px;">Please fill in your database connection variables below.</p>       
        
        <form method="post" action="setup.php" class="aform">
        
            <label for "DBHost">Database Host</label>
            	<input type="text" id="DBHost" name="DBHost" size="30" /><br />
            <label for "DBUser">Database Username</label>
            	<input type="text" id="DBUser" name="DBUser" size="30" /><br />
            <label for "DBPass">Database Password</label>
            	<input type="text" id="DBPass" name="DBPass" size="30" /><br />
 
        	<p style="width:420px;">Type in the name of your database (this must already exist).</p>
       
            <label for "DBName">Database Name</label>
            	<input type="text" id="DBName" name="DBName" size="30" /><br /> 
                
       	 	<p style="width:420px;">You must also create an master admin user.<br />Please enter this information below, and save for your records.</p>
       
            <label for "admin_user">Admin User</label>
            	<input type="text" id="admin_user" name="admin_user" size="30" /><br />     
            <label for "admin_pass">Admin Password</label>
            	<input type="text" id="admin_pass" name="admin_pass" size="30" /><br />
            <label for "admin_email">Admin Email</label>
            	<input type="text" id="admin_email" name="admin_email" size="30" /><br />            
       
            <br /><br  />
            
            <label>&nbsp;</label>
            	<input type="submit" value="Submit" />
        
        </form>

		<?php
				}//end else
		?>
        </div>
    
    
    	<div class="rightcol">
        	<h2>Initial Setup</h2>
            <p>Welcome to phpAbstracts.</p>
            <p>Using this form, you will be able to automatically setup your database
            for use with this system.</p>
            <p style="font-weight:bold;">Before you begin</p>
            <p>You must manually create an empty database before you run this script!</p>
            <p> Please create an empty database 
	           (for example: through your web host or by using phpMyAdmin), and then then type in the name of the database where specified.</p>
        </div>
        
        <div class="breaker">&nbsp;</div>
        
    </div>
    
    <div class="footer" style="margin-top:10px;">Powered by <a href="http://www.phpabstracts.com">phpAbstracts</a>, licensed under the GNU GPL.</div>
    
    

</body>


</html>














