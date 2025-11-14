<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors', 0);
error_reporting(E_ALL);
$tiempossss = 4404000;
ini_set("session.cookie_lifetime", $tiempossss);
ini_set("session.gc_maxlifetime", $tiempossss);
session_start();

$director = '../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");

include("lib_datarp.php");
//include("../precuentaprincipal/lib_asiento.php");
include("../pedidoabodegav3/lib_asiento.php");

$objformulario = new  ValidacionesFormulario();
$objtableform = new templateform();

$centrob_id = $_POST["centrob_id"];
$centro_id = $_POST["centrob_id"];
//$precu_id=$_POST["precu_id"];
$precu_id = $_POST["precu_id"];
$clie_id = $_POST["clie_id"];
$code_redp = $_POST["code_redp"];

$busca_precuent = "select * from dns_precuenta where precu_id='" . $precu_id . "'";
$rs_precuent = $DB_gogess->executec($busca_precuent);
echo $especipr_id = $rs_precuent->fields["especipr_id"];

$per_activo = 0;
$per_activo = $objformulario->replace_cmb("dns_periodobodega", "perio_activo,perio_anio", " where perio_activo=", 1, $DB_gogess);
$periodo_actual = $objformulario->replace_cmb("dns_periodobodega", "perio_id,perio_anio", " where perio_activo=", "1", $DB_gogess);

$lista_aenviar = array();

$busca_listapr = "select * from dns_precuenta inner join dns_preddetalleprecuentav on dns_precuenta.precu_id=dns_preddetalleprecuentav.precu_id where dns_precuenta.precu_id='" . $precu_id . "'";
$rs_lprecuentas = $DB_gogess->executec($busca_listapr, array());
if ($rs_lprecuentas) {

  while (!$rs_lprecuentas->EOF) {


    $area_id = $rs_lprecuentas->fields["area_id"];

    $busca_area = "select * from lpin_area where area_id='" . $area_id . "'";
    $rs_barea = $DB_gogess->executec($busca_area, array());
    $narea_v = '';
    $narea_v = $rs_barea->fields["area_nombre"];


    $detapreoper_id = $rs_lprecuentas->fields["detapre_id"];

    $cuadrobm_id = 0;
    $cuadrobm_id = $rs_lprecuentas->fields["cuadrobm_id"];

    echo "<br>CUADRO BASICO:" . $cuadrobm_id . "<br>";
    //echo $rs_lprecuentas->fields["detapre_detalle"]."<br>";

    $cantidad_valor = $rs_lprecuentas->fields["detapre_cantidad"];
    $detapre_cantidad = $rs_lprecuentas->fields["detapre_cantidad"];
    $stockactual = "select sum(stock_cantidad*stock_signo) as stactual from dns_stockactual where centro_id=" . $centrob_id . " and cuadrobm_id='" . $cuadrobm_id . "'";
    $rs_stactua = $DB_gogess->executec($stockactual);
    $maximo_permitido = $rs_stactua->fields["stactual"];

    echo "CANTIDAD PEDIDA:" . $cantidad_valor . "<br>";
    echo "CANTIDAD PERMITIDA:" . $maximo_permitido . "<br>";

    $lista_aenviar = array();


    if ($cantidad_valor <= $maximo_permitido) {

      //echo '<br>---------------------<br>';
      //busca entregados

      $busca_entregadox = "select sum(detapre_cantidad) as cantidad_val from dns_detalleprecuenta where areap_id>0 and precu_id='" . $precu_id . "' and  detapreoper_id='" . $rs_lprecuentas->fields["detapre_id"] . "'";
      $rs_okentregx = $DB_gogess->executec($busca_entregadox, array());
      $cantidad_valx = $rs_okentregx->fields["cantidad_val"];

      $detapre_cantidad = $detapre_cantidad - $cantidad_valx;

      //echo  "Entregado:".$detapre_cantidad;
      //echo '<br>---------------------<br>';
      //busca entregados


      $detpretmp_id = 0;
      $egrec_id_v = 0;
      $centro_redpublica = 0;
      $array_asignaciondata = array();

      if ($detapre_cantidad > 0) {
        //echo '<br>---------------------busca---<br>';
        $array_asignaciondata = busca_paradescargarapaciente($periodo_actual, $centrob_id, $cuadrobm_id, $detapre_cantidad, $detpretmp_id, $egrec_id_v, $centro_redpublica, $detapreoper_id, $DB_gogess, $objformulario);
      }
      //print_r($array_asignaciondata);
      $lista_aenviar[] = $array_asignaciondata;
    }

    //==================================================================================
    print_r($lista_aenviar);

    //$lista_aenviar=array();
    if (count($lista_aenviar) > 0) {

      $egreg_gen = 0;
      $egreg_gen = $precu_id;


      for ($i = 0; $i < count($lista_aenviar); $i++) {

        for ($j = 0; $j < count($lista_aenviar[$i]); $j++) {

          $desglosa_id = array();
          $desglosa_id = explode("|", $lista_aenviar[$i][$j]);
          //print_r($desglosa_id);
          //=======================================================
          $cuadrobm_id = $desglosa_id[3];
          $cantidad_val = $desglosa_id[1];
          $cantidad_valor = $desglosa_id[1];
          $egrec_id = 0;
          $moviin_id = $desglosa_id[0];
          $detpretmp_id = $desglosa_id[4];

          //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++



          $busca_movimientodata = "select * from dns_movimientoinventario where moviin_id='" . $moviin_id . "'";
          $rs_movidata = $DB_gogess->executec($busca_movimientodata, array());

          $moviinb_redpublica = $rs_movidata->fields["moviinb_redpublica"];
          $cuadrobm_id = $rs_movidata->fields["cuadrobm_id"];
          $centro_id = $rs_movidata->fields["centro_id"];
          $tipom_id = 2;
          $tipomov_id = 18;
          $moviin_nlote = $rs_movidata->fields["moviin_nlote"];
          $moviin_fechadecaducidad = $rs_movidata->fields["moviin_fechadecaducidad"];
          $moviin_comprobantedeingreso = '0';
          $moviin_fechaingreso = '';
          $centroenvia_id = '0';
          $centrorecibe_id = '0';
          $centrorecibe_observacion = '';
          $centrorecibe_cantidad = 0;
          $centrorecibe_documento = '';
          $centrorecibe_bodegamatriz = 1;
          $usua_id = $_SESSION['ces1313777_sessid_inicio'];
          $moviin_fechaenvio = '';
          $moviin_nombrerecibe = '';
          $moviin_cedularecibe = '';
          $moviin_gradorecibe = '';

          if ($fecha_desc) {
            $moviin_fecharegistro = $fecha_desc . " " . date("H:i:s");
          } else {
            $moviin_fecharegistro = date("Y-m-d H:i:s");
          }

          $unid_id = $rs_movidata->fields["unid_id"];
          $uniddesg_id = $rs_movidata->fields["uniddesg_id"];
          $moviin_cantidadunidadconsumo = 1;
          $moviin_totalenunidadconsumo = $cantidad_valor;
          $moviin_fechadeelaboracion = $rs_movidata->fields["moviin_fechadeelaboracion"];
          $moviin_nombreproveedor = $rs_movidata->fields["moviin_nombreproveedor"];
          $moviin_nombrefabricante = $rs_movidata->fields["moviin_nombrefabricante"];
          $moviin_preciocompra = $rs_movidata->fields["moviin_preciocompra"];
          $moviin_total = $rs_movidata->fields["moviin_preciocompra"] * $cantidad_valor;
          $moviin_rsanitario = $rs_movidata->fields["moviin_rsanitario"];
          $compra_id = $rs_movidata->fields["compra_id"];
          $moviin_autorizado = '';
          $moviin_fechaautorizado = '';
          $moviin_aprobo = '0';
          $tempdsp_id = '0';
          $egrec_id = '0';
          $entregamoviin_id = $moviin_id;
          $entregaclie_id = $clie_id;

          if ($fecha_desc) {
            $entrega_fecha = $fecha_desc . " " . date("H:i:s");
          } else {
            $entrega_fecha = date("Y-m-d H:i:s");
          }

          $per_activo = 0;
          $per_activo = $objformulario->replace_cmb("dns_periodobodega", "perio_activo,perio_anio", " where perio_activo=", 1, $DB_gogess);

          ///ingresa primero precuenta
          $stockactual = "select sum(stock_cantidad*stock_signo) as stactual from dns_stockactual where centro_id=" . $centro_id . " and cuadrobm_id='" . $cuadrobm_id . "'";
          $rs_stactua = $DB_gogess->executec($stockactual);
          $maximo_permitido = $rs_stactua->fields["stactual"];



          if ($cantidad_valor <= $maximo_permitido) {


            $inserta_movimiento = "INSERT INTO dns_movimientoinventario ( cuadrobm_id, centro_id, tipom_id, tipomov_id, moviin_nlote, moviin_fechadecaducidad, moviin_comprobantedeingreso, moviin_fechaingreso, centroenvia_id, centrorecibe_id, centrorecibe_observacion, centrorecibe_cantidad, centrorecibe_documento, centrorecibe_bodegamatriz, usua_id, moviin_fechaenvio, moviin_nombrerecibe, moviin_cedularecibe, moviin_gradorecibe, moviin_fecharegistro, unid_id, uniddesg_id, moviin_cantidadunidadconsumo, moviin_totalenunidadconsumo, moviin_fechadeelaboracion, moviin_nombreproveedor, moviin_nombrefabricante, moviin_preciocompra, moviin_total, moviin_rsanitario, compra_id, moviin_autorizado, moviin_fechaautorizado, moviin_aprobo, tempdsp_id, egrec_id, entregamoviin_id, entregaclie_id, entrega_fecha, precu_id,perioac_id,moviin_tblreceta,moviinb_redpublica) VALUES
('" . $cuadrobm_id . "','" . $centro_id . "','" . $tipom_id . "','" . $tipomov_id . "','" . $moviin_nlote . "','" . $moviin_fechadecaducidad . "','" . $moviin_comprobantedeingreso . "','" . $moviin_fechaingreso . "','" . $centroenvia_id . "','" . $centrorecibe_id . "','" . $centrorecibe_observacion . "','" . $centrorecibe_cantidad . "','" . $centrorecibe_documento . "','" . $centrorecibe_bodegamatriz . "','" . $usua_id . "','" . $moviin_fechaenvio . "','" . $moviin_nombrerecibe . "','" . $moviin_cedularecibe . "','" . $moviin_gradorecibe . "','" . $moviin_fecharegistro . "','" . $unid_id . "','" . $uniddesg_id . "','" . $moviin_cantidadunidadconsumo . "','" . $moviin_totalenunidadconsumo . "','" . $moviin_fechadeelaboracion . "','" . $moviin_nombreproveedor . "','" . $moviin_nombrefabricante . "','" . $moviin_preciocompra . "','" . $moviin_total . "','" . $moviin_rsanitario . "','" . $compra_id . "','" . $moviin_autorizado . "','" . $moviin_fechaautorizado . "','" . $moviin_aprobo . "','" . $tempdsp_id . "','" . $egrec_id . "','" . $entregamoviin_id . "','" . $entregaclie_id . "','" . $entrega_fecha . "','" . $precu_id . "','" . $per_activo . "','" . $tabla . "','" . $moviinb_redpublica . "');";

            $rs_entrega = $DB_gogess->executec($inserta_movimiento, array());

            $moviin_iddes = $DB_gogess->funciones_nuevoID(0);


            $busca_medi = "select * from dns_cuadrobasicomedicamentos where cuadrobm_id='" . $cuadrobm_id . "'";
            $rs_medi = $DB_gogess->executec($busca_medi, array());
            $categ_id = $rs_medi->fields["categ_id"];

            if ($categ_id == 1 or $categ_id == 2) {
              $detapre_tipo = $categ_id;
              $detapre_tipofarmacia = $categ_id;
            } else {
              $detapre_tipo = 2;
              $detapre_tipofarmacia = $categ_id;
            }

            $mnupan_id = 0;
            $detapre_codigop = $rs_medi->fields["cuadrobm_codigoatc"];
            $detapre_detalle = $rs_medi->fields["cuadrobm_nombrecomercial"];
            $detapre_cantidad = $cantidad_valor;
            $detapre_precio = $moviin_preciocompra;
            if ($fecha_desc) {
              $detapre_fecharegistro = $fecha_desc . " " . date("H:i:s");
            } else {
              $detapre_fecharegistro = date("Y-m-d H:i:s");
            }

            $usua_id = $_SESSION['ces1313777_sessid_inicio'];
            //$centro_id=$_SESSION['ces1313777_centro_id'];
            $detapre_codigoform = 0;
            $detapre_idgrid = 0;
            $table = '';
            $detapre_origen = $narea_v;

            $busca_cliente = "select * from app_cliente where clie_id='" . $clie_id . "'";
            $rs_bcliente = $DB_gogess->executec($busca_cliente, array());
            $conve_id = $rs_bcliente->fields["conve_id"];

            $pvp_enformula = 0;
            //$pvp_enformula=$objFormulascontable->formulas_pvp($conve_id,$detapre_precio,$DB_gogess);

            $perioc_id = 0;
            $busca_formulax1 = "select * from lpin_periodocontable where perioc_activo=1";
            $rs_formulax1 = $DB_gogess->executec($busca_formulax1);
            $perioc_id = $rs_formulax1->fields["perioc_id"];

            if ($code_redp == 1) {


              $precios_valores = array();
              $precios_valores = $objBodega->busca_precioproductoredp($cuadrobm_id, $DB_gogess);

              $detapre_precio = $precios_valores["pcosto"];
              $detapre_precioventa = $precios_valores["pvp"];


              if ($precios_valores["ptecho"] > 0) {
                $detapre_precioventa = $precios_valores["ptecho"];
              }
            } else {
              //normal
              $precios_valores = array();
              $precios_valores = $objBodega->busca_precioproducto($cuadrobm_id, $DB_gogess);

              if ($conve_id == 7) {
                $detapre_precio = $precios_valores["pcosto"];
                $detapre_precioventa = $precios_valores["pisspol"];
              } else {
                /*if ($especipr_id == '27') {
                  $detapre_precio = $precios_valores["pcosto"];
                  $detapre_precioventa = $precios_valores["plasticos"];
                } else {
                  $detapre_precio = $precios_valores["pcosto"];
                  $detapre_precioventa = $precios_valores["pvp"];
                }*/

                switch ($especipr_id) {
                  case 27: {
                      $detapre_precio = $precios_valores["pcosto"];
                      $detapre_precioventa = $precios_valores["plasticos"];
                    }
                    break;
                  case 32: {
                      $detapre_precio = $precios_valores["pcosto"];
                      $detapre_precioventa = $precios_valores["otorr"];
                    }
                    break;
                  default: {
                      $detapre_precio = $precios_valores["pcosto"];
                      $detapre_precioventa = $precios_valores["pvp"];
                    }
                }
              }
              //normal

            }


            if ($detapre_precio == 0) {

              //normal
              $precios_valores = array();
              $precios_valores = $objBodega->busca_precioproducto($cuadrobm_id, $DB_gogess);

              if ($conve_id == 7) {
                $detapre_precio = $precios_valores["pcosto"];
                $detapre_precioventa = $precios_valores["pisspol"];
              } else {
                /*if($especipr_id=='27')
  {
    $detapre_precio=$precios_valores["pcosto"];
    $detapre_precioventa=$precios_valores["plasticos"];
  }
  else
  {
    $detapre_precio=$precios_valores["pcosto"];
    $detapre_precioventa=$precios_valores["pvp"];
  }*/

                switch ($especipr_id) {
                  case 27: {
                      $detapre_precio = $precios_valores["pcosto"];
                      $detapre_precioventa = $precios_valores["plasticos"];
                    }
                    break;
                  case 32: {
                      $detapre_precio = $precios_valores["pcosto"];
                      $detapre_precioventa = $precios_valores["otorr"];
                    }
                    break;
                  default: {
                      $detapre_precio = $precios_valores["pcosto"];
                      $detapre_precioventa = $precios_valores["pvp"];
                    }
                }
              }
              //normal

            }

            $inserta_datadis = "INSERT INTO dns_detalleprecuenta (precu_id, clie_id, mnupan_id, detapre_tipo, detapre_codigop, detapre_detalle, detapre_cantidad, detapre_precio, detapre_fecharegistro, usua_id, centro_id, atenc_id, detapre_codigoform,detapre_idgrid,detapre_table,centrob_id,detapre_origen,moviin_id,cuadrobm_id,conve_id,detapre_precioventa,perioc_id,detapre_tipofarmacia,detapre_redpublica,detapreoper_id,areap_id) VALUES ('" . $precu_id . "','" . $clie_id . "','" . $mnupan_id . "','" . $detapre_tipo . "','" . $detapre_codigop . "','" . $detapre_detalle . "','" . $detapre_cantidad . "','" . $detapre_precio . "','" . $detapre_fecharegistro . "','" . $usua_id . "','" . $centro_id . "','" . $atenc_id . "','" . $detapre_codigoform . "','" . $detapre_idgrid . "','" . $table . "','" . $centrob_id . "','" . $detapre_origen . "','" . $moviin_iddes . "','" . $cuadrobm_id . "','" . $conve_id . "','" . $detapre_precioventa . "','" . $perioc_id . "','" . $detapre_tipofarmacia . "','" . $code_redp . "','" . $detapreoper_id . "','" . $area_id . "');";

            $rs_detapre = $DB_gogess->executec($inserta_datadis, array());
            $id_gen_detapre_id = $DB_gogess->funciones_nuevoID(0);
            //genera asiento
            genera_asientodescargo($precu_id, $id_gen_detapre_id, $DB_gogess);
            //genera asiento
          }
          //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

        }
      }
    }

    //===================================================================================		   


    $rs_lprecuentas->MoveNext();
  }
}

//echo $centrob_id."<br>";
//echo $precu_id;

//$actualiza_po="update dns_precuenta set precu_activo=2 where precu_id='".$precu_id."'";
//$rs_acpo= $DB_gogess->executec($actualiza_po,array());

$actualiza_pox = "update dns_precuenta set asg_pedido='" . $precu_id . "' where precu_id='" . $precu_id . "'";
$rs_acpox = $DB_gogess->executec($actualiza_pox, array());
