<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4404000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_SESSION['ces1313777_sessid_inicio'])
{

$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");

include("../precuenta/lib_asiento.php");

$objformulario= new  ValidacionesFormulario();

$precu_id=$_POST["precu_id"];
$detapre_id=$_POST["detapre_id"];


$busca_pedido="select * from dns_precuenta where precu_id='".$precu_id."'";
$rs_bupedido= $DB_gogess->executec($busca_pedido,array());

$clie_id=$rs_bupedido->fields["clie_id"];
$especipr_id=0;
$especipr_id=$rs_bupedido->fields["especipr_id"];

//detalle a modificar

$modif_d="select * from dns_detalleprecuentaprincipal where detapre_id='".$detapre_id."'";
$rs_bdetallex= $DB_gogess->executec($modif_d,array());

$cuadrobm_id=$rs_bdetallex->fields["cuadrobm_id"];


$busca_cliente="select * from app_cliente where clie_id='".$clie_id."'";
$rs_bcliente = $DB_gogess->executec($busca_cliente,array());	  
$conve_id=$rs_bcliente->fields["conve_id"];


$convepr_id=$rs_bupedido->fields["convepr_id"];
$lista_convenio="select * from cesdb_arextension.dns_convenios where conve_id='".$convepr_id."'";
$rs_conve= $DB_gogess->executec($lista_convenio,array());
$rs_conve->fields["conve_redpublica"];
	
$code_redp=0;
$code_redp=$rs_conve->fields["conve_redpublica"];

//detalle a modificar


$busca_medi="select * from dns_cuadrobasicomedicamentos where cuadrobm_id='".$cuadrobm_id."'";
$rs_medi = $DB_gogess->executec($busca_medi,array());
$categ_id=$rs_medi->fields["categ_id"];

if($categ_id==1 or $categ_id==2)
{
$detapre_tipo=$categ_id;
$detapre_tipofarmacia=$categ_id;
}
else
{
$detapre_tipo=2;
$detapre_tipofarmacia=$categ_id;
}



if($code_redp==1)
{

$precios_valores=array();
$precios_valores=$objBodega->busca_precioproductoredp($cuadrobm_id,$DB_gogess);

$detapre_precio=$precios_valores["pcosto"];
$detapre_precioventa=$precios_valores["pvp"];


if($detapre_precioventa>$precios_valores["ptecho"]  and $precios_valores["ptecho"]>0)
{
  $detapre_precioventa=$precios_valores["ptecho"];
}

//echo "entra en red publica";

}
else
{
//normal
$precios_valores=array();
$precios_valores=$objBodega->busca_precioproducto($cuadrobm_id,$DB_gogess);


if($conve_id==7)
{
  $detapre_precio=$precios_valores["pcosto"];
  $detapre_precioventa=$precios_valores["pisspol"];
}
else
{
  if($especipr_id=='27')
  {
    $detapre_precio=$precios_valores["pcosto"];
    $detapre_precioventa=$precios_valores["plasticos"];
  }
  else
  {
    $detapre_precio=$precios_valores["pcosto"];
    $detapre_precioventa=$precios_valores["pvp"];
  }
}

//normal
}

///actualiza=data
$ac_data="update dns_detalleprecuentaprincipal set 	detapre_precio='".$detapre_precio."',detapre_precioventa='".$detapre_precioventa."' where detapre_id='".$detapre_id."'";
$rs_data2 = $DB_gogess->executec($ac_data,array());
///actauliza=data


//genera asiento

genera_asientodescargo($precu_id,$detapre_id,$DB_gogess);

//genera asiento



}
?>