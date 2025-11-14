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

  $busca_ventas = "select * from beko_documentocabecera_vista where (doccab_ndocumento like '%" . $busca_venta . "%' or doccab_rucci_cliente like '%" . $busca_venta . "%' or doccab_nombrerazon_cliente like '%" . $busca_venta . "%') and  ( saldo>0 and doccab_id not in (select doccabcp_id from lpin_masivocobropagodetalle where doccabcp_id!='' and crb_enlace='" . $crb_enlace . "')) and tipocmp_codigo='01' order by doccab_fechaemision_cliente asc";

  $rs_listadiariox = $DB_gogess->executec($busca_ventas, array());
  if ($rs_listadiariox) {
?>
    <div>
      <strong>Total a cobrar:</strong> <span id="total">0.00</span>
    </div>
	<input type="checkbox" id="seleccionar_todos"> Seleccionar Todos<br>
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
            <div align="center"><strong>FECHA</strong></div>
          </td>
          <td bgcolor="#D1EAF1">
            <div align="center"><strong>No. DOCUMENTO </strong></div>
          </td>

          <td bgcolor="#D1EAF1">
            <div align="center"><strong>DESCRIPCION</strong></div>
          </td>


          <td bgcolor="#D1EAF1">
            <div align="center"><strong>TIPO</strong></div>
          </td>
          <td bgcolor="#D1EAF1">
            <div align="center"><strong>CI/RUC</strong></div>
          </td>
          <td bgcolor="#D1EAF1">
            <div align="center"><strong>PROVEEDOR</strong></div>
          </td>
          <td bgcolor="#D1EAF1">
            <div align="center"><strong>SALDO</strong></div>
          </td>
          <td bgcolor="#D1EAF1">
            <div align="center"><strong>COBRAR</strong></div>
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
              <input name="check_asig[]" type="checkbox" id="check_asig" value="<?php echo  $rs_listadiariox->fields["doccab_id"]; ?>">
            </td>
            <td nowrap><?php echo str_replace(" 00:00:00", "", $rs_listadiariox->fields["doccab_fechaemision_cliente"]); ?></td>
            <td nowrap><?php echo $rs_listadiariox->fields["doccab_ndocumento"]; ?></td>

            <td>
              <div align="center">
			  <?php  echo $rs_listadiariox->fields["doccab_adicional"]; ?>
                <input name="valor_obs_<?php echo $rs_listadiariox->fields["doccab_id"]; ?>" type="hidden" id="valor_obs_<?php echo $rs_listadiariox->fields["doccab_id"]; ?>" value="" size="12">
              </div>
            </td>



            <td><?php echo $rs_listadiariox->fields["tipocmp_nombre"]; ?></td>
            <td><?php echo $rs_listadiariox->fields["doccab_rucci_cliente"]; ?></td>
            <td><?php echo $rs_listadiariox->fields["doccab_nombrerazon_cliente"]; ?></td>
            <td><?php echo $rs_listadiariox->fields["saldo"]; ?></td>
            <td>
              <div align="center">
                <input name="valor_data_<?php echo $rs_listadiariox->fields["doccab_id"]; ?>" type="text" id="valor_data_<?php echo $rs_listadiariox->fields["doccab_id"]; ?>" value="<?php echo $rs_listadiariox->fields["saldo"]; ?>" size="10">
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

        $("#div_procesaentrega").load("templateformsweb/maestro_standar_macobropagopl/listasvc/asig_ventas.php", {
          datos_data: $('#concatenado_valor').val(),
          crb_id: '<?php echo $crb_id; ?>',
          usua_id: '<?php echo $usua_id; ?>'
        }, function(result) {

          grid_extras_11916('<?php echo $crb_enlace; ?>', 0, 0);

        });
        $("#div_procesaentrega").html("Espere un momento...");
      }

      //  End 
      -->
    </script>

    <script>
      $(document).ready(function() {
        // Escuchar cambios en los checkboxes
        $('input[name="check_asig[]"]').change(function() {
          let total = 0;

          // Iterar sobre los checkboxes seleccionados
          $('input[name="check_asig[]"]:checked').each(function() {
            // Obtener el valor del campo asociado
            let id = $(this).val(); // El valor del checkbox es único para asociar
            let campoValor = $(`#valor_data_${id}`).val(); // Buscar el campo correspondiente

            // Sumar el valor si es un número válido
            if (!isNaN(campoValor)) {
              total += parseFloat(campoValor);
            }
          });

          // Mostrar el total en un elemento (crea un div con id="total" para mostrarlo)
          $('#total').text(total.toFixed(2)); // Formatear con 2 decimales
        });
      });
    </script>
	
	<script>

$(document).ready(function () {
    // Función para calcular el total
    function calcularTotal() {
        let total = 0;
        $('input[name="check_asig[]"]:checked').each(function () {
            let id = $(this).val();
            let valor = parseFloat($('#valor_data_' + id).val()) || 0;
            total += valor;
        });
        $('#total').text(total.toFixed(2));
    }

    // Evento para seleccionar/deseleccionar todos los checkboxes
    $('#seleccionar_todos').change(function () {
        let isChecked = $(this).prop('checked');
        $('input[name="check_asig[]"]').prop('checked', isChecked);
        calcularTotal();
    });

    // Evento para calcular total cuando se seleccionan individualmente
    $('input[name="check_asig[]"]').change(function () {
        calcularTotal();
    });

    // Evento para recalcular total si se cambian los valores en los inputs de valor_data
    $('input[id^="valor_data_"]').on('input', function () {
        calcularTotal();
    });
});

</script>





<?php
  }
}

?>