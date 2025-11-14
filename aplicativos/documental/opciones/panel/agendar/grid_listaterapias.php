<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',1);
error_reporting(E_ALL);
$tiempossss=140000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");
?>
<style type="text/css">
<!--

.txt_titulo {

	font-size: 11px;

	font-family: Verdana, Arial, Helvetica, sans-serif;

	font-weight: bold;

	border: 1px solid #666666;			

 }

.txt_txt {

	font-size: 11px;

	font-family: Verdana, Arial, Helvetica, sans-serif;

	border: 1px solid #666666;			

 }

.Estilo1 {font-size: 10px}

-->
</style>

<?php
$itme_fac=array(); 
 $condatos_fac=array();
$busca_facturadas="select terap_id,doccab_ndocumento,doccab_fechaemision_cliente from beko_documentocabecera inner join beko_documentodetalle on beko_documentocabecera.doccab_id=beko_documentodetalle.doccab_id where 	atenc_hc='".$_POST['atenc_hc']."'";
$rs_facturadas = $DB_gogess->executec($busca_facturadas,array());
$vb=0;
if($rs_facturadas)
{
  while (!$rs_facturadas->EOF) {	
   
   $itme_fac=explode(",",$rs_facturadas->fields["terap_id"]);
   
   
   
   for($i=0;$i<count($itme_fac);$i++)
   {
    if($itme_fac[$i]>0)
	{
	 
	 $condatos_fac[$itme_fac[$i]]["nfactura"]=$rs_facturadas->fields["doccab_ndocumento"];
	 $condatos_fac[$itme_fac[$i]]["fechafactura"]=$rs_facturadas->fields["doccab_fechaemision_cliente"];

	}

   }
   

   
   $rs_facturadas->MoveNext();
  }


}


?>

<div class="table-responsive">

<table class="table table-bordered"  style="width:100%" >

  <tr>

    <td>Eliminar</td>
	<td>Especialidad</td>
	<td>Terapista</td>
	<td>Fecha</td>
	<td>Hora</td>
	<td>Estado</td>
    <td>Autorizaci&oacute;n</td>
	<td>N.Factura</td>
  </tr>

  <?php

    $cuenta=0;

 $lista_servicios="select * from  faesa_terapiasregistro where atenc_hc='".$_POST['atenc_hc']."' order by terap_fecha asc";

 $rs_data = $DB_gogess->executec($lista_servicios,array());

 if($rs_data)

 {

	  while (!$rs_data->EOF) {	

	    $cuenta++;
		
		$link_borrar="borrar_registro('faesa_terapiasregistro','terap_id','".$rs_data->fields["terap_id"]."');";
		
		$nombre_especialidad="select * from dns_especialidad where especi_id=".$rs_data->fields["especi_id"];
		$rs_especo = $DB_gogess->executec($nombre_especialidad,array());
		
		
		$nombre_uus="select * from app_usuario where usua_id=".$rs_data->fields["usua_id"];
		$rs_uus = $DB_gogess->executec($nombre_uus,array());

  ?>

  <tr>
 <?php
 if(@$condatos_fac[$rs_data->fields["terap_id"]]["nfactura"])
 {
 ?>
 <td > Facturado </td>
 <?php
 }
 else
 { 
  ?>
    <td onClick="<?php echo $link_borrar; ?>" style="cursor:pointer" ><span class="glyphicon glyphicon-ban-circle"></span></td>
<?php
}
?>
	<td><?php echo $rs_especo->fields["especi_nombre"]; ?></td>
	<td><?php echo $rs_uus->fields["usua_nombre"]." ".$rs_uus->fields["usua_apellido"]; ?></td>
	<td><?php echo $rs_data->fields["terap_fecha"]; ?></td>
	<td><?php echo $rs_data->fields["terap_hora"]; ?></td>
	<td><?php echo $rs_data->fields["terap_estado"]; ?></td>
	<td><?php echo $rs_data->fields["terap_autorizacion"]; ?></td>
	<td><?php echo @$condatos_fac[$rs_data->fields["terap_id"]]["nfactura"]; ?></td>

    
  </tr>

  <?php

   $rs_data->MoveNext();	   

	  }

  }

  ?>

</table>

</div>