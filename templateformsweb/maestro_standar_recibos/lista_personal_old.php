<?php
$tiempossss=44440000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");
if($_SESSION['ces1313777_sessid_inicio'])
{

$objformulario= new  ValidacionesFormulario();

$sql1='';
$sql2='';

//valor_b

if($_POST["prof_nombreval"])
{
$sql1=" usua_formaciondelprofesional like '".@$_POST["prof_nombreval"]."' and ";
}

if($_POST["valor_b"])
{
$sql2=" (usua_formaciondelprofesional like '%".@$_POST["valor_b"]."%' or usua_nombre like '%".$_POST["valor_b"]."%' or usua_apellido like '%".$_POST["valor_b"]."%') and (usua_formaciondelprofesional in(select prof_nombre from cesdb_arextension.dns_profesion where prof_nosalir=0)) and ";
}


$concatenado=$sql1.$sql2;
$concatenado=substr($concatenado,0,-4);

?>

<style type="text/css">
<!--
.Estilo5 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
-->
</style>


<div class="table-responsive">

<div id="diasHabilitados">

<div id="agregar_servicio" style="height:30px"></div>

<table class="table table-bordered"  style="width:100%" >
  <tr bgcolor="#73A4AC">
    <td style="color:#FFFFFF"></td>
    <td style="color:#FFFFFF">No</td>
    <td style="color:#FFFFFF" >Nombre Profesional</td>
	<td style="color:#FFFFFF" >Area</td>
  </tr>
  <?php

 $cuenta=0;
  
 if($concatenado)
 {
   $lista_servicios="select * from  app_usuario where usua_ciruc not in('1711467884','1714907449') and (usua_formaciondelprofesional in(select prof_nombre from cesdb_arextension.dns_profesion where prof_nosalir=0)) and ".$concatenado."  and usua_estado=1 and centro_id='".$_SESSION['ces1313777_centro_id']."'";
 }
 else
 {
   $lista_servicios="select * from  app_usuario where usua_ciruc not in('1711467884','1714907449') and (usua_formaciondelprofesional in(select prof_nombre from cesdb_arextension.dns_profesion where prof_nosalir=0)) and usua_estado=1 and centro_id='".$_SESSION['ces1313777_centro_id']."'";
 }
 
 
 $rs_data = $DB_gogess->executec($lista_servicios,array());
 if($rs_data)
 {

	  while (!$rs_data->EOF) {	
	    $cuenta++;         
       ?>
  <tr>
    <td onClick="agregar_servicio('<?php echo $rs_data->fields["usua_id"]; ?>')" style="cursor:pointer" ><img src="images/bekosell.png"></td>
    <td><?php echo $cuenta; ?></td>
	<td><?php echo $rs_data->fields["usua_nombre"]." ".$rs_data->fields["usua_apellido"]; ?></td>
	<td><?php echo $rs_data->fields["usua_formaciondelprofesional"]; ?></td>    
  </tr>
  <?php
        $rs_data->MoveNext();
	  }
  }

  ?>

</table>
</div>

</div>

<script language="javascript">
<!--
function agregar_servicio(idinsumo)
{

	
$("#agregar_servicio").load("templateformsweb/maestro_standar_recibos/agregar_servicio.php",{
usua_id:idinsumo,
enlace:'<?php echo $_POST["pVar1"]; ?>',
conve_id:'<?php echo $_POST["conve_id"]; ?>',
doccab_autorizacion:'<?php echo $_POST["doccab_autorizacion"]; ?>'

 },function(result){       
			
			grid_factura(0);
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