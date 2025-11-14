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

$conc_fechacorte=$_POST["conc_fechacorte"];
$conc_cuenta=$_POST["conc_cuenta"];
$conc_saldobanco=$_POST["conc_saldobanco"];
$conc_idform=$_POST["conc_idform"];

if($_POST["valor"]=='true')
{
$valor=1;

$actualiza_data="update ".$_POST["tabla"]." set ".$_POST["campo"]."='".$valor."',conc_idform='".$conc_idform."' where ".$_POST["campoidtabla"]."='".$_POST["id"]."'";
$okvalor=$DB_gogess->executec($actualiza_data); 

}
else
{
$valor=0;

$actualiza_data="update ".$_POST["tabla"]." set ".$_POST["campo"]."='".$valor."',conc_idform='0' where ".$_POST["campoidtabla"]."='".$_POST["id"]."'";
$okvalor=$DB_gogess->executec($actualiza_data); 

}

//echo $actualiza_data;


}


if($conc_idform>0)
{
$busca_elanterior="select * from app_conciliacion where conc_id < ".$conc_idform." order by conc_id desc limit 1";
$rs_ultimafecha = $DB_gogess->executec($busca_elanterior,array());
}
else
{
$busca_elanterior="select * from app_conciliacion  order by conc_id desc limit 1";
$rs_ultimafecha = $DB_gogess->executec($busca_elanterior,array());
}


$fecha_corteanterior=$rs_ultimafecha->fields["conc_fechacorte"];
$conc_saldocontableant=$rs_ultimafecha->fields["conc_saldocontable"];


$suma_valort=0;
//$lista_renta="select * from lpin_comprobantecontable inner join lpin_detallecomprobantecontable on lpin_comprobantecontable.comcont_enlace=lpin_detallecomprobantecontable.comcont_enlace where comcont_fecha<='".$conc_fechacorte."' and detcc_cuentacontable='".$conc_cuenta."' order by comcont_fecha asc";


if(!(trim($fecha_corteanterior)))
{
$lista_renta="select * from lpin_comprobantecontable inner join lpin_detallecomprobantecontable on lpin_comprobantecontable.comcont_enlace=lpin_detallecomprobantecontable.comcont_enlace where ((comcont_fecha<='".$conc_fechacorte."' and conc_idform=0) or (conc_idform='".$conc_idform."') or (comcont_fecha<='".$conc_fechacorte."' and  detcc_conciliacion=0 and conc_idform=0)) and detcc_cuentacontable='".$conc_cuenta."' and comcont_anulado=0  order by comcont_fecha asc";


}
else
{
$lista_renta="select * from lpin_comprobantecontable inner join lpin_detallecomprobantecontable on lpin_comprobantecontable.comcont_enlace=lpin_detallecomprobantecontable.comcont_enlace where (( comcont_fecha >'".$fecha_corteanterior."' and comcont_fecha<='".$conc_fechacorte."' and conc_idform=0 ) or (conc_idform='".$conc_idform."') or (comcont_fecha<='".$conc_fechacorte."' and 	detcc_conciliacion=0 and conc_idform=0)) and detcc_cuentacontable='".$conc_cuenta."' and comcont_anulado=0 order by comcont_fecha asc";
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
	$ncampo_val='detcc_conciliacion';
	
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

if($rs_listadata->fields["detcc_conciliacion"]==1 and $rs_listadata->fields["conc_idform"]==$conc_idform)
{
$suma_valort=$suma_valort+$montosuma;
}

         $rs_listadata->MoveNext();
	  }
  }	

//$diferencia=0;
//$diferencia=$conc_saldobanco-$suma_valort;

//echo "Saldo anterior:".$conc_saldocontableant."<br>";
//echo $suma_valort."<br>";

$saldo_finalmes=0;
$saldo_finalmes=$conc_saldocontableant+($suma_valort);
//echo "saldo contable:".$saldo_finalmes."<br>";
//echo $conc_saldobanco."<br>";
$diferencia=0;
$diferencia=round(($conc_saldobanco-$saldo_finalmes),2);

//echo $diferencia."<br>";
?>  

<script language="javascript">
<!--

$('#conc_saldocontable').val('<?php echo $saldo_finalmes; ?>');
$('#conc_diferencia').val('<?php echo $diferencia; ?>')
$('#stotal').html('<?php echo $saldo_finalmes; ?>');


//-->
</script>  