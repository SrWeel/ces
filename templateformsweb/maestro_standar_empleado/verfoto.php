<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=144000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

$path_archivo="../../../../../archivo/";
//Imagen inicial horizontal
$toma_lafoto="select clie_foto as foto from app_cliente where clie_id=".$_POST["clie_id"];
$ok_foto=$DB_gogess->executec($toma_lafoto);

$foto_agirar=$ok_foto->fields["foto"];
$time_hoy=date("Ymdhis");

?>
<img src="<?php echo "/faesa/archivo/".$foto_agirar; ?>?aleatorio=<?php echo $time_hoy; ?>" width="70%"   />