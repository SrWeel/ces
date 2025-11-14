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
$b_tarifario=$_POST["b_tarifario"];
$clie_id=$_POST["clie_id"];

$busca_clientec="select * from app_cliente where clie_id='".$clie_id."'";
$rs_bclientec = $DB_gogess->executec($busca_clientec,array());	  
$conve_idc=$rs_bclientec->fields["conve_id"];
 
$n_convenio="select * from cesdb_arextension.dns_convenios where conve_id='".$conve_idc."'";
$rs_conve = $DB_gogess->executec($n_convenio,array());	

$conve_id=$rs_conve->fields["conve_id"];

echo "Convenio:".$rs_conve->fields["conve_nombre"];
?>


<table width="95%" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td>CODIGO</td>
	<td>NOMBRE</td>
	<td>PRECIO</td>
    <td>CANTIDAD</td>
    <td>PROCESAR</td>
  </tr>
<?php
if($b_tarifario)
{
$lista_productos="select * from efacsistema_producto where prod_activo=1 and prod_nombre like '%".$b_tarifario."%' order by prod_nombre asc";
}
else
{
$lista_productos="select * from efacsistema_producto where prod_activo=1 order by prod_nombre asc";
}

$rs_bproductos = $DB_gogess->executec($lista_productos,array());
if($rs_bproductos)
 {
	while (!$rs_bproductos->EOF) { 
	
	
	$prod_id=$rs_bproductos->fields["prod_id"];
	
	$precio=0;
	$prod_preciocosto=0;
	if($conve_id=='' or $conve_id=='6')
    {
      
	  $precio=$rs_bproductos->fields["prod_precio"];
      $impuesto=$rs_bproductos->fields["impu_codigo"];
      $tari_codigo=$rs_bproductos->fields["tari_codigo"];
      $prod_preciocosto=$rs_bproductos->fields["prod_preciocosto"];

    }
	else
	{
	    $datos_produ="select * from efacsistema_producto left join cesdb_arextension.dns_gridconvenios on efacsistema_producto.prod_enlace=cesdb_arextension.dns_gridconvenios.prod_enlace where prod_codigo='".$rs_bproductos->fields["prod_codigo"]."' and gconve_convenio='".$conve_id."'";
$rs_produ = $DB_gogess->executec($datos_produ,array());
		
		$impuesto=$rs_bproductos->fields["impu_codigo"];
		$tari_codigo=$rs_bproductos->fields["tari_codigo"];
		$precio=$rs_produ->fields["gconve_precio"];
		$prod_preciocosto=$rs_produ->fields["prod_preciocosto"];	
		
		if(!($precio))
		{
		    $precio=$rs_bproductos->fields["prod_precio"];
            $impuesto=$rs_bproductos->fields["impu_codigo"];
            $tari_codigo=$rs_bproductos->fields["tari_codigo"];
            $prod_preciocosto=$rs_bproductos->fields["prod_preciocosto"];		
		}
	
	}
?>

  <tr>
    <td style="font-size:10px"><?php echo $rs_bproductos->fields["prod_codigo"]; ?></td>
	<td style="font-size:10px"><?php echo $rs_bproductos->fields["prod_nombre"]; ?></td>
	<td style="font-size:10px"><?php echo $precio; ?></td>
    <td><input name="cantidp_<?php echo $prod_id; ?>" type="number" id="cantidp_<?php echo $prod_id; ?>" size="5" style="width:70px"></td>
    <td><input type="button" name="Submit" value="--&gt;&gt;" onClick="asgnar_prdetalle('<?php echo $prod_id; ?>')" ></td>
  </tr>
<?php 


     $rs_bproductos->MoveNext();	
	}	
} 	
  
?>  
</table>