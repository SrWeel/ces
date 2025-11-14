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

$busca_cliente="select * from dns_fisioterapia where fisiot_id='".$id_valor."'";
$rs_bcliente = $DB_gogess->executec($busca_cliente,array());

$usua_id_vl=$rs_bcliente->fields["usua_id"];
$centro_id_vl=$rs_bcliente->fields["centro_id"];

$fecha_anterior='';
$fecha_anterior=$rs_bcliente->fields["fisiot_fecharegistro"];

$fisiot_enlace='';
$fisiot_enlace=$rs_bcliente->fields["fisiot_enlace"];


///actualiza_datos
$nueva_fecha='';
$nueva_fecha=$fecha_cambio." ".date("H:i:s");

if($id_valor)
{

$actualiza_paciente="update dns_fisioterapia set fisiot_fecharegistro='".$nueva_fecha."' where fisiot_id='".$id_valor."'";
$rs_acpaciente = $DB_gogess->executec($actualiza_paciente,array());


if(@$rs_acpaciente)
{
   //REGISTRO DE TERAPIAS
    $busca_fechareg=explode(" ",$fecha_anterior);
    $busca_organos="update dns_regfisioterapia set regterapia_fecharegistro='".$nueva_fecha."' where fisiot_enlace='".$fisiot_enlace."' and regterapia_fecharegistro like '".$busca_fechareg[0]."%'";
    $rs_organos = $DB_gogess->executec($busca_organos,array());
   //REGISTRO DE TERAPIAS
   
   //cesdb_arextension.dns_diagnosticofisioterapia
   $busca_organos="update cesdb_arextension.dns_diagnosticofisioterapia set diagn_fecharegistro='".$nueva_fecha."' where fisiot_enlace='".$fisiot_enlace."' and diagn_fecharegistro like '".$busca_fechareg[0]."%'";
   $rs_organos = $DB_gogess->executec($busca_organos,array());    
   //cesdb_arextension.dns_diagnosticofisioterapia
   
   //dns_tarifariofisioterapia   
   $busca_organos="update dns_tarifariofisioterapia set cuabas_fecharegistro='".$nueva_fecha."' where fisiot_enlace='".$fisiot_enlace."' and cuabas_fecharegistro like '".$busca_fechareg[0]."%'";
   $rs_organos = $DB_gogess->executec($busca_organos,array());   
   //dns_tarifariofisioterapia
   
  
   
   //dns_dispositivosfisioterapia
   
   $lista_rescetdia="select * from dns_dispositivosfisioterapia where plantrai_despachado='' and fisiot_enlace='".$fisiot_enlace."' and plantrai_fecharegistro like '".$busca_fechareg[0]."%'";
   $rs_listarecetas = $DB_gogess->executec($lista_rescetdia,array());
   if($rs_listarecetas)
		{
			while (!$rs_listarecetas->EOF) {
    
   $busca_organos1="update dns_dispositivosfisioterapia set plantrai_fecharegistro='".$nueva_fecha."' where plantrai_id='".$rs_listarecetas->fields["plantrai_id"]."'";
   $rs_organos1 = $DB_gogess->executec($busca_organos1,array()); 
   
    $permid_idtabla=$rs_listarecetas->fields["plantrai_id"];
	$permid_tabla="dns_dispositivosfisioterapia";
	$permid_acepta=1;
	$permid_motivo="INGRESO_ANTERIOR_SOPORTE_SISTEMA";
	$permid_fecharegistro=date("Y-m-d H:i:s");
	$usua_id=$usua_id_vl;
	$centro_id=$centro_id_vl;
	
  //borra permisos anteriores
   $dele_permi="delete from cesdb_arextension.dns_permisosdespacho where permid_idtabla='".$permid_idtabla."' and permid_tabla='".$permid_tabla."'";
   $rs_delpermi= $DB_gogess->executec($dele_permi,array());
   //borra permisos anteriores	
   
   //crea permiso
   $insert_data="insert into cesdb_arextension.dns_permisosdespacho (permid_idtabla,permid_tabla,permid_acepta,permid_motivo,permid_fecharegistro,usua_id,centro_id) values ('".$permid_idtabla."','".$permid_tabla."','".$permid_acepta."','".$permid_motivo."','".$permid_fecharegistro."','".$usua_id."','".$centro_id."')";
   $rs_ddata= $DB_gogess->executec($insert_data,array());
   //crea permiso
   
   
               $rs_listarecetas->MoveNext();			   
			   }
		}
   
   //dns_dispositivosfisioterapia
   

   $inserta_rastro="insert into cesdb_arextension.dns_cambiofecharegistro (cbfech_tabla,cbfech_idvalor,cbfech_fecharegistroanterior,cbfech_fecharegistronueva,cbfech_motivo,cbfech_fechacambio,usua_id) values ('dns_fisioterapia','".$id_valor."','".$fecha_anterior."','".$nueva_fecha."','".$ttext_motivo."','".date("Y-m-d H:i:s")."','".$_SESSION['ces1313777_sessid_inicio']."')";
   
  $rs_rastro = $DB_gogess->executec($inserta_rastro,array());
?>   
<script type="text/javascript">
<!--
$('#fisiot_fecharegistro').val('<?php echo $nueva_fecha; ?>');
$('#despliegue_fisiot_fecharegistro').html('<?php echo $nueva_fecha; ?>');

grid_extras_5184('<?php echo $fisiot_enlace; ?>',0,0);
grid_extras_5542('<?php echo $fisiot_enlace; ?>',0,0);
grid_extras_6188('<?php echo $fisiot_enlace; ?>',0,0);
grid_extras_5240('<?php echo $fisiot_enlace; ?>',0,0);
grid_extras_5590('<?php echo $fisiot_enlace; ?>',0,0);


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