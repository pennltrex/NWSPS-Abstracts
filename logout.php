<?php 
/********************************************************
 *
 *	phpAbstracts
 *  http://www.phpabstracts.com
 *
 *  For copyright and license information, see readme.txt
 *
*********************************************************/



	// set the expiration date to one hour ago
	setcookie("user", "", time()-3600);
	header( 'Location: login.php' );

?>