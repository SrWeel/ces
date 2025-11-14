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