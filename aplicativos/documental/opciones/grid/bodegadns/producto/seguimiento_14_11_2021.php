<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
header('Content-Type: text/html; charset=UTF-8');
$tiempossss="44450000";
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if(@$_SESSION['ces1313777_sessid_inicio'])
{

$director='../../../../../../';
include("../../../../../../cfg/clases.php");
include("../../../../../../cfg/declaracion.php");

$objformulario= new  ValidacionesFormulario();

$cuadrobm_id=$_POST["pVar1"];

$busca_nmedic="select * from dns_cuadrobasicomedicamentos where cuadrobm_id='".$cuadrobm_id."'";
$rs_nmedic= $DB_gogess->executec($busca_nmedic);
$nom1='';					
if($rs_nmedic->fields["cuadrobm_nombrecomercial"])
{
   $nom1=$rs_nmedic->fields["cuadrobm_nombrecomercial"].' ';
}

$nom2='';					
if($rs_nmedic->fields["cuadrobm_primerniveldesagregcion"])
{
   $nom2=$rs_nmedic->fields["cuadrobm_primerniveldesagregcion"].' ';
}

$nom3='';					
if($rs_nmedic->fields["cuadrobm_tercerniveldesagregcion"])
{
   $nom3=$rs_nmedic->fields["cuadrobm_tercerniveldesagregcion"].' ';
}
 
$nom4='';					
if($rs_nmedic->fields["cuadrobm_concentracion"])
{
   $nom4=$rs_nmedic->fields["cuadrobm_concentracion"].' ';
}

$nom5='';					
if($rs_nmedic->fields["cuadrobm_nombredispositivo"])
{
   $nom5=$rs_nmedic->fields["cuadrobm_nombredispositivo"].' ';
}


$concatena_nom=$nom1.$nom2.$nom3.$nom4.$nom5;

$nombre_medic=utf8_encode($rs_nmedic->fields["cuadrobm_principioactivo"]).' '.utf8_encode($concatena_nom);

//and tipomov_id in (1,17) 
$obtiene_precio="select * from dns_principalmovimientoinventario where  tipom_id=1 and cuadrobm_id='".$cuadrobm_id."' order by moviin_id desc";
$rs_obtprecio= $DB_gogess->executec($obtiene_precio);
?>
<center><b><?php echo $nombre_medic; ?></b></center><br>
<table width="700" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#CCCCCC"><div align="center">Lote</div></td>
    <td bgcolor="#CCCCCC"><div align="center">No. Compra / Documento </div></td>
    <td bgcolor="#CCCCCC"><div align="center">Precio Compra / Ingreso </div></td>
    <td bgcolor="#CCCCCC"><div align="center">Cantidad</div></td>
    <td bgcolor="#CCCCCC"><div align="center">Fecha Caduca</div></td>
  </tr>
<?php
 if($rs_obtprecio)
	{
		while (!$rs_obtprecio->EOF) {	
		
		$busca_compra="select * from dns_compras where compra_id='".$rs_obtprecio->fields["compra_id"]."'";
		$rs_obtcompra= $DB_gogess->executec($busca_compra);
		
		if($rs_obtprecio->fields["tipomov_id"]==1)
		{
		  $nom_t='INVENTARIO INICIAL';
		}
		else
		{
		  $compra_nsec='';
		  $compra_nsec=str_pad($rs_obtprecio->fields["compra_id"], 10, "0", STR_PAD_LEFT);
		  $nom_t=$compra_nsec;
		}
		
		
		
		
?>  
  <tr>
    <td nowrap><div align="center"><?php echo $rs_obtprecio->fields["moviin_nlote"]; ?></div></td>
    <td nowrap><div align="center"><?php echo $nom_t; ?></div></td>
    <td><div align="center"><?php echo $rs_obtprecio->fields["moviin_preciocompra"]; ?></div></td>
    <td><div align="center"><?php echo $rs_obtprecio->fields["centrorecibe_cantidad"]; ?></div></td>
    <td nowrap><div align="center"><?php echo $rs_obtprecio->fields["moviin_fechadecaducidad"]; ?></div></td>
  </tr>
<?php
          $rs_obtprecio->MoveNext();
		}
	}
?>  
</table>

<?php
$obtiene_precio="select * from  dns_movimientoinventario where  moviin_fecharegistro>='2021-09-01' and  tipomov_id in (1) and cuadrobm_id='".$cuadrobm_id."' order by moviin_id desc";
$rs_obtprecio= $DB_gogess->executec($obtiene_precio);
?>
<center><b>INVENTARIO INICIAL POR CENTROS</b></center><br>
<table width="400" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#CCCCCC"><div align="center">Centro</div></td>
    <td bgcolor="#CCCCCC"><div align="center">Lote</div></td>
    <td bgcolor="#CCCCCC"><div align="center">No. Compra </div></td>
    <td bgcolor="#CCCCCC"><div align="center">Precio Compra </div></td>
    <td bgcolor="#CCCCCC"><div align="center">Cantidad Compra</div></td>
    <td bgcolor="#CCCCCC"><div align="center">Fecha Caduca</div></td>
  </tr>
<?php
 if($rs_obtprecio)
	{
		while (!$rs_obtprecio->EOF) {	
		
		
		  $nom_t='INVENTARIO INICIAL';	
		  
		  
		 $busca_ncentro="select * from dns_centrosalud where centro_id='".$rs_obtprecio->fields["centro_id"]."'";
		 $rs_ncentro= $DB_gogess->executec($busca_ncentro);
		
?>  
  <tr>
    <td nowrap><div align="center"><?php echo utf8_encode($rs_ncentro->fields["centro_nombre"]); ?></div></td>
	<td nowrap><div align="center"><?php echo $rs_obtprecio->fields["moviin_nlote"]; ?></div></td>
    <td nowrap><div align="center"><?php echo $nom_t; ?></div></td>
    <td><div align="center"><?php echo $rs_obtprecio->fields["moviin_preciocompra"]; ?></div></td>
    <td><div align="center"><?php echo $rs_obtprecio->fields["centrorecibe_cantidad"]; ?></div></td>
    <td nowrap><div align="center"><?php echo $rs_obtprecio->fields["moviin_fechadecaducidad"]; ?></div></td>
  </tr>
<?php
          $rs_obtprecio->MoveNext();
		}
	}
?>  
</table>


<?php

}


?>