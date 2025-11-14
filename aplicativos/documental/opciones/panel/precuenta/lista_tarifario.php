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

$bode_id=$_POST["bode_id"];
?>


<table width="200" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td>CODIGO</td>
	<td>NOMBRE</td>
	<td>PRECIO</td>
    <td>CANTIDAD</td>
    <td>PROCESAR</td>
  </tr>
<?php
$lista_productos="select * from efacsistema_producto where prod_activo=1 order by prod_id desc limit 50";
$rs_bproductos = $DB_gogess->executec($lista_productos,array());
if($rs_bproductos)
 {
	while (!$rs_bproductos->EOF) { 
	
	
	$prod_id=$rs_bproductos->fields["prod_id"];
?>

  <tr>
    <td style="font-size:10px"><?php echo $rs_bproductos->fields["prod_codigo"]; ?></td>
	<td style="font-size:10px"><?php echo $rs_bproductos->fields["prod_nombre"] ?></td>
	<td style="font-size:10px"><?php echo $rs_bproductos->fields["prod_precio"] ?></td>
    <td><input name="cantidp_<?php echo $prod_id; ?>" type="number" id="cantidp_<?php echo $prod_id; ?>" size="5" style="width:70px"></td>
    <td><input type="button" name="Submit" value="--&gt;&gt;" onClick="asgnar_prdetalle('<?php echo $prod_id; ?>')" ></td>
  </tr>
<?php 


     $rs_bproductos->MoveNext();	
	}	
} 	
  
?>  
</table>