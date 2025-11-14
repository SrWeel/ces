<?php
/**
 * Funciones de bodega
 * 
 * Este archivo se tiene todas las funciones para la bodega.
 * 
 * @author Ecohevea <franklin.aguas@gmail.com>
 * @version 1.0
 * @package session_system
 */

class obj_bodegas{


function stock_alafecha($centro_id,$cuadrobm_id,$fecha_corte,$lote,$compra_id,$DB_gogess)
{

  $stockactual="select sum(stock_cantidad*stock_signo) as stactual from dns_principalstockactual st inner join dns_principalmovimientoinventario inv on st.moviin_id=inv.moviin_id where st.centro_id='".$centro_id."' and st.cuadrobm_id='".$cuadrobm_id."' and  date_format(stock_fechaureg,'%Y-%m-%d')<='".$fecha_corte."' and inv.moviin_nlote='".$lote."' and inv.compra_id='".$compra_id."'";
  $rs_stactua = $DB_gogess->executec($stockactual);
  
  return $rs_stactua->fields["stactual"];

}

//saca el nombre del producto
function nombre_pr($codigo,$cuadrobm_id,$DB_gogess)
{

if($codigo)
{
$busca_nmedic="select * from dns_cuadrobasicomedicamentos where cuadrobm_codigoatc='".$codigo."'";
}

if($cuadrobm_id)
{
$busca_nmedic="select * from dns_cuadrobasicomedicamentos where cuadrobm_id='".$cuadrobm_id."'";
}

$datosp=array();

$rs_nmedic=$DB_gogess->executec($busca_nmedic);
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
$nombre_medic='';
$nombre_medic=utf8_encode($rs_nmedic->fields["cuadrobm_principioactivo"]).' '.utf8_encode($concatena_nom);

$datosp["nombre"]=$nombre_medic;
$datosp["codigo"]=$rs_nmedic->fields["cuadrobm_codigoatc"];

return $datosp;

}

/*Saca precio de inventario inicila del periodo y ultimo precio de compra */
function saca_precio_general($cuadrobm_id,$centro_id,$objformulario,$DB_gogess)
{
  $datos=array();
  $per_activo=0;
  $per_activo=$objformulario->replace_cmb("dns_periodobodega","perio_activo,perio_anio"," where perio_activo=",1,$DB_gogess);
  
  //inventario inicial
  $busca_ultimoprecio="select * from dns_movimientoinventario where moviin_fecharegistro>='2021-09-01' and cuadrobm_id='".$cuadrobm_id."' and tipom_id=1 and tipomov_id in (1) and centro_id='".$centro_id."' order by moviin_id desc";
  $rs_bprecio = $DB_gogess->executec($busca_ultimoprecio);
  
  $precio_inincial=$rs_bprecio->fields["moviin_preciocompra"];
  //inventario inicial
  
  
  
  //compras actuales  
  $busca_ultimoing="select * from dns_movimientoinventario where tipom_id=1 and tipomov_id=2 and cuadrobm_id='".$cuadrobm_id."' and centro_id='".$centro_id."' and perioac_id='".$per_activo."' and egrec_id!=0 order by moviin_id desc";
  $rs_bulcompra = $DB_gogess->executec($busca_ultimoing);
  
  $precio_compra=$rs_bulcompra->fields["moviin_preciocompra"];
  //compras actuales
  
  $datos["precio_invincial"]=$precio_inincial;
  $datos["precio_compra"]=$precio_compra;
}


/*Saca precio de inventario inicial */
function saca_precio_inicialxcentro($cuadrobm_id,$centro_id,$objformulario,$DB_gogess)
{
  $datos=array();
  $per_activo=0;
  $per_activo=$objformulario->replace_cmb("dns_periodobodega","perio_activo,perio_anio"," where perio_activo=",1,$DB_gogess);
  
  //inventario inicial
  $busca_ultimoprecio="select * from dns_movimientoinventario where moviin_fecharegistro>='2021-09-01' and cuadrobm_id='".$cuadrobm_id."' and tipom_id=1 and tipomov_id in (1) and centro_id='".$centro_id."' order by moviin_id desc";
  $rs_bprecio = $DB_gogess->executec($busca_ultimoprecio);
  
  $precio_inincial=$rs_bprecio->fields["moviin_preciocompra"];
  //inventario inicial
  
  
  
  return $precio_inincial;
}


/*Saca precio de inventario inicial general */
function saca_precio_inicialgeneral($cuadrobm_id,$objformulario,$DB_gogess)
{
  $datos=array();
  $per_activo=0;
  $per_activo=$objformulario->replace_cmb("dns_periodobodega","perio_activo,perio_anio"," where perio_activo=",1,$DB_gogess);
  
  //inventario inicial
  $busca_ultimoprecio="select moviin_preciocompra,count(moviin_preciocompra) as total from dns_movimientoinventario where moviin_fecharegistro>='2021-09-01' and cuadrobm_id='".$cuadrobm_id."' and tipom_id=1 and tipomov_id in (1) group by moviin_preciocompra order by count(moviin_preciocompra) desc";
  $rs_bprecio = $DB_gogess->executec($busca_ultimoprecio);
  
  $precio_inincial=$rs_bprecio->fields["moviin_preciocompra"];
  //inventario inicial
  
  //inventario inicial
  $busca_ultimopreciod="select moviin_preciocompra,count(moviin_preciocompra) as total from dns_movimientoinventario where moviin_fecharegistro>='2021-09-01' and cuadrobm_id='".$cuadrobm_id."' and tipom_id=1 and tipomov_id in (1) group by moviin_preciocompra order by count(moviin_preciocompra) asc";
  $rs_bpreciod = $DB_gogess->executec($busca_ultimopreciod);
  
  $precio_ininciald=$rs_bpreciod->fields["moviin_preciocompra"];
  //inventario inicial
  
  $datos["ultimo"]=$precio_inincial;
  
  if($precio_inincial!=$precio_ininciald)
  {
   $datos["diferente"]=$precio_ininciald;
  }
  else
  {
   $datos["diferente"]='';
  }
  return $datos;
}

/*Saca ultimo precio de compra bodega principal por producto*/
function saca_precio_comprabp($cuadrobm_id,$objformulario,$DB_gogess)
{
  $datos=array();
  $per_activo=0;
  $per_activo=$objformulario->replace_cmb("dns_periodobodega","perio_activo,perio_anio"," where perio_activo=",1,$DB_gogess);
  
 //ultimo precio
  $busca_ultimoing="select * from dns_principalmovimientoinventario where tipom_id=1 and tipomov_id=17 and cuadrobm_id='".$cuadrobm_id."' and perioac_id='".$per_activo."' and compra_id!=0 order by moviin_id desc";
  $rs_bulcompra = $DB_gogess->executec($busca_ultimoing);
  
  $precio_compra=$rs_bulcompra->fields["moviin_preciocompra"];
  //ultimo precio
  
  //mayor precio
  $busca_ultimoingm="select * from dns_principalmovimientoinventario where tipom_id=1 and tipomov_id=17 and cuadrobm_id='".$cuadrobm_id."' and perioac_id='".$per_activo."' and compra_id!=0 order by moviin_preciocompra desc";
  $rs_bulcompram = $DB_gogess->executec($busca_ultimoingm);
  
  $precio_compramayor=$rs_bulcompram->fields["moviin_preciocompra"];
  //mayor precio
  
  
   //menor precio
  $busca_ultimoingmen="select * from dns_principalmovimientoinventario where tipom_id=1 and tipomov_id=17 and cuadrobm_id='".$cuadrobm_id."' and perioac_id='".$per_activo."' and compra_id!=0 order by moviin_preciocompra asc";
  $rs_bulcompramen = $DB_gogess->executec($busca_ultimoingmen);
  
  $precio_compramenor=$rs_bulcompram->fields["moviin_preciocompra"];
  //menor precio
  
  $datos["ultimo"]=$precio_compra;
  $datos["mayor"]=$precio_compramayor;
  $datos["menor"]=$precio_compramenor;
  return $datos;
  
  
}



}



?>