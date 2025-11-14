<?php
$tiempossss=44440000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");


$valor_b=$_POST["valor_b"];
$conve_id=$_POST["conve_id"];
$pVar1=$_POST["pVar1"];
$valor_porcentaje=$_POST["valor_porcentaje"];

if($conve_id=='')
{
 $conve_id=6;
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
$lista_servicios="select * from dns_hill where hill_codigo like '%".$valor_b."%' or hill_descripcion like '%".$valor_b."%'";

?>

<div class="table-responsive">
<div id="diasHabilitados">

<table class="table table-bordered"  style="width:100%" >
  <tr bgcolor="#73A4AC">
    <td style="color:#FFFFFF"></td>
    <td style="color:#FFFFFF">No</td>
	<td style="color:#FFFFFF" >C&oacute;digo</td>
	<td style="color:#FFFFFF" >Descripci&oacute;n</td>
	<td style="color:#FFFFFF" >Precio Unitario</td>
  </tr>
  <?php 
 $rs_data = $DB_gogess->executec($lista_servicios,array());
 if($rs_data)
 {

	  while (!$rs_data->EOF) {	
	    $cuenta++;         
		$precio_valor=0;	
		
		if($rs_data->fields["hill_codigo"]=='AYUDANTE' or $rs_data->fields["hill_codigo"]=='ANESTESIOLOGO')
		{
		  $precio_valor=0;	
		  $busca_detalles="select sum(docdet_total) as total from beko_recibodetalle where doccab_id='".$pVar1."'  and docdet_detallea='MAC'";
		  $rs_detalles = $DB_gogess->executec($busca_detalles,array());
		  
		  if($valor_porcentaje>0)
		  {
		    $precio_valor=($rs_detalles->fields["total"]*$valor_porcentaje)/100;
		  }
		
		}
		else
		{
		
		$precio_valor=0;		
		//busca si hay convenio y calcula el precio		
		$busca_cnv="select * from cesdb_arextension.dns_gridconvenioshill where hill_enlace='".$rs_data->fields["hill_enlace"]."' and gconvehil_convenio='".$conve_id."'";
		$rs_cnv = $DB_gogess->executec($busca_cnv,array());
		
		$precio_valor=$rs_data->fields["hill_medicos"]*$rs_cnv->fields["gconvehil_precio"];
		
		if($valor_porcentaje>0)
		{
		  $precio_valor=($precio_valor*$valor_porcentaje)/100;
		
		} 
		
		//busca si hay convenio y calcula el precio
		
		}
       ?>
  <tr>
    <td onClick="agregar_serviciohill('<?php echo $rs_data->fields["hill_id"]; ?>')" style="cursor:pointer" ><img src="images/bekosell.png"></td>
    <td><?php echo $cuenta; ?></td>
	<td><?php echo $rs_data->fields["hill_codigo"]; ?></td>
	<td><?php echo $rs_data->fields["hill_descripcion"]; ?></td>  
	<td><?php echo $precio_valor; ?></td>    
  </tr>
  <?php
        $rs_data->MoveNext();
	  }
  }

  ?>

</table>
<div id="agregar_serviciohill" style="height:30px"></div>
</div>
</div>

<script language="javascript">
<!--
function agregar_serviciohill(hill_id)
{

	
$("#agregar_serviciohill").load("templateformsweb/maestro_standar_recibos/agregar_serviciohill.php",{
hill_id:hill_id,
valor_porcentaje:'<?php echo $valor_porcentaje; ?>',
enlace:'<?php echo $pVar1; ?>',
conve_id:'<?php echo $conve_id; ?>',
cant_valor:$('#cant_valor').val()

 },function(result){       
			
			grid_factura(0);
			//divBody_insumo
			//$('#divDialog_insumo').dialog( "close" );
			 
  });  
  $("#agregar_serviciohill").html("Espere un momento...");


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