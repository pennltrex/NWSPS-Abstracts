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
	
		//Grab abstract_id passed in
		$abstract_id = $_POST['abstract_id'];
		
		//Database Connection Variables
		include('db.php');
		
		//Connect to database	
		mysql_connect($host,$username,$password);
		@mysql_select_db($database) or die( "Unable to select database");
		
		//Select all users	
		$query = "SELECT * FROM abstracts WHERE abstract_id = '$abstract_id'";
		$result = mysql_query($query);
		
		$i = 0;
		$name = mysql_result($result,$i,"name");
		$address = mysql_result($result,$i,"address");
		$city = mysql_result($result,$i,"city");
		$state = mysql_result($result,$i,"state");
		$zip = mysql_result($result,$i,"zip");
		$email = mysql_result($result,$i,"email");
		$phone = mysql_result($result,$i,"phone");
		$title = mysql_result($result,$i,"title");
		$length = mysql_result($result,$i,"length");
		$summary = mysql_result($result,$i,"summary");
		$gap = mysql_result($result,$i,"gap");
		$need = mysql_result($result,$i,"need");
		$change = mysql_result($result,$i,"change");
		$word_count = mysql_result($result,$i,"word_count");
		$master_status = mysql_result($result, $i, "master_status");
		$last_edit = mysql_result($result,$i,"last_edit");
		
		//Output breadcrumbs
		$goback_abstract = 	"<form method='post' style='display:inline;' action='detail.php' name='goback_abstract_form' id='goback_abstract_form'>" . 
								"<input type='hidden' id='abstract_id' name='abstract_id' value='" . $abstract_id . "' />" . 
								"<a href='#' onclick='javascript:document.goback_abstract_form.submit();'>View Abstract " . $abstract_id . "</a>" .
							"</form>";
		echo "<div class='breadcrumbs'><a href='list.php'>" . $home_title . "</a> /" . $goback_abstract . " /Edit Abstract</div>";
		
		
		//Output title
		echo "<h1>Edit Abstract " . $abstract_id . "</h1>";

		//Output date of last edit
		if ($last_edit) echo "<p>Last Edited: " . $last_edit . "</p>";
?>


	
                            <br />
                            
                            <form method="post" action="edit_abstract_process.php" class="aform">

                            	<h3>Abstract Title</h3>
                                
                                <p>Enter the title of the abstract.</p>
                            
                                    <label for="title">Title</label>
                                        <input type="text" name="title" id="title" size="60" maxlength="250" value="<?php echo $title; ?>" />
                                    <br />
                                
                                <br />
                                
                                <h3>Author(s)</h3>
                                
                                <p>Enter in format: Family Name, Given Name</p>
                            
                                    <label for "name">Name</label>
                                        <input type="text" id="name" name="name" size="50" value="<?php echo $name; ?>" /><br />
                                    
                                    <label for "clinic">Practice</label>
                                        <input type="text" id="clinic" name="clinic" size="50" value="<?php echo $clinic; ?>" /><br />

                           
                               
                                <br />
                                <br />
                                
								<h3>Presentation</h3>
                                
                                <p>Enter information about the presentation at the conference.</p>
								
                                <label for="format">Preferred Format</label>
							  		<select id="format" name="format">
                                        <option value="Poster" <?php if ($format == "Poster") echo "selected"; ?>>Poster</option>
                                        <option value="Panel" <?php if ($format == "Panel") echo "selected"; ?>>Panel</option>
                                    </select>
								<br /><br />
								<label for="language">Language of Presentation</label>
									<select id="language" name="language">
                                    	<?php
										$t = 1;
										while ($custom_language[$t]) {
											echo "<option value='" . $custom_language[$t] . "'";
												if ($language == $custom_language[$t]) echo " selected";
												echo ">" . $custom_language[$t] . "</option>";	
											$t = $t+1;
										}		
									?>		
                                    </select>
								<br /><br />
								<label for="presenter">Name of Presenting Author</label>
									<input type="text" name="presenter" id="presenter" size="40" value="<?php echo $presenter; ?>" />
								<br />
								
                                
                                
                                <br />
                                <br />
                                <br />
                                
                                <h3>Abstract Content</h3>
                                
                                <p>Please select the main topic area of your abstract, and the location where the 
                                primary work was carried out.</p>
                                
                                <label for="topic">Topic</label>
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
                                    
                                <br /><br />

                                <label for="country">Location</label>
                                    <select id="country" name="country">
                                    <?php
										$t = 1;
										while ($custom_country[$t]) {
											echo "<option value='" . $custom_country[$t] . "'";
												if ($country == $custom_country[$t]) echo " selected";
												echo ">" . $custom_country[$t] . "</option>";	
											$t = $t+1;
										}		
									?>
                                    </select>
                                <br /><br />

                                
                                <p>Briefly describe the context for the work and explain why this study or programme was needed.</p>
                                
								<label for="background">Background
									<span class="suggested_words">Suggested<br /><?php echo $background_words_limit; ?> words</span>
								</label>
								<textarea name="background" wrap="hard" cols="50" rows="10"><?php echo $background; ?></textarea>
								<br /><br />
                                
								<p>What did you aim to achieve with this study or programme?</p>
								
                                <label for="purpose">Purpose of Study or Programme
									<span class="suggested_words">Suggested<br /><?php echo $purpose_words_limit; ?> words</span>
								</label>
								<textarea name="purpose" wrap="hard" cols="50" rows="10"><?php echo $purpose; ?></textarea>
								<br /><br />
                                
								<p>Describe the key activities that define the work. For example, provide
                                information that answers questions such as: With whom did you work?
                                How did you identify / select these people? What was your intervention? How did you
                                measure it?</p>
								
                                <label for="methods">Study or Programme Design and Methods
									<span class="suggested_words">Suggested:<br /><?php echo $methods_words_limit; ?> words</span>
								</label>
								<textarea name="methods" wrap="hard" cols="50" rows="12"><?php echo $methods; ?></textarea>
								<br /><br />
								
								<p>What did you discover from doing this work?</p>
                                
                                <label for="findings">Findings of Study or Programme
									<span class="suggested_words">Suggested<br /><?php echo $findings_words_limit; ?> words</span>
								</label>
								<textarea name="findings" wrap="hard" cols="50" rows="15"><?php echo $findings; ?></textarea>
								<br /><br />
                                
								<p>What can you conclude about this field? How might this information be used by other organisations?</p>
								
                                <label for="conclusion">Conclusions and Programme Implications
									<span class="suggested_words">Suggested<br /><?php echo $conclusion_words_limit; ?> words</span>
								</label>
								<textarea name="conclusion" wrap="hard" cols="40" rows="10"><?php echo $conclusion; ?></textarea>
								<br /><br />
								
								<p>Note: the complete abstract should not exceed <?php echo $total_words_limit; ?> words</p>
                                
                                <span style="color:gray">Suggested Total: <?php echo $total_words_limit; ?> words</span>
								
								<br /><br />
								
								<h3>Contact Person</h3>
                                
                                <p>Enter contact details for corresponding author.</p>
								
									<label for="name">Name</label>
                                        <input type="text" name="name" id="name" size="40" value="<?php echo $name; ?>" />
                                    <br />
									<label for="email1">E-mail #1</label>
                                        <input type="text" name="email1" id="email1" size="40" value="<?php echo $email1; ?>" />
                                    <br />
                                    <label for="email2">E-mail #2</label>
                                        <input type="text" name="email2" id="email2" size="40" value="<?php echo $email2; ?>" />
                                    <br />
                                 	<label for="phone1">Office Phone</label>
                                        <input type="text" name="phone1" id="phone1" size="40" value="<?php echo $phone1; ?>" />
                                    <br />
                                    <label for="phone2">Cell Phone</label>
                                        <input type="text" name="phone2" id="phone2" size="40" value="<?php echo $phone2; ?>" />
                                    <br />
									<label for="fax">Fax</label>
                                        <input type="text" name="fax" id="fax" size="40" value="<?php echo $fax; ?>" />
                                    <br />
									<label for="address">Mailing Address</label>
                                        <textarea name="address" id="address" wrap="hard" cols="40" rows="3" /><?php echo $address; ?></textarea>
                                    <br />
								
								<br /><br /><br />
                                                                
                                <p>Please note that once you click on the button below, the changes above will overwrite the previous abstract permanently. </p>
                                
                                <br />
                                
                                <input type='hidden' id='abstract_id' name='abstract_id' value="<?php echo $abstract_id; ?>" />
                                
								<input id="submitform" name="submit" type="submit" value="Save Changes" 
								style="width:250px;height:25px;color:black;" />
                            
                            </form>
                            
                            <br /><br /><br /><br />
                            
<?php

	} //end if

	//Include footer template
	include('footer.php');
?>                            