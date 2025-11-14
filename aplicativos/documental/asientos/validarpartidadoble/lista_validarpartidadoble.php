<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Genera</title>
<style type="text/css">
<!--
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
}
-->
</style>



</head>

<body>
<?php


if($_SESSION['ces1313777_sessid_inicio'])
{

$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");
$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();

$contador=0;
 $totalvalor=0;
 $colord_data='';
 $totalvalorxml=0;
 $suma_array=array();
?>
<table border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#F0F0F0"><strong>No</strong></td>
	<td bgcolor="#F0F0F0"><strong>ID</strong></td>
	<td bgcolor="#F0F0F0"><strong>FECHA</strong></td>
    <td bgcolor="#F0F0F0"><strong>CONCEPTO</strong></td>
    <td bgcolor="#F0F0F0"><strong>NUMERO DE COMPROBANTE</strong></td>
	<td bgcolor="#F0F0F0"><strong>TIPO</strong></td>
	<td bgcolor="#F0F0F0"><strong>ANULADO</strong></td>
	<td bgcolor="#F0F0F0"><strong>DEBE</strong></td>
	<td bgcolor="#F0F0F0"><strong>HABER</strong></td>
	<td bgcolor="#F0F0F0"><strong>DIFERENTE</strong></td>
  </tr>
<?php
$suma_debe=0;
$suma_haber=0;

$busca_listatx="select * from lpin_comprobantecontable where comcont_fecha>='2023-06-30' and comcont_fecha<='2023-12-06'";
//$busca_listatx="select * from lpin_comprobantecontable where comcont_fecha>='2023-01-01' and comcont_fecha<='2023-06-30'";
$rs_listatx = $DB_gogess->executec($busca_listatx);
if($rs_listatx)
	{
	   while (!$rs_listatx->EOF) 
			{
			
			///saca el debe
			$lista_debe="select sum(detcc_debe) as detcc_debe from lpin_detallecomprobantecontable where comcont_enlace='".$rs_listatx->fields["comcont_enlace"]."'";
			$rs_debe = $DB_gogess->executec($lista_debe);
			//saca el debe
			
			//saca el haber
			$lista_haber="select sum(detcc_haber) as detcc_haber from lpin_detallecomprobantecontable where comcont_enlace='".$rs_listatx->fields["comcont_enlace"]."'";
			$rs_haber = $DB_gogess->executec($lista_haber);
			//saca el habr
			
		$colord_data='';
		$contador++;
		
		$diferente='';
		if(round($rs_debe->fields["detcc_debe"],2)!=round($rs_haber->fields["detcc_haber"],2))
		{
		  $diferente='ALERTA';
		}
		
			?>
  <tr <?php echo $colord_data; ?> >
    <td><?php echo $contador; ?></td>
	<td><?php echo $rs_listatx->fields["comcont_id"]; ?></td>
	<td><?php echo $rs_listatx->fields["comcont_fecha"]; ?></td>	
    <td><?php echo $rs_listatx->fields["comcont_concepto"]; ?></td>
    <td><?php echo $rs_listatx->fields["comcont_numeroc"]; ?></td>
	<td><?php echo $rs_listatx->fields["tipoa_id"]; ?></td>
	<td><?php echo $rs_listatx->fields["comcont_anulado"]; ?></td>
	<td><?php echo round($rs_debe->fields["detcc_debe"],2); ?></td>
	<td><?php echo round($rs_haber->fields["detcc_haber"],2); ?></td>
	<td><b><?php echo $diferente; ?></b></td>
  </tr>
			<?php
			
			$suma_debe=$suma_debe+round($rs_debe->fields["detcc_debe"],2);
			
			$suma_haber=$suma_haber+round($rs_haber->fields["detcc_haber"],2);

			
	//}		
			
			$rs_listatx->MoveNext();
			}
	}		

?>

<tr  bgcolor="#CCCCCC">
    <td></td>
	<td></td>
    <td></td>
	<td></td>
    <td></td>
	<td></td>
	<td></td> 
	<td><?php echo $suma_debe; ?></td> 
	<td><?php echo $suma_haber; ?></td> 
	<td></td> 
  </tr>
  
</table>

<?php
//print_r($suma_array);
}
?>



<script type="text/javascript">
<!--





//  End -->
</script>


</body>
</html>
