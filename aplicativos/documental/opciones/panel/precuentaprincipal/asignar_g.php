<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4404000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");

$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();

$precu_id=$_POST["precu_id"];
$clie_id=$_POST["clie_id"];
$atenc_id=$_POST["atenc_id"];
$cuadrobm_id=$_POST["cuadrobm_id"];
$cantidad=$_POST["cantidad"];

$centro_id=$_POST["centro_id"];
$maximop=$_POST["maximop"];
$centro_id=$_POST["centro_id"];
	  

$busca_medi="select * from dns_cuadrobasicomedicamentos where cuadrobm_id='".$cuadrobm_id."'";
$rs_medi = $DB_gogess->executec($busca_medi,array());

$categ_id=$rs_medi->fields["categ_id"];

//1= MEDICAMENTOS
//2= INSUMOS
$stockactual="select sum(stock_cantidad*stock_signo) as stactual from dns_stockactual where centro_id=".$centro_id." and cuadrobm_id='".$cuadrobm_id."'";
$rs_stactua = $DB_gogess->executec($stockactual);
$maximo_permitido=$rs_stactua->fields["stactual"];


if($cantidad<=$maximo_permitido)
{

//ingresar descargo

//ingresa descargo

$detapre_tipo=$categ_id;
$mnupan_id=0;
$detapre_codigop=$rs_medi->fields["cuadrobm_codigoatc"];
$detapre_detalle=$rs_medi->fields["cuadrobm_nombrecomercial"];
$detapre_cantidad=$cantidad;
$detapre_precio=$rs_medi->fields["cuadrobm_preciomedicamento"];
$detapre_fecharegistro=date("Y-m-d H:i:s");
$usua_id=$_SESSION['ces1313777_sessid_inicio'];
$centro_id=$_SESSION['ces1313777_centro_id'];
$detapre_codigoform=0;
$detapre_idgrid=0;
$table='';
$bode_id=$_POST["bode_id"];
$detapre_origen='DESCARGO APP';

echo $inserta_datadis="INSERT INTO dns_detalleprecuentaprincipal (precu_id, clie_id, mnupan_id, detapre_tipo, detapre_codigop, detapre_detalle, detapre_cantidad, detapre_precio, detapre_fecharegistro, usua_id, centro_id, atenc_id, detapre_codigoform,detapre_idgrid,detapre_table,bodega_id,detapre_origen,moviin_id) VALUES ('".$precu_id."','".$clie_id."','".$mnupan_id."','".$detapre_tipo."','".$detapre_codigop."','".$detapre_detalle."','".$detapre_cantidad."','".$detapre_precio."','".$detapre_fecharegistro."','".$usua_id."','".$centro_id."','".$atenc_id."','".$detapre_codigoform."','".$detapre_idgrid."','".$table."','".$bode_id."','".$detapre_origen."','".$moviin_id."');";
//$rs_insdatadis = $DB_gogess->executec($inserta_datadis,array());


}
else
{
?>

<script type="text/javascript">
<!--
alert("Cantidad supera al stock actual...");

//  End -->
</script>

<?php
}
?>

