<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();



if($_SESSION['ces1313777_sessid_inicio'])
{

$crudoc_id=$_POST["valor_id"];

$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");
$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();

?>
<table border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>N</td>
	<td>N_COMPORBANTE</td>
    <td>TABLA P </td>
    <td>CAMPO P </td>
    <td>TABLA S </td>
    <td>CAMPO S </td>
    <td>CAMPO S OBTENIDO </td>
	<td></td>
    <td>N FACTURA </td>
	<td></td>
  </tr>

<?php
$cuenta=0;
$lista_compronteserroneos="SELECT * FROM `lpin_comprobantecontable` WHERE `comcont_tablas` LIKE 'dns_compras' and `comcont_idtablas`='' ORDER BY `lpin_comprobantecontable`.`comcont_fecha` DESC";
$rs_ventas = $DB_gogess->executec($lista_compronteserroneos);

	if($rs_ventas)
	{
	   while (!$rs_ventas->EOF) 
			{
			
			 
			 $busca_data="select * from ".$rs_ventas->fields["comcont_tabla"]." where crudoc_id='".$rs_ventas->fields["comcont_idtabla"]."'";
			 $rs_data = $DB_gogess->executec($busca_data);
			 
			 $doccabcr_id=$rs_data->fields["doccabcr_id"];
			 $compracr_id=$rs_data->fields["compracr_id"];
			 
			 $num_factura="select * from beko_documentocabecera where doccab_id='".$doccabcr_id."'";
			 $rs_factura = $DB_gogess->executec($num_factura);
		
		$cuenta++;	 
			 echo '  <tr>
			 
    <td>'.$cuenta.'</td>
	<td>'.$rs_ventas->fields["comcont_id"].'</td>
    <td>'.$rs_ventas->fields["comcont_tabla"].'</td>
    <td>'.$rs_ventas->fields["comcont_idtabla"].'</td>
    <td>'.$rs_ventas->fields["comcont_tablas"].'</td>
    <td>'.$rs_ventas->fields["comcont_idtablas"].'</td>
    <td>'.$doccabcr_id.'</td>
	<td>'.$compracr_id.'</td>
    <td>'.$rs_factura->fields["doccab_ndocumento"].'</td>';
	

  
  $comcont_concepto=$rs_ventas->fields["comcont_concepto"];
  
  $doccab_ndocumento=$rs_factura->fields["doccab_ndocumento"];
  $doccab_nombrerazon_cliente=$rs_factura->fields["doccab_nombrerazon_cliente"];
  
  $ctualiza="update lpin_comprobantecontable set comcont_concepto='".$comcont_concepto.' '.$doccab_ndocumento.' '.$doccab_nombrerazon_cliente."',comcont_proceso=1,tipoa_id=7,comcont_tablas='".beko_documentocabecera."',comcont_idtablas='".$doccabcr_id."' where comcont_id='".$rs_ventas->fields["comcont_id"]."'";
  $rs_acdatax = $DB_gogess->executec($ctualiza);		 
	
	echo '<td>'.$ctualiza.'</td>';		 
	  echo '</tr>';		 
			  
			  $rs_ventas->MoveNext();
			}
	}		

?>
</table>

<?php

}
?>