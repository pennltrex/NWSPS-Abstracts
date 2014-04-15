<?php
	
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
    <script language="javascript" type="text/javascript" src="js/submit_form.js"></script>
    <script type="text/javascript">
		//for submit_form.js
		var countsuffix = "_words";
		var remainingwords = "words_remaining";
        total_limit = <?php echo $total_words_limit; ?>;
    </script>
 
</head>


<body>

	 <div id="header" class="top_container">
        <img src="<?php echo $site_logo ?>">
    </div>


	 <div class="centering_container" id="main_container" >

        <h1>Call for abstracts</h1>
        
        <p>52nd Annual Meeting of the Northwest Society of Plastic Surgeons</p>
        
        <p style="font-weight:bold;">Please note that it will not be possible to edit an abstract after it has been 
        submitted.</p>
        
        <br />
        
        <form id="abstract_submit_form" enctype="multipart/form-data" name="abstract_submit_form" method="post" action="submit_process.php" 
        class="aform" onsubmit="return validate(this)">
            
            <h3>Author</h3>
            
                <div id="name" class="conf_form_name">
                    <label for="name">Name</label>
                    <input name="name" type="text" id="name" size="60" />
                    <br />
                    <label for="clinic">Practice</label>
                    <input name="clinic" type="text" id="clinic" size="60" />
                    <br />
                    <label for="address">Address</label>
                    <input name="address" type="text" id="address" size="60"/>
                    <br />
                    <label for="city">City/ST/ZIP</label>
                    <input name="city" type="text" id="city" size="34"/>
                    <input name="state" type="text" id="state" size="2" />
                    <input name="zip" type="text" id="zip" size="9" />
                    <br />
                    <label for="email">E-mail</label>
                    <input type="text" name="email" id="email" size="60" />
                    <br />
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" id="phone" size="60" />
                </div> 
           
            <br />
            <br />
            
            <h3>Abstract</h3>
            
            <p>Tips on presentation:</p>
            	<ol>
            		<li>Use good and standardized before and after photos.</li>
            		<li>Don’t read from your slides.</li>
            		<li>A good picture is worth a thousand words.</li>
            		<li>Keep graphs simple; remember we’re surgeons.</li>
            		<li>Ensure your talk with remain on time.</li>
            	<ol>
            
            <p>Enter information about your desired presentation at the conference.</p>
            <p>Enter the title of your abstract.</p>
        
                <label for="title">Title</label>
                    <input type="text" name="title" id="title" size="60" maxlength="250" />
                <br />

            <label for="duration">Length of Presentation</label>
            	<select id="duration" name="duration">
            		<option value="5">5 minutes</option>
            		<option value="10">10 minutes</option>
            		<option value="15">15 minutes</option>
            		<option value="20">20 minutes</option>
            	</select>

            
            <p>Brief summary of presentation:</p>
            
            <label for="summary">
                <span class="suggested_words">Suggested<br /><?php echo $summary_words_limit; ?> words</span>
                <span id="summary_your_words" class="your_words">
                    Your count<br /><span id="summary_words">0</span> words
                </span>
            </label>
            <textarea name="summary" wrap="hard" cols="60" rows="10" 
            onkeyup="check_length(this, gap, need, change, <?php echo $summary_words_limit; ?>);" 
            onkeydown="check_length(this, gap, need, change, <?php echo $summary_words_limit; ?>);" 
            onmouseout="check_length(this, gap, need, change, <?php echo $summary_words_limit; ?>);"></textarea>
            <br /><br />
            
            <p>What is the practice based issue you want to address?</p>
            
            <label for="gap">
                <span class="suggested_words">Suggested<br /><?php echo $gap_words_limit; ?> words</span>
                <span id="gap_your_words" class="your_words">
                    Your count<br /><span id="gap_words">0</span> words
                </span>
            </label>
            <textarea name="gap" wrap="hard" cols="60" rows="10" 
            onkeyup="check_length(this, summary, need, change, <?php echo $gap_words_limit; ?>);" 
            onkeydown="check_length(this, summary, need, change, <?php echo $gap_words_limit; ?>);" 
            onmouseout="check_length(this, summary, need, change, <?php echo $gap_words_limit; ?>);"></textarea>
            <br /><br />
            
            <p>Why does that issue exist? (need)</p>
            
            <label for="need">
                <span class="suggested_words">Suggested:<br /><?php echo $need_words_limit; ?> words</span>
                <span id="need_your_words" class="your_words">
                    Your count:<br /><span id="need_words">0</span> words
                </span>
            </label>
            <textarea name="need" wrap="hard" cols="60" rows="12" 
            onkeyup="check_length(this, summary, gap, change, <?php echo $need_words_limit; ?>);" 
            onkeydown="check_length(this, summary, gap, change, <?php echo $need_words_limit; ?>);" 
            onmouseout="check_length(this, summary, gap, change, <?php echo $need_words_limit; ?>);"></textarea>
            <br /><br />
            
            <p>What do we want to change? (How are we going to approach the management of patients differently?)</p>
            
            <label for="change">
                <span class="suggested_words">Suggested<br /><?php echo $change_words_limit; ?> words</span>
                <span id="change_your_words" class="your_words">
                    Your count<br /><span id="change_words">0</span> words
                </span>
            </label>
            <textarea name="change" wrap="hard" cols="60" rows="15" 
            onkeyup="check_length(this, summary, gap, need, <?php echo $change_words_limit; ?>);" 
            onkeydown="check_length(this, summary, gap, need, <?php echo $change_words_limit; ?>);" 
            onmouseout="check_length(this, summary, gap, need, <?php echo $change_words_limit; ?>);"></textarea>
            <br /><br />

            
            <p>Note: the complete abstract should not exceed <?php echo $total_words_limit; ?> words</p>
            
            <span style="color:gray">Suggested Total: <?php echo $total_words_limit; ?> words</span>
            
            <span style="padding:0px 20px 0px 20px;"> | </span>

            <span id="total_words_remaining" style="color:#009900;">
                Your Total: <span id="words_remaining">0</span> words
            </span>
            
            <input type="hidden" id="word_count" name="word_count" value="0" />
            
            <br /><br />
            

        
        <h3>Presentation Upload</h3>
        
        <p>All Presentations:​
        	<ol>
        		<li>Must be in Microsoft PowerPoint or Apple Keynote.</li>
				<li>Must include a financial disclosure slide.</li>
				<li>Must be ready to load onto the master computer the day prior to your scheduled presentation. These will be deleted from the master computer after your presentation.</li>
			</ol>
		</p>
        	<label for="presentation">Presentation:</label>
        	<input type="file" name="presentation" id="presentation"><br />
        
        
        <h3>Disclosure Form</h3>
        <p>All presenters are required to complete a disclosure form. Please upload your signed disclosure form below.</p>
        	<label for="disclosure">Filename:</label>
			<input type="file" name="disclosure" id="disclosure"><br />
            

            <p>
            <input type="checkbox" name="agree" value="agree">
            I accept the terms and conditions for abstract submission.
            </p>
            
            <p>Please note that once you click on the button below, your abstract will be submitted and no further 
            changes can be made. We appreciate your interest in this conference.</p>
            
            <br />
            
            <input id="submitform" name="submit" type="submit" value="Submit this Abstract" 
            style="width:250px;height:25px;color:black;" />
        
        </form>
        
        
    	<br /><br />
        
	</div>       
    
        
</body>


</html>