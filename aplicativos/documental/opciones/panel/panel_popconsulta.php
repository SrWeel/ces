<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=44445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


if(@$_SESSION['ces1313777_sessid_inicio'])
{

//Llamando objetos

$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");
$objformulario= new  ValidacionesFormulario();

//$_POST["pVar1"];
$clie_id=$_POST["pVar2"];
$mnupan_id=$_POST["pVar3"];
$atenc_id=$_POST["pVar4"];
$centro_id=$_POST["pVar7"];

//$rs_anamesis=$objformulario->obtiene_atencionanam($clie_id,$centro_id,$DB_gogess);


?>

<div class="row" align="center">
<div class="col-sm-6">
<B>PRIMERA VEZ</B><BR>
<a href="javascript:ver_formularioenpantalla('aplicativos/documental/opciones/panel/panel_substandarformunicoanamnesis.php','Perfil','divBody_ext','',<?php echo $clie_id; ?>,'44','<?php echo $atenc_id; ?>',0,0,'<?php echo $centro_id; ?>')"><img src="archivo/gogess_data99704GOMQL20180729.png"><span class="selected"></span>
</a>
</div>

<div class="col-sm-6">
<B>SUBSECUENTE</B><BR>
<a href="javascript:ver_formularioenpantalla('aplicativos/documental/opciones/panel/panel_substandarformularios_sub.php','Perfil','divBody_ext','',<?php echo $clie_id; ?>,'59','<?php echo $atenc_id; ?>',0,0,'<?php echo $centro_id; ?>')">
<img src="archivo/gogess_data99704GOMQL20180729.png"><span class="selected"></span>
</a>
</div>
</div>
<?php





}			
else
{

	$varable_enviafunc=base64_encode("ver_formularioenpantalla('aplicativos/documental/opciones/panel/panel_facturas.php','Perfil','divBody_ext','','34',0,0,0,0,0)");
		
	//enviar
	echo '
	<script type="text/javascript">
	<!--
	abrir_standar("aplicativos/documental/activar_sesion.php","Activar_Sesi&oacute;n","divBody_acsession","divDialog_acsession",400,400,"'.$varable_enviafunc.'",0,0,0,0,0,0);
	//  End -->
	</script>
	
	<div id="divBody_acsession"></div>
	';


}

?>