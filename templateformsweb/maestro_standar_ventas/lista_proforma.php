<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4404000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_SESSION['ces1313777_sessid_inicio'])
{

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

$objformulario= new  ValidacionesFormulario();






$doccab_id=$_POST["doccab_id"];

?>
<table border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#C2E1ED"><strong>ELIMINAR</strong></td>
    <td bgcolor="#C2E1ED"><strong>CODIGO</strong></td>
    <td bgcolor="#C2E1ED"><strong>DESCRIPCION</strong></td>
    <td bgcolor="#C2E1ED"><strong>PRECIO U </strong></td>
    <td bgcolor="#C2E1ED"><strong>CANTIDAD</strong></td>
    <td bgcolor="#C2E1ED"><strong>IMPUESTO</strong></td>
    <td bgcolor="#C2E1ED"><strong>IVA</strong></td>
    <td bgcolor="#C2E1ED"><strong>TOTAL</strong></td>
  </tr>
  
<?php
$asignados="select * from beko_proformamhdetallefactura where doccab_id='".$doccab_id."'";
$rs_asignados = $DB_gogess->executec($asignados,array());

 if($rs_asignados)
 {

	  while (!$rs_asignados->EOF) {	
	  
	   
	  
	  $impumh_codigo=$objformulario->replace_cmb("beko_impuesto","impu_codigo,impu_nombre"," where impu_codigo=",$rs_asignados->fields["impumh_codigo"],$DB_gogess);
	  
	  $tarimh_codigo=$objformulario->replace_cmb("beko_tarifa_vista","hill_taricodigo,tari_nombre"," where hill_taricodigo=",$rs_asignados->fields["tarimh_codigo"],$DB_gogess);
	  
	  
	  $total_val=round(($rs_asignados->fields["mhdetfac_preciou"]*$rs_asignados->fields["mhdetfac_cantidad"]),2);
?>  
  <tr>
    <td><div align="center">
      <input type="submit" name="Submit" value="QUITAR" onClick="lista_quitarproformar('<?php echo $rs_asignados->fields["mhdetfac_id"]; ?>')">
    </div></td>
    <td><?php echo $rs_asignados->fields["mhdetfac_codprincipal"]; ?></td>
    <td><?php echo $rs_asignados->fields["mhdetfac_descripcion"]; ?></td>
    <td><?php echo $rs_asignados->fields["mhdetfac_preciou"]; ?></td>
    <td><?php echo $rs_asignados->fields["mhdetfac_cantidad"]; ?></td>
    <td><?php echo $impumh_codigo; ?></td>
    <td><?php echo $tarimh_codigo; ?></td>
    <td><?php echo $total_val; ?></td>
  </tr>
<?php
           $rs_asignados->MoveNext();	  

	  }
  }
?>  
</table>


<?php

$lista_valor=array();



$lista_detalles="select sum(mhdetfac_total) as total,tarimh_codigo as tari_codigo  from beko_proformamhdetallefactura where doccab_id='".$doccab_id."' group by tarimh_codigo";
$rs_data = $DB_gogess->executec($lista_detalles,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	  
	     $lista_valor[$rs_data->fields["tari_codigo"]]=$lista_valor[$rs_data->fields["tari_codigo"]]+$rs_data->fields["total"];
	  
	    $rs_data->MoveNext();
	  }
  }	    

//print_r($lista_valor);

$lista_detalles="select sum(mhdetfac_descuento) as descuento  from beko_proformamhdetallefactura where doccab_id='".$doccab_id."'";
$rs_data = $DB_gogess->executec($lista_detalles,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	  
	    $array_descuentos["descuento"]=$array_descuentos["descuento"]+$rs_data->fields["descuento"];
	  
	   $rs_data->MoveNext();
	  }
 }	   
 


$valor_iva=array();
$totales_iva=0;
$gran_total=0;


$sacatari="select * from beko_tarifa";
$rs_sacatar = $DB_gogess->executec($sacatari,array());	
 if($rs_sacatar)
 {
	  while (!$rs_sacatar->EOF) {	  
	  
	  $valor_iva[$rs_sacatar->fields["tari_codigo"]]=($lista_valor[$rs_sacatar->fields["tari_codigo"]]*$rs_sacatar->fields["tari_valor"])/100;
	  
	  $gran_total=$gran_total+$lista_valor[$rs_sacatar->fields["tari_codigo"]];
	  $totales_iva=$totales_iva+$valor_iva[$rs_sacatar->fields["tari_codigo"]];
	  
	  $rs_sacatar->MoveNext();
	  }
 }	  
 
 $ttotal=$gran_total+$totales_iva;

?>
<table width="272" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>Subtotal IVA:</td>
    <td><?php echo round($lista_valor[2], 2); ?></td>
  </tr>
  <tr>
    <td>Subtotal sin IVA:</td>
    <td><?php echo round($lista_valor[0], 2); ?></td>
  </tr>
  <tr>
    <td>Iva:</td>
    <td><?php echo round($totales_iva, 2); ?></td>
  </tr>
  
  <tr>
    <td>Total:</td>
    <td><?php echo round($ttotal, 2); ?></td>
  </tr>
</table>



<center>



<a target="_blank" class="btnPrint_imp" href="templateformsweb/maestro_standar_ventas/lista_proformaimp.php?imp=1&pa=<?php echo $doccab_id ?>"><img src="images/btn_imp.png" border="0"></a>


</center>


<?php
}
?>

<div id="borrar_insumoagregado"></div>
<script language="javascript">
<!--

function lista_quitarproformar(id_item)
{
  
    $("#borrar_insumoagregado").load("templateformsweb/maestro_standar_ventas/quitar_proforma.php",{
		id_item:id_item
	  },function(result){  
	  
	     lista_asignadosproformar();
		 
	  });  
	
  $("#borrar_insumoagregado").html("Espere un momento...");  

}

 $(".btnPrint_imp").printPage();
//-->
</script>