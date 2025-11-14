<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4444450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");
$objformulario= new  ValidacionesFormulario();

/*echo $_POST["campoid"]."<br>";
echo $_POST["valorid"]."<br>";
echo $_POST["tabla"]."<br>";
echo $_POST["campo"]."<br>";
echo $_POST["valor"]."<br>";*/

if($_POST["valor"]=='true')
{
$actualiza_datos="update ".$_POST["tabla"]." set ".$_POST["campo"]."='1' where ".$_POST["campoid"]."=".$_POST["valorid"];
}
else
{
$actualiza_datos="update ".$_POST["tabla"]." set ".$_POST["campo"]."='0' where ".$_POST["campoid"]."=".$_POST["valorid"];
}
$rs_fields = $DB_gogess->executec($actualiza_datos,array());
?>
<?php
if(!(@$_SESSION['ces1313777_sessid_inicio']))
{

echo '
<script type="text/javascript">
<!--
abrir_standar("aplicativos/documental/activar_sesion.php","Activar_Sesi&oacute;n","divBody_acsession'.$_POST["fie_id"].'","divDialog_acsession'.$_POST["fie_id"].'",400,400,"",0,0,0,0,0,0);
//  End -->
</script>

<div id="divBody_acsession'.$_POST["fie_id"].'"></div>
';

}
?>