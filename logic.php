<?php
include('../CS3380/secure/database.php');
$conn = pg_connect(HOST." ".DBNAME." ".USERNAME." ".PASSWORD) or die('Could not connect:' . pg_last_error());
$date = date('m/d/Y');
echo $date;
pg_prepare($conn,"query","SELECT * FROM dich.trip WHERE end_date = $1");
$result = pg_execute($conn,"query",array($date));
while ($line = pg_fetch_array($result, null, PGSQL_ASSOC))
{
	$name = $line["name"];
	$to = $line["contact_email"];
	$startDate = $line["start_date"];
	$endDate = $line["end_date"];
	$queryMessage = $line["message"];
	$subject = "You should check on $name!";
	$message = "$name listed you as their emergency contact. They left on $startDate, and should have returned on $endDate.";
	if($line["message"])
	{
		$message = $message."They also left the message \n $queryMessage \n";
	}
	$message = $message."Please check on them!";
	echo $to;
	echo $subject;
	echo $message;
	mail($to,$subject,$message);
}


?>