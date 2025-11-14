<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
if(@$_SESSION['ces1313777_sessid_inicio'])
{
$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");

for($itbl=0;$itbl<count($lista_tbldata);$itbl++)
 {

  include(@$director."libreria/estructura/".$lista_tbldata[$itbl].".php");

 } 

$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();


?>
<script language="javascript">
<!--

function panel_agendar()
{

$("#panel_agendar").load("aplicativos/documental/opciones/panel/agendar/agendar.php",{
hc_code:$('#hc_code').val(),
centro_id:'<?php echo $_SESSION['ces1313777_centro_id']; ?>'

 },function(result){       

  });  

$("#panel_agendar").html("Espere un momento...");
}

//-->
</script>

<style type="text/css">
<!--
.Estilo1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: bold;
}
-->
</style>

<p>&nbsp;</p>
<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="129"><span class="Estilo1">Historia clinica:</span></td>
    <td width="356"><input name="hc_code" type="text" id="hc_code" value=""  class="form-control"  ></td>
    <td width="115"><input type="button" name="Submit" value="Ver " onClick="panel_agendar()" ></td>
  </tr>
</table>
<p>&nbsp;</p>
<div id="panel_agendar"></div>

<?php
}
else
{
 echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; ">Tu sesi&oacute;n ha expirado, ingrese su usuario y clave y vuelva a seleccionar la opci&oacute;n</div>';
//enviar
//$varable_enviafunc=base64_encode("desplegar_grid_atencion();");
$varable_enviafunc='';
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