<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4444450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

$objformulario= new  ValidacionesFormulario();


$centro_id=$_POST["centro_id"];
$usua_id=$_POST["usua_id"];
$cierr_fecha=$_POST["cierr_fecha"];
$cierr_fechafin=$_POST["cierr_fechafin"];

if($_SESSION['ces1313777_sessid_inicio'])
{

$taabla_cab='';
$ver_linkpdf='';
//if($_POST["ctpc_id"]==1)
//{
   $taabla_cab='beko_documentocabecera';
   $ver_linkpdf='ver_pdf';
//}

//if($_POST["ctpc_id"]==2)
//{
   //$taabla_cab='beko_recibocabecera'; 
   //$ver_linkpdf='ver_pdfrecibo';   
//}

//$lista_fac="select * from ".$taabla_cab." where centro_id='".$centro_id."' and usua_id='".$usua_id."' and DATE_FORMAT(doccab_fechaemision_cliente,'%Y-%m-%d')='".$cierr_fecha."' and doccab_anulado=0 order by doccab_id asc";

if($cierr_fechafin!='' and  $cierr_fechafin!='0000-00-00')
{
$lista_fac="select * from beko_documentocabecera inner join lpin_formapagoventa on beko_documentocabecera.doccab_id=lpin_formapagoventa.doccab_id where  beko_documentocabecera.usua_id='".$usua_id."' and (DATE_FORMAT(doccab_fechaemision_cliente,'%Y-%m-%d')>='".$cierr_fecha."' and DATE_FORMAT(doccab_fechaemision_cliente,'%Y-%m-%d')<='".$cierr_fechafin."') and doccab_anulado=0 order by beko_documentocabecera.doccab_id asc";


}
else
{

$lista_fac="select * from beko_documentocabecera inner join lpin_formapagoventa on beko_documentocabecera.doccab_id=lpin_formapagoventa.doccab_id where  beko_documentocabecera.usua_id='".$usua_id."' and DATE_FORMAT(doccab_fechaemision_cliente,'%Y-%m-%d')='".$cierr_fecha."' and doccab_anulado=0 order by beko_documentocabecera.doccab_id asc";

}

//echo $lista_fac;

//$lista_fac="select * from ".$taabla_cab." where centro_id='".$centro_id."'  and DATE_FORMAT(doccab_fechaemision_cliente,'%Y-%m-%d')='".$cierr_fecha."' order by doccab_id asc";
?>
<table width="100%" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#BDD7EC"><b>No.</b></td>
    <td bgcolor="#BDD7EC"><b>Fecha</b></td>
	<td bgcolor="#BDD7EC"><b>Forma de Pago</b></td>
    <td bgcolor="#BDD7EC"><b>No. Doc</b></td>
    <td bgcolor="#BDD7EC"><b>Cliente</b></td>
    <td bgcolor="#BDD7EC"><b>Ruc</b></td>
    <td bgcolor="#BDD7EC"><b>Total</b></td>
    <td bgcolor="#BDD7EC"><b>Ver PDF</b></td>
  </tr>
  
<?php
$grantotal=0;
$num_data=0;
 $rs_data = $DB_gogess->executec($lista_fac,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {
	  
	  $num_data++;

	  $forma_pago='';
	  
	 
	$busca_fpagox="select * from lpin_formapagoventa where doccab_id='".$rs_data->fields["doccab_id"]."' and frmc_codigo='".$rs_data->fields["frmc_codigo"]."' and frmpven_id='".$rs_data->fields["frmpven_id"]."'";
    $rs_fpagox = $DB_gogess->executec($busca_fpagox,array());	
     
	if($rs_fpagox->fields["frmc_codigo"]=='01')
	{
	  $forma_pago='EFECTIVO'; 
	}
	
	if($rs_fpagox->fields["frmc_codigo"]=='19')
	{
	  $forma_pago='TARJETA DE CREDITO'; 
	}
	
	if($rs_fpagox->fields["frmc_codigo"]=='16')
	{
	  $forma_pago='TARJETA DE DEBITO'; 
	}
	
	if($rs_fpagox->fields["frmc_codigo"]=='20')
	{
	  $forma_pago='TRANSFERENCIA'; 
	}
	 
	
	 
	$bunombre=''; 
	$bunombre=$objformulario->replace_cmb("cesdb_arextension.dns_tipoproceso","tippo_id,tippo_nombre","where tippo_id=",$rs_data->fields["tippo_id"],$DB_gogess);
	$nombreptxt='';
	if($rs_data->fields["tippo_id"]==2 or $rs_data->fields["tippo_id"]==8)
	{
	  $nombreptxt=" (".$bunombre.")";
	}
	
	//$busca_saldo="select * from beko_documentocabecera_vista where doccab_id='".$rs_data->fields["doccab_id"]."'";
	//$rs_busaldo = $DB_gogess->executec($busca_saldo,array());
	//$saldo=$rs_busaldo->fields["saldo"];
	
	$saldo=$rs_data->fields["doccab_saldohoracierre"];

	if($rs_data->fields["tippo_id"]==1 or ($rs_data->fields["tippo_id"]==2 and $saldo>0) or ($rs_data->fields["tippo_id"]==8 and $saldo>0))
	{
	  $forma_pago='CUENTAS POR COBRAR'.$nombreptxt; 
	}
	
	$frmpven_valor=0;
	$frmpven_valor=$rs_fpagox->fields["frmpven_valor"];	
?>  
  <tr>
    <td><?php echo $num_data; ?></td>
    <td><?php echo $rs_data->fields["doccab_fechaemision_cliente"]; ?></td>
	<td><?php echo $forma_pago; ?></td>
    <td><?php echo $rs_data->fields["doccab_ndocumento"]; ?></td>
    <td><?php echo $rs_data->fields["doccab_nombrerazon_cliente"]." ".$rs_data->fields["doccab_apellidorazon_cliente"]; ?></td>
    <td><?php echo $rs_data->fields["doccab_rucci_cliente"]; ?></td>
    <td><?php echo $frmpven_valor; ?></td>
    <td><input type="button" name="Button" value="PDF" onClick="<?php echo $ver_linkpdf; ?>('<?php echo $rs_data->fields["doccab_id"]; ?>','01')" ></td>
  </tr>
<?php
       
	   $grantotal=$grantotal+$frmpven_valor;

        $rs_data->MoveNext();	   
	  }
  }

?> 
 <tr>
    <td bgcolor="#BDD7EC" >&nbsp;</td>
	<td bgcolor="#BDD7EC" >&nbsp;</td>
    <td bgcolor="#BDD7EC" >&nbsp;</td>
    <td bgcolor="#BDD7EC" >&nbsp;</td>
    <td bgcolor="#BDD7EC" >&nbsp;</td>
    <td bgcolor="#BDD7EC" ><b>Total</b></td>
    <td bgcolor="#BDD7EC" ><b><?php echo $grantotal; ?></b></td>
    <td bgcolor="#BDD7EC" >&nbsp;</td>
  </tr> 
</table>
<?php
}

?>