<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=44450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_SESSION['ces1313777_sessid_inicio'])
{

$director='../../../../../../';
include("../../../../../../cfg/clases.php");
include("../../../../../../cfg/declaracion.php");
$objformulario= new  ValidacionesFormulario();


$cuadrobm_id=$_POST["cuadrobm_id"];
$cantidad_val=$_POST["cantidad_val"];
$egrec_id=$_POST["egrec_id"];
$moviin_id=$_POST["moviin_id"];

//busca tipo movimiento

$busca_egreso="select * from dns_invegresosvarios where egrec_id='".$egrec_id."'";
$rs_egreso = $DB_gogess->executec($busca_egreso);

$tipom_id=$rs_egreso->fields["tipom_id"];
$tipomov_id=$rs_egreso->fields["tipomov_id"];


//busca tipo movimiento

$valoralet=mt_rand(1,5);
sleep($valoralet);

//verifica disponibilidad

$busca_disponible="select * from dns_movimientoinventario where moviin_id='".$moviin_id."'";
$rs_bdispo = $DB_gogess->executec($busca_disponible);

$valor_movimiento=0;
$valor_movimiento=$rs_bdispo->fields["moviin_totalenunidadconsumo"];

//echo $valor_movimiento."<br>";

//busca_movimientos_fuera
$lista_ent="select sum(moviin_totalenunidadconsumo) as entregadot from  dns_movimientoinventario where (moviincent_id='".$moviin_id."' or entregamoviin_id='".$moviin_id."') and centro_id='".$_SESSION['ces1313777_centro_id']."' and tipom_id=2";
						

$rs_ent = $DB_gogess->executec($lista_ent);
$valor_movimiento2=0;
$valor_movimiento2=$rs_ent->fields["entregadot"];
//busca_movimientos_fuera

echo "<br>Entregado:".$valor_movimiento2."<br>";

//echo $valor_movimiento2."<br>";
//busca asignados

$busca_asig="select sum(cantidad_val) as totalegreso from dns_invtemporaldespacho inner join dns_invegresosvarios on dns_invtemporaldespacho.egrec_id=dns_invegresosvarios.egrec_id where moviin_id='".$moviin_id."' and egrec_anulado=0 and dns_invegresosvarios.egrec_id='".$egrec_id."'";
$rs_asig = $DB_gogess->executec($busca_asig);

$cantidad_asig=0;

if(@$rs_asig->fields["totalegreso"])
{
  $cantidad_asig=$rs_asig->fields["totalegreso"];
}
else
{
  $cantidad_asig=0;
}

echo "Asignado:".$cantidad_asig."<br>";
//verifica disponibilidad


//saca valor restante

$restante_valor=$valor_movimiento-$valor_movimiento2-$cantidad_asig;

//echo $restante_valor;

if($cantidad_val<=$restante_valor)
{
$valor_nuevo=$restante_valor-$cantidad_val;

//inserta==================================================================
$usua_id=$_SESSION['ces1313777_sessid_inicio'];
$tempdsp_fecharegistro=date("Y-m-d H:i:s");
 $inserta_despacho="insert into dns_invtemporaldespacho (egrec_id,cuadrobm_id,cantidad_val,usua_id,tempdsp_fecharegistro,moviin_id,tipom_id,tipomov_id) values ('".$egrec_id."','".$cuadrobm_id."','".$cantidad_val."','".$usua_id."','".$tempdsp_fecharegistro."','".$moviin_id."','".$tipom_id."','".$tipomov_id."')";
$rs_despacho = $DB_gogess->executec($inserta_despacho);
//inserta==================================================================
?>

<script type="text/javascript">
<!--  
 
 $('#invdiv_<?php echo $moviin_id; ?>').html('<?php echo $valor_nuevo; ?>');
 
//  End -->
</script>  
<?php
}
else
{
?>
<script type="text/javascript">
<!--

alert("Cantidad no disponible");


//  End -->
</script>
<?php
}



}
?>