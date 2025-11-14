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

if($_SESSION['ces1313777_sessid_inicio'])
{

$lista_fac="select count(*) totalt from ".$taabla_cab." where centro_id='".$centro_id."' and usua_id='".$usua_id."' and DATE_FORMAT(doccab_fechaemision_cliente,'%Y-%m-%d')='".$cierr_fecha."' and 	doccab_anulado=0 order by doccab_id asc";
$rs_data = $DB_gogess->executec($lista_fac,array());

$lista_facanulada="select count(*) totalt from ".$taabla_cab." where centro_id='".$centro_id."' and usua_id='".$usua_id."' and DATE_FORMAT(doccab_fechaemision_cliente,'%Y-%m-%d')='".$cierr_fecha."' and  doccab_anulado=1 order by doccab_id asc";
$rs_dataanulada = $DB_gogess->executec($lista_facanulada,array());


$array_totales=array();

$total_global=0;

$lista_facefectivo="select * from ".$taabla_cab." where centro_id='".$centro_id."' and usua_id='".$usua_id."' and DATE_FORMAT(doccab_fechaemision_cliente,'%Y-%m-%d')='".$cierr_fecha."' and doccab_anulado=0  order by doccab_id asc";
$rs_dataefectivo = $DB_gogess->executec($lista_facefectivo,array());

 if($rs_dataefectivo)
 {
	  while (!$rs_dataefectivo->EOF) {
	  
	  
	    $total_global=$total_global+$rs_dataefectivo->fields["doccab_total"];
		
		 
	    $forma_pago='';
		if($_POST["ctpc_id"]==1)
        {
		
	    if($rs_dataefectivo->fields["tippo_id"]==1)
		  {  
			$forma_pago='CREDITO';    
		  }
		  else
		  {
			 
			if($rs_dataefectivo->fields["doccab_fpago"]=='01')
			{
			  $forma_pago='EFECTIVO'; 
			}
			
			if($rs_dataefectivo->fields["doccab_fpago"]=='19')
			{
			  $forma_pago='TARJETA DE CREDITO'; 
			}
			
			if($rs_dataefectivo->fields["doccab_fpago"]=='16')
			{
			  $forma_pago='TARJETA DE DEBITO'; 
			}
			
		  }
		  
		  }
		  
		  if($_POST["ctpc_id"]==2)
          {
		     $forma_pago='CREDITO';
		  
		  }
		  
	  
	     $array_totales[$forma_pago]=$array_totales[$forma_pago]+$rs_dataefectivo->fields["doccab_total"];
	  
	  
	  $rs_dataefectivo->MoveNext();	   
	  }
  }


//print_r($array_totales);


$lista_valoranulado="select sum(doccab_total) as tanulado from ".$taabla_cab." where centro_id='".$centro_id."' and usua_id='".$usua_id."' and DATE_FORMAT(doccab_fechaemision_cliente,'%Y-%m-%d')='".$cierr_fecha."' and doccab_anulado=1  order by doccab_id asc";
$rs_datavanulado = $DB_gogess->executec($lista_valoranulado,array());

$array_totales["EFECTIVO"]=$array_totales["EFECTIVO"]*1;
?>

<script language="javascript">
<!--

$('#cierr_ntransacciones').val('<?php echo $rs_data->fields["totalt"]; ?>');

$('#cierr_efectivo').val('<?php echo $array_totales["EFECTIVO"]; ?>');

$('#cierr_cheque').val('');

$('#cierr_credito').val('<?php echo $array_totales["CREDITO"]; ?>');

$('#cierr_tarjetacredito').val('<?php echo $array_totales["TARJETA DE CREDITO"]; ?>');

$('#cierr_transferencia').val('');

$('#cierr_otros').val('');

$('#cierr_total').val('<?php echo $total_global; ?>');

$('#cierr_anulados').val('<?php echo $rs_dataanulada->fields["totalt"]; ?>');

$('#cierr_valoranulado').val('<?php echo $rs_datavanulado->fields["tanulado"]; ?>');



guarda_data();

//-->
</script>


<script language="javascript">
<!--
<?php
$cierr_enlace=$_POST["cierr_enlace"];
$total_dineromoneda="select sum(ingefec_valor) as total_moneda from cesdb_arextension.app_ingresoefectivo where cierr_enlace='".$cierr_enlace."'";
$rs_dineromoneda = $DB_gogess->executec($total_dineromoneda,array());
$total_moneda=0;
$total_moneda=number_format($rs_dineromoneda->fields["total_moneda"], 2, '.', '');

?>

  $('#cierr_totaldinero').val('<?php echo $total_moneda*1; ?>');
  
  //alert($('#cierr_totaldinero').val());
  //alert($('#cierr_total').val());
  
 if($('#cierr_totaldinero').val()!=$('#cierr_efectivo').val())
  {  
 
 //=============================================== 
  if($('#cierr_totaldinero').val()>$('#cierr_efectivo').val())
  {
  
      $('#data_alerta').html('<span style="font-size:14px; color:#FF0000"><b>Alerta!!! Sobrante</b></span>');	  
	  $('#estac_id').val(2);
	  $('#despliegue_estac_id').html('<span style="color:#FF0000">DINERO EXCEDENTE</span>');
  }
  else
  {
     $('#data_alerta').html('<span style="font-size:14px; color:#FF0000"><b>Alerta!!! Faltante</b></span>');
	 $('#estac_id').val(1);
	 $('#despliegue_estac_id').html('<span style="color:#FF0000">DINERO FALTANTE</span>');
  
  }
 //=================================================
 
 } 
 else
 {
    $('#data_alerta').html('');
	
    $('#estac_id').val(3);
	$('#despliegue_estac_id').html('CUADRADO');
	
 }
  
  
//-->
</script>

<?php
}

?>

