<?php
/********************************************************
 *
 *	phpAbstracts
 *  http://www.phpabstracts.com
 *
 *  For copyright and license information, see readme.txt
 *
*********************************************************/



	//Include commonly used variables
	include('vars.php');
	
	//Database Connection Variables
	include('db.php');
	
	mysql_connect($host,$username,$password);
	@mysql_select_db($database) or die( "Unable to select database");
	
	
	//Capture form fields to variables
	
	$name=$_POST['name'];
	$clinic=$_POST['clinic'];
	$address=$_POST['address'];
	$city=$_POST['city'];
	$state=$_POST['state'];
	$zip=$_POST['zip'];
	$email=$_POST['email'];
	$phone=$_POST['phone'];
	$title=$_POST['title'];
	$duration=$_POST['duration'];
	$summary=$_POST['summary'];
	$gap=$_POST['gap'];
	$need=$_POST['need'];
	$change=$_POST['change'];	
	$presentation=$_POST['presentation'];
	$disclosure=$_POST['disclosure'];
	$word_count=$_POST['word_count'];
	$date = date("F j, Y, g:i a");
	
	
		

	
	
		// upload presentation
$allowedExts = array("gif", "jpeg", "jpg", "png", "JPG", "GIF", "PNG", "JPEG", "DOC", "doc", "DOCX", "docx", "ppt", "pptx",  "PPT", "PPTX", "zip", "ZIP", "pdf", "PDF");
 $temp = explode(".", $_FILES["presentation"]["name"]);
 $extension = end($temp);
 if ((($_FILES["presentation"]["type"] == "image/gif")
 || ($_FILES["presentation"]["type"] == "image/jpeg")
 || ($_FILES["presentation"]["type"] == "image/jpg")
 || ($_FILES["presentation"]["type"] == "image/pjpeg")
 || ($_FILES["presentation"]["type"] == "image/x-png")
 || ($_FILES["presentation"]["type"] == "application/pdf")
 || ($_FILES["presentation"]["type"] == "application/msword")
 || ($_FILES["presentation"]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document")
 || ($_FILES["presentation"]["type"] == "application/vnd.ms-powerpoint")
 || ($_FILES["presentation"]["type"] == "application/vnd.openxmlformats-officedocument.presentationml.presentation")
 || ($_FILES["presentation"]["type"] == "application/zip")
 || ($_FILES["presentation"]["type"] == "image/png"))
 && ($_FILES["presentation"]["size"] < 20000000)
 && in_array($extension, $allowedExts))
  {
  if ($_FILES["presentation"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["presentation"]["error"] . "<br>";
    }
  else
    {

    if (file_exists("upload/" . $_FILES["presentation"]["name"]))
      {
      echo $_FILES["presentation"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["presentation"]["tmp_name"],
      "abstracts/" . $_FILES["presentation"]["name"]);
      $presentation=$_FILES["presentation"]["name"];
    }
    }
  }
else
  {
  echo "Invalid file";
  }	
  
  
  
	// upload disclosure
 $allowedExts = array("gif", "jpeg", "jpg", "png", "JPG", "GIF", "PNG", "JPEG", "DOC", "doc", "DOCX", "docx", "ppt", "pptx", "PPT", "PPTX", "zip", "ZIP", "pdf", "PDF");
 $temp = explode(".", $_FILES["disclosure"]["name"]);
 $extension = end($temp);
 if ((($_FILES["disclosure"]["type"] == "image/gif")
 || ($_FILES["disclosure"]["type"] == "image/jpeg")
 || ($_FILES["disclosure"]["type"] == "image/jpg")
 || ($_FILES["disclosure"]["type"] == "image/pjpeg")
 || ($_FILES["disclosure"]["type"] == "image/x-png")
 || ($_FILES["disclosure"]["type"] == "application/pdf")
 || ($_FILES["disclosure"]["type"] == "application/msword")
 || ($_FILES["disclosure"]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document")
 || ($_FILES["disclosure"]["type"] == "application/vnd.ms-powerpoint")
 || ($_FILES["disclosure"]["type"] == "application/vnd.openxmlformats-officedocument.presentationml.disclosure")
 || ($_FILES["disclosure"]["type"] == "application/zip")
 || ($_FILES["disclosure"]["type"] == "image/png"))
 && ($_FILES["disclosure"]["size"] < 20000000)
 && in_array($extension, $allowedExts))
   {
   if ($_FILES["disclosure"]["error"] > 0)
     {
     echo "Return Code: " . $_FILES["disclosure"]["error"] . "<br>";
     }
   else
     {
 
     if (file_exists("upload/" . $_FILES["disclosure"]["name"]))
       {
       echo $_FILES["disclosure"]["name"] . " already exists. ";
       }
     else
       {
       move_uploaded_file($_FILES["disclosure"]["tmp_name"],
       "disclosures/" . $_FILES["disclosure"]["name"]);
       $disclosure=$_FILES["disclosure"]["name"];
       }
     }
   }
 else
   {
   echo "Invalid file";
   }


		
	
	//Store into database
	
	$query = "INSERT INTO abstracts VALUES ('', '$date', '$name', '$clinic', '$address', '$city', '$state', '$zip', '$email', '$phone', '$title', '$duration', '$summary', '$gap', '$need', '$change', '$presentation', '$disclosure' , '$word_count','Unfiled', '', '' )";
	
	mysql_query($query) or die(mysql_error()); 	
	
	// Grab ID Number
	$abstract_id = mysql_insert_id();	
	
	
	mysql_close();
	

	
	
	if(get_magic_quotes_gpc()) {
		$name=stripslashes($name);
		$clinic=stripslashes($clinic);
		$adress=stripslashes($address);
		$city=stripslashes($city);
		$state=stripslashes($state);
		$zip=stripslashes($zip);
		$email=stripslashes($email);
		$phone=stripslashes($phone);
		$title=stripslashes($title);
		$duration=stripslashes($duration);
		$summary=stripslashes($summary);
		$gap=stripslashes($gap);
		$need=stripslashes($need);
		$change=stripslashes($change);
		$presentation=stripslashes($presentation);
		$disclosure=stripslashes($disclosure);
	}

		
	//Send e-mail to recipient
	
	$to2 = $email;
	$subject2 = "Abstract Submission Form: " . $abstract_id;
	$body2 = $date . "\nAbstract ID: " . $abstract_id . 
			"\n\nThank you for your abstract submission. We acknowledge receipt." . 
			"\n\nPlease note your Abstract ID above. A copy of your abstract is included below. " . 
			"\n\nThank you." .
			"\n\nTITLE\n" . $title . "\n\nAUTHORS\nAuthor: " . $name . "\nEmail:" . $email;
	$body2 = $body2 . "\n\nPRESENTATION\nduration: " . $duration .
			"\n\nCONTENT\nSummary: " . $summary . 
			"\n\nGap: " . $gap . "\n\nNeed: " .
			$need . "\n\nChange: " . $change . "\n\nFiles \n\nPresentation:" . $presentation . 
			"\n\nDisclosure: " . $site_url ."/". $disclosure;		
	
	$from = $site_email;
	$headers = "From: $from";
	
	mail($to2, $subject2, $body2, $headers);
	
?>



	<!--Output confirmation-->
	
	<!DOCTYPE html>
	
	
	<head>
	
		<title><?php echo $site_title; ?></title>
		<link href="css/abstracts.css" rel="stylesheet" type="text/css" />
	 
	</head>
	
	
	<body>
	
		<div id="header" class="top_container">
            <img src="<?php echo $site_logo ?>">
        </div>
	
	
		 <div class="centering_container" id="main_container" >
	
			<h1>Thank you!</h1>
	
							
			<p>Thank you for your abstract submission titled "<?php echo $title; ?>".</p>
            <p>Your Abstract ID Number is: <?php echo $abstract_id; ?></p>
            <p>You will receive an e-mail confirmation shortly.</p>
<?php 
  if ($_FILES["presentation"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["presentation"]["error"] . "<br>";
    }
  else
    {

    echo "Abstract Uploaded to: " . "<a href='abstracts/" . $presentation . "'>" . $presentation . "</a><br />";
    }
 ?>
 <?php 
  if ($_FILES["disclosure"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["disclosure"]["error"] . "<br>";
    }
  else
    {

    echo "Disclosure Uploaded to: " . "<a href='disclosures/" . $disclosure . "'>" . $disclosure . "</a><br />";
    }
 ?>
        </div>       
        
            
    </body>
    
    
    </html>