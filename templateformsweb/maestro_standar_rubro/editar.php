<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',1);
error_reporting(E_ALL);
$tiempossss=445440000;

ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");


$busca_lista="select * from dns_atencionevaluacion where eteneva_id=".$_POST["eteneva_idx"];
$rs_obtiene = $DB_gogess->executec($busca_lista,array());

echo '<input name="eteneva_idxval" type="hidden" id="eteneva_idxval" value="'.$rs_obtiene->fields["eteneva_id"].'" />';

echo '<input name="eteneva_observacionxval" type="hidden" id="eteneva_observacionxval" value="'.$rs_obtiene->fields["eteneva_observacion"].'" />';

echo '<input name="eteneva_adpsxval" type="hidden" id="eteneva_adpsxval" value="'.$rs_obtiene->fields["eteneva_adps"].'" />';

echo '<input name="eteneva_psxval" type="hidden" id="eteneva_psxval" value="'.$rs_obtiene->fields["eteneva_ps"].'" />';

echo '<input name="eteneva_pxval" type="hidden" id="eteneva_pxval" value="'.$rs_obtiene->fields["eteneva_p"].'" />';

echo '<input name="eteneva_lxval" type="hidden" id="eteneva_lxval" value="'.$rs_obtiene->fields["eteneva_l"].'" />';

echo '<input name="eteneva_tfxval" type="hidden" id="eteneva_tfxval" value="'.$rs_obtiene->fields["eteneva_tf"].'" />';

echo '<input name="eteneva_toxval" type="hidden" id="eteneva_toxval" value="'.$rs_obtiene->fields["eteneva_to"].'" />';

echo '<input name="eteneva_fechaentregaxval" type="hidden" id="eteneva_fechaentregaxval" value="'.$rs_obtiene->fields["eteneva_fechaentrega"].'" />';

echo '<input name="eteneva_numautorizacionxval" type="hidden" id="eteneva_numautorizacionxval" value="'.$rs_obtiene->fields["eteneva_numautorizacion"].'" />';

echo '<input name="eteneva_numfacturaxval" type="hidden" id="eteneva_numfacturaxval" value="'.$rs_obtiene->fields["eteneva_numfactura"].'" />';



if(!(@$_SESSION['ces1313777_sessid_inicio']))
{


//echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; ">Tu sesi&oacute;n ha expirado</div>';
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