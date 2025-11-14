<?php
$tiempossss=444000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");
if($_SESSION['ces1313777_sessid_inicio'])
{
$proveeve_id=$_POST["proveeve_id"];

$centro_id=24;

if(strlen(@$_POST["valor_b"])>=1)	
{

$sql1='';

if($_POST["valor_b"])
{
$sql1=" ( cuadrobm_codigoatc like '%".@$_POST["valor_b"]."%' or cuadrobm_nombrecomercial like '%".@$_POST["valor_b"]."%') and ";
}

if(@$_SESSION['ces1313777_sessid_emp_id'])
{
   $sql2="emp_id = ".@$_SESSION['ces1313777_sessid_emp_id']." and ";
}


$concatenado=$sql1.$sql2;
$concatenado=substr($concatenado,0,-4);

if($concatenado)
{
	$lista_prductos="select * from dns_cuadrobasicomedicamentos where ".$concatenado." order by cuadrobm_nombrecomercial desc";
}
else
{
	$lista_prductos="select * from dns_cuadrobasicomedicamentos order by cuadrobm_nombrecomercial desc limit 20";
}
//echo $lista_prductos;
$tipopac_id='';
?>
<table width="560" border="1" align="center" cellpadding="2" cellspacing="1">
  <tr>
   <td bgcolor="#C5D7E4" style="font-size:10px" ><strong>CODIGO</strong></td>	
	<td bgcolor="#C5D7E4" style="font-size:10px" ><strong>NOMBRE</strong></td>
    <td bgcolor="#C5D7E4" style="font-size:10px" ><strong>STOCK ACTUAL</strong></td> 
	<td bgcolor="#C5D7E4" style="font-size:10px" ><strong>PRECIO</strong></td> 
		<td bgcolor="#C5D7E4" style="font-size:10px"><strong>CANTIDAD</strong></td>
    <td bgcolor="#C5D7E4" style="font-size:10px"><strong>PROFORMAR</strong></td>

	<td bgcolor="#C5D7E4" style="font-size:10px"></td>
  </tr>
  
<?php

$rs_bproductos = $DB_gogess->executec($lista_prductos,array());

 if($rs_bproductos)
 {

	  while (!$rs_bproductos->EOF) {	
	  
	$cuadrobm_id=$rs_bproductos->fields["cuadrobm_id"];	
	$stockactual="select sum(stock_cantidad*stock_signo) as stactual from dns_stockactual where centro_id=".$centro_id." and cuadrobm_id='".$cuadrobm_id."'";
	$rs_stactua = $DB_gogess->executec($stockactual);	
	$maximo_permitido=$rs_stactua->fields["stactual"];

   	//if($rs_stactua->fields["stactual"]>0 and $rs_bproductos->fields["cuadrobm_pvp"]>0)
	if($rs_stactua->fields["stactual"]>0)
	{
?>
  <tr bgcolor="#EFF3F5">
   <!-- <td onClick="agregar_insumo('<?php echo $rs_bproductos->fields["cuadrobm_id"]; ?>','')" style="cursor:pointer" ><img src="images/bekosell.png"><td bgcolor="#FFFFFF"></td> -->
     <td bgcolor="#FFFFFF"><b><?php echo $rs_bproductos->fields["cuadrobm_codigoatc"]; ?></b></td>
    <td bgcolor="#FFFFFF"><b><?php echo $rs_bproductos->fields["cuadrobm_nombrecomercial"]; ?></b></td>
	<td bgcolor="#FFFFFF" style="font-size:10px"><?php echo $rs_stactua->fields["stactual"]; ?></td>
	<?php
	$valor_precio='';	
	$valor_precio=$rs_bproductos->fields["cuadrobm_pvp"];
	?>
    
	<td nowrap="nowrap" bgcolor="#FFFFFF"><b>$ <?php echo $valor_precio; ?></b></td>
	<td nowrap="nowrap" bgcolor="#FFFFFF"><input name="cant_val_<?php echo $cuadrobm_id; ?>" type="text" id="cant_val_<?php echo $cuadrobm_id; ?>" size="10" value="1" /></td>
	
	<td bgcolor="#FFFFFF"><input type="button" name="Submit" value="--&gt;&gt;" onClick="ejecuta_despacharproforma('<?php echo $cuadrobm_id; ?>','<?php echo $centro_id; ?>','<?php echo $maximo_permitido; ?>','<?php echo $proveeve_id; ?>')" ></td>
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

	  echo "Por favor ingrese mas de 1 caracteres para la b&uacute;squeda...";

  }



}

?>