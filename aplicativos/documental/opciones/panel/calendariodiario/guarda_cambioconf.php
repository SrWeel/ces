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

    $terap_motivo = '';
    $terap_motivo = $_POST["terap_motivo"];

    $actualiza = "update faesa_terapiasregistro set terap_confirmado='" . $_POST["terap_confirmado"] . "',terap_observacion='" . $_POST["terap_observacion"] . "',terap_observacionconfirmado='" . $_POST["terap_observacionconfirmado"] . "' where terap_id=" . $_POST["terap_id"];
    $rs_act = $DB_gogess->executec($actualiza, array());

    $buscat = "select * from faesa_terapiasregistro  where terap_id=" . $_POST["terap_id"];
    $rs_buscat = $DB_gogess->executec($buscat, array());

    if ($rs_buscat->fields["terap_confirmado"] == 1) {
        $estado_confirmado = "<span style='color: green;' ><b>CONFIRMADO</b></span>";
    } else {
        $estado_confirmado = "<span style='color: red;' ><b>SIN CONFIRMAR</b></span>";
    }


    if ($rs_act) {
        echo "Actualizado";
        echo '<script type="text/javascript">
<!--

$("#estado_conf' . $_POST["terap_id"] . '").html("' . $estado_confirmado . '");

//ver_calendario_general();
//ver_diario();


//  End -->
</script>';
    } else {
        echo "Horario ya usado verifique por favor....";
    }
}
