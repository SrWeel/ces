<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors', 0);
error_reporting(E_ALL);
$tiempossss = 4445000;
ini_set("session.cookie_lifetime", $tiempossss);
ini_set("session.gc_maxlifetime", $tiempossss);
session_start();

if (!@$_SESSION['ces1313777_sessid_inicio']) {
    exit("Acceso no autorizado");
}

$director = '../../../../../';
include($director . "cfg/clases.php");
include($director . "cfg/declaracion.php");
include($director . "libreria/estructura/aqualis_master.php");

$obj_util = new util_funciones();
$objformulario = new ValidacionesFormulario();

// ============ DETECTAR MODO: EDITAR o CREAR ============
$modo = $_GET['modo'] ?? 'editar'; // 'editar' por defecto
$terap_id = $_POST["pVar1"] ?? $_GET['terap_id'] ?? null;
$clie_id = $_GET['clie_id'] ?? null;

// Si es modo crear, pero no hay paciente → error
if ($modo === 'crear' && !$clie_id) {
    die("Falta paciente para crear turno");
}

// ============ DATOS DEL PACIENTE ============
$paciente_data = '';
$clie_nombre = '';
$clie_apellido = '';

if ($clie_id) {
    $sql_pac = "SELECT clie_nombre, clie_apellido FROM app_cliente WHERE clie_id = ?";
    $rs_pac = $DB_gogess->executec($sql_pac, [$clie_id]);
    if ($rs_pac && $rs_pac->RecordCount() > 0) {
        $clie_nombre = $rs_pac->fields["clie_nombre"];
        $clie_apellido = $rs_pac->fields["clie_apellido"];
        $paciente_data = ucwords(strtolower(utf8_encode($clie_nombre . " " . $clie_apellido)));
    }
}

// ============ SI ES EDITAR: CARGAR DATOS EXISTENTES ============
$rs_buscat = null;
$terap_motivo = '';
$terap_observacion = '';
$terap_fecha = date('Y-m-d');
$terap_hora = '';
$terap_horaf = '';
$prof_id = '';
$usua_id = '';
$terap_recuperacion = '';

if ($modo === 'editar' && $terap_id) {
    $buscat = "SELECT * FROM faesa_terapiasregistro WHERE terap_id = ?";
    $rs_buscat = $DB_gogess->executec($buscat, [$terap_id]);

    if ($rs_buscat && $rs_buscat->RecordCount() > 0) {
        $terap_motivo = $rs_buscat->fields["terap_motivo"];
        $terap_observacion = $rs_buscat->fields["terap_observacion"];
        $terap_fecha = $rs_buscat->fields["terap_fecha"];
        $terap_hora = str_replace(':00', '', $rs_buscat->fields["terap_hora"]);
        $terap_horaf = str_replace(':00', '', $rs_buscat->fields["terap_horaf"]);
        $prof_id = $rs_buscat->fields["prof_id"];
        $usua_id = $rs_buscat->fields["usua_id"];
        $terap_recuperacion = $rs_buscat->fields["terap_recuperacion"];
        $clie_id = $rs_buscat->fields["clie_id"];

        // Recargar paciente
        $sql_pac = "SELECT clie_nombre, clie_apellido FROM app_cliente WHERE clie_id = ?";
        $rs_pac = $DB_gogess->executec($sql_pac, [$clie_id]);
        if ($rs_pac) {
            $paciente_data = ucwords(strtolower(utf8_encode($rs_pac->fields["clie_nombre"] . " " . $rs_pac->fields["clie_apellido"])));
        }
    } else {
        die("Turno no encontrado");
    }
} else {
    // MODO CREAR: observación obligatoria con TURNO EXTRA
    $terap_observacion = "TURNO EXTRA";
}

// ============ HORAS DISPONIBLES ============
$hora_ini = '07:00';
$hora_fin = '19:00';
$rango_hora = 30;
$arreglo_horas = $obj_util->genera_arrayhora($hora_ini, $rango_hora, $hora_fin);

// ============ FILTRO ESPECIALIDAD ============
$filtro_espe = " WHERE prof_id NOT IN (38,777,888,911116,77) ORDER BY prof_nombre ASC";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        .css_cambiot { font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; }
        .css_titulocambio { font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
        .obligatorio { color: red; }
    </style>
</head>
<body>

<div align="center">
    <p><strong><?= $modo === 'crear' ? 'CREAR NUEVO TURNO' : 'CAMBIO DE FECHA/HORA' ?></strong></p>
    <p><b><?= htmlspecialchars($paciente_data) ?></b></p>
</div>

<form id="form_turno">
    <input type="hidden" name="modo" value="<?= $modo ?>">
    <input type="hidden" name="terap_id" value="<?= $terap_id ?>">
    <input type="hidden" name="clie_id" value="<?= $clie_id ?>">

    <table border="0" align="center" cellpadding="0" cellspacing="2">
        <tr>
            <td class="css_titulocambio">Especialidad:</td>
            <td>
                <select name="prof_idcambio" id="prof_idcambio" class="form-control css_cambiot" onchange="ver_terapistacalcambio()" required>
                    <option value="">-seleccionar-</option>
                    <?php $objformulario->fill_cmb('cesdb_arextension.dns_profesion', 'prof_id,prof_nombre', $prof_id, $filtro_espe, $DB_gogess); ?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="css_titulocambio">Médico:</td>
            <td>
                <div id="lista_terapistacalcambio">
                    <select name="usua_idvalcambio" id="usua_idvalcambio" class="form-control css_cambiot" required>
                        <option value="">--Seleccionar Terapista--</option>
                        <?php if ($prof_id): ?>
                            <?php
                            $buespe = "SELECT usua_id FROM app_usuario us 
                         INNER JOIN dns_gridfuncionprofesional espe ON us.usua_enlace = espe.usua_enlace 
                         WHERE espe.prof_id = ? AND usua_agenda = 1 
                         ORDER BY usua_apellido ASC";
                            $rs_med = $DB_gogess->executec($buespe, [$prof_id]);
                            while (!$rs_med->EOF) {
                                $selected = ($rs_med->fields['usua_id'] == $usua_id) ? 'selected' : '';
                                $nombre = $objformulario->replace_cmb('app_usuario', 'usua_id,usua_nombre,usua_apellido', 'WHERE usua_id=', $rs_med->fields['usua_id'], $DB_gogess);
                                echo "<option value='{$rs_med->fields['usua_id']}' $selected>$nombre</option>";
                                $rs_med->MoveNext();
                            }
                            ?>
                        <?php endif; ?>
                    </select>
                </div>
            </td>
        </tr>
        <tr>
            <td class="css_titulocambio">Fecha:</td>
            <td><input type="text" name="terap_fechaxcambio" id="terap_fechaxcambio" class="css_cambiot" value="<?= $terap_fecha ?>" required></td>
        </tr>
        <tr>
            <td class="css_titulocambio">Hora Inicio:</td>
            <td>
                <select name="hora_tiempoxcambio" id="hora_tiempoxcambio" class="css_cambiot" required>
                    <option value="">-hora-</option>
                    <?php foreach ($arreglo_horas as $h): ?>
                        <option value="<?= $h ?>" <?= ($h == $terap_hora) ? 'selected' : '' ?>><?= $h ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>

        <tr>
            <td valign="top" class="css_titulocambio">
                Observaciones <span class="obligatorio">*</span>:
            </td>
            <td>
        <textarea name="terap_observacion" id="terap_observacion" rows="3" class="css_cambiot" required
                  <?= $modo === 'crear' ? 'readonly' : '' ?>><?= htmlspecialchars($terap_observacion) ?></textarea>
                <?php if ($modo === 'crear'): ?>
                    <small style="color: red;">* Obligatorio: TURNO EXTRA</small>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <button type="button" onclick="guarda_turno()"><?= $modo === 'crear' ? 'CREAR TURNO' : 'ACTUALIZAR' ?></button>
            </td>
        </tr>
    </table>
</form>

<div id="guarda_t"></div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script>
    $(function() {
        $("#terap_fechaxcambio").datepicker({
            dateFormat: 'yy-mm-dd',
            minDate: 0
        });
    });

    function ver_terapistacalcambio() {
        const prof_id = $('#prof_idcambio').val();
        $("#lista_terapistacalcambio").load("lista_terapistacambio.php", { prof_idtx: prof_id });
    }

    function guarda_turno() {
        const form = $('#form_turno').serialize();
        $("#guarda_t").html("Guardando...");

        $.post("guarda_cambio_extra.php", form, function(res) {
            $("#guarda_t").html(res);
            setTimeout(() => { parent.ver_diario?.(); }, 1000);
        }).fail(() => {
            $("#guarda_t").html("Error al guardar");
        });
    }
</script>

</body>
</html>