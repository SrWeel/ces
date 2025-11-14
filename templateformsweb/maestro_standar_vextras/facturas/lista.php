<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors', 0);
error_reporting(E_ALL);
$tiempossss = 4444450000;
ini_set("session.cookie_lifetime", $tiempossss);
ini_set("session.gc_maxlifetime", $tiempossss);
session_start();
$director = '../../../';
include("../../../cfg/clases.php");
include("../../../cfg/declaracion.php");
$objformulario = new  ValidacionesFormulario();

if ($_SESSION['ces1313777_sessid_inicio']) {

  $usua_id = $_POST["usua_id"];
  $asigextr_fechaaprobacion = $_POST["asigextr_fechaaprobacion"];
  $asigextr_id = $_POST["asigextr_id"];

  $mesfecha = array();
  $mesfecha = explode("-", $asigextr_fechaaprobacion);

  $datosusuario = "select * from app_usuario where usua_id='" . $usua_id . "'";
  $rs_usuario = $DB_gogess->executec($datosusuario, array());
  $usua_ciruc = $rs_usuario->fields["usua_ciruc"];

  $sacamosidcliente = "select provee_id from app_proveedor where provee_ruc like '" . $usua_ciruc . "%' or provee_cedula like '" . $usua_ciruc . "%'";

?>
  <table width="100%" border="1" cellspacing="0" cellpadding="0">
    <tr>
      <td bgcolor="#D6EBEF">PAGAR</td>
      <td bgcolor="#D6EBEF">FACTURA</td>
      <td bgcolor="#D6EBEF">FECHA</td>
      <td bgcolor="#D6EBEF">VALOR FACTURA</td>
      <td bgcolor="#D6EBEF">VALOR PAGA</td>

    </tr>

    <?php
    $sumatotal = 0;
    $suma_pagado = 0;
    $lista_facturas = "select * from beko_documentocabecera where tippo_id=1 and proveeve_id in (" . $sacamosidcliente . ") and month(doccab_fechaemision_cliente)='" . $mesfecha[1] . "'";
    $rs_listfac = $DB_gogess->executec($lista_facturas, array());
    if ($rs_listfac) {
      while (!$rs_listfac->EOF) {



        $busca_pagado = "select * from beko_documentocabecera_vista where doccab_id='" . $rs_listfac->fields["doccab_id"] . "'";
        $rs_pagado = $DB_gogess->executec($busca_pagado, array());
        $saldo = $rs_pagado->fields["saldo"];
        //if ($saldo > 0) {

        $doccab_idvalor = $rs_listfac->fields["doccab_id"];

        //busca detalle de pago
        $lista_pago = "select * from lpin_pagosfacturas where asigextr_id='" . $asigextr_id . "' and 	doccab_id='" . $doccab_idvalor . "'";
        $rs_lpago = $DB_gogess->executec($lista_pago, array());

        $valor_data = 0;
        if ($rs_lpago->fields["pgofac_id"] > 0) {
          $valor_data = $rs_lpago->fields["pgofac_valor"];
          $idnuevo = $rs_lpago->fields["pgofac_id"];
          $pgofac_saldo = $rs_lpago->fields["pgofac_saldo"];
        } else {

          $valor_data = 0;
          $doccab_id = $doccab_idvalor;
          $pgofac_valor  = 0;
          $usua_id = $_SESSION['ces1313777_sessid_inicio'];
          $pgofac_fecharegistro = date("Y-m-d H:i:s");
          $pgofac_saldo = $rs_listfac->fields["doccab_total"];

          $inserta_lista = "insert into lpin_pagosfacturas (asigextr_id,doccab_id,pgofac_valor,usua_id,pgofac_fecharegistro,pgofac_saldo) values ('" . $asigextr_id . "','" . $doccab_id . "','" . $pgofac_valor . "','" . $usua_id . "','" . $pgofac_fecharegistro . "','" . $pgofac_saldo . "')";
          $rs_okinsert = $DB_gogess->executec($inserta_lista, array());
          $idnuevo = 0;
          $idnuevo = $DB_gogess->funciones_nuevoID(0);
        }
        //busca detalle de pago
    ?>
        <tr>
          <td nowrap><input type="button" value="Pagar" onclick="envia_valorpaga('<?php echo $rs_listfac->fields["doccab_id"]; ?>','<?php echo $idnuevo; ?>');" /></td>
          <td nowrap><?php echo $rs_listfac->fields["doccab_ndocumento"]; ?></td>
          <td nowrap><?php echo $rs_listfac->fields["doccab_fechaemision_cliente"]; ?></td>
          <td nowrap>
            <div id="sal_ac_<?php echo $rs_listfac->fields["doccab_id"]; ?>"><?php echo $pgofac_saldo; ?></div>
          </td>
          <?php
          $link_valor = " guardar_camposgridp('lpin_pagosfacturas', 'pgofac_valor', '" . $idnuevo . "',$('#valor_" . $rs_listfac->fields["doccab_id"] . "').val(), 'pgofac_id') ";
          ?>

          <td nowrap><input type="text" id="valor_<?php echo $rs_listfac->fields["doccab_id"]; ?>" name="valor_<?php echo $rs_listfac->fields["doccab_id"]; ?>" value="<?php echo $valor_data; ?>" size="7" onChange="<?php echo $link_valor; ?>"></td>



        </tr>
    <?php

        $sumatotal = $sumatotal + $rs_listfac->fields["doccab_total"];
        $suma_pagado = $suma_pagado + $valor_data;
        // }

        $rs_listfac->MoveNext();
      }
    }
    ?>
    <tr>
      <td nowrap>&nbsp;</td>
      <td nowrap>&nbsp;</td>
      <td nowrap>&nbsp;</td>
      <td nowrap><?php echo $sumatotal; ?></td>
      <td nowrap>
        <div id="gtotalpago"><?php echo $suma_pagado; ?></div><input type="hidden" id="gpago" name="gpago" value="<?php echo $suma_pagado; ?>">
      </td>
    </tr>
  </table>
  <div id="campog_valorprocesot"> </div>

<?php

}
?>
<input name="valor_mes" type="hidden" id="valor_mes" value="<?php echo $sumatotal ?>">
<input type="button" name="Submit" value="Enviar Valor" onClick="envia_valor();">



<script type="text/javascript">
  <!--
  function envia_valorpaga(doccab_id, idn) {
    $('#valor_' + doccab_id).val($('#sal_ac_' + doccab_id).html());

    guardar_camposgridp('lpin_pagosfacturas', 'pgofac_valor', idn, $('#valor_' + doccab_id).val(), 'pgofac_id');

  }

  function guardar_camposgridp(tabla, campo, id, valor, campoidtabla) {

    $("#campog_valorprocesot").load("templateformsweb/maestro_standar_vextras/facturas/guarda_camposgrid.php", {

      tabla: tabla,
      campo: campo,
      id: id,
      valor: valor,
      campoidtabla: campoidtabla,
      asigextr_id: $('#asigextr_id').val(),
      asigextr_cuentadebe: $('#asigextr_cuentadebe').val()

    }, function(result) {

      actualiza_retenciones();
    });

    $("#campog_valorprocesot").html("Espere un momento...");

  }

  //  End 
  -->
</script>