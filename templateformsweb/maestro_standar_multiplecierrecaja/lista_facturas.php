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

if($_SESSION['ces1313777_sessid_inicio'])
{

$taabla_cab='';
$ver_linkpdf='';
if($_POST["ctpc_id"]==1)
{
   $taabla_cab='beko_documentocabecera';
   $ver_linkpdf='ver_pdf';
}

if($_POST["ctpc_id"]==2)
{
   $taabla_cab='beko_recibocabecera'; 
   $ver_linkpdf='ver_pdfrecibo';
   
}

$lista_fac="select * from ".$taabla_cab." where centro_id='".$centro_id."' and usua_id='".$usua_id."' and DATE_FORMAT(doccab_fechaemision_cliente,'%Y-%m-%d')='".$cierr_fecha."' and doccab_anulado=0 order by doccab_id asc";


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
	  if($_POST["ctpc_id"]==1)
     {
	    if($rs_data->fields["tippo_id"]==1)
		  {  
			$forma_pago='CREDITO';    
		  }
		  else
		  {
			 
			if($rs_data->fields["doccab_fpago"]=='01')
			{
			  $forma_pago='EFECTIVO'; 
			}
			
			if($rs_data->fields["doccab_fpago"]=='19')
			{
			  $forma_pago='TARJETA DE CREDITO'; 
			}
			
			if($rs_data->fields["doccab_fpago"]=='16')
			{
			  $forma_pago='TARJETA DE DEBITO'; 
			}
			
		  }
	  
	 }
	 
	 if($_POST["ctpc_id"]==2)
     {
	     if($rs_data->fields["tippo_id"]==2)
		  {
		    $forma_pago='CONVENIOS'; 
		  }
		 if($rs_data->fields["tippo_id"]==4)
		  {
		    $forma_pago='IESS'; 
		  }
		 if($rs_data->fields["tippo_id"]==5)
		  {
		    $forma_pago='MOVILIDAD'; 
		  }
		 if($rs_data->fields["tippo_id"]==6)
		  {
		    $forma_pago='GRATUIDAD'; 
		  }  
		   
	 } 
?>  
  <tr>
    <td><?php echo $num_data; ?></td>
    <td><?php echo $rs_data->fields["doccab_fechaemision_cliente"]; ?></td>
	<td><?php echo $forma_pago; ?></td>
    <td><?php echo $rs_data->fields["doccab_ndocumento"]; ?></td>
    <td><?php echo $rs_data->fields["doccab_nombrerazon_cliente"]." ".$rs_data->fields["doccab_apellidorazon_cliente"]; ?></td>
    <td><?php echo $rs_data->fields["doccab_rucci_cliente"]; ?></td>
    <td><?php echo $rs_data->fields["doccab_total"]; ?></td>
    <td><input type="button" name="Button" value="PDF" onClick="<?php echo $ver_linkpdf; ?>('<?php echo $rs_data->fields["doccab_id"]; ?>','01')" ></td>
  </tr>
<?php
       
	   $grantotal=$grantotal+$rs_data->fields["doccab_total"];

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