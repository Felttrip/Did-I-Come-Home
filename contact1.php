#!/usr/local/bin/php
<?php
include('../CS3380/secure/database.php');
$conn = pg_connect(HOST." ".DBNAME." ".USERNAME." ".PASSWORD) or die('Could not connect:' . pg_last_error());
$date = date('m/d/Y');
pg_prepare($conn,"query1","SELECT * FROM dich.trip WHERE end_date >= $1 AND status = 0");
$result = pg_execute($conn,"query1",array($date));
pg_prepare($conn,"query2", "UPDATE dich.trip SET status=1 WHERE end_date >= $1 AND status = 0");
pg_execute($conn,"query2",array($date));

while ($line = pg_fetch_array($result, null, PGSQL_ASSOC))
{
	$name = $line["name"];
	$to = $line["user_email"];
	$startDate = $line["start_date"];
	$endDate = $line["end_date"];
	$queryMessage = $line["message"];
	$userId = $line["user_id"];
	$subject = "Did you get home ok?";
	$header = "Content-Type: text/html; charset=ISO-8859-1\r\n";
	$message = "<html><body>Hi $name! We hope you had a great trip!\n Please click";
	$message .= "<form method=\"POST\" action=\"www.nathanielthompson.info/DidIComeHome/madeIt.php\"><input type=\"hidden\" name=\"userid\" value=\"$userId\" /><input type=\"submit\" name=\"submit\" value=\"here\" /></form>";
	$message .="to let us know you made it back.  If not your emergency contact will be notified in 24 hours.</body></html>";
	mail($to,$subject,$message,$header);

}


?>