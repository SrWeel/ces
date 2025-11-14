<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


if($_SESSION['ces1313777_sessid_inicio'])
{

$acfi_id=$_POST["valor_id"];

$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");
$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();


?>
<table border="1" align="center" cellpadding="0" cellspacing="0">
<?php
$cuenta=0;
$lista_data="select * from rete_data";
$rs_enlace = $DB_gogess->executec($lista_data);

if($rs_enlace)
	{
	   while (!$rs_enlace->EOF) 
			{
	  
	  $busca_data="select * from comprobante_retencion_cab where compretcab_nretencion='".$rs_enlace->fields["rete_numerodoc"]."'";
	  $rs_bdata = $DB_gogess->executec($busca_data);
	  
	  $compretcab_id=$rs_bdata->fields["compretcab_id"];
	  $rete_estado=$rs_bdata->fields["compretcab_estadosri"];
	  
	  $compra_id=$rs_bdata->fields["compra_id"];
	  $compretcab_anulado=$rs_bdata->fields["compretcab_anulado"];
	  $cuenta++;
			?>
			  
  <tr>
    <td><?php echo $cuenta; ?></td>
	<td><?php echo $rs_enlace->fields["rete_numerodoc"]; ?></td>
    <td><?php echo $rs_enlace->fields["rete_acceso"]; ?></td>
    <td>AUTORIZADO</td>
	<td><?php echo $rete_estado; ?></td>
	<td><?php echo $compra_id; ?></td>
	<td><?php echo $compretcab_anulado; ?></td>
  </tr>
  
  
			<?php
			  $rs_enlace->MoveNext();
			}
    }		

?>
</table>
<?php

}

?>