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

$busca_cliente="select * from dns_enfermeria where enferm_id='".$id_valor."'";
$rs_bcliente = $DB_gogess->executec($busca_cliente,array());

$usua_id_vl=$rs_bcliente->fields["usua_id"];
$centro_id_vl=$rs_bcliente->fields["centro_id"];

$fecha_anterior='';
$fecha_anterior=$rs_bcliente->fields["enferm_fecharegistro"];

$enferm_enlace='';
$enferm_enlace=$rs_bcliente->fields["enferm_enlace"];


///actualiza_datos
$nueva_fecha='';
$nueva_fecha=$fecha_cambio." ".date("H:i:s");

if($id_valor)
{

$actualiza_paciente="update dns_enfermeria set enferm_fecharegistro='".$nueva_fecha."' where enferm_id='".$id_valor."'";
$rs_acpaciente = $DB_gogess->executec($actualiza_paciente,array());


if(@$rs_acpaciente)
{
   //ACTIVIDADES DE ENFERMERIA INYECCIONES   
    $busca_fechareg=explode(" ",$fecha_anterior);
    $busca_organos="update dns_actividadesenfermeria set actemf_fecharegistro='".$nueva_fecha."' where enferm_enlace='".$enferm_enlace."' and actemf_fecharegistro like '".$busca_fechareg[0]."%'";
    $rs_organos = $DB_gogess->executec($busca_organos,array());   
   //ACTIVIDADES DE ENFERMERIA INYECCIONES
   
   //ACTIVIDADES DE ENFERMERIA VACUNAS  
    $busca_fechareg=explode(" ",$fecha_anterior);
    $busca_organos="update dns_actividadesvacuna set actemfvac_fecharegistro='".$nueva_fecha."' where enferm_enlace='".$enferm_enlace."' and actemfvac_fecharegistro like '".$busca_fechareg[0]."%'";
    $rs_organos = $DB_gogess->executec($busca_organos,array());   
   //ACTIVIDADES DE ENFERMERIA VACUNAS 
   
   //ACTIVIDADES DE ENFERMERIA GENERALES  
    $busca_fechareg=explode(" ",$fecha_anterior);
    $busca_organos="update dns_actividadesgenerales set actemfgen_fecharegistro='".$nueva_fecha."' where enferm_enlace='".$enferm_enlace."' and actemfgen_fecharegistro like '".$busca_fechareg[0]."%'";
    $rs_organos = $DB_gogess->executec($busca_organos,array());   
   //ACTIVIDADES DE ENFERMERIA GENERALES   
   
   
   //NOTAS DE ENFERMERIA
   $busca_fechareg=explode(" ",$fecha_anterior);
    $busca_organos="update dns_gridenfermeria set genfermeria_fecharegistro='".$nueva_fecha."' where enferm_enlace='".$enferm_enlace."' and genfermeria_fecharegistro like '".$busca_fechareg[0]."%'";
    $rs_organos = $DB_gogess->executec($busca_organos,array());     
   //NOTAS DE ENFERMERIA
   
   
   //cesdb_arextension.dns_diagnosticoenfermeria
   $busca_organos="update cesdb_arextension.dns_diagnosticoenfermeria set diagn_fecharegistro='".$nueva_fecha."' where enferm_enlace='".$enferm_enlace."' and diagn_fecharegistro like '".$busca_fechareg[0]."%'";
   $rs_organos = $DB_gogess->executec($busca_organos,array());    
   //cesdb_arextension.dns_diagnosticoenfermeria
   
   //dns_tarifarioenfermeria   
   $busca_organos="update dns_tarifarioenfermeria set cuabas_fecharegistro='".$nueva_fecha."' where enferm_enlace='".$enferm_enlace."' and cuabas_fecharegistro like '".$busca_fechareg[0]."%'";
   $rs_organos = $DB_gogess->executec($busca_organos,array());   
   //dns_tarifarioenfermeria
   
  
   
   //dns_dispositivosenfermeria
   
   $lista_rescetdia="select * from dns_dispositivosenfermeria where plantrai_despachado='' and enferm_enlace='".$enferm_enlace."' and plantrai_fecharegistro like '".$busca_fechareg[0]."%'";
   $rs_listarecetas = $DB_gogess->executec($lista_rescetdia,array());
   if($rs_listarecetas)
		{
			while (!$rs_listarecetas->EOF) {
    
   $busca_organos1="update dns_dispositivosenfermeria set plantrai_fecharegistro='".$nueva_fecha."' where plantrai_id='".$rs_listarecetas->fields["plantrai_id"]."'";
   $rs_organos1 = $DB_gogess->executec($busca_organos1,array()); 
   
    $permid_idtabla=$rs_listarecetas->fields["plantrai_id"];
	$permid_tabla="dns_dispositivosenfermeria";
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
   
   //dns_dispositivosenfermeria
   

   $inserta_rastro="insert into cesdb_arextension.dns_cambiofecharegistro (cbfech_tabla,cbfech_idvalor,cbfech_fecharegistroanterior,cbfech_fecharegistronueva,cbfech_motivo,cbfech_fechacambio,usua_id) values ('dns_enfermeria','".$id_valor."','".$fecha_anterior."','".$nueva_fecha."','".$ttext_motivo."','".date("Y-m-d H:i:s")."','".$_SESSION['ces1313777_sessid_inicio']."')";
   
  $rs_rastro = $DB_gogess->executec($inserta_rastro,array());
?>   
<script type="text/javascript">
<!--
$('#enferm_fecharegistro').val('<?php echo $nueva_fecha; ?>');
$('#despliegue_enferm_fecharegistro').html('<?php echo $nueva_fecha; ?>');

grid_extras_5483('<?php echo $enferm_enlace; ?>',0,0);
grid_extras_5778('<?php echo $enferm_enlace; ?>',0,0);
grid_extras_5779('<?php echo $enferm_enlace; ?>',0,0);
grid_extras_5183('<?php echo $enferm_enlace; ?>',0,0);
grid_extras_5241('<?php echo $enferm_enlace; ?>',0,0);
grid_extras_5592('<?php echo $enferm_enlace; ?>',0,0);
grid_extras_6186('<?php echo $enferm_enlace; ?>',0,0);

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