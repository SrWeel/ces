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

$busca_cliente="select * from dns_atencion where atenc_id='".$id_valor."'";
$rs_bcliente = $DB_gogess->executec($busca_cliente,array());

$fecha_anterior='';
$fecha_anterior=$rs_bcliente->fields["atenc_fecharegistro"];

$atenc_enlace='';
$atenc_enlace=$rs_bcliente->fields["atenc_enlace"];


///actualiza_datos
$nueva_fecha='';
$nueva_fecha=$fecha_cambio." ".date("H:i:s");

if($id_valor)
{

$actualiza_paciente="update dns_atencion set atenc_fecharegistro='".$nueva_fecha."' where atenc_id='".$id_valor."'";
$rs_acpaciente = $DB_gogess->executec($actualiza_paciente,array());


if(@$rs_acpaciente)
{
   //signos vitales
    $busca_fechareg=explode(" ",$fecha_anterior);
    $busca_signos="update dns_signosvitales set signovita_fecharegistro='".$nueva_fecha."' where atenc_enlace='".$atenc_enlace."' and signovita_fecharegistro like '".$busca_fechareg[0]."%'";
    $rs_cambiasignos = $DB_gogess->executec($busca_signos,array());
   //signos vitales

   $inserta_rastro="insert into cesdb_arextension.dns_cambiofecharegistro (cbfech_tabla,cbfech_idvalor,cbfech_fecharegistroanterior,cbfech_fecharegistronueva,cbfech_motivo,cbfech_fechacambio,usua_id) values ('dns_atencion','".$id_valor."','".$fecha_anterior."','".$nueva_fecha."','".$ttext_motivo."','".date("Y-m-d H:i:s")."','".$_SESSION['ces1313777_sessid_inicio']."')";
   
  $rs_rastro = $DB_gogess->executec($inserta_rastro,array());
?>   
<script type="text/javascript">
<!--
$('#atenc_fecharegistro').val('<?php echo $nueva_fecha; ?>');
$('#despliegue_atenc_fecharegistro').html('<?php echo $nueva_fecha; ?>');

grid_extras_5569('<?php echo $atenc_enlace; ?>',0,0);
desplegar_grid_atencion(0);

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