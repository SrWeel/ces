<?php
header('Content-Type: text/html; charset=UTF-8');
$tiempossss = 44450000;
ini_set("session.cookie_lifetime", $tiempossss);
ini_set("session.gc_maxlifetime", $tiempossss);
session_start();

/*echo $_POST["tabla"]."<br>";
echo $_POST["campo"]."<br>";
echo $_POST["id"]."<br>";
echo $_POST["valor"]."<br>";*/

if ($_SESSION['ces1313777_sessid_inicio']) {
  $director = '../../../';
  include("../../../cfg/clases.php");
  include("../../../cfg/declaracion.php");
  include(@$director . "libreria/estructura/aqualis_master.php");
  $sqltotal = "";

  $asigextr_id = $_POST["asigextr_id"];
  $asigextr_cuentadebe = $_POST["asigextr_cuentadebe"];

  for ($itbl = 0; $itbl < count($lista_tbldata); $itbl++) {
    include(@$director . "libreria/estructura/" . $lista_tbldata[$itbl] . ".php");
  }

  $cuenta_lista = 0;
  $objformulario = new  ValidacionesFormulario();
  $objformulario->sisfield_arr = $gogess_sisfield;
  $objformulario->sistable_arr = $gogess_sistable;


  $actualiza_data = "update " . $_POST["tabla"] . " set " . $_POST["campo"] . "='" . $_POST["valor"] . "' where " . $_POST["campoidtabla"] . "='" . $_POST["id"] . "'";
  $okvalor = $DB_gogess->executec($actualiza_data);

  $lista_pago = "select sum(pgofac_valor) as totalp from lpin_pagosfacturas where asigextr_id='" . $asigextr_id . "'";
  $rs_lpago = $DB_gogess->executec($lista_pago, array());
  $totalp = $rs_lpago->fields["totalp"];

  $comcont_enlace = strtoupper(uniqid() . date("YmdHis"));

  //genera asiento
  $bu_data = "select * from lpin_pagosfacturas where asigextr_id='" . $asigextr_id . "'";
  $rs_udata = $DB_gogess->executec($bu_data, array());

  $doccab_id = $rs_udata->fields["doccab_id"];

  $busca_factu = "select * from beko_documentocabecera where doccab_id='" . $doccab_id . "'";
  $rs_bufact = $DB_gogess->executec($busca_factu, array());

  $doccab_ndocumento = $rs_bufact->fields["doccab_ndocumento"];

  $array_haber[$cuenta_lista]["TIPO"] = "DEBE";
  $array_haber[$cuenta_lista]["CUENTA"] = $asigextr_cuentadebe;
  $array_haber[$cuenta_lista]["VALOR"] = $_POST["valor"];
  $cuenta_lista++;

  $array_haber[$cuenta_lista]["TIPO"] = "HABER";
  $array_haber[$cuenta_lista]["CUENTA"] = '1.1.2.5.1';
  $array_haber[$cuenta_lista]["VALOR"] = $_POST["valor"];
  $cuenta_lista++;

  //===========================================================

  print_r($array_haber);
  // Array de datos proporcionado
  $transacciones = $array_haber;
  // Array para almacenar los resultados agrupados
  $resultadoAgrupado = [];
  // Iterar sobre cada transaccion
  foreach ($transacciones as $transaccion) {
    $tipo = $transaccion['TIPO'];
    $cuenta = $transaccion['CUENTA'];
    $valor = $transaccion['VALOR'];
    // Generar una clave unica combinando TIPO y CUENTA
    $clave = $tipo . '_' . $cuenta;
    // Verificar si ya existe la clave en el array resultadoAgrupado
    if (!isset($resultadoAgrupado[$clave])) {
      $resultadoAgrupado[$clave] = [
        'TIPO' => $tipo,
        'CUENTA' => $cuenta,
        'VALOR' => 0
      ];
    }
    // Sumar el valor al grupo correspondiente
    $resultadoAgrupado[$clave]['VALOR'] += $valor;
  }
  // Convertir el array resultadoAgrupado a un array indexado simple
  $resultadoFinal = array_values($resultadoAgrupado);
  // Imprimir el resultado final
  $array_haber = $resultadoFinal;
  $tabla_asiento = 'conco_asignaextras';
  $valor_id =  $asigextr_id;
  $tipo_code = 13;

  $comcont_tablas = 'beko_documentocabecera';
  $comcont_idtablas = $doccab_id;

  //crea asiento
  //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
  //

  $busca_cabeceraasiento = "select * from lpin_comprobantecontable where comcont_tabla='" . $tabla_asiento . "' and comcont_idtabla='" . $valor_id . "' and comcont_rol=0";
  $rs_bcabecera = $DB_gogess->executec($busca_cabeceraasiento);

  if ($rs_bcabecera->fields["comcont_id"] > 0) {

    //actualiza comprobante

    //++++++++++++++++++++++++++
    //concepto factura

    $busca_principalx = "select *,year(asigextr_fechasolicitud) as anio from conco_asignaextras where asigextr_id='" . $asigextr_id . "'";
    $rs_bprincipalx = $DB_gogess->executec($busca_principalx);

    $asigextr_nombre = $rs_bprincipalx->fields["asigextr_nombre"];
    $asigextr_fechasolicitud = $rs_bprincipalx->fields["asigextr_fechasolicitud"];

    $genr_anio = $rs_bprincipalx->fields["anio"];
    $genr_fechacierre = $rs_bprincipalx->fields["asigextr_fechasolicitud"];
    $crb_fecha = $genr_fechacierre;

    $doccab_anulado = 0;
    $concepto = '';
    $concepto = $n_tipo . ' CONSUMO FARMACIA FAC-' . $doccab_ndocumento . ' ' . $genr_anio . '-' . $asigextr_fechasolicitud . ' ' . $asigextr_nombre . ' CODE:' . $asigextr_id;
    //$concepto=$concepto;
    //concepto factura
    //++++++++++++++++++++++++++
    //preguntar se anula la factura se anula pago
    $actualiza_data = "update lpin_comprobantecontable set tipoa_id='" . $tipo_code . "',comcont_anulado='" . $doccab_anulado . "',comcont_fecha='" . $genr_fechacierre . "',comcont_concepto='" . $concepto . "',comcont_numeroc='" . $asigextr_id . "' where comcont_id='" . $rs_bcabecera->fields["comcont_id"] . "'";
    $rs_actualizdada = $DB_gogess->executec($actualiza_data);

    //actualiza comprobante
    //===========================================================================

    $comcont_enlace = $rs_bcabecera->fields["comcont_enlace"];

    $borra_dt = "delete from lpin_detallecomprobantecontable where comcont_enlace='" . $comcont_enlace . "'";
    $rs_oktd = $DB_gogess->executec($borra_dt);

    for ($i = 0; $i < count($array_haber); $i++) {

      $detcc_debe = 0;
      $detcc_haber = 0;

      if ($array_haber[$i]["TIPO"] == 'DEBE') {
        $detcc_debe = $array_haber[$i]["VALOR"];
      }

      if ($array_haber[$i]["TIPO"] == 'HABER') {
        $detcc_haber = $array_haber[$i]["VALOR"];
      }

      $detcc_cuentacontable = '';
      $detcc_cuentacontable = $array_haber[$i]["CUENTA"];

      //BUSCA CUENTA

      $busca_dtacuenta = "select * from lpin_plancuentas where planc_codigoc='" . $detcc_cuentacontable . "'";
      $rs_bcuenta = $DB_gogess->executec($busca_dtacuenta);

      $detcc_descricpion = $rs_bcuenta->fields["planc_nombre"];
      $detcc_referencia = $rs_bcuenta->fields["planc_nombre"];

      $comcont_enlace = $rs_bcabecera->fields["comcont_enlace"];

      //BUSCA CUENTA

      $lista_data = "INSERT INTO lpin_detallecomprobantecontable (detcc_id, detcc_cuentacontable, detcc_descricpion, detcc_referencia, detcc_entidad, detcc_debe, detcc_haber, usua_id, detcc_fecharegistro,comcont_enlace) VALUES (NULL, '" . $detcc_cuentacontable . "', '" . $detcc_descricpion . "', '" . $detcc_referencia . "', '','" . round($detcc_debe, 2) . "','" . round($detcc_haber, 2) . "','" . $_SESSION['ces1313777_sessid_inicio'] . "', '" . $crb_fecha . "','" . $comcont_enlace . "') ";
      $rs_ok = $DB_gogess->executec($lista_data);
    }




    //===========================================================================
  } else {
    //===========================================================================

    //++++++++++++++++++++++++++
    //concepto factura
    $busca_principalx = "select *,year(asigextr_fechasolicitud) as anio from conco_asignaextras where asigextr_id='" . $asigextr_id . "'";
    $rs_bprincipalx = $DB_gogess->executec($busca_principalx);

    $asigextr_nombre = $rs_bprincipalx->fields["asigextr_nombre"];
    $asigextr_fechasolicitud = $rs_bprincipalx->fields["asigextr_fechasolicitud"];
    $genr_anio = $rs_bprincipalx->fields["anio"];
    $genr_fechacierre = $rs_bprincipalx->fields["asigextr_fechasolicitud"];
    $crb_fecha = $genr_fechacierre;

    $doccab_anulado = 0;


    $concepto = '';
    $concepto = $n_tipo . ' CONSUMO FARMACIA FAC-' . $doccab_ndocumento . ' ' . $genr_anio . '-' . $asigextr_fechasolicitud . ' ' . $asigextr_nombre . ' CODE:' . $asigextr_id;

    //$concepto=utf8_encode($concepto);
    //concepto factura
    //++++++++++++++++++++++++++


    $fecha_hoy = '';
    $fecha_hoy = date("Y-m-d H:i:s");

    $comcont_rol = 0;

    $inserta_cab = "INSERT INTO lpin_comprobantecontable ( tipoa_id, comcont_fecha, comcont_concepto, comcont_numeroc, comcont_estado, comcont_diferencia, comcont_enlace, usua_id, comcont_fecharegistro, centro_id, comcont_tabla, comcont_idtabla,comcont_obs,comcont_anulado,comcont_rol,comcont_tablas,comcont_idtablas) VALUES
( '" . $tipo_code . "', '" . $crb_fecha . "', '" . $concepto . "', '" . $asigextr_id . "', 'APROBADO', 0, '" . $comcont_enlace . "', '" . $_SESSION['ces1313777_sessid_inicio'] . "', '" . $fecha_hoy . "','" . $_SESSION['ces1313777_centro_id'] . "', '" . $tabla_asiento . "', '" . $valor_id . "','AUTOMATICO','" . $doccab_anulado . "','" . $comcont_rol . "','" . $comcont_tablas . "','" . $comcont_idtablas . "');";

    $rs_insertcab = $DB_gogess->executec($inserta_cab);
    $id_gen = $DB_gogess->funciones_nuevoID(0);


    if ($rs_insertcab) {
      //-----------------------------------------

      for ($i = 0; $i < count($array_haber); $i++) {

        $detcc_debe = 0;
        $detcc_haber = 0;

        if ($array_haber[$i]["TIPO"] == 'DEBE') {
          $detcc_debe = $array_haber[$i]["VALOR"];
        }

        if ($array_haber[$i]["TIPO"] == 'HABER') {
          $detcc_haber = $array_haber[$i]["VALOR"];
        }

        $detcc_cuentacontable = '';
        $detcc_cuentacontable = $array_haber[$i]["CUENTA"];

        //BUSCA CUENTA

        $busca_dtacuenta = "select * from lpin_plancuentas where planc_codigoc='" . $detcc_cuentacontable . "'";
        $rs_bcuenta = $DB_gogess->executec($busca_dtacuenta);

        //echo $busca_dtacuenta."<br>";

        $detcc_descricpion = $rs_bcuenta->fields["planc_nombre"];
        $detcc_referencia = $rs_bcuenta->fields["planc_nombre"];

        //BUSCA CUENTA

        $lista_data = "INSERT INTO lpin_detallecomprobantecontable (detcc_id, detcc_cuentacontable, detcc_descricpion, detcc_referencia, detcc_entidad, detcc_debe, detcc_haber, usua_id, detcc_fecharegistro,comcont_enlace) VALUES (NULL, '" . $detcc_cuentacontable . "', '" . $detcc_descricpion . "', '" . $detcc_referencia . "', '','" . round($detcc_debe, 2) . "','" . round($detcc_haber, 2) . "','" . $_SESSION['ces1313777_sessid_inicio'] . "', '" . $crb_fecha . "','" . $comcont_enlace . "') ";

        //echo $lista_data."<br>";

        $rs_ok = $DB_gogess->executec($lista_data);
      }


      //-----------------------------------------			
    }

    //===========================================================================
  }
  //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
  //crea asiento	


  //===========================================================


  //genera asiento

}
?>

<script type="text/javascript">
  <!--
  $('#gtotalpago').html('<?php echo round($totalp, 2); ?>');
  $('#gpago').val('<?php echo round($totalp, 2); ?>');
  -->
</script>