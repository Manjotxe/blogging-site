<?php
include('common/connection.php');
include('classes/verify.class.php');

// Create an instance of the Verify class
$verification = new Verify($connect);

// Call the method to verify the account
$verification->verifyAccount();
?>
