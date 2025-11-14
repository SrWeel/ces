<?php
$tiempossss=44440000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

$valor_b=$_POST["valor_b"];

$tippo_id=$_POST["tippo_id"];

$conve_id=$_POST["conve_id"];

$fuente_precio="prod_precio";
if($tippo_id==1)
{
$fuente_precio="prod_preciotarifarionacional";
}
else
{
$fuente_precio="prod_precio";
}
?>
<style type="text/css">
<!--
.Estilo5 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
-->
</style>
<?php
if($_SESSION['ces1313777_sessid_inicio'])
{

$objformulario= new  ValidacionesFormulario();

$sql1='';
$sql2='';

//valor_b
//busca si es especialidad


$busca_espcialida="select * from cesdb_arextension.dns_profesion where prof_id='".$_POST["prof_id"]."'";
$rs_dataespcialidad = $DB_gogess->executec($busca_espcialida,array());

if($rs_dataespcialidad->fields["prof_especialidad"]==1)
{

if($_POST["prof_id"]=='911116')
{
$tabla_tmporalespe="select prod_id,'".$_POST["prof_id"]."' as prof_id,prod_nombre,prod_codigo,prod_precio,prod_preciotarifarionacional,tipp_id from efacsistema_producto where prod_codigo in ('97814') and prod_nivel=1";
}
else
{
//99212 sub
$tabla_tmporalespe="select prod_id,'".$_POST["prof_id"]."' as prof_id,prod_nombre,prod_codigo,prod_precio,prod_preciotarifarionacional,tipp_id from efacsistema_producto where prod_codigo in ('99202') and prod_nivel=1";
}


$sql_new="select *,app_usuario.usua_id as usuat_id from  app_usuario inner join dns_gridfuncionprofesional on app_usuario.usua_enlace=dns_gridfuncionprofesional.usua_enlace inner join (".$tabla_tmporalespe.") tblespe on dns_gridfuncionprofesional.prof_id=tblespe.prof_id";

}


if($rs_dataespcialidad->fields["prof_especialidadconcodigo"]==1)
{

//subsecuentes 99211

$tabla_tmporalespe="select prod_id,prod_nombre,prod_codigo,prod_precio,prof_id,tipp_id from efacsistema_producto inner join dns_gridaplicaen on efacsistema_producto.prod_enlace=dns_gridaplicaen.prod_enlace where prof_id='".$_POST["prof_id"]."' and prod_nivel=1 and tipp_id=2 and prod_codigo not in ('99211')";

//$sql_new="select *,app_usuario.usua_id as usuat_id from  app_usuario inner join (".$tabla_tmporalespe.") tblespe on app_usuario.usua_formaciondelprofesional=tblespe.usua_formaciondelprofesional";

$sql_new="select *,app_usuario.usua_id as usuat_id from  app_usuario inner join dns_gridfuncionprofesional on app_usuario.usua_enlace=dns_gridfuncionprofesional.usua_enlace inner join (".$tabla_tmporalespe.") tblespe on dns_gridfuncionprofesional.prof_id=tblespe.prof_id";

}


//---------------------------------------------------------------------------------------


if($_POST["prof_id"])
{
$sql1=" dns_gridfuncionprofesional.prof_id = '".@$_POST["prof_id"]."' and ";
}

if($_POST["valor_b"])
{
$sql2=" (dns_gridfuncionprofesional.prof_id = '".@$_POST["valor_b"]."' or usua_nombre like '%".$_POST["valor_b"]."%' or usua_apellido like '%".$_POST["valor_b"]."%' ) and (prof_id in(select prof_id from cesdb_arextension.dns_profesion where prof_nosalir=0)) and ";
}
$concatenado=$sql1.$sql2;
$concatenado=substr($concatenado,0,-4);
?>

<div class="table-responsive">
<div id="diasHabilitados">

<table class="table table-bordered"  style="width:100%" >
  <tr bgcolor="#73A4AC">
    <td style="color:#FFFFFF"></td>
    <td style="color:#FFFFFF">No</td>
	<td style="color:#FFFFFF" >C&oacute;digo</td>
	<td style="color:#FFFFFF" >Area</td>
	<td style="color:#FFFFFF" >Precio</td>
  </tr>
  <?php

 $cuenta=0;
 if($concatenado)
 {
    $lista_servicios=$sql_new." and  usua_ciruc not in('1711467884','1714907449') and (dns_gridfuncionprofesional.prof_id in(select prof_id from cesdb_arextension.dns_profesion where prof_nosalir=0)) and ".$concatenado."  and usua_estado=1 and app_usuario.centro_id='".$_SESSION['ces1313777_centro_id']."'";
 }
 else
 {
    $lista_servicios=$sql_new." and  usua_ciruc not in('1711467884','1714907449') and (dns_gridfuncionprofesional.prof_id in(select prof_id from cesdb_arextension.dns_profesion where prof_nosalir=0)) and usua_estado=1 and app_usuario.centro_id='".$_SESSION['ces1313777_centro_id']."'";
	
 
 }
 
// echo $lista_servicios;

$lista_servicios="select * from efacsistema_producto where prod_activo=1 and (prod_codigo like '%".$valor_b."%' or prod_nombre like '%".$valor_b."%')";
 
 
 $rs_data = $DB_gogess->executec($lista_servicios,array());
 if($rs_data)
 {

	  while (!$rs_data->EOF) {	
	    $cuenta++;  
		
$valor_precio_isnerta=$rs_data->fields[$fuente_precio];
		
$gconve_precio=0; 
if($conve_id>0)
{
	$busca_valorconvenio="select * from cesdb_arextension.dns_gridconvenios conve inner join efacsistema_producto on conve.prod_enlace=efacsistema_producto.prod_enlace where prod_id='".$rs_data->fields["prod_id"]."' and gconve_convenio='".$conve_id."'";
	$rs_valorconvenio = $DB_gogess->executec($busca_valorconvenio,array());
	$gconve_precio=$rs_valorconvenio->fields["gconve_precio"];
}
  
//ver precio convenio

if($gconve_precio>0)
	{
	    //$saca_descuentovalor=($conve_descuento*$rs_dataproducto->fields[$valor_precio])/100;
		$valor_precio_isnerta=$gconve_precio;
	
	}  
	     
       ?>
  <tr>
    <td onClick="agregar_servicio('<?php echo $rs_data->fields["usuat_id"]; ?>','<?php echo $rs_data->fields["prod_id"]; ?>','<?php echo $_POST["prof_id"]; ?>')" style="cursor:pointer" ><img src="images/bekosell.png"></td>
    <td><?php echo $cuenta; ?></td>
	<td><?php echo $rs_data->fields["prod_codigo"]; ?></td>  
	<td><?php echo $rs_dataespcialidad->fields["prof_nombre"]; ?>(<?php echo $rs_data->fields["prod_nombre"]; ?>)</td>    
	<td nowrap="nowrap">$ <?php echo $valor_precio_isnerta; ?></td>  
  </tr>
  <?php
        $rs_data->MoveNext();
	  }
  }

  ?>

</table>
<div id="agregar_servicio" style="height:30px"></div>
</div>
</div>

<script language="javascript">
<!--
function agregar_servicio(idinsumo,prod_id,prof_id)
{

	
$("#agregar_servicio").load("templateformsweb/maestro_standar_recibos/agregar_servicio.php",{
usua_id:idinsumo,
prod_id:prod_id,
tippo_id:'<?php echo $tippo_id; ?>',
enlace:'<?php echo $_POST["pVar1"]; ?>',
conve_id:'<?php echo $_POST["conve_id"]; ?>',
doccab_autorizacion:'<?php echo $_POST["doccab_autorizacion"]; ?>',
prof_id:prof_id

 },function(result){       
			
			grid_factura(0);
			//divBody_insumo
			$('#divDialog_insumo').dialog( "close" );
			 
  });  
  $("#agregar_servicio").html("Espere un momento...");


}

//-->
</script>

<?php
}
else
{

$varable_enviafunc='';
   $varable_enviafunc=base64_encode("buscar_terapia()");
	
		
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