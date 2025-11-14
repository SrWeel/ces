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

class obj_bodegas
{

  function busca_precioproductoredp($cuadrobm_id, $DB_gogess)
  {
    //$lp=array();
    //$bu_px="select * from dns_redppreciostiempo where cuadrobm_id='".$cuadrobm_id."'";
    //$rs_bupx = $DB_gogess->executec($bu_px);

    // $lp["pcosto"]=$rs_bupx->fields["precio_compra"];
    //$lp["pvp"]=$rs_bupx->fields["precio_pvp"];
    //$lp["pisspol"]=$rs_bupx->fields["precio_ispol"];
    //$lp["plasticos"]=$rs_bupx->fields["precio_plasticos"];
    //$lp["ptecho"]=$rs_bupx->fields["precio_techo"];


    $lp = array();
    $bu_px = "select * from dns_preciostiempo where cuadrobm_id='" . $cuadrobm_id . "'";
    $rs_bupx = $DB_gogess->executec($bu_px);

    $lp["pcosto"] = $rs_bupx->fields["precio_compra"];
    $lp["pvp"] = $rs_bupx->fields["precio_pvp"];
    $lp["pisspol"] = $rs_bupx->fields["precio_ispol"];
    $lp["plasticos"] = $rs_bupx->fields["precio_plasticos"];
    $lp["otorr"] = $rs_bupx->fields["precio_otorr"];

    $busca_preciotecho = "select * from dns_cuadrobasicomedicamentos where cuadrobm_id='" . $cuadrobm_id . "'";
    $rs_buptecho = $DB_gogess->executec($busca_preciotecho);
    $lp["ptecho"] = $rs_buptecho->fields["cuadrobm_preciotecho"];


    return $lp;
  }

  function busca_precioproducto($cuadrobm_id, $DB_gogess)
  {
    $lp = array();
    $bu_px = "select * from dns_preciostiempo where cuadrobm_id='" . $cuadrobm_id . "'";
    $rs_bupx = $DB_gogess->executec($bu_px);

    $lp["pcosto"] = $rs_bupx->fields["precio_compra"];
    $lp["pvp"] = $rs_bupx->fields["precio_pvp"];
    $lp["pisspol"] = $rs_bupx->fields["precio_ispol"];
    $lp["plasticos"] = $rs_bupx->fields["precio_plasticos"];
    $lp["otorr"] = $rs_bupx->fields["precio_otorr"];

    return $lp;
  }


  function busca_redp_preciopromediocompra($per_activo, $moviin_id, $cuadrobm_id, $DB_gogess)
  {

    //precio actual
    $bu_px = "select * from dns_redppreciostiempo where cuadrobm_id='" . $cuadrobm_id . "'";
    $rs_bupx = $DB_gogess->executec($bu_px);
    $precio_compra = 0;
    $precio_compra = $rs_bupx->fields["precio_compra"];
    //precio actual
    //echo "Tablapeciotiempo:".$precio_compra."<br>";

    $busca_ultimoprecio = "select AVG(moviin_preciocompra) as moviin_preciocompra from dns_principalmovimientoinventario where cuadrobm_id='" . $cuadrobm_id . "' and tipomov_id in (1,17) and moviin_redpublica='1' and 	perioac_id='" . $per_activo . "' order by moviin_preciocompra desc limit 1";
    $rs_ultiprecio = $DB_gogess->executec($busca_ultimoprecio);

    $ultimo_preciovalor = $rs_ultiprecio->fields["moviin_preciocompra"];

    //echo "Movimiento:".$ultimo_preciovalor."<br>";

    $saca_promedio = 0;
    //if($precio_compra>0)
    //{
    //$saca_promedio=($precio_compra+$ultimo_preciovalor)/2;
    //}
    //else
    //{
    $saca_promedio = $ultimo_preciovalor;
    //}

    return round($saca_promedio, 2);
  }
//precio de compra


function busca_preciopromediocompra($cuadrobm_id,$preciocomprallega, $DB_gogess)
  {
    $bu_px = "select * from dns_preciostiempo where cuadrobm_id='" . $cuadrobm_id . "'";
    $rs_bupx = $DB_gogess->executec($bu_px);
    $precio_compra = 0;
    $precio_compra = $rs_bupx->fields["precio_compra"];
	
	
	if($precio_compra>0)
	{
	$precio_promedio=($preciocomprallega+$precio_compra)/2;
	}
	else
	{
	$precio_promedio=$preciocomprallega;
	}

    return round($precio_promedio, 2);
  }

//precio de compra

//precio red publica promedio

function busca_redp_precioproaccompra($per_activo, $moviin_id, $cuadrobm_id,$preciocomprallega, $DB_gogess)
  {

    //precio actual
    $bu_px = "select * from dns_redppreciostiempo where cuadrobm_id='" . $cuadrobm_id . "'";
    $rs_bupx = $DB_gogess->executec($bu_px);
    $precio_compra = 0;
    $precio_compra = $rs_bupx->fields["precio_compra"];
    //precio actual
    //echo "Tablapeciotiempo:".$precio_compra."<br>";

	if($precio_compra>0)
	{
	$precio_promedio=($preciocomprallega+$precio_compra)/2;
	}
	else
	{
	$precio_promedio=$preciocomprallega;
	}
	
    //}

    return round($precio_promedio, 2);
  }

//precio red publica promedio



  function busca_preciomayorcompra($cuadrobm_id, $DB_gogess)
  {

    $lista_incialbodegas = "select moviin_preciocompra from dns_movimientoinventario where cuadrobm_id='" . $cuadrobm_id . "' and tipom_id=1 and tipomov_id=1 order by moviin_preciocompra desc limit 1";
    //$rs_ultbodega = $DB_gogess->executec($lista_incialbodegas);
    $precio_ini = 0;
    //$precio_ini=$rs_ultbodega->fields["moviin_preciocompra"];

    $precio_mayor = 0;
    $busca_ultimoprecio = "select moviin_preciocompra from dns_principalmovimientoinventario where moviin_fecharegistro>='2024-02-15' and cuadrobm_id='" . $cuadrobm_id . "' and tipomov_id in (1,17) order by moviin_preciocompra desc limit 1";
    $rs_ultiprecio = $DB_gogess->executec($busca_ultimoprecio);




    $bu_px = "select * from dns_preciostiempo where cuadrobm_id='" . $cuadrobm_id . "'";
    $rs_bupx = $DB_gogess->executec($bu_px);
    $precio_compra = 0;
    $precio_compra = $rs_bupx->fields["precio_compra"];

    $precio_ibini = 0;
    if ($precio_ini > $rs_ultiprecio->fields["moviin_preciocompra"]) {
      $precio_ibini = $precio_ini;
    } else {
      $precio_ibini = $rs_ultiprecio->fields["moviin_preciocompra"];
    }

    if ($precio_ibini > $precio_compra) {
      $precio_mayor = $precio_ibini;
    } else {
      $precio_mayor = $precio_compra;
    }

    return round($precio_mayor, 2);
  }

  function clasifica_data($fecha_corte, $centro_id, $cuadrobm_id, $subo_id, $DB_gogess)
  {

    $array_lista = array();
    $saca_consulta = "select * from dns_subbodega where subo_id='" . $subo_id . "'";
    $rs_consul = $DB_gogess->executec($saca_consulta);

    $subo_script = $rs_consul->fields["subo_script"];

    $lista_cadu = '';
    $cuenta = 0;

    $lista_compras = "select * from dns_compras RIGHT join dns_principalmovimientoinventario on dns_compras.compra_id=dns_principalmovimientoinventario.compra_id where dns_principalmovimientoinventario.tipom_id=1  and cuadrobm_id='" . $cuadrobm_id . "' " . $subo_script;
    $rs_lcompras = $DB_gogess->executec($lista_compras);
    if ($rs_lcompras) {
      while (!$rs_lcompras->EOF) {


        $stockactual = "select sum(stock_cantidad*stock_signo) as stactual from dns_principalstockactual st inner join dns_principalmovimientoinventario inv on st.moviin_id=inv.moviin_id where st.centro_id='" . $centro_id . "' and st.cuadrobm_id='" . $cuadrobm_id . "' and  date_format(stock_fechaureg,'%Y-%m-%d')<='" . $fecha_corte . "' and inv.moviin_nlote='" . $rs_lcompras->fields["moviin_nlote"] . "'  and stock_periodo>=2021";
        $rs_stactua = $DB_gogess->executec($stockactual);

        if ($rs_stactua->fields["stactual"] > 0) {

          // $lista_cadu.=$rs_lcompras->fields["moviin_nlote"]."<br>";
          // $lista_cadu.=$rs_lcompras->fields["moviin_fechadecaducidad"]."<br>";
          // $lista_cadu.=$rs_stactua->fields["stactual"]."<br>";

          $array_lista[$cuenta]["moviin_nlote"] = $rs_lcompras->fields["moviin_nlote"];
          $array_lista[$cuenta]["moviin_fechadecaducidad"] = $rs_lcompras->fields["moviin_fechadecaducidad"];
          $array_lista[$cuenta]["stactual"] = $rs_stactua->fields["stactual"];

          $cuenta++;
        }




        $rs_lcompras->MoveNext();
      }
    }

    $array_lista = array_unique($array_lista);

    //print_r($array_lista);

    return $array_lista;
  }


  function stock_accentro($per_activo, $centro_id, $cuadrobm_id, $DB_gogess)
  {

    $stockactual = "select sum(stock_cantidad*stock_signo) as stactual from dns_stockactual where stock_periodo='" . $per_activo . "'  and centro_id=" . $centro_id . " and cuadrobm_id='" . $cuadrobm_id . "'";
    $rs_stactua = $DB_gogess->executec($stockactual);

    $rs_stactua = $DB_gogess->executec($stockactual);

    $stactual = $rs_stactua->fields["stactual"];

    return $stactual;
  }

  function stock_alafecha($centro_id, $cuadrobm_id, $fecha_corte, $lote, $compra_id, $DB_gogess)
  {

    $stockactual = "select sum(stock_cantidad*stock_signo) as stactual from dns_principalstockactual st inner join dns_principalmovimientoinventario inv on st.moviin_id=inv.moviin_id where st.centro_id='" . $centro_id . "' and st.cuadrobm_id='" . $cuadrobm_id . "' and  date_format(stock_fechaureg,'%Y-%m-%d')<='" . $fecha_corte . "' and inv.moviin_nlote='" . $lote . "' and  stock_periodo>=2021";
    $rs_stactua = $DB_gogess->executec($stockactual);

    return $rs_stactua->fields["stactual"];
  }

  function stock_alafechacentro($centro_id, $cuadrobm_id, $fecha_corte, $lote, $per_activo, $DB_gogess)
  {

    $stockactual = "select sum(stock_cantidad*stock_signo) as stactual from dns_stockactual st inner join dns_movimientoinventario inv on st.moviin_id=inv.moviin_id where st.centro_id='" . $centro_id . "' and st.cuadrobm_id='" . $cuadrobm_id . "' and  date_format(stock_fechaureg,'%Y-%m-%d')<='" . $fecha_corte . "' and inv.moviin_nlote='" . $lote . "' and stock_periodo>='" . $per_activo . "'";
    $rs_stactua = $DB_gogess->executec($stockactual);

    return $rs_stactua->fields["stactual"];
  }

  //saca el nombre del producto
  function nombre_pr($codigo, $cuadrobm_id, $DB_gogess)
  {

    if ($codigo) {
      $busca_nmedic = "select * from dns_cuadrobasicomedicamentos where cuadrobm_codigoatc='" . $codigo . "'";
    }

    if ($cuadrobm_id) {
      $busca_nmedic = "select * from dns_cuadrobasicomedicamentos where cuadrobm_id='" . $cuadrobm_id . "'";
    }

    $datosp = array();

    $rs_nmedic = $DB_gogess->executec($busca_nmedic);
    $nom1 = '';
    if ($rs_nmedic->fields["cuadrobm_nombrecomercial"]) {
      $nom1 = $rs_nmedic->fields["cuadrobm_nombrecomercial"] . ' ';
    }

    $nom2 = '';
    if ($rs_nmedic->fields["cuadrobm_primerniveldesagregcion"]) {
      $nom2 = $rs_nmedic->fields["cuadrobm_primerniveldesagregcion"] . ' ';
    }

    $nom3 = '';
    if ($rs_nmedic->fields["cuadrobm_tercerniveldesagregcion"]) {
      $nom3 = $rs_nmedic->fields["cuadrobm_tercerniveldesagregcion"] . ' ';
    }

    $nom4 = '';
    if ($rs_nmedic->fields["cuadrobm_concentracion"]) {
      $nom4 = $rs_nmedic->fields["cuadrobm_concentracion"] . ' ';
    }

    $nom5 = '';
    if ($rs_nmedic->fields["cuadrobm_nombredispositivo"]) {
      $nom5 = $rs_nmedic->fields["cuadrobm_nombredispositivo"] . ' ';
    }

    $concatena_nom = $nom1 . $nom2 . $nom3 . $nom4 . $nom5;
    $nombre_medic = '';
    $nombre_medic = utf8_encode($rs_nmedic->fields["cuadrobm_principioactivo"]) . ' ' . utf8_encode($concatena_nom);

    $datosp["nombre"] = $nombre_medic;
    $datosp["codigo"] = $rs_nmedic->fields["cuadrobm_codigoatc"];

    return $datosp;
  }

  /*Saca precio de inventario inicila del periodo y ultimo precio de compra */
  function saca_precio_general($cuadrobm_id, $centro_id, $objformulario, $DB_gogess)
  {
    $datos = array();
    $per_activo = 0;
    $per_activo = $objformulario->replace_cmb("dns_periodobodega", "perio_activo,perio_anio", " where perio_activo=", 1, $DB_gogess);

    //inventario inicial
    $busca_ultimoprecio = "select * from dns_movimientoinventario where moviin_fecharegistro>='2021-09-01' and cuadrobm_id='" . $cuadrobm_id . "' and tipom_id=1 and tipomov_id in (1) and centro_id='" . $centro_id . "' order by moviin_id desc";
    $rs_bprecio = $DB_gogess->executec($busca_ultimoprecio);

    $precio_inincial = $rs_bprecio->fields["moviin_preciocompra"];
    //inventario inicial



    //compras actuales  
    $busca_ultimoing = "select * from dns_movimientoinventario where tipom_id=1 and tipomov_id=2 and cuadrobm_id='" . $cuadrobm_id . "' and centro_id='" . $centro_id . "' and perioac_id='" . $per_activo . "' and egrec_id!=0 order by moviin_id desc";
    $rs_bulcompra = $DB_gogess->executec($busca_ultimoing);

    $precio_compra = $rs_bulcompra->fields["moviin_preciocompra"];
    //compras actuales

    $datos["precio_invincial"] = $precio_inincial;
    $datos["precio_compra"] = $precio_compra;
  }


  /*Saca precio de inventario inicial */
  function saca_precio_inicialxcentro($cuadrobm_id, $centro_id, $objformulario, $DB_gogess)
  {
    $datos = array();
    $per_activo = 0;
    $per_activo = $objformulario->replace_cmb("dns_periodobodega", "perio_activo,perio_anio", " where perio_activo=", 1, $DB_gogess);

    //inventario inicial
    $busca_ultimoprecio = "select * from dns_movimientoinventario where moviin_fecharegistro>='2021-09-01' and cuadrobm_id='" . $cuadrobm_id . "' and tipom_id=1 and tipomov_id in (1) and centro_id='" . $centro_id . "' order by moviin_id desc";
    $rs_bprecio = $DB_gogess->executec($busca_ultimoprecio);

    $precio_inincial = $rs_bprecio->fields["moviin_preciocompra"];
    //inventario inicial



    return $precio_inincial;
  }


  /*Saca precio de inventario inicial general */
  function saca_precio_inicialgeneral($cuadrobm_id, $objformulario, $DB_gogess)
  {
    $datos = array();
    $per_activo = 0;
    $per_activo = $objformulario->replace_cmb("dns_periodobodega", "perio_activo,perio_anio", " where perio_activo=", 1, $DB_gogess);

    //inventario inicial
    $busca_ultimoprecio = "select moviin_preciocompra,count(moviin_preciocompra) as total from dns_movimientoinventario where moviin_fecharegistro>='2021-09-01' and cuadrobm_id='" . $cuadrobm_id . "' and tipom_id=1 and tipomov_id in (1) group by moviin_preciocompra order by count(moviin_preciocompra) desc";
    $rs_bprecio = $DB_gogess->executec($busca_ultimoprecio);

    $precio_inincial = $rs_bprecio->fields["moviin_preciocompra"];
    //inventario inicial

    //inventario inicial
    $busca_ultimopreciod = "select moviin_preciocompra,count(moviin_preciocompra) as total from dns_movimientoinventario where moviin_fecharegistro>='2021-09-01' and cuadrobm_id='" . $cuadrobm_id . "' and tipom_id=1 and tipomov_id in (1) group by moviin_preciocompra order by count(moviin_preciocompra) asc";
    $rs_bpreciod = $DB_gogess->executec($busca_ultimopreciod);

    $precio_ininciald = $rs_bpreciod->fields["moviin_preciocompra"];
    //inventario inicial

    $datos["ultimo"] = $precio_inincial;

    if ($precio_inincial != $precio_ininciald) {
      $datos["diferente"] = $precio_ininciald;
    } else {
      $datos["diferente"] = '';
    }
    return $datos;
  }


  /*Saca precio de inventario inicial por centro */
  function saca_precio_inicialcentro($centro_id, $cuadrobm_id, $objformulario, $DB_gogess)
  {
    $datos = array();
    $per_activo = 0;
    $per_activo = $objformulario->replace_cmb("dns_periodobodega", "perio_activo,perio_anio", " where perio_activo=", 1, $DB_gogess);

    //inventario inicial
    $busca_ultimoprecio = "select moviin_preciocompra,count(moviin_preciocompra) as total from dns_movimientoinventario where moviin_fecharegistro>='2021-09-01' and cuadrobm_id='" . $cuadrobm_id . "' and tipom_id=1 and tipomov_id in (1) and centro_id='" . $centro_id . "' group by moviin_preciocompra order by count(moviin_preciocompra) desc";
    $rs_bprecio = $DB_gogess->executec($busca_ultimoprecio);

    $precio_inincial = $rs_bprecio->fields["moviin_preciocompra"];
    //inventario inicial

    //inventario inicial
    $busca_ultimopreciod = "select moviin_preciocompra,count(moviin_preciocompra) as total from dns_movimientoinventario where moviin_fecharegistro>='2021-09-01' and cuadrobm_id='" . $cuadrobm_id . "' and tipom_id=1 and tipomov_id in (1) and centro_id='" . $centro_id . "' group by moviin_preciocompra order by count(moviin_preciocompra) asc";
    $rs_bpreciod = $DB_gogess->executec($busca_ultimopreciod);

    $precio_ininciald = $rs_bpreciod->fields["moviin_preciocompra"];
    //inventario inicial

    $datos["ultimo"] = $precio_inincial;

    if ($precio_inincial != $precio_ininciald) {
      $datos["diferente"] = $precio_ininciald;
    } else {
      $datos["diferente"] = '';
    }
    return $datos;
  }


  /*Saca ultimo precio de compra bodega principal por producto*/
  function saca_precio_comprabp($cuadrobm_id, $objformulario, $DB_gogess)
  {
    $datos = array();
    $per_activo = 0;
    $per_activo = $objformulario->replace_cmb("dns_periodobodega", "perio_activo,perio_anio", " where perio_activo=", 1, $DB_gogess);

    //ultimo precio
    $busca_ultimoing = "select * from dns_principalmovimientoinventario where tipom_id=1 and tipomov_id in (17,6,9) and cuadrobm_id='" . $cuadrobm_id . "' and perioac_id='" . $per_activo . "' and compra_id!=0 order by moviin_id desc";
    $rs_bulcompra = $DB_gogess->executec($busca_ultimoing);

    $precio_compra = $rs_bulcompra->fields["moviin_preciocompra"];
    //ultimo precio

    //mayor precio
    $busca_ultimoingm = "select * from dns_principalmovimientoinventario where tipom_id=1 and tipomov_id in (17,6,9) and cuadrobm_id='" . $cuadrobm_id . "' and perioac_id='" . $per_activo . "' and compra_id!=0 order by moviin_preciocompra desc";
    $rs_bulcompram = $DB_gogess->executec($busca_ultimoingm);

    $precio_compramayor = $rs_bulcompram->fields["moviin_preciocompra"];
    //mayor precio


    //menor precio
    $busca_ultimoingmen = "select * from dns_principalmovimientoinventario where tipom_id=1 and tipomov_id in (17,6,9) and cuadrobm_id='" . $cuadrobm_id . "' and perioac_id='" . $per_activo . "' and compra_id!=0 order by moviin_preciocompra asc";
    $rs_bulcompramen = $DB_gogess->executec($busca_ultimoingmen);

    $precio_compramenor = $rs_bulcompramen->fields["moviin_preciocompra"];
    //menor precio

    $datos["ultimo"] = $precio_compra;
    $datos["mayor"] = $precio_compramayor;
    $datos["menor"] = $precio_compramenor;
    return $datos;
  }
}
