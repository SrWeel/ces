<?php
header('Content-Type: text/html; charset=UTF-8');
$tiempossss=44450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

/*echo $_POST["tabla"]."<br>";
echo $_POST["campo"]."<br>";
echo $_POST["id"]."<br>";
echo $_POST["valor"]."<br>";*/

if($_SESSION['ces1313777_sessid_inicio'])
{
$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

$sqltotal="";
$compra_enlace=$_POST["compra_enlace"];

$conct_fechacorte=$_POST["conct_fechacorte"];
$conct_cuenta=$_POST["conct_cuenta"];
$conct_saldobanco=$_POST["conct_saldobanco"];
$conct_idform=$_POST["conct_idform"];

if($_POST["valor"]=='true')
{
$valor=1;

$actualiza_data="update ".$_POST["tabla"]." set ".$_POST["campo"]."='".$valor."',conct_idform='".$conct_idform."' where ".$_POST["campoidtabla"]."='".$_POST["id"]."'";
$okvalor=$DB_gogess->executec($actualiza_data); 

}
else
{
$valor=0;

$actualiza_data="update ".$_POST["tabla"]." set ".$_POST["campo"]."='".$valor."',conct_idform='0' where ".$_POST["campoidtabla"]."='".$_POST["id"]."'";
$okvalor=$DB_gogess->executec($actualiza_data); 

}

//echo $actualiza_data;


}


if($conct_idform>0)
{
$busca_elanterior="select * from app_tarjetaconciliacion where conct_id < ".$conct_idform." order by conct_id desc limit 1";
$rs_ultimafecha = $DB_gogess->executec($busca_elanterior,array());
}
else
{
$busca_elanterior="select * from app_tarjetaconciliacion  order by conct_id desc limit 1";
$rs_ultimafecha = $DB_gogess->executec($busca_elanterior,array());
}


$fecha_corteanterior=$rs_ultimafecha->fields["conct_fechacorte"];
$conct_saldocontableant=$rs_ultimafecha->fields["conct_saldocontable"];


$suma_valort=0;
//$lista_renta="select * from lpin_comprobantecontable inner join lpin_detallecomprobantecontable on lpin_comprobantecontable.comcont_enlace=lpin_detallecomprobantecontable.comcont_enlace where comcont_fecha<='".$conct_fechacorte."' and detcc_cuentacontable='".$conct_cuenta."' order by comcont_fecha asc";


if(!(trim($fecha_corteanterior)))
{
$lista_renta="select * from lpin_comprobantecontable inner join lpin_detallecomprobantecontable on lpin_comprobantecontable.comcont_enlace=lpin_detallecomprobantecontable.comcont_enlace where ((comcont_fecha<='".$conct_fechacorte."' and conct_idform=0) or (conct_idform='".$conct_idform."') or (comcont_fecha<='".$conct_fechacorte."' and  detcct_conciliacion=0 and conct_idform=0)) and detcc_cuentacontable='".$conct_cuenta."' and comcont_anulado=0  order by comcont_fecha asc";


}
else
{
$lista_renta="select * from lpin_comprobantecontable inner join lpin_detallecomprobantecontable on lpin_comprobantecontable.comcont_enlace=lpin_detallecomprobantecontable.comcont_enlace where (( comcont_fecha >'".$fecha_corteanterior."' and comcont_fecha<='".$conct_fechacorte."' and conct_idform=0 ) or (conct_idform='".$conct_idform."') or (comcont_fecha<='".$conct_fechacorte."' and 	detcct_conciliacion=0 and conct_idform=0)) and detcc_cuentacontable='".$conct_cuenta."' and comcont_anulado=0 order by comcont_fecha asc";
}

//echo $lista_renta;

$rs_listadata = $DB_gogess->executec($lista_renta,array());
if($rs_listadata)
 {
	  while (!$rs_listadata->EOF) {	
	
	$comulla_simple="'";
    $tabla_valordata="";
    $tabla_valordata="'lpin_detallecomprobantecontable'";
	
	$campo_valor="";
	$campo_valor="'detcc_id'";
	$ide_producto='detcc_id';
	$ncampo_val='detcct_conciliacion';
	
$monto=0;
$signo='';
if($rs_listadata->fields["detcc_debe"]>0)
{
  $monto=$rs_listadata->fields["detcc_debe"];
  $signo='<i class="fa fa-plus" style="color:#000000"></i>';
  $montosuma=$rs_listadata->fields["detcc_debe"];
}
if($rs_listadata->fields["detcc_haber"]>0)
{
  $monto=$rs_listadata->fields["detcc_haber"];
  $signo='<i class="fa fa-minus" style="color:#FF0000"></i>';
  $montosuma=$rs_listadata->fields["detcc_haber"]*-1;
}

if($rs_listadata->fields["detcct_conciliacion"]==1 and $rs_listadata->fields["conct_idform"]==$conct_idform)
{
$suma_valort=$suma_valort+$montosuma;
}

         $rs_listadata->MoveNext();
	  }
  }	

//$diferencia=0;
//$diferencia=$conct_saldobanco-$suma_valort;

//echo "Saldo anterior:".$conct_saldocontableant."<br>";
//echo $suma_valort."<br>";

$saldo_finalmes=0;
$saldo_finalmes=$conct_saldocontableant+($suma_valort);
//echo "saldo contable:".$saldo_finalmes."<br>";
//echo $conct_saldobanco."<br>";
$diferencia=0;
$diferencia=round(($conct_saldobanco-$saldo_finalmes),2);

//echo $diferencia."<br>";
?>  

<script language="javascript">
<!--

$('#conct_saldocontable').val('<?php echo $saldo_finalmes; ?>');
$('#conct_diferencia').val('<?php echo $diferencia; ?>')
$('#stotal').html('<?php echo $saldo_finalmes; ?>');


//-->
</script>  