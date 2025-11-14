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

if (@$_SESSION['ces1313777_sessid_inicio']) {
  $crb_id = $_POST["crb_id"];
  $busca_venta = $_POST["busca_venta"];
  $usua_id = @$_SESSION['ces1313777_sessid_inicio'];

  $bsuca_data = "select * from lpin_masivocobropago where crb_id='" . $crb_id . "'";
  $rs_budata = $DB_gogess->executec($bsuca_data, array());
  $crb_enlace = $rs_budata->fields["crb_enlace"];

  $busca_ventas = "select * from app_proveedor where provee_borradologico=0 and (provee_nombre like '%" . $busca_venta . "%' or provee_cedula like '%" . $busca_venta . "%' or provee_ruc like '%" . $busca_venta . "%') order by provee_nombre asc";

  $rs_listadiariox = $DB_gogess->executec($busca_ventas, array());
  if ($rs_listadiariox) {
?>
    <div id="div_procesaentrega">
      <table width="100%" border="1" cellspacing="0" cellpadding="0">
        <tr>
          <td bgcolor="#D1EAF1">
            <div align="center"><strong>No.</strong></div>
          </td>
          <td bgcolor="#D1EAF1">
            <div align="center"><strong>SELEC</strong></div>
          </td>
          <td bgcolor="#D1EAF1">
            <div align="center"><strong>NOMBRE</strong></div>
          </td>
          <td bgcolor="#D1EAF1">
            <div align="center"><strong>RUC</strong></div>
          </td>
          <td bgcolor="#D1EAF1">
            <div align="center"><strong>CEDULA</strong></div>
          </td>
          <td bgcolor="#D1EAF1">
            <div align="center"><strong>COBRAR</strong></div>
          </td>
          <td bgcolor="#D1EAF1">
            <div align="center"><strong>DESCRIPCION</strong></div>
          </td>
        </tr>
        <?php
        $contadorval = 0;
        while (!$rs_listadiariox->EOF) {

          $contadorval++;
        ?>
          <tr>
            <td nowrap><?php echo $contadorval; ?></td>
            <td>
              <input name="check_asig[]" type="checkbox" id="check_asig" value="<?php echo  $rs_listadiariox->fields["provee_id"]; ?>">
            </td>
            <td nowrap><?php echo $rs_listadiariox->fields["provee_nombre"]; ?></td>
            <td nowrap><?php echo $rs_listadiariox->fields["provee_ruc"]; ?></td>
            <td><?php echo $rs_listadiariox->fields["provee_cedula"]; ?></td>
            <td>
              <div align="center">
                <input name="valor_data_<?php echo $rs_listadiariox->fields["provee_id"]; ?>" type="text" id="valor_data_<?php echo $rs_listadiariox->fields["provee_id"]; ?>" value="" size="10">
              </div>
            </td>

            <td>
              <div align="center">
                <input name="valor_obs_<?php echo $rs_listadiariox->fields["provee_id"]; ?>" type="text" id="valor_obs_<?php echo $rs_listadiariox->fields["provee_id"]; ?>" value="" size="20">
              </div>
            </td>

          </tr>
        <?php
          $rs_listadiariox->MoveNext();
        }
        ?>

      </table>
      <br><br>
      <center>
        <input name="concatenado_valor" type="hidden" id="concatenado_valor">
        <div id="enviar_data">
          <input type="button" name="Submit" value="AGREGAR A LISTADO PARA PROCESAR" onClick="seleccionado_valores()">
        </div>
      </center>

    </div>

    <script type="text/javascript">
      <!--
      function seleccionado_valores() {
        var listaCompras = '';
        var actual_valor;
        var ingreso_valor
        var entregar;

        var t_aentregar;
        var total_selecio;

        t_aentregar = 0;
        total_selecio = 0;

        $('#enviar_data').hide();

        let text;
        if (confirm("Esta seguro que desea agregar estos registros?") == true) {
          $('#enviar_data').hide();
        } else {
          $('#enviar_data').show();
          return false;
        }


        $("input[name='check_asig[]']").each(function(index) {
          if ($(this).is(':checked')) {

            texto = $('#valor_obs_' + $(this).val()).val();
            textoLimpio = texto.replace(/[,'']/g, " ");

            listaCompras += $(this).val() + '|' + $('#valor_data_' + $(this).val()).val() + '|' + textoLimpio + ',';

            //listaCompras += $(this).val() + '|' + $('#valor_data_' + $(this).val()).val() + ',';


          }
        });

        $('#concatenado_valor').val(listaCompras);

        if ($('#concatenado_valor').val() == '') {
          alert("Seleccione Una opcion");
          $('#enviar_data').show();
        } else {
          enviar_registros();
        }
      }



      function enviar_registros() {


        if ($('#detanticm_id').val() == '') {
          alert("Ingrese Detalle tipo anticipo");
          $('#enviar_data').show();
          return false;
        }

        if ($('#cuenta').val() == '') {
          alert("Ingrese la cuenta porfavor");
          $('#enviar_data').show();
          return false;

        }

        $("#div_procesaentrega").load("templateformsweb/maestro_standar_macobropagopl/listasvccc/asig_ventas.php", {
          datos_data: $('#concatenado_valor').val(),
          crb_id: '<?php echo $crb_id; ?>',
          usua_id: '<?php echo $usua_id; ?>',
          cuenta: $('#cuenta').val(),
          detanticm_id: $('#detanticm_id').val()
        }, function(result) {

          grid_extras_11916('<?php echo $crb_enlace; ?>', 0, 0);

        });
        $("#div_procesaentrega").html("Espere un momento...");
      }

      //  End 
      -->
    </script>

<?php
  }
}

?>