<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors', 0);
error_reporting(E_ALL);
$tiempossss = 4445000;
ini_set("session.cookie_lifetime", $tiempossss);
ini_set("session.gc_maxlifetime", $tiempossss);
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda Médica</title>
    <!-- Removed Tailwind CDN - using pure CSS instead -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            min-height: 100vh;
            color: #333;
        }

        .professional-scroll::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        .professional-scroll::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 4px;
        }

        .professional-scroll::-webkit-scrollbar-thumb {
            background: #94a3b8;
            border-radius: 4px;
        }

        .professional-scroll::-webkit-scrollbar-thumb:hover {
            background: #64748b;
        }

        .appointment-card {
            transition: all 0.3s ease;
        }

        .appointment-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .specialist-column {
            transition: all 0.3s ease;
        }

        .specialist-column.hidden-column {
            display: none !important;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #64748b;
        }

        .empty-state i {
            font-size: 64px;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 24px 16px;
        }

        .header-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            padding: 24px;
            margin-bottom: 24px;
        }

        .header-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .header-icon {
            background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%);
            padding: 12px;
            border-radius: 8px;
            color: white;
            font-size: 24px;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .header-text h1 {
            font-size: 24px;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 4px;
        }

        .header-text p {
            font-size: 14px;
            color: #6b7280;
        }

        .header-text .date-value {
            font-weight: 600;
            color: #EE82EE;
        }

        .filter-section {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .filter-label {
            font-size: 14px;
            font-weight: 500;
            color: #374151;
        }

        #filterSpecialty {
            padding: 8px 16px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
            background-color: white;
            color: #333;
            cursor: pointer;
            min-width: 250px;
            transition: all 0.2s;
        }

        #filterSpecialty:focus {
            outline: none;
            ring: 2px;
            ring-color: #3b82f6;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .schedule-table-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .table-scroll {
            overflow-x: auto;
            overflow-y: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: linear-gradient(90deg, #2563eb 0%, #1d4ed8 100%);
            position: sticky;
            top: 0;
            z-index: 10;
        }

        /*thead th {*/
        /*    padding: 16px;*/
        /*    text-align: left;*/
        /*    font-size: 14px;*/
        /*    font-weight: 600;*/
        /*    color: white;*/
        /*    border-left: 1px solid #1e40af;*/
        /*    min-width: 180px;*/
        /*    position: sticky;*/
        /*    background: linear-gradient(90deg, #2563eb 0%, #1d4ed8 100%);*/
        /*}*/

        /*thead th:first-child {*/
        /*    min-width: 100px;*/
        /*    position: sticky;*/
        /*    left: 0;*/
        /*    z-index: 20;*/
        /*    background: #1d4ed8;*/
        /*    border-left: none;*/
        /*}*/

        thead .specialist-header {
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
        }

        .specialist-name {
            display: flex;
            align-items: center;
            gap: 8px;
            justify-content: center;
        }

        .specialist-last-name {
            font-size: 12px;
            font-weight: normal;
        }

        .specialty-badges {
            display: flex;
            flex-wrap: wrap;
            gap: 4px;
            justify-content: center;
            margin-top: 4px;
        }

        .specialty-badge {
            font-size: 11px;
            background-color: #60a5fa;
            color: white;
            padding: 2px 8px;
            border-radius: 16px;
        }

        tbody {
            border-top: 1px solid #e5e7eb;
        }

        tbody tr {
            border-bottom: 1px solid #e5e7eb;
            transition: background-color 0.2s;
        }

        tbody tr:hover {
            background-color: #f9fafb;
        }

        tbody td {
            padding: 12px 16px;
            border-left: 1px solid #e5e7eb;
            font-size: 14px;
        }

        tbody td:first-child {
            position: sticky;
            left: 0;
            background: white;
            border-right: 1px solid #e5e7eb;
            font-weight: 600;
            color: #374151;
            z-index: 5;
        }

        tbody tr:hover td:first-child {
            background-color: #f9fafb;
        }

        .time-icon {
            color: #3b82f6;
            margin-right: 8px;
        }

        .card-space {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .appointment-item {
            border-radius: 8px;
            padding: 12px;
            background-color: #f3f4f6;
            border: 1px solid #d1d5db;
            transition: all 0.3s ease;
        }

        .appointment-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .appointment-item-gray {
            background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
            border: 1px solid #d1d5db;
        }

        .appointment-item-blue {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            border: 2px solid #93c5fd;
        }

        .appointment-controls {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 8px;
        }

        .btn-icon {
            background: none;
            border: none;
            padding: 6px;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.2s;
            font-size: 14px;
        }

        .btn-delete {
            color: #ef4444;
        }

        .btn-delete:hover {
            color: #b91c1c;
            background-color: #fee2e2;
        }

        .btn-reschedule {
            color: #3b82f6;
        }

        .btn-reschedule:hover {
            color: #1d4ed8;
            background-color: #dbeafe;
        }

        .patient-info {
            margin-top: 4px;
            font-size: 14px;
            font-weight: 600;
            color: #000;
        }

        .patient-note {
            font-size: 12px;
            font-style: italic;
            color: #0033cc;
            margin-top: 4px;
        }

        .patient-detail {
            font-size: 12px;
            font-weight: 500;
            color: #000;
            margin-top: 4px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .confirm-section {
            margin-top: 12px;
            padding-top: 12px;
            border-top: 1px solid #e5e7eb;
        }

        .btn-confirm {
            width: 100%;
            background: linear-gradient(90deg, #3b82f6 0%, #2563eb 100%);
            color: white;
            border: none;
            font-size: 12px;
            font-weight: 600;
            padding: 8px 12px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .btn-confirm:hover {
            background: linear-gradient(90deg, #2563eb 0%, #1d4ed8 100%);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        .status-badge {
            font-size: 11px;
            padding: 4px 8px;
            border-radius: 16px;
            font-weight: 600;
            display: inline-block;
            margin-top: 8px;
        }

        .status-unconfirmed {
            background-color: #fee2e2;
            color: #7f1d1d;
        }

        .status-confirmed {
            background-color: #dcfce7;
            color: #166534;
        }

        .special-record {
            background: linear-gradient(135deg, #e0e7ff 0%, #dbeafe 100%);
            border: 1px solid #818cf8;
            border-radius: 8px;
            padding: 12px;
            margin-bottom: 8px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .special-record:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .special-record-title {
            font-size: 12px;
            font-weight: 700;
            text-align: center;
            color: #5B79B0;
            margin-bottom: 4px;
        }

        .special-record-name {
            font-size: 12px;
            text-align: center;
            color: #5B79B0;
        }

        .empty-state-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            padding: 48px 16px;
        }

        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                align-items: flex-start;
            }

            .filter-section {
                flex-direction: column;
                width: 100%;
            }

            #filterSpecialty {
                width: 100%;
            }

            .table-scroll {
                max-height: 500px;
            }

            thead th {
                font-size: 12px;
                padding: 12px 8px;
                min-width: 120px;
            }

            tbody td {
                padding: 8px;
                font-size: 12px;
            }
        }
    </style>
</head>
<body>

<?php
if (@$_SESSION['ces1313777_sessid_inicio']) {
$director = '../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");

$obj_util = new util_funciones();
$fecha_valor = $_POST["fecha_valor"];
$hora_ini = '07:00';
$hora_fin = '19:00';

function horario_maniana($usua_id, $ndia, $hora, $DB_gogess)
{
    $nombre_data = '';
    $busca_hmaniana = "select * from cereni_pacientemateria inner join cereni_asignamaterias on cereni_pacientemateria.asigm_id=cereni_asignamaterias.asigm_id inner join cereni_horario on cereni_pacientemateria.horac_id=cereni_horario.horac_id where (horac_hoai='" . $hora . "') and dia_id='" . $ndia . "' and cereni_asignamaterias.usua_id='" . $usua_id . "'";
    $rs_hm = $DB_gogess->executec($busca_hmaniana, array());
    if ($rs_hm) {
        while (!$rs_hm->EOF) {
            $busca_clieter = "select * from app_cliente where clie_id='" . $rs_hm->fields["clie_id"] . "'";
            $rs_bclieter = $DB_gogess->executec($busca_clieter, array());
            $nombre_dato = explode(" ", $rs_bclieter->fields["clie_nombre"]);
            $apellido_dato = explode(" ", $rs_bclieter->fields["clie_apellido"]);
            $nombre_p = $nombre_dato[0] . " " . $apellido_dato[0] . " | " . $rs_hm->fields["horac_horai"] . "-" . $rs_hm->fields["horac_hoaf"];

            $nombre_data .= '<div style="background-color: #eff6ff; border: 1px solid #93c5fd; border-radius: 8px; padding: 8px; margin-bottom: 4px;">
                    <p style="font-size: 12px; font-weight: 600; text-align: center; color: #000;">' . utf8_encode($nombre_p) . '</p>
                </div>';
            $rs_hm->MoveNext();
        }
    }

    $busca_hmaniana = "select * from cereni_pacientemateria inner join cereni_asignamaterias on cereni_pacientemateria.asigm_id=cereni_asignamaterias.asigm_id inner join cereni_horario on cereni_pacientemateria.horac_id=cereni_horario.horac_id where (horac_hoai='" . $hora . "') and dia_id='8' and cereni_asignamaterias.usua_id='" . $usua_id . "'";
    $rs_hm = $DB_gogess->executec($busca_hmaniana, array());
    if ($rs_hm) {
        while (!$rs_hm->EOF) {
            $busca_clieter = "select * from app_cliente where clie_id='" . $rs_hm->fields["clie_id"] . "'";
            $rs_bclieter = $DB_gogess->executec($busca_clieter, array());
            $nombre_dato = explode(" ", $rs_bclieter->fields["clie_nombre"]);
            $apellido_dato = explode(" ", $rs_bclieter->fields["clie_apellido"]);
            $nombre_p = $nombre_dato[0] . " " . $apellido_dato[0] . " | " . $rs_hm->fields["horac_horai"] . "-" . $rs_hm->fields["horac_hoaf"];

            $nombre_data .= '<div style="background-color: #f3e8ff; border: 1px solid #e9d5ff; border-radius: 8px; padding: 8px; margin-bottom: 4px;">
                    <p style="font-size: 12px; font-weight: 600; text-align: center; color: #000;">' . utf8_encode($nombre_p) . '</p>
                </div>';
            $rs_hm->MoveNext();
        }
    }
    return $nombre_data;
}

function bevolucion_general($fecha, $hora, $DB_gogess)
{
    $nombre_data = '';
    $busca_evaluacion = "select * from faesa_evaluacionasigahorario where asighor_fecha='" . $fecha . "' and asighor_hora='" . $hora . "'";
    $rs_eceva = $DB_gogess->executec($busca_evaluacion, array());

    if ($rs_eceva) {
        while (!$rs_eceva->EOF) {
            $busca_clieter = "select * from app_cliente where clie_id='" . $rs_eceva->fields["clie_id"] . "'";
            $rs_bclieter = $DB_gogess->executec($busca_clieter, array());
            $nombre_p = $rs_bclieter->fields["clie_nombre"] . " " . $rs_bclieter->fields["clie_apellido"];
            $link_paciente = 'onclick="ver_formularioenpantalla(\'aplicativos/documental/datos_pacientes.php\',\'Editar\',\'divBody_ext\',\'' . $rs_eceva->fields["clie_id"] . '\',\'25\',0,0,0,0,99)"';

            $nombre_data .= '<div class="special-record" ' . $link_paciente . '>
                    <p class="special-record-title">EVALUACIÓN</p>
                    <p class="special-record-name">' . utf8_encode($nombre_p) . '</p>
                </div>';
            $rs_eceva->MoveNext();
        }
    }
    return $nombre_data;
}

function bevolucion($usua_id, $fecha, $hora, $DB_gogess)
{
    $nombre_data = '';
    $busca_evaluacion = "select * from faesa_evaluacionasigahorario where usua_idmedi='" . $usua_id . "' and asighor_fecha='" . $fecha . "' and asighor_hora='" . $hora . "'";
    $rs_eceva = $DB_gogess->executec($busca_evaluacion, array());

    if ($rs_eceva) {
        while (!$rs_eceva->EOF) {
            $busca_clieter = "select * from app_cliente where clie_id='" . $rs_eceva->fields["clie_id"] . "'";
            $rs_bclieter = $DB_gogess->executec($busca_clieter, array());
            $nombre_p = $rs_bclieter->fields["clie_nombre"] . " " . $rs_bclieter->fields["clie_apellido"];
            $link_paciente = 'onclick="ver_formularioenpantalla(\'aplicativos/documental/datos_pacientes.php\',\'Editar\',\'divBody_ext\',\'' . $rs_eceva->fields["clie_id"] . '\',\'25\',0,0,0,0,99)"';

            $nombre_data .= '<div class="special-record" ' . $link_paciente . '>
                    <p class="special-record-title">EVALUACIÓN</p>
                    <p class="special-record-name">' . utf8_encode($nombre_p) . '</p>
                </div>';
            $rs_eceva->MoveNext();
        }
    }
    return $nombre_data;
}

?>

<div class="container">
    <!-- Header -->
    <div class="header-card">
        <div class="header-content">
            <div class="header-left">
                <div class="header-icon">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <div class="header-text">
                    <h1>Agenda Médica</h1>
                    <p>Fecha: <span class="date-value"><?php echo $fecha_valor; ?></span></p>
                </div>
            </div>

            <!-- Filtro de Especialidades -->
            <div class="filter-section">
                <label class="filter-label">
                    <i class="fas fa-filter" style="margin-right: 8px;"></i>Filtrar por especialidad:
                </label>
                <select id="filterSpecialty">
                    <option value="">-- Seleccione una especialidad --</option>
                    <option value="all">Todas las especialidades</option>
                    <?php
                    // Obtener lista única de especialidades
                    $especialidades_map = array();
                    $lista_personal = "select * from app_usuario where usua_estado=1 and usua_agenda=1 and usua_id!=74";
                    $rs_personal = $DB_gogess->executec($lista_personal, array());
                    if ($rs_personal) {
                        while (!$rs_personal->EOF) {
                            $buespe = "select * from app_usuario us inner join dns_gridfuncionprofesional espe on us.usua_enlace=espe.usua_enlace inner join cesdb_arextension.dns_profesion prof on espe.prof_id=prof.prof_id where us.usua_id='" . $rs_personal->fields["usua_id"] . "' and prof.prof_id not in (38,777,888,911116,77)";
                            $rs_buespe = $DB_gogess->executec($buespe, array());
                            if ($rs_buespe) {
                                while (!$rs_buespe->EOF) {
                                    $especialidades_map[$rs_buespe->fields["prof_nombre"]] = true;
                                    $rs_buespe->MoveNext();
                                }
                            }
                            $rs_personal->MoveNext();
                        }
                    }
                    foreach ($especialidades_map as $esp => $val) {
                        echo '<option value="' . htmlspecialchars($esp) . '">' . htmlspecialchars($esp) . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>

    <!-- Estado vacío inicial -->
    <div id="emptyState" class="empty-state-container">
        <div class="empty-state">
            <i class="fas fa-filter"></i>
            <h3 style="font-size: 20px; font-weight: 600; color: #374151; margin: 16px 0 8px;">Seleccione una
                especialidad</h3>
            <p style="color: #6b7280;">Por favor, seleccione una especialidad del filtro superior para visualizar la
                agenda médica.</p>
        </div>
    </div>

    <!-- Tabla de Horarios -->
    <div id="scheduleContainer" class="schedule-table-container" style="display: none;">
        <div class="table-scroll professional-scroll">
            <table id="scheduleTable">
                <thead>
                <tr>
                    <th style="  padding: 16px;
            text-align: left;
            font-size: 14px;
            font-weight: 600;
            color: white;
            border-left: 1px solid #1e40af;
            min-width: 180px;
            position: sticky;
            background: linear-gradient(90deg, #2563eb 0%, #1d4ed8 100%); left: 0; z-index: 20; background: #1d4ed8; border-left: none;">
                        <i class="fas fa-clock" style="margin-right: 8px;"></i>Horario
                    </th>
                    <?php
                    $lista_personal = "select * from app_usuario where usua_estado=1 and usua_agenda=1 and usua_id!=74";
                    $rs_personal = $DB_gogess->executec($lista_personal, array());
                    if ($rs_personal) {
                        while (!$rs_personal->EOF) {
                            $nombre_uno = explode(" ", $rs_personal->fields["usua_nombre"]);
                            $nombre_dos = explode(" ", $rs_personal->fields["usua_apellido"]);

                            $n_especialidad = '';
                            $especialidades_array = array();
                            $buespe = "select * from app_usuario us inner join dns_gridfuncionprofesional espe on us.usua_enlace=espe.usua_enlace inner join cesdb_arextension.dns_profesion prof on espe.prof_id=prof.prof_id where us.usua_id='" . $rs_personal->fields["usua_id"] . "' and prof.prof_id not in (38,777,888,911116,77)";
                            $rs_buespe = $DB_gogess->executec($buespe, array());
                            if ($rs_buespe) {
                                while (!$rs_buespe->EOF) {
                                    $n_especialidad .= $rs_buespe->fields["prof_nombre"] . " ";
                                    $especialidades_array[] = $rs_buespe->fields["prof_nombre"];
                                    $rs_buespe->MoveNext();
                                }
                            }

                            $especialidades_data = htmlspecialchars(implode(',', $especialidades_array));

                            echo '<th class="specialist-column hidden-column" data-specialties="' . $especialidades_data . '" style="border-left: 1px solid #1e40af; min-width: 180px;">
                                        <div class="specialist-header">
                                            <div class="specialist-name">
                                                <i class="fas fa-user-md"></i>
                                                <span>' . utf8_encode($rs_personal->fields["usua_nombre"]) . '</span>
                                            </div>
                                            <span class="specialist-last-name">' . utf8_encode($nombre_dos[0]) . '</span>
                                            <div class="specialty-badges">';

                            foreach ($especialidades_array as $esp) {
                                echo '<span class="specialty-badge">' . htmlspecialchars($esp) . '</span>';
                            }

                            echo '</div>
                                        </div>
                                    </th>';

                            $rs_personal->MoveNext();
                        }
                    }
                    ?>
                </tr>
                </thead>
                <tbody>
                <?php
                $arreglo_horas = $obj_util->genera_arrayhora($hora_ini, $rango_hora, $hora_fin);
                for ($hi = 0; $hi < count($arreglo_horas); $hi++) {
                    $bandera = 0;
                    $lista_personal = "select * from app_usuario where usua_estado=1 and usua_agenda=1 and usua_id!=74";
                    $rs_personal = $DB_gogess->executec($lista_personal, array());
                    if ($rs_personal) {
                        while (!$rs_personal->EOF) {
                            $lista_buscat = "select terap_id from faesa_terapiasregistro where usua_id=" . $rs_personal->fields["usua_id"] . " and terap_fecha='" . $fecha_valor . "' and terap_hora='" . $arreglo_horas[$hi] . "' and terap_cancelado=0";
                            $rs_lbuscat = $DB_gogess->executec($lista_buscat, array());
                            if ($rs_lbuscat->fields["terap_id"] > 0) {
                                $bandera = 1;
                            }
                            $rs_personal->MoveNext();
                        }
                    }

                    $bandera = 1;
                    if ($bandera == 1) {
                        ?>
                        <tr>
                            <td style="position: sticky; left: 0; background: white; border-right: 1px solid #e5e7eb; font-weight: 600; color: #374151; z-index: 5;">
                                <i class="fas fa-clock time-icon"></i><?php echo $arreglo_horas[$hi]; ?>
                            </td>
                            <?php
                            $lista_personal = "select * from app_usuario where usua_estado=1 and usua_agenda=1 and usua_id!=74";
                            $rs_personal = $DB_gogess->executec($lista_personal, array());
                            if ($rs_personal) {
                                while (!$rs_personal->EOF) {
                                    $especialidades_array = array();
                                    $buespe = "select * from app_usuario us inner join dns_gridfuncionprofesional espe on us.usua_enlace=espe.usua_enlace inner join cesdb_arextension.dns_profesion prof on espe.prof_id=prof.prof_id where us.usua_id='" . $rs_personal->fields["usua_id"] . "' and prof.prof_id not in (38,777,888,911116,77)";
                                    $rs_buespe = $DB_gogess->executec($buespe, array());
                                    if ($rs_buespe) {
                                        while (!$rs_buespe->EOF) {
                                            $especialidades_array[] = $rs_buespe->fields["prof_nombre"];
                                            $rs_buespe->MoveNext();
                                        }
                                    }
                                    $especialidades_data = htmlspecialchars(implode(',', $especialidades_array));

                                    $lista_buscat = "select terap_confirmado,terap_id,atenc_hc,especi_id,faesa_terapiasregistro.usua_id,faesa_terapiasregistro.clie_id,terap_fecha,terap_hora,terap_autorizacion,terap_estado,terap_fechapago,terap_nfactura,faesa_terapiasregistro.centro_id,faesa_terapiasregistro.usuar_id,terap_fecharegistro,terap_recuperacion,terap_observacion,terap_tipoevatera,tipopac_id,clie_nombre,clie_apellido,terap_motivo,terap_asiste,quiro_id,terap_medicompanies,terap_copago,seg_id,tipocon_id from faesa_terapiasregistro left join app_cliente on faesa_terapiasregistro.clie_id=app_cliente.clie_id where faesa_terapiasregistro.usua_id=" . $rs_personal->fields["usua_id"] . " and terap_fecha='" . $fecha_valor . "' and terap_hora='" . $arreglo_horas[$hi] . "' and terap_cancelado=0";

                                    echo '<td class="specialist-column hidden-column" data-specialties="' . $especialidades_data . '" style="border-left: 1px solid #e5e7eb;">';
                                    echo '<div class="card-space">';

                                    $rs_lbuscat = $DB_gogess->executec($lista_buscat, array());
                                    if ($rs_lbuscat) {
                                        while (!$rs_lbuscat->EOF) {
                                            $link_b = "borrar_terapia('faesa_terapiasregistro','terap_id','" . $rs_lbuscat->fields["terap_id"] . "')";
                                            $click_cambiohorario = "onclick=cambio_horario('" . $rs_lbuscat->fields["terap_id"] . "')";

                                            $nombre_dato = explode(" ", $rs_lbuscat->fields["clie_nombre"]);
                                            $apellido_dato = explode(" ", $rs_lbuscat->fields["clie_apellido"]);
                                            $paciente_data = ucwords(strtolower(utf8_encode($rs_lbuscat->fields["clie_nombre"] . " " . $apellido_dato[0])));

                                            $terap_motivo = '';
                                            if ($rs_lbuscat->fields["terap_motivo"]) {
                                                $terap_motivo = '<div class="patient-note">' . $rs_lbuscat->fields["terap_motivo"] . '</div>';
                                            }

                                            $terap_extra_badge = '';
                                            if ($rs_lbuscat->fields["terap_observacion"] === "TURNO EXTRA") {
                                                $terap_extra_badge = '<div style="font-size: 11px; padding: 4px 8px; border-radius: 16px; font-weight: 600; display: inline-block; margin-top: 8px; background-color: #fef3c7; color: #92400e;"><i class="fas fa-star" style="margin-right: 4px;"></i>TURNO EXTRA</div>';
                                            }

                                            $n_quirofano = '';
                                            if ($rs_lbuscat->fields["quiro_id"] > 0) {
                                                $busca_quirofano = "select * from lospinos_quirofanos where quiro_id='" . $rs_lbuscat->fields["quiro_id"] . "'";
                                                $rs_bquirofano = $DB_gogess->executec($busca_quirofano, array());
                                                $n_quirofano = '<div class="patient-detail"><i class="fas fa-procedures"></i>' . $rs_bquirofano->fields["quiro_nombre"] . '</div>';
                                            }

                                            $n_seguro = '';
                                            if (@$rs_lbuscat->fields["seg_id"]) {
                                                $busca_seguro = "select * from cesdb_arextension.dns_convenios where conve_id='" . $rs_lbuscat->fields["seg_id"] . "'";
                                                $rs_bseguro = $DB_gogess->executec($busca_seguro, array());
                                                $n_seguro = '<div class="patient-detail" style="color: #000;"><i class="fas fa-shield-alt"></i>' . $rs_bseguro->fields["conve_nombre"] . '</div>';
                                            }

                                            $n_tipoconsulta = '';
                                            if (@$rs_lbuscat->fields["tipocon_id"]) {
                                                $busca_tipoconsulta = "SELECT * FROM cesdb_arextension.dns_tipoconsulta WHERE tipocon_id='" . $rs_lbuscat->fields["tipocon_id"] . "'";
                                                $rs_btipoconsulta = $DB_gogess->executec($busca_tipoconsulta, array());
                                                $n_tipoconsulta = '<div class="patient-detail" style="color: #000;"><i class="fas fa-stethoscope"></i>' . $rs_btipoconsulta->fields["tipocon_nombre"] . '</div>';
                                            }

                                            $estado_confirmado = '';
                                            $badge_class = 'status-unconfirmed';
                                            $estado_text = 'SIN CONFIRMAR';
                                            if ($rs_lbuscat->fields["terap_confirmado"] == 1) {
                                                $badge_class = 'status-confirmed';
                                                $estado_text = 'CONFIRMADO';
                                            }

                                            if ($rs_lbuscat->fields["terap_asiste"] == 1) {
                                                echo '<div class="appointment-item appointment-item-gray">
                                                    ' . $n_seguro . '
                                                    <div class="patient-info">' . $paciente_data . '</div>
                                                    ' . $terap_motivo . $n_quirofano . $n_tipoconsulta . '
                                                    ' . $terap_extra_badge . '
                                                    <div class="status-badge ' . $badge_class . '">' . $estado_text . '</div>
                                                </div>';
                                            } else {
                                                $function_confirma = "confirmacion_horariox('" . $rs_lbuscat->fields["terap_id"] . "')";

                                                echo '<div class="appointment-item appointment-item-blue">
                                                    <div class="appointment-controls">
                                                        <button onclick="' . $link_b . '" class="btn-icon btn-delete" title="Eliminar">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                        <button ' . $click_cambiohorario . ' class="btn-icon btn-reschedule" title="Cambiar horario">
                                                            <i class="fas fa-clock"></i>
                                                        </button>
                                                    </div>
                                                    ' . $n_seguro . '
                                                    <div class="patient-info">' . $paciente_data . '</div>
                                                    ' . $terap_motivo . $n_quirofano . $n_tipoconsulta . '
                                                    ' . $terap_extra_badge . '
                                                    <div class="confirm-section">
                                                        <button onclick="' . $function_confirma . '" class="btn-confirm">
                                                            <i class="fas fa-check-circle" style="margin-right: 4px;"></i>Confirmar Cita
                                                        </button>
                                                        <div id="estado_conf' . $rs_lbuscat->fields["terap_id"] . '" style="margin-top: 8px; text-align: center;">
                                                            <span class="status-badge ' . $badge_class . '">' . $estado_text . '</span>
                                                        </div>
                                                    </div>
                                                </div>';
                                            }

                                            $rs_lbuscat->MoveNext();
                                        }
                                    }

                                    echo bevolucion($rs_personal->fields["usua_id"], $fecha_valor, $arreglo_horas[$hi], $DB_gogess);
                                    $ndia_valor = date('N', strtotime($fecha_valor));
                                    echo horario_maniana($rs_personal->fields["usua_id"], $ndia_valor, $arreglo_horas[$hi], $DB_gogess);

                                    echo '</div></td>';
                                    $rs_personal->MoveNext();
                                }
                            }
                            ?>
                        </tr>
                        <?php
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modals containers -->
<div id="divBody_pantallag"></div>
<div id="divBody_fisica"></div>
<div id="divBody_confirmacion"></div>
<div id="borra_ci"></div>
<div id="grid_borrart"></div>

<script>
    document.getElementById('filterSpecialty').addEventListener('change', function () {
        const selectedValue = this.value;
        const selectedSpecialty = selectedValue.toLowerCase();
        const columns = document.querySelectorAll('.specialist-column');
        const emptyState = document.getElementById('emptyState');
        const scheduleContainer = document.getElementById('scheduleContainer');

        // Si no hay selección, mostrar estado vacío
        if (selectedValue === '') {
            emptyState.style.display = 'block';
            scheduleContainer.style.display = 'none';
            columns.forEach(column => {
                column.classList.add('hidden-column');
            });
            return;
        }

        // Ocultar estado vacío y mostrar tabla
        emptyState.style.display = 'none';
        scheduleContainer.style.display = 'block';

        // Si se selecciona "Todas las especialidades"
        if (selectedValue === 'all') {
            columns.forEach(column => {
                column.classList.remove('hidden-column');
            });
            return;
        }

        // Filtrar por especialidad específica
        columns.forEach(column => {
            const specialties = column.getAttribute('data-specialties').toLowerCase();

            if (specialties.includes(selectedSpecialty)) {
                column.classList.remove('hidden-column');
            } else {
                column.classList.add('hidden-column');
            }
        });
    });

    function cambio_horario(terap_id) {
        abrir_standar("cambiohorario.php", "CambioHorario", "divBody_fisica", "divDialog_fisica", 400, 400, terap_id, 0, 0, 0, 0, 0, 0);
    }

    function borrar_terapia(tabla, campo, valor) {
        if (confirm("¿Está seguro que desea eliminar esta cita?")) {
            document.getElementById("grid_borrart").innerHTML = "Procesando...";
            document.getElementById("grid_borrart").load = function (url, data, callback) {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", url, true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onload = function () {
                    if (callback) callback(xhr.responseText);
                };
                var params = Object.keys(data).map(k => encodeURIComponent(k) + '=' + encodeURIComponent(data[k])).join('&');
                xhr.send(params);
            };
            if (typeof jQuery !== 'undefined') {
                jQuery("#grid_borrart").load("borrart.php", {
                    ptabla: tabla,
                    pcampo: campo,
                    pvalor: valor
                }, function (result) {
                    ver_diario();
                });
            }
        }
    }

    function abrir_standar(urlpantalla, titulopantalla, divBody, divDialog, ancho, alto, variable1, variable2, variable3, variable4, variable5, variable6, variable7) {
        var data_divBody = divBody;
        var data_divDialog = divDialog;
        var data_ancho = ancho;
        var data_alto = alto;

        fnExpLabRegReg = function (urlpantalla, titulopantalla, variable1, variable2, variable3, variable4, variable5, variable6, variable7) {
            var xobjPadre = jQuery("#" + divBody);
            xobjPadre.append("<div id='" + data_divDialog + "' title='" + titulopantalla + "'></div>");
            var xobj = jQuery("#" + data_divDialog);
            xobj.dialog({
                open: function (event, ui) {
                    jQuery(".ui-pg-selbox").css({"visibility": "hidden"});
                },
                close: function (event, ui) {
                    jQuery(".ui-pg-selbox").css({"visibility": "visible"});
                    jQuery(this).remove();
                },
                resizable: false,
                autoOpen: false,
                width: data_ancho,
                height: data_alto,
                modal: true,
            });
            xobj.load(urlpantalla, {
                pVar1: variable1,
                pVar2: variable2,
                pVar3: variable3,
                pVar4: variable4,
                pVar5: variable5,
                pVar6: variable6,
                pVar7: variable7
            });
            xobj.dialog("open");
            return false;
        }
        fnExpLabRegReg(urlpantalla, titulopantalla, variable1, variable2, variable3, variable4, variable5, variable6, variable7);
    }

    function confirmacion_horariox(terap_id) {
        abrir_standar("confirmacion.php", "CONFIRMACION", "divBody_confirmacion", "divDialog_confirmacion", 400, 400, terap_id, 0, 0, 0, 0, 0, 0);
    }

    // Inicialización de DataTable (si está disponible)
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof jQuery !== 'undefined' && typeof jQuery.fn.DataTable !== 'undefined') {
            var table = jQuery('#scheduleTable').DataTable({
                "fixedHeader": {
                    header: true,
                },
                "responsive": true,
                "paging": false,
                "fixedColumns": {
                    left: 1
                },
                "searching": false,
                "info": false
            });
        }
    });
</script>

</body>
</html>

<?php
} else {
    echo '<div style="min-height: 100vh; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);">
        <div style="background: white; border-radius: 12px; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1); padding: 32px; max-width: 448px; width: 100%; margin: 0 16px;">
            <div style="text-align: center; margin-bottom: 24px;">
                <div style="background-color: #fee2e2; border-radius: 50%; width: 64px; height: 64px; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;">
                    <i class="fas fa-exclamation-triangle" style="color: #ef4444; font-size: 24px;"></i>
                </div>
                <h2 style="font-size: 24px; font-weight: bold; color: #1f2937; margin-bottom: 8px;">Sesión Expirada</h2>
                <p style="color: #4b5563;">Tu sesión ha expirado. Por favor, ingresa tu usuario y contraseña para continuar.</p>
            </div>
            <button onclick="reactivarSesion()" style="width: 100%; background: linear-gradient(90deg, #3b82f6 0%, #2563eb 100%); color: white; font-weight: 600; padding: 12px 24px; border-radius: 8px; border: none; cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                <i class="fas fa-sign-in-alt" style="margin-right: 8px;"></i>Iniciar Sesión
            </button>
        </div>
    </div>';

    $varable_enviafunc = '';
    echo '
    <script type="text/javascript">
        function reactivarSesion() {
            abrir_standar("aplicativos/documental/activar_sesion.php","Activar Sesión","divBody_acsession","divDialog_acsession",400,400,"' . $varable_enviafunc . '",0,0,0,0,0,0);
        }
        
        // Auto-ejecutar al cargar
        window.onload = function() {
            reactivarSesion();
        };
    </script>
    <div id="divBody_acsession"></div>';
}
?>

</body>
</html>
