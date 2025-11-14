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

//busca disponibilidad
$busca_pedido="select * from ".$_POST["tabla"]." where plantra_id='".$_POST["plantra_id"]."'";
$rs_bupedido= $DB_gogess->executec($busca_pedido,array());

$select_bu="select * from dns_cuadrobasicomedicamentos where cuadrobm_codigoatc in (select plantra_codigo from ".$_POST["tabla"]." where plantra_id='".$_POST["plantra_id"]."')";
$rs_bu= $DB_gogess->executec($select_bu,array());

$stockactual="select sum(stock_cantidad * stock_signo) as stactual from dns_stockactual where centro_id=".$_POST["centro_id"]." and cuadrobm_id=".$rs_bu->fields["cuadrobm_id"];
$rs_stactua = $DB_gogess->executec($stockactual);

if(trim($rs_stactua->fields["stactual"]*1)>=trim($rs_bupedido->fields["plantra_cantidad"]*1))
{
//-----------------------------------
//busca el ultimo movimiento inventario
$busca_movi="select * from dns_movimientoinventario where cuadrobm_id=".$rs_bu->fields["cuadrobm_id"]." and centro_id='".$_POST["centro_id"]."' and tipom_id=1 order by moviin_fecharegistro desc limit 1";
$rs_bultimomovi = $DB_gogess->executec($busca_movi);
//busca el ultimo movimiento inventario

$despachar_data="update ".$_POST["tabla"]." set usuad_id='".$_POST["usua_id"]."',centrod_id='".$_POST["centro_id"]."',plantra_despachado='SI',plantra_fechadespacho='".date("Y-m-d H:i:s")."' where plantra_id='".$_POST["plantra_id"]."';";
$rs_ddata= $DB_gogess->executec($despachar_data,array());

if($rs_ddata)
{

    $busca_recetaac="select * from dns_stockactual where stock_tabla='".$_POST["tabla"]."' and stock_idtbla='".$_POST["plantra_id"]."'";
	$rs_brecetaac = $DB_gogess->executec($busca_recetaac,array());
	
	if(!($rs_brecetaac->fields["stock_id"]))
	{
	
    //busca
	$inserta_movi="insert into dns_stockactual (centro_id,cuadrobm_id,unid_id,moviin_cantidadunidadconsumo,uniddesg_id,moviin_id,stock_cantidad,stock_fechaureg,stock_signo,stock_tabla,stock_idtbla, 	stock_tipo) VALUES ('".$_POST["centro_id"]."','".$rs_bu->fields["cuadrobm_id"]."','".$rs_bultimomovi->fields["unid_id"]."','".$rs_bultimomovi->fields["moviin_cantidadunidadconsumo"]."','".$rs_bultimomovi->fields["uniddesg_id"]."',0,'".$rs_bupedido->fields["plantra_cantidad"]."',now(),-1,'".$_POST["tabla"]."','".$_POST["plantra_id"]."','CONSUMO')";
	$rs_insertmovi= $DB_gogess->executec($inserta_movi,array());
	//busca
	}
	
}



//-----------------------------------
}
else
{
?>

<script type="text/javascript">
 
alert("No hay disponibilidad;");

</script>
<?php
}
//busca disponibilidad


?>