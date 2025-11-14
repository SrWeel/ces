<?php

header('Content-Type: text/html; charset=UTF-8');
$tiempossss=140000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

?>

<style type="text/css">

<!--

#divcoordenada{

top:0px;

	left:0px;

position: absolute;

}



-->

</style>

<?php

if($_SESSION['ces1313777_sessid_inicio'])
{

$director='../../';

include("../../cfg/clases.php");

include("../../cfg/declaracion.php");



$actualizacampop="update app_impresioncampos  set impcamp_y='".$_POST["py"]."',impcamp_x='".$_POST["px"]."' where impcamp_id='".$_POST["pidcampo"]."'";

$okvalor=$DB_gogess->executec($actualizacampop,array()); 

 if($okvalor)

 {

 echo "<div id=divcoordenada  > Y:".$_POST["py"]." -- X:".$_POST["px"]."</div>";

 }



}

 

 

 

?>