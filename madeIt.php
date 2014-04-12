
<?php
if (isset( $_POST['submit']))
{
	echo "<html><body>".$_POST["userid"]."</body></html>";
}
else
{
	header("Location: /DidIComeHome/index.php");
}
?>