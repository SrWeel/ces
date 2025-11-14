<?php
$server         	= $host;  		                
$db_user        	= $userdb; 		                                     
$db_pass        	= $passwdb;		                                    
$database       	= $basededatos;	                                              


$timeoutseconds 	= "300";			// How long it it boefore the user is no longer online
$showlink         = "1";                  // Link to us? 1 = Yes  0 = No

//Only one person is online
$oneperson1       = "<br>Visitante en Linea";  //Change the text that will be displayed
$oneperson2       = "";     //Change the text that will be displayed

//Two or more people online
$twopeople1       ="<br>Visitantes en Linea"; //Change the text that will be displayed
$twopeople2       ="";      //Change the text that will be displayed



                                                                                                     

//The following should only be modified if you know what you are doing
$timestamp=time();                                                                                            
$timeout=$timestamp-$timeoutseconds;  
mysql_connect($server, $db_user, $db_pass) or die ("sibase_online Database CONNECT Error");                                                                   
mysql_db_query($database, "INSERT INTO sibase_online VALUES ('$timestamp','$REMOTE_ADDR','$PHP_SELF')") or die("sibase_online Database INSERT Error"); 
mysql_db_query($database, "DELETE FROM sibase_online WHERE timestamp<$timeout") or die("sibase_online Database DELETE Error");
$result=mysql_db_query($database, "SELECT DISTINCT ip FROM sibase_online WHERE file='$PHP_SELF'") or die("sibase_online Database SELECT Error");
$user  =mysql_num_rows($result);                                                                                                                                                                             
if ($user==1) {echo"<font size=1>$oneperson1 $user $oneperson2</font>";} else {echo"<font size=1>$twopeople1 $user $twopeople2";}

//If you have chosen to support us.
switch ($showlink) {
case 0:
   echo "";
   break;
case 1:
   echo "";
   break;
}
?>