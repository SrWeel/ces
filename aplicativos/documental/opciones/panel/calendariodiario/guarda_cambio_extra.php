<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors', 0);
error_reporting(E_ALL);
$tiempossss = 4445000;
ini_set("session.cookie_lifetime", $tiempossss);
ini_set("session.gc_maxlifetime", $tiempossss);
session_start();

if (!@$_SESSION['ces1313777_sessid_inicio']) {
    echo "Acceso no autorizado";
    exit;
}

$director = '../../../../../';
include($director . "cfg/clases.php");
include($director . "cfg/declaracion.php");

// ============ DETECTAR MODO: EDITAR o CREAR ============
$modo = $_POST["modo"] ?? 'editar'; // 'editar' o 'crear'
$terap_id = $_POST["terap_id"] ?? null;
$clie_id = $_POST["clie_id"] ?? null;

if ($modo === 'crear' && !$clie_id) {
    echo "Falta paciente para crear turno";
    exit;
}

// ============ VALIDAR CAMPOS OBLIGATORIOS ============
$required = ['prof_idcambio', 'usua_idvalcambio', 'terap_fechaxcambio', 'hora_tiempoxcambio'];
foreach ($required as $campo) {
    if (empty($_POST[$campo])) {
        echo "Falta campo obligatorio: $campo";
        exit;
    }
}

// ============ MODO CREAR: VALIDAR OBSERVACIÓN ============
$terap_observacion = trim($_POST["terap_observacion"] ?? '');
if ($modo === 'crear') {
    if ($terap_observacion !== 'TURNO EXTRA') {
        echo "Observación debe ser: TURNO EXTRA";
        exit;
    }
}


// ============ PREPARAR DATOS COMUNES ============
$datos = [
    'prof_id' => $_POST["prof_idcambio"],
    'especi_id' => $_POST["prof_idcambio"],
    'usua_id' => $_POST["usua_idvalcambio"],
    'terap_fecha' => $_POST["terap_fechaxcambio"],
    'terap_hora' => $_POST["hora_tiempoxcambio"] . ':00',
    'terap_observacion' => $terap_observacion,
    'clie_id' => $clie_id,
    'centro_id' => $_SESSION['ces1313777_centro_id'] ?? 1,
    'usuar_id' => $_SESSION['ces1313777_sessid_inicio'],
    'terap_fecharegistro' => date("Y-m-d H:i:s")
];

// ============ EJECUTAR ACCIÓN ============
if ($modo === 'editar' && $terap_id) {

        echo "Horario ya usado verifique por favor....";


} else {
    // === CREAR NUEVO TURNO ===
    $campos = implode(", ", array_keys($datos));
    $valores = implode(", ", array_fill(0, count($datos), "?"));
    $params = array_values($datos);

    $insert = "INSERT INTO faesa_terapiasregistro ($campos) VALUES ($valores)";
    $rs_insert = $DB_gogess->executec($insert, $params);

    if ($rs_insert) {
        echo "Turno creado correctamente";
    } else {
        echo "Error al crear turno. Verifique disponibilidad.";
    }
}
?>
<script type="text/javascript">
    <!--
    // === MENSAJE DE ÉXITO ===
    var mensaje = "<?php
        if ($modo === 'editar') {
            echo ($rs_act ? 'Actualizado' : 'Horario ya usado verifique por favor....');
        } else {
            echo ($rs_insert ? 'Turno creado correctamente' : 'Error al crear turno. Verifique disponibilidad.');
        }
        ?>";

    // Mostrar alerta
    alert(mensaje);

    // Solo cerrar y refrescar si fue exitoso
    <?php if (($modo === 'editar' && $rs_act) || ($modo === 'crear' && $rs_insert)): ?>
    setTimeout(function() {
        // Refrescar calendario del padre
        if (window.opener && typeof window.opener.ver_diario === 'function') {
            window.opener.ver_diario();
        }
        if (window.opener && typeof window.opener.ver_calendario_general === 'function') {
            window.opener.ver_calendario_general();
        }
        // Cerrar esta ventana
        window.close();
    }, 300);
    <?php else: ?>
    // Si hay error, no cerrar
    console.log("Error: No se cerró la ventana.");
    <?php endif; ?>
    // -->
</script>