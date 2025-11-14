<?php
ini_set("session.cookie_lifetime",36000);
ini_set("session.gc_maxlifetime",36000);
session_start();
/***VARIABLES POR GET ***/
$numero = count($_GET);
$tags = array_keys($_GET);// obtiene los nombres de las varibles
$valores = array_values($_GET);// obtiene los valores de las varibles


 $director='../../../';
 include("../../../cfg/clases.php");
 include("../../../cfg/declaracion.php");
 include(@$director."libreria/estructura/aqualis_master.php");
 $objformulario= new  ValidacionesFormulario();


$comcont_id=$_POST["pVar1"];



$lista_data="select * from  lpin_comprobantecontable where comcont_id='".$comcont_id."'";
$registros_data = $DB_gogess->executec($lista_data,array());

 if($registros_data)
 {
	  while (!$registros_data->EOF) {	
	  
	  
$plantilla='';
$plantilla='<br><table width="90%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" bgcolor="#D8EDEC"><div align="center"><b>ASIENTOS CONTABLES</b></div></td>
  </tr>
  <tr>
    <td><b>C&oacute;digo:</b></td>
    <td>-comcont_id-</td>
  </tr>
  <tr>
    <td><b>Tipo:</b></td>
    <td>-tipoa_id-</td>
  </tr>  
  <tr>
    <td><b>Fecha:</b></td>
    <td>-comcont_fecha-</td>
  </tr>
  <tr>
    <td><b>Concepto:</b></td>
    <td>-comcont_concepto-</td>
  </tr>
</table>
';

$table='lpin_comprobantecontable';
$plantilla=$objvarios->llena_plantilladata($plantilla,$table,$DB_gogess,$objformulario,$registros_data);

echo $plantilla;
	  
$sumadebe=0;
 $sumahaber=0;
 	  
?>	  
<br />	  
<table class="table table-bordered"  style="width:100%" >
  <tr>
    <td bgcolor="#DFE9EE" ><b>Cuenta</b></td>
	<td bgcolor="#DFE9EE" ><b>Debe</b></td>
	<td bgcolor="#DFE9EE" ><b>Haber</b></td>
	<td bgcolor="#DFE9EE" ><b>Centro de Costos</b></td>

  </tr>
 <?php
 $lista_asientos="select * from lpin_detallecomprobantecontable left join lpin_plancuentas on lpin_detallecomprobantecontable.detcc_cuentacontable=lpin_plancuentas.planc_codigoc where comcont_enlace='".$registros_data->fields["comcont_enlace"]."' order by detcc_tipo asc";
 $lista_asientos = $DB_gogess->executec($lista_asientos,array());
 if($lista_asientos)
 {
	  while (!$lista_asientos->EOF) {	
	  
	  $busca_ccostos="select * from lpin_centrodecostos where centcost_id='".$lista_asientos->fields["centcost_id"]."'";
	  $lista_ccostos = $DB_gogess->executec($busca_ccostos,array());
 ?>   
  <tr>
    <td><?php echo $lista_asientos->fields["planc_codigoc"]." ".$lista_asientos->fields["planc_nombre"]; ?></td>
	<td><?php echo $lista_asientos->fields["detcc_debe"]; ?></td>
	<td><?php echo $lista_asientos->fields["detcc_haber"]; ?></td>
	<td><?php echo $lista_ccostos->fields["centcost_nombre"]; ?></td>

  </tr>
 <?php
 
 $sumadebe=$sumadebe+$lista_asientos->fields["detcc_debe"];
 $sumahaber=$sumahaber+$lista_asientos->fields["detcc_haber"];
 
            $lista_asientos->MoveNext();	
			
		   }
 }
 ?> 
 
  <tr>
    <td><b>Totales</b></td>
	<td><b><?php echo $sumadebe; ?></b></td>
	<td><b><?php echo $sumahaber; ?></b></td>
	<td></td>
	<td></td>
  </tr>
</table> 

<?php	  
	   $registros_data->MoveNext();
	  }
 }	  


?>