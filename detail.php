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
	
	//Grab abstract_id passed in
	$abstract_id = $_POST['abstract_id'];
	
	//Output breadcrumbs
	echo "<div class='breadcrumbs'><a href='list.php'>" . $home_title . "</a> /View Abstract " . $abstract_id . "</div>";
	
	//Database Connection Variables
	include('db.php');


	//Connect to database	
	mysql_connect($host,$username,$password);
	@mysql_select_db($database) or die( "Unable to select database");

	
	//Select abstract matching the abstract_id
	$query2 = "SELECT * FROM abstracts WHERE abstract_id = $abstract_id";
	$result = mysql_query($query2);
	$num = mysql_numrows($result);
	
	
	/********************************/
	/*** PRINT ABSTRACT TO SCREEN ***/
	/********************************/
	
	echo "<div id='detail_content' >";
		
	$i=0;
	
	$abstract_id = mysql_result($result,$i,"abstract_id");
	$date = mysql_result($result,$i,"date");
	$title = mysql_result($result,$i,"title");
	$name = mysql_result($result,$i,"name");
    $clinic = mysql_result($result,$i,"clinic");
// 	$author2 = mysql_result($result,$i,"author2");
// 	$organization2 = mysql_result($result,$i,"organization2");
// 	$author3 = mysql_result($result,$i,"author3");
// 	$organization3 = mysql_result($result,$i,"organization3");
// 	$author4 = mysql_result($result,$i,"author4");
// 	$organization4 = mysql_result($result,$i,"organization4");
// 	$author5 = mysql_result($result,$i,"author5");
// 	$organization5 = mysql_result($result,$i,"organization5");
// 	$author6 = mysql_result($result,$i,"author6");
// 	$organization6 = mysql_result($result,$i,"organization6");
// 	$format = mysql_result($result,$i,"format");
// 	$language = mysql_result($result,$i,"language");
// 	$presenter = mysql_result($result,$i,"presenter");
// 	$background = mysql_result($result,$i,"background");
	$summary = mysql_result($result,$i,"summary");
	$gap = mysql_result($result,$i,"gap");
	$need = mysql_result($result,$i,"need");
	$change = mysql_result($result,$i,"change");
	$word_count = mysql_result($result,$i,"word_count");
	$name = mysql_result($result,$i,"name");
	$email = mysql_result($result,$i,"email");
// 	$email2 = mysql_result($result,$i,"email2");
	$phone = mysql_result($result,$i,"phone");
// 	$phone2 = mysql_result($result,$i,"phone2");
// 	$fax = mysql_result($result,$i,"fax");
	$address = mysql_result($result,$i,"address");
	$city = mysql_result($result,$i,"city");
	$state = mysql_result($result,$i,"state");
	$zip = mysql_result($result,$i,"zip");
// 	$country = mysql_result($result,$i,"country");
// 	$topic = mysql_result($result,$i,"topic");
	$master_status = mysql_result($result, $i, "master_status");
	$scholarship = mysql_result($result, $i, "scholarship");
	$last_edit = mysql_result($result, $i, "last_edit");
	
	//Ouput abstract title
	echo " <h1>" . $title . "</h1><br />";
	
	//Output abstract author information
	echo "<div class='author_info_div'>";
		echo "<a href=\"#\" onclick=\"show('author_info');\">Author Information &raquo;</a>";
		echo "<div id='author_info' style='visibility:hidden;display:none;'>";
			echo "<br /><div style='width:45%; float:left;'>";
				echo "Author: " . $name . "<br>Organization 1: " . $clinic;
// 				if ($author2) echo "<br><br>Author 2: " . $author2 . "<br>Organization 2: " . $organization2;
// 				if ($author3) echo "<br><br>Author 3: " . $author3 . "<br>Organization 3: " . $organization3;
// 				if ($author4) echo "<br><br>Author 4: " . $author4 . "<br>Organization 4: " . $organization4;
// 				if ($author5) echo "<br><br>Author 5: " . $author5 . "<br>Organization 5: " . $organization5;
// 				if ($author6) echo "<br><br>Author 6: " . $author6 . "<br>Organization 6: " . $organization6;
			echo "</div>";
			echo "<div style='width:47%; float:right;'>";
				echo "Presentation length: " . $length;
				if ($admin) {
					echo "<br /><br />Name: " . $name . "<br>E-mail: " . $email;
// 					if ($email2) echo "<br>E-mail 2: " . $email2;
					if ($phone1) echo "<br>Phone: " . $phone;
// 					if ($phone2) echo "<br>Cell Phone: " . $phone2;
// 					if ($fax) echo "<br>Fax: " . $fax;
					echo "<br>Address: " . $address . "<br />" . $city . ", " . $state . " " . $zip . "<br /><br />";	
				}
			echo "</div>";	 
			echo "<div style='clear:both;text-align:right;'>" . 
				 "<a href=\"#\" onclick=\"hide('author_info');\">&laquo; Close</a></div>"; 	
		echo "</div>";
		
	echo "</div><br /><br />";
				 
	//Output abstract body
	echo "<div class='midfont'>";
	
	echo "<b>Summary:</b> " . $summary . "<br><br><b>Gap:</b> " .
		$gap . "<br><br><b>Need:</b> " . $need . "<br><br><b>Change:</b> " . $change . 
		"<br /><b>Total Words:</b> " . $word_count;
		
	echo "</div>";
	


	//End detail_content
	echo "</div>"; 
	
	
		
	/*******************************/
	/*** PRINT SIDEBAR FOR ADMIN ***/
	/*******************************/
	
	if ($admin) {
		
		echo "<div class='sidebar'>";
		
		
//////////PRINT MASTER ACCEPT/REJECT FORM

		echo "<div class='header' style='border-top:0px;'>Set Status</div>";
		echo "<p>Set the Status for this abstract below.</p>";
        echo "<div class='indented' style='padding-bottom:10px;'>";
		echo "<form method='post' action='master_status_set.php' name='master_status_form'>";
			
			echo "<input type='hidden' id='abstract_id' name='abstract_id' value='" . $abstract_id . "' />";
			
			echo "<input type='radio' name='master_status' value='Poster'";
				 if ($master_status == "Poster") echo " checked ";
			  	 echo "onclick='javascript:show(\"scholarshipdiv\");' ";
				 echo "/>Poster<br />";	
			echo "<input type='radio' name='master_status' value='Panel'";
				 if ($master_status == "Panel") echo " checked ";
				 echo "onclick='javascript:show(\"scholarshipdiv\");' ";
			  	 echo "/>Panel<br />";
			echo "<input type='radio' name='master_status' value='Roundtable'";
				 if ($master_status == "Roundtable") echo " checked ";
				 echo "onclick='javascript:show(\"scholarshipdiv\");' ";
			  	 echo "/>Roundtable<br />";	  
			echo "<input type='radio' name='master_status' value='Rejected'";
				 if ($master_status == "Rejected") echo " checked ";
				 echo "onclick='javascript:hide(\"scholarshipdiv\"); " . 
					  "document.master_status_form.scholarship.checked=false;' "; 
			  	 echo "/>Rejected<br />";
			echo "<input type='radio' name='master_status' value='Unfiled'";
				 if ($master_status == "Unfiled") echo " checked ";
				 echo "onclick='javascript:hide(\"scholarshipdiv\"); " . 
					  "document.master_status_form.scholarship.checked=false;' "; 
			  	 echo "/>Unfiled<br />";	 
		
		if ($master_status == "Poster" || $master_status == "Panel" || $master_status == "Roundtable")
			echo "<div id='scholarshipdiv'>";
		else echo "<div id='scholarshipdiv' style='visibility:hidden;display:none;'>";
		echo "<br /><input type='checkbox' id='scholarship' name='scholarship'";
			if ($scholarship == "on") echo " checked ";
			echo "/>Scholarship<br />";	
		echo "</div>";		 	 	 
		
		echo "<br /><input type='submit' class='submit' value='Set Status' />";
		echo "</form>";
        echo "</div>";
		
		
		
//////////PRINT EDIT ABSTRACT FORM

		echo "<br />";
		
		echo "<div class='header'>Edit Abstract</div>";
		echo "<div class='indented' style='padding-bottom:10px;'>";
		if ($last_edit) echo "<p>Last Edited On:<br />" . $last_edit . "</p>";
		echo "<form method='post' action='edit_abstract.php' style='display:inline;'>";
			echo "<input type='hidden' id='abstract_id' name='abstract_id' value='" . $abstract_id . "' />";
			echo "<br /><input type='submit' class='submit' value='Edit Abstract' />";
		echo "</form>";
		
		echo "<form method='post' action='delete.php' style='display:inline;' onsubmit='return deleteconfirm(\"" . $abstract_id . "\");'>";
			echo "<input type='hidden' id='abstract_id' name='abstract_id' value='" . $abstract_id . "' />";
			echo " | <input type='submit' class='submit' value='Delete' />";
        echo "</form>";
		
		echo "</div>";
		echo "<br />";
		
		
		
		
//////////PRINT ASSIGNMENTS FORM

		echo "<br /><div class='header'>Assignments</div>";
	
		
		//Select all users and sort by name
		$query2 = "SELECT * FROM users WHERE ROLE='USER' ORDER BY name";
		$result = mysql_query($query2);
		$num = mysql_numrows($result);
		
		echo "<form method='post' action='assign_process.php'>";
		echo "<input type='hidden' id='abstract_id' name='abstract_id' value='" . $abstract_id . "' />";
		
		echo "Assign to:<br />" . 
			 "<select id='user_id' name='user_id' style='width:150px;'>";
		
		//Output user names as OPTIONS for Select Box
		$i=0;
		while ($i < $num) {
			$user_id=mysql_result($result,$i,"user_id");
			$name=mysql_result($result,$i,"name");
			echo "<option value='" . $user_id. "'>" . $name . "</option>";
			$i++;
		}
		
		echo "</select>&nbsp;";
		echo "<input type='submit' class='submit' value='Go' />";
		echo "</form>";
		
			
		
//////////PRINT ASSIGNED USERS

 		//Create view selecting all assigned user_id's
        $query2 = "CREATE OR REPLACE VIEW assigned_users AS SELECT * FROM reviews WHERE abstract_id = '$abstract_id'";
        mysql_query($query2) or die(mysql_error()); 
		
        
		//Match name with assigned user_id's
        $query3 = "SELECT * FROM users INNER JOIN assigned_users WHERE users.user_id = assigned_users.user_id";
        $result = mysql_query($query3);
        $num = mysql_numrows($result);
        
		//Begin output
		echo "<br /><p>Currently assigned to:</p>";
	    echo "<ol>";
		
		//Print assigned viewers to screen
        $i=0;
        while ($i < $num) {
            $name=mysql_result($result,$i,"name");
			$review_id=mysql_result($result,$i,"review_id");
			$status = mysql_result($result,$i,"status");
            echo "<li>" . $name;
			if ($status <> "Complete") {
				echo " <a href='#' onclick='deletereviewer(" . $review_id . ", " . $abstract_id . ")'>Delete</a>";
			}
			echo "</li>";
            $i++;
        }
        
		echo "</ol>";
		
		echo "<br />";
		
//////////PRINT REVIEWS
		
		//Select all the completed reviews for this abstract
		$query5 = "SELECT * FROM reviews WHERE abstract_id='$abstract_id' AND status='Complete'";
		$result5 = mysql_query($query5);
		$num5 = mysql_numrows($result5);
		
		//Begin output of reviews
		if ($num5 > 0) {
		
			//Output title
			echo "<div class='header'>Reviews</div>";
			echo "<div class='overallscore'>Overall Score: <strong><span id='overall_score'>&nbsp;</span></strong> / 3</div>";
			
			//Output reviews
			$k=0;
			while ($k < $num5) {
				$user_id=mysql_result($result5,$k,"user_id");
				
				//Match name of the reviewer to user_id
				$query6 = "SELECT name FROM users WHERE user_id='$user_id'";
				$result6 = mysql_query($query6);
				$num6 = mysql_numrows($result6);
				
				$name=mysql_result($result6,0,"name");
				
				$relevance=mysql_result($result5,$k,"relevance");
				$quality=mysql_result($result5,$k,"quality");
				$recommendation=mysql_result($result5,$k,"recommendation");
				$comments=mysql_result($result5,$k,"comments");
				
				//Change review numbers to words
				switch ($relevance) {
					case 0:
					  $relevance_words = "Poor";
					  break;
					case 1:
					  $relevance_words = "Average";
					  break;
					case 2:
					  $relevance_words = "Good";
					  break;
					case 3:
					  $relevance_words = "Excellent";
					  break;
				}
				switch ($quality) {
					case 0:
					  $quality_words = "Poor";
					  break;
					case 1:
					  $quality_words = "Average";
					  break;
					case 2:
					  $quality_words = "Good";
					  break;
					case 3:
					  $quality_words = "Excellent";
					  break;
				}
				
				//Calculate average
				$average_score = ($relevance + $quality) / 2;
				$average_score = number_format($average_score,1);
				$overall_average = $overall_average + $average_score;
	
				
				//Print review to screen
				echo "<hr class='divider_line' />";
				echo "Average Score: <strong>" . $average_score . "</strong> / 3<br />";
				echo "Relevance: " . $relevance_words . " <span class='small'>(" . $relevance . "/3)</span><br />";
				echo "Quality: " . $quality_words . " <span class='small'>(" . $quality . "/3)</span><br />";
				echo "<br />Recommend: " . $recommendation . "<br />";
				echo "<br />Comments: " . $comments . "<br />";
				echo "<br />Reviewer: " . $name . "<br />";
 
				$k++;
			}
			$overall_average = $overall_average / $num5;
			$overall_average = number_format($overall_average,1);
			
			echo "<script type='text/javascript'> ";
         	echo "document.getElementById('overall_score').innerHTML = '" . $overall_average . "'; ";
    		echo "</script>";
		}//end if for reviews
		
			
		//Close sidebar div (for admin)
		echo "</div><div style='clear:both;'>&nbsp;</div>";
		
	} //end if for admin
	
	
	
	/*******************************/
	/*** PRINT SIDEBAR FOR USERS ***/
	/*******************************/
	
	else {
	
		//Start sidebar
		echo "<div class='sidebar'>";

		
		$user_id = $_COOKIE["user_id"];
		
		//Check if review has been completed
        $query5 = "SELECT * FROM reviews WHERE user_id='$user_id' AND abstract_id='$abstract_id'";
        $result5 = mysql_query($query5);
        
		$status = mysql_result($result5,0,"status");
		$review_id = mysql_result($result5,0,"review_id");
		
		
		//Print header
		echo "<div class='header' style='border-top:0px;'>Submit Review</div>";
		
		//If review has been completed
		if($status == "Complete") {
			echo "You have already completed this review";
		}
		//Otherwise, print review form to screen
		else {
?>
	        <form method="post" id="review_form" name="review_form" action="review_process.php" onsubmit="return validate(this)">
            
                <input type="hidden" id="review_id" name="review_id" value="<?php echo($review_id); ?>" />
                <input type="hidden" id="abstract_id" name="abstract_id" value="<?php echo($abstract_id); ?>" />
                <p>Relevance: <br />
                    <div class="indented">
                        <input type="radio" name="relevance" value="3" />Excellent<br />
                        <input type="radio" name="relevance" value="2" />Good<br />
                        <input type="radio" name="relevance" value="1" />Average<br />
                        <input type="radio" name="relevance" value="0" />Poor<br />
                    </div>
                </p>
                <hr />
                <p>Quality: <br />
                    <div class="indented">
                        <input type="radio" name="quality" value="3" />Excellent<br />
                        <input type="radio" name="quality" value="2" />Good<br />
                        <input type="radio" name="quality" value="1" />Average<br />
                        <input type="radio" name="quality" value="0" />Poor<br />
                    </div>
                </p>
                <hr />    
                <p>A <strong><?php echo $format?></strong> presentation has been requested. What is your final recommendation?<br />
                    <div class="indented">
                        <input type="radio" name="recommendation" value="Panel" />Accept as Panel<br />
                        <input type="radio" name="recommendation" value="Poster">Accept as Poster<br />
                        <input type="radio" name="recommendation" value="Roundtable">Accept as Roundtable<br />
                        <input type="radio" name="recommendation" value="Reject">Reject<br />
                    </div>
                </p>
                <hr />
                <p>Comments:<br /> 
                    <div class="indented">
                        <textarea cols="18" rows="13" name="comments" id="comments"></textarea>
                    </div>
                </p>
                <hr />
                <p>Optional: The topic of this abstract is <?php echo $topic?>. If you think this is a mistake, 
                please change it below.</p>
                    <div class="indented" style="padding-bottom:10px;">
                        <select id="topic" name="topic">
                        <?php
							$t = 1;
							while ($custom_topic[$t]) {
								echo "<option value='" . $custom_topic[$t] . "'";
									if ($topic == $custom_topic[$t]) echo " selected";
									echo ">" . $custom_topic[$t] . "</option>";	
								$t = $t+1;
							}		
						?>	
                        </select>
                    </div>
                <hr />        
                <p>Please note that once a review is submitted, it CANNOT be modified.</p>
                <input type="submit" value="Submit" id="review_form_submit" name="review_form_submit" />
            </form>

<?php
		} //end else for completed
		
		//end sidebar
		echo "</div>";
		
		echo "<div style='clear:both;'>&nbsp;</div>";
		
		//PRINT-ONLY DIV
		echo "<div id='print_only'>";
			echo "<h2>Review</h2>";
			echo "<p>Relevance: Excellent / Good / Average / Poor</p>";
			echo "<p>Quality: Excellent / Good / Average / Poor </p>";
			echo "<p>A " . $format . " presentation has been requested. What is your final recommendation?<br />" .
				 "Accept as Panel / Accept as Poster / Accept as Roundtable / Reject</p>";
			echo "<p>Comments:</p>";
		echo "</div>";
	
	
	} //end else for non-admin


	//Close database
	mysql_close();
	

	//Include footer template
	include('footer.php');

?>