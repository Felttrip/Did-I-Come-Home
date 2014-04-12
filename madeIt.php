
<?php
if (isset( $_POST['submit']))
{
	pg_prepare($conn,"remove","DELETE FROM dich.trip WHERE user_id=$1");
	pg_execute($conn,"remove",array($_POST["userid"]));
}
else
{
	header("Location: /DidIComeHome/index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>You Made It!</title>
</head>
<body>
<h1>Glad you made it home safe!</h1>
<div><a href="/DidIComeHome/index.php">Want to plan another trip?</a></div>
</body>
</html>