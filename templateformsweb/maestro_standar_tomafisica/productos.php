<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4440000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

if($_SESSION['ces1313777_sessid_inicio'])
{

$centro_id=$_POST["centro_id"];
$cuadrobm_id=$_POST["cuadrobm_id"];
$precio='';
$impuesto='';
$tari_codigo='';
$prod_preciocosto='';


$datos_produ="select * from dns_cuadrobasicomedicamentos where cuadrobm_id='".$_POST["cuadrobm_id"]."'";
$rs_produ = $DB_gogess->executec($datos_produ,array());

//$impu_codigo=$rs_produ->fields["impu_codigo"];
//$tari_codigo=$rs_produ->fields["tari_codigo"];

if($centro_id==1)
{

$stockactual="select sum(stock_cantidad*stock_signo) as stactual from dns_principalstockactual where centro_id='55' and cuadrobm_id='".$cuadrobm_id."'";
$rs_stactua = $DB_gogess->executec($stockactual);

$busca_und="select uniddesg_id from dns_principalstockactual where centro_id='55' and cuadrobm_id='".$cuadrobm_id."' order by stock_id  desc limit 1";
$rs_und = $DB_gogess->executec($busca_und);

$unid_idx=$rs_und->fields["uniddesg_id"];

     
	 
	 

}
else
{

$stockactual="select sum(stock_cantidad*stock_signo) as stactual from dns_stockactual where centro_id='".$centro_id."' and cuadrobm_id='".$cuadrobm_id."'";
$rs_stactua = $DB_gogess->executec($stockactual);

$busca_und="select uniddesg_id from dns_stockactual where centro_id='".$centro_id."' and cuadrobm_id='".$cuadrobm_id."' order by stock_id  desc limit 1";
$rs_und = $DB_gogess->executec($busca_und);

$unid_idx=$rs_und->fields["uniddesg_id"];

}


     $busca_precio="select * from dns_preciostiempo where cuadrobm_id='".$cuadrobm_id."'";
	 $rs_buprecio = $DB_gogess->executec($busca_precio,array());
	 $precio_compra=$rs_buprecio->fields["precio_compra"];
	 
	 $busca_preciorp="select * from dns_redppreciostiempo where cuadrobm_id='".$cuadrobm_id."'";
	 $rs_bupreciorp = $DB_gogess->executec($busca_preciorp,array());
	 $precio_comprarp=$rs_bupreciorp->fields["precio_compra"];
	 
	 	
	 
	 $busca_var="select max(moviin_preciocompra) as mayorp,min(moviin_preciocompra) as menorp, round((max(moviin_preciocompra)-min(moviin_preciocompra)),2) as rango from dns_compras inner join dns_temporalovimientoinventario on dns_compras.compra_id=dns_temporalovimientoinventario.compra_id where cuadrobm_id='".$cuadrobm_id."'";
	 $rs_bvaria = $DB_gogess->executec($busca_var,array());
	 $variacionp=$rs_bvaria->fields["rango"];
	 
	 $envia_precio=$precio_compra;
	 $variacion_entre_may=$variacionp;
	 
	 $envia_preciorp=$precio_comprarp;
	 
	 $cudrob="select * from  dns_cuadrobasicomedicamentos where cuadrobm_id='".$cuadrobm_id."'";
	 $rs_cuadrov = $DB_gogess->executec($cudrob,array());
	 
	 $cuadrobm_privada=$rs_cuadrov->fields["cuadrobm_privada"];
	 $cuadrobm_redp=$rs_cuadrov->fields["cuadrobm_redp"];
	 $cuadrobm_preciotecho=$rs_cuadrov->fields["cuadrobm_preciotecho"];
	 
	 $redp='';
	 $priva='';
	 if($cuadrobm_redp==1)
	 {
	   $redp='SI';   
	 }
	 
	 if($cuadrobm_privada==1)
	 {
	   $priva='SI';   
	 }
	 
	 $textorp="<b>PRECIO COMPRA: </b>".$precio_compra."<br><b>PRECIO COMPRA REDP: </b>".$precio_comprarp."<br><b>RED PUBLICA: </b>".$redp."<br> <b>PRIVADA: </b>".$priva."<br><b>PRECIO TECHO RP: </b>".$cuadrobm_preciotecho;

?>

<script language="javascript">
<!--
$('#detaprecio').html('');

$('#unid_idx').val('<?php echo $unid_idx; ?>');
$('#ajuspr_cantidadx').val('<?php echo $rs_stactua->fields["stactual"]; ?>');

$('#detaprecio').html('<?php echo $textorp; ?>');




//-->
</script>

<?php

}

?>