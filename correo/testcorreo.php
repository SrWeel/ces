<?php
    ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );

	
$to      = "franklin.aguas@gmail.com";
$subject = "Test Mail";
$message = "This is a test email";

echo mail($to, $subject, $message);

phpinfo();
?>