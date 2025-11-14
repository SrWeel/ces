<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors', 0);
error_reporting(E_ALL);
$tiempossss = 4445000;
ini_set("session.cookie_lifetime", $tiempossss);
ini_set("session.gc_maxlifetime", $tiempossss);
session_start();
if (@$_SESSION['ces1313777_sessid_inicio']) {

    $director = '../../../../../';
    include("../../../../../cfg/clases.php");
    include("../../../../../cfg/declaracion.php");

    $obj_util = new util_funciones();

    include(@$director . "libreria/estructura/aqualis_master.php");
    $objformulario = new  ValidacionesFormulario();

    $buscat = "select * from faesa_terapiasregistro  where terap_id=" . $_POST["pVar1"];
    $rs_buscat = $DB_gogess->executec($buscat, array());

    $terap_confirmado = $rs_buscat->fields["terap_confirmado"];

    $buscat2 = "select * from faesa_terapiasregistro inner join app_cliente on faesa_terapiasregistro.clie_id=app_cliente.clie_id where terap_id=" . $_POST["pVar1"];
    $rs_buscat2 = $DB_gogess->executec($buscat2, array());

    $nombre_dato = array();
    $nombre_dato = explode(" ", $rs_buscat2->fields["clie_nombre"]);
    $apellido_dato = array();
    $apellido_dato = explode(" ", $rs_buscat2->fields["clie_apellido"]);
    $paciente_data = ucwords(strtolower(utf8_encode($rs_buscat2->fields["clie_nombre"] . " " . $apellido_dato[0])));


?>
    <style type="text/css">
        <!--
        .css_cambiot {
            font-size: 11px;
            font-family: Verdana, Arial, Helvetica, sans-serif;
        }

        .css_titulocambio {
            font-size: 11px;
            font-family: Verdana, Arial, Helvetica, sans-serif;
            font-weight: bold;
        }
        -->
    </style>
    <div align="center">
        <p>Confirmaci&oacute;n Cita</p>
        <p><b><?php echo $paciente_data; ?></b> </p>
    </div>
    <table border="0" align="center" cellpadding="0" cellspacing="2">
        <tr>
            <td class="css_titulocambio">Especialidad:</td>
            <td>
                <?php
                echo $objformulario->replace_cmb("cesdb_arextension.dns_profesion", "prof_id,prof_nombre", " where prof_id =", $rs_buscat->fields["prof_id"], $DB_gogess);
                ?>

            </td>
        </tr>
        <tr>
            <td><span class="css_titulocambio">Medico</span>:</td>
            <td>
                <div id="lista_terapistacalcambio">

                    <?php
                    echo $objformulario->replace_cmb("app_usuario", "usua_id,usua_nombre,usua_apellido", " where usua_id =", $rs_buscat->fields["usua_id"], $DB_gogess);
                    ?>

                </div>
            </td>
        </tr>
        <tr>
            <td><span class="css_titulocambio">Fecha: </span></td>
            <td><?php echo $rs_buscat->fields["terap_fecha"]; ?> </td>
        </tr>
        <tr>
            <td><span class="css_titulocambio">Hora:</span></td>
            <td><span class="css_cambiot">
                    <?php echo $rs_buscat->fields["terap_hora"];
                    ?>
                </span></td>
        </tr>

        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2">
                <div align="center" class="css_titulocambio">CONFIRMACION</div>
                <br>
            </td>
        </tr>
        <tr>
            <td><span class="css_titulocambio">Confirmado:</span></td>
            <td><span class="css_cambiot"><select name="terap_confirmado" id="terap_confirmado" class="css_cambiot">
                        <option value="">-seleccionar-</option>
                        <?php
                        $objformulario->fill_cmb('gogess_sino', 'value,etiqueta', $rs_buscat->fields["terap_confirmado"], '', $DB_gogess);
                        ?>
                    </select></span></td>
        </tr>
        <tr>
            <td valign="top"><span class="css_titulocambio">Observaciones</span></td>
            <td><span class="css_cambiot"><textarea name="terap_observacionconfirmado" rows="4" cols="40" id="terap_observacionconfirmado"><?php echo $rs_buscat->fields["terap_observacionconfirmado"]; ?></textarea></span></td>
        </tr>
        <tr>
            <td colspan="2">
                <div align="center"><br><br>
                    <input type="button" name="Submit" value="Actualizar" onclick="guarda_cmbconfirmado('<?php echo $_POST["pVar1"]; ?>')" />
                </div>
                <div align="center"></div>
            </td>
        </tr>
    </table>


    <div id="guarda_tx"></div>
    <script type="text/javascript">
        <!--
        $("#terap_fechaxcambio").datepicker({
            dateFormat: 'yy-mm-dd'
        });
        //  End 
        -->
    </script>


    <script type="text/javascript">
        <!--
        function guarda_cmbconfirmado(terap_id) {

            if ($('#terap_observacionconfirmado').val() == '') {
                alert("Campo obligatorio observacion");
                return false;
            }

            $("#guarda_tx").load("guarda_cambioconf.php", {
                terap_id: terap_id,
                terap_confirmado: $('#terap_confirmado').val(),
                terap_observacionconfirmado: $('#terap_observacionconfirmado').val()

            }, function(result) {

                // ver_diario();

            });

            $("#guarda_tx").html("Espere un momento...");


        }

        function ver_terapistacalcambio() {

            $("#lista_terapistacalcambio").load("lista_terapistacambio.php", {
                prof_idtx: $('#prof_idcambio').val()
            }, function(result) {



            });

            $("#lista_terapistacalcambio").html("Espere un momento...");

        }
        //  End 
        -->
    </script>

<?php
}
?>