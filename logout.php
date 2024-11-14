<?php
echo "You have been logged out<br>";
$_SESSION = [];
session_destroy();
?>
<a href="index.php">Return to the main page</a>