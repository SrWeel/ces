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

$centro_id=$_POST["centro_id"];
$b_data=trim($_POST["b_data"]);
echo $clie_id=$_POST["clie_id"];

if($centro_id==1)
{
  $centro_id=55;
}

$activodespacho=1;

if($activodespacho==1)
{
?>


<table width="95%" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td style="font-size:10px" bgcolor="#CCCCCC" class="css_titulo" >CODIGO</td>
	<td style="font-size:10px" bgcolor="#CCCCCC" class="css_titulo" >NOMBRE</td>
   <!-- <td style="font-size:10px" >STOCK ACTUAL</td> -->
    <td style="font-size:10px" bgcolor="#CCCCCC" class="css_titulo" >DESCARGAR</td>
  </tr>
<?php
$lista_productos="select * from dns_cuadrobasicomedicamentos_vista where cuadrobm_principioactivo like '%".$b_data."%' or cuadrobm_codigoatc='".$b_data."' order by  cuadrobm_principioactivo asc ";
$rs_bproductos = $DB_gogess->executec($lista_productos,array());
if($rs_bproductos)
 {
	while (!$rs_bproductos->EOF) { 
	
	$cuadrobm_id=$rs_bproductos->fields["cuadrobm_id"];
	
	$stockactual="select sum(stock_cantidad*stock_signo) as stactual from dns_principalstockactual where centro_id=".$centro_id." and cuadrobm_id='".$cuadrobm_id."'";
	$rs_stactua = $DB_gogess->executec($stockactual);
	
	$maximo_permitido=$rs_stactua->fields["stactual"];
	
	if($rs_stactua->fields["stactual"]>0)
	{
?>

  <tr>
    <td style="font-size:10px"><?php echo $rs_bproductos->fields["cuadrobm_codigoatc"]; ?></td>
	<td style="font-size:10px"><?php echo $rs_bproductos->fields["cuadrobm_nombrecomercial"]; ?></td>
	<!-- <td style="font-size:10px"><?php echo $rs_stactua->fields["stactual"]; ?></td> -->
    <td><input type="button" name="Submit" value="--&gt;&gt;" onClick="ejecuta_despachar('<?php echo $cuadrobm_id; ?>','<?php echo $centro_id; ?>','<?php echo $maximo_permitido; ?>','<?php echo $clie_id; ?>')" ></td>
  </tr>
<?php 
     }


     $rs_bproductos->MoveNext();	
	}	
} 	
  
?>  
</table>

<?php
}
else
{
   echo "No activo para Despacho";

}
?>

<script type="text/javascript">
<!--



//  End -->
</script>