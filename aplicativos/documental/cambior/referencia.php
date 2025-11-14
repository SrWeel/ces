<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


if($_SESSION['ces1313777_sessid_inicio'])
{

$fecha_cambio=$_POST["fecha_cambio"];
$ttext_motivo=$_POST["ttext_motivo"];
$id_valor=$_POST["id_valor"];


$director='../../../';
include("../../../cfg/clases.php");
include("../../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");
$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();
$comillasimple="'";

$busca_cliente="select * from dns_referencia where referencia_id='".$id_valor."'";
$rs_bcliente = $DB_gogess->executec($busca_cliente,array());

$usua_id_vl=$rs_bcliente->fields["usua_id"];
$centro_id_vl=$rs_bcliente->fields["centro_id"];

$fecha_anterior='';
$fecha_anterior=$rs_bcliente->fields["referencia_fecharegistro"];

$referencia_enlace='';
$referencia_enlace=$rs_bcliente->fields["referencia_enlace"];


///actualiza_datos
$nueva_fecha='';
$nueva_fecha=$fecha_cambio." ".date("H:i:s");

if($id_valor)
{

$actualiza_paciente="update dns_referencia set referencia_fecharegistro='".$nueva_fecha."' where referencia_id='".$id_valor."'";
$rs_acpaciente = $DB_gogess->executec($actualiza_paciente,array());


if(@$rs_acpaciente)
{
   
  
   
   //dns_diagnosticoreferencia
   $busca_organos="update dns_diagnosticoreferencia set diagn_fecharegistro='".$nueva_fecha."' where referencia_enlace='".$referencia_enlace."' and diagn_fecharegistro like '".$busca_fechareg[0]."%'";
   $rs_organos = $DB_gogess->executec($busca_organos,array());    
   //dns_diagnosticoreferencia
   
   
   

   $inserta_rastro="insert into cesdb_arextension.dns_cambiofecharegistro (cbfech_tabla,cbfech_idvalor,cbfech_fecharegistroanterior,cbfech_fecharegistronueva,cbfech_motivo,cbfech_fechacambio,usua_id) values ('dns_referencia','".$id_valor."','".$fecha_anterior."','".$nueva_fecha."','".$ttext_motivo."','".date("Y-m-d H:i:s")."','".$_SESSION['ces1313777_sessid_inicio']."')";
   
  $rs_rastro = $DB_gogess->executec($inserta_rastro,array());
?>   
<script type="text/javascript">
<!--
$('#referencia_fecharegistro').val('<?php echo $nueva_fecha; ?>');
$('#despliegue_referencia_fecharegistro').html('<?php echo $nueva_fecha; ?>');

grid_extras_5363('<?php echo $referencia_enlace; ?>',0,0);
//grid_extras_5778('<?php echo $referencia_enlace; ?>',0,0);
//grid_extras_5779('<?php echo $referencia_enlace; ?>',0,0);
//grid_extras_5183('<?php echo $referencia_enlace; ?>',0,0);
//grid_extras_5241('<?php echo $referencia_enlace; ?>',0,0);
//grid_extras_5592('<?php echo $referencia_enlace; ?>',0,0);
//grid_extras_6186('<?php echo $referencia_enlace; ?>',0,0);

//  End -->
</script> 
<?php  
   echo "<center>Fecha de registro fue actualizado...</center>"; 
}
else
{
  echo "<center>Alerta!! registro no fue actualizdo comun&iacute;quese con el administrador del sistema...</center>";

}

}
///actualiza_datos


}
?>