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

$busca_clientex="select * from app_cliente where clie_id='".$clie_id."'";
$rs_bclientex = $DB_gogess->executec($busca_clientex,array());	  
$conve_id=$rs_bclientex->fields["conve_id"];

$cuadrobmext_id=$_POST["cuadrobmext_id"];
$n_medicamntoext=$_POST["n_medicamntoext"];
$n_cantidadext=$_POST["n_cantidadext"];
$n_precioext=$_POST["n_precioext"];
$n_obsext=$_POST["n_obsext"];
$centrotx_id=$_POST["centrotx_id"];

if($cuadrobmext_id>0)
{

//===================================
$periodo_actual=$objformulario->replace_cmb("dns_periodobodega","perio_id,perio_anio"," where perio_activo=","1",$DB_gogess);
$busca_medi="select * from dns_cuadrobasicomedicamentos where cuadrobm_id='".$cuadrobmext_id."'";
$rs_medi = $DB_gogess->executec($busca_medi,array());
$categ_id=$rs_medi->fields["categ_id"];

if($centrotx_id==1)
{
 $centrotx_id=55;
}

$busca_paraentrega="select * from dns_principalmovimientoinventario where tipom_id=1 and moviin_fecharegistro>='2021-09-01' and cuadrobm_id='".$cuadrobmext_id."' and year(moviin_fecharegistro)>='".$periodo_actual."' and centro_id='".$centrotx_id."' order by moviin_fechadecaducidad asc";
$rs_paraentrega = $DB_gogess->executec($busca_paraentrega,array());

$detapre_tipo=$categ_id;
$mnupan_id=0;
$detapre_codigop=$rs_medi->fields["cuadrobm_codigoatc"];
$detapre_detalle=$rs_medi->fields["cuadrobm_nombrecomercial"];
$detapre_cantidad=$n_cantidadext;

$precios_valores=array();
$precios_valores=$objBodega->busca_precioproducto($cuadrobmext_id,$DB_gogess);

$detapre_precio=0;
$detapre_precioventa=0;

if($conve_id==7)
{
  $detapre_precio=$precios_valores["pcosto"];
  $detapre_precioventa=$precios_valores["pisspol"];
}
else
{
  $detapre_precio=$precios_valores["pcosto"];
  $detapre_precioventa=$precios_valores["pvp"];
}


$detapre_fecharegistro=date("Y-m-d H:i:s");
$usua_id=$_SESSION['ces1313777_sessid_inicio'];
$centro_id=$_SESSION['ces1313777_centro_id'];
$detapre_codigoform=0;
$detapre_idgrid=0;
$table='';
$centrob_id=$centrotx_id;
$detapre_origen='DESCARGO TEMPORAL';
$detapre_observacion=$n_obsext;

//====================================

}
else
{
//====================================

$detapre_tipox=$_POST["detapre_tipox"];
$detapre_tipo=$detapre_tipox;
$mnupan_id=0;
$detapre_codigop='TEMP'.strtoupper(uniqid());
$detapre_detalle=$n_medicamntoext;
$detapre_cantidad=$n_cantidadext;
$detapre_precio=$n_precioext;
$detapre_fecharegistro=date("Y-m-d H:i:s");
$usua_id=$_SESSION['ces1313777_sessid_inicio'];
$centro_id=$_SESSION['ces1313777_centro_id'];
$detapre_codigoform=0;
$detapre_idgrid=0;
$table='';
$centrob_id=$centrotx_id;
$detapre_origen='DESCARGO TEMPORAL';
$detapre_observacion=$n_obsext;

$detapre_precioventa=$objFormulascontable->formulas_pvp($convenio,$detapre_precio,$DB_gogess);



//====================================
}


//$stockactual="select sum(stock_cantidad*stock_signo) as stactual from dns_stockactual where centro_id=".$centro_id." and cuadrobm_id='".$cuadrobm_id."'";
//$rs_stactua = $DB_gogess->executec($stockactual);
//$maximo_permitido=$rs_stactua->fields["stactual"];


//ingresar descargo

//ingresa descargo

$inserta_datadis="INSERT INTO dns_detalleprecuenta (precu_id, clie_id, mnupan_id, detapre_tipo, detapre_codigop, detapre_detalle, detapre_cantidad, detapre_precio, detapre_fecharegistro, usua_id, centro_id, atenc_id, detapre_codigoform,detapre_idgrid,detapre_table,centrob_id,detapre_origen,moviin_id,cuadrobm_id,detapre_observacion,detapre_precioventa) VALUES ('".$precu_id."','".$clie_id."','".$mnupan_id."','".$detapre_tipo."','".$detapre_codigop."','".$detapre_detalle."','".$detapre_cantidad."','".$detapre_precio."','".$detapre_fecharegistro."','".$usua_id."','".$centro_id."','".$atenc_id."','".$detapre_codigoform."','".$detapre_idgrid."','".$table."','".$centrob_id."','".$detapre_origen."','0','".$cuadrobmext_id."','".$detapre_observacion."','".$detapre_precioventa."');";


$rs_insdatadis = $DB_gogess->executec($inserta_datadis,array());


?>

