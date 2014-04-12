<!doctype>
<html>
<head>
<title>
	Did I Come Home?
</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<h1>Did I Come Home</h1>
<?php
if (isset( $_POST['submit']))
{
	include('../CS3380/secure/database.php');
    $conn = pg_connect(HOST." ".DBNAME." ".USERNAME." ".PASSWORD) or die('Could not connect:' . pg_last_error());
	$name = htmlspecialchars($_POST["name"]);
	$location = htmlspecialchars($_POST["location"]);
	$startDate = htmlspecialchars($_POST["startDate"]);
	$endDate = htmlspecialchars($_POST["endDate"]);
	$userEmail = htmlspecialchars($_POST["userEmail"]);
	$contactEmail =htmlspecialchars($_POST["contactEmail"]);
	$message =htmlspecialchars($_POST["message"]);
	if($message == "Anything else you want to tell your contact person?")
	{
		$message = null;
	}

	pg_prepare($conn,"add_trip","INSERT INTO dich.trip (name,location,start_date,end_date,user_email,contact_email,message) VALUES ($1,$2,$3,$4,$5,$6,$7)");
	pg_execute($conn,"add_trip",array($name,$location,$startDate,$endDate,$userEmail,$contactEmail,$message));
	header("Location: pass.html");

}?>
<div id = "form">
<form  method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
	<div>Name?<br><input type="text" name="name" required/></div>
	<div>Where are you going?<br><input type="text" name="location" required/></div>
	<div>When are you leaving?<br><input type="date" name="startDate" required/></div>
	<div>When should you be home?<br><input type="date" name="endDate" required/></div>
	<div>What is your email address?<br><input type="email" name="userEmail" autocomplete="off" required/></div>
	<div>Who should we contact if you don't come back in time?<br><input type="email" name="contactEmail" autocomplete="off" required:/></div>
	<div><textarea rows="4" cols="50" name = "message">Anything else you want to tell your contact person?</textarea>
    <input type="submit" name="submit" value="Submit" />
</form>
</div>
</body>
</html>
