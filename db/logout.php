/*The A Team
Manzi Karama, Nathan Skerritt, Andrew Dopplinger
Tears down connection to database*/

<?php 
session_destroy();
header("Location: ../pages/login.html");
exit();
?>