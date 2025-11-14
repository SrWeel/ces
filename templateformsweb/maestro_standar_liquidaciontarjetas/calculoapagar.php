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


$lqtran_depositox=$_POST["lqtran_depositox"]*1;
$lqtran_comisionx=$_POST["lqtran_comisionx"]*1;
$lqtran_ivax=$_POST["lqtran_ivax"]*1;
$lqtran_baseretirx=$_POST["lqtran_baseretirx"]*1;
$lqtran_baseretivax=$_POST["lqtran_baseretivax"]*1;
$porcecrl_idx=$_POST["porcecrl_idx"]*1;
$porcecil_idx=$_POST["porcecil_idx"]*1;
$lqtran_apagarx=$_POST["lqtran_apagarx"]*1;
$tpliq_valornodeducible=$_POST["tpliq_valornodeducible"]*1;
$tpliq_id=$_POST["tpliq_id"];

//renta
$lista_renta="select * from factur_porcentajes where porce_id='".$porcecrl_idx."'";
$rs_renta = $DB_gogess->executec($lista_renta,array());

$calculov=0;
$calculov=($lqtran_baseretirx*$rs_renta->fields["porce_valor"])/100;
$valor_renta=0;
$valor_renta=round($calculov,2);	

//iva
$lista_renta="select * from factur_porcentajes where porce_id='".$porcecil_idx."'";
$rs_renta = $DB_gogess->executec($lista_renta,array());

$calculov=0;
$calculov=($lqtran_baseretivax*$rs_renta->fields["porce_valor"])/100;
$valor_iva=0;
$valor_iva=round($calculov,2);

 
//if tpliq_id=2
//$apagra_v=$lqtran_depositox-$lqtran_comisionx-$valor_renta-$valor_iva-$tpliq_valornodeducible;

//if tpliq_id=1 liquidaion por factura
//$apagra_v=$lqtran_depositox-$lqtran_comisionx-$lqtran_ivax-$valor_renta-$valor_iva-$tpliq_valornodeducible;

$apagra_v=0;
if($tpliq_id==2)
{
echo $lqtran_depositox."<br>";
echo $lqtran_comisionx."<br>";
echo $valor_renta."<br>";
echo $valor_iva."<br>";
echo $lqtran_ivax."<br>";
echo $tpliq_valornodeducible."<br>";

$apagra_v=$lqtran_depositox-$lqtran_comisionx-$lqtran_ivax-$valor_renta;
}
else
{
$apagra_v=$lqtran_depositox-$lqtran_comisionx-$lqtran_ivax-$valor_renta-$valor_iva-$tpliq_valornodeducible;
}
?>

<script type="text/javascript">
<!--

$('#lqtran_apagarx').val('<?php echo $apagra_v; ?>');

//  End -->
</script>