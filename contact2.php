#!/usr/local/bin/php
<?php
include('../CS3380/secure/database.php');
$conn = pg_connect(HOST." ".DBNAME." ".USERNAME." ".PASSWORD) or die('Could not connect:' . pg_last_error());
$date = date('m/d/Y');
pg_prepare($conn,"query","SELECT * FROM dich.trip WHERE end_date >= $1 AND status = 1");
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
	$header = "Content-Type: text/html; charset=ISO-8859-1\r\n";
	if($line["message"])
	{
		$message = $message."They also left the message \n $queryMessage \n";
	}
	$message = $message."<html><body><h1>Please check on them!</h1>\n If they have returned safely or you wish to stop recieving these emails click";
	$message .= "<form method=\"POST\" action=\"www.nathanielthompson.info/DidIComeHome/madeIt.php\"><input type=\"hidden\" name=\"userid\" value=\"$userId\" /><input type=\"submit\" name=\"submit\" value=\"here\" /></form></body></html>";
	mail($to,$subject,$message,$header);
}


?>