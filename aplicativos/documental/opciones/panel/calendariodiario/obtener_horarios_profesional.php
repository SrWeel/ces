<?php
header('Content-Type: application/json; charset=UTF-8');
ini_set('display_errors', 0);
error_reporting(E_ALL);
$tiempossss = 44540000;
ini_set("session.cookie_lifetime", $tiempossss);
ini_set("session.gc_maxlifetime", $tiempossss);
session_start();

if (@$_SESSION['ces1313777_sessid_inicio']) {
    $director = '../../../../../';
    include("../../../../../cfg/clases.php");
    include("../../../../../cfg/declaracion.php");
    $obj_util = new util_funciones();

    $usua_id = $_POST["usua_id"];
    $fecha = $_POST["fecha"];

    $response = array(
        'success' => false,
        'horas' => array(),
        'mensaje' => ''
    );

    if (empty($usua_id)) {
        $response['mensaje'] = 'Debe seleccionar un profesional';
        echo json_encode($response);
        exit;
    }

    if (empty($fecha)) {
        $response['mensaje'] = 'Debe seleccionar una fecha';
        echo json_encode($response);
        exit;
    }

    // Determinar el día de la semana de la fecha seleccionada
    $dia_semana = date('N', strtotime($fecha)); // 1=Lunes, 7=Domingo

    // Consulta simplificada - SIN filtro de horario_activo primero para debug
    $query_todos = "SELECT ch.*, ld.dia_nombre, ld.dia_id
                    FROM clinica_horarios ch 
                    INNER JOIN dns_listadia ld ON ch.dia_id = ld.dia_id
                    WHERE ch.usua_id = ?
                    ORDER BY ld.dia_id, ch.horario_hora ASC";

    $rs_todos = $DB_gogess->executec($query_todos, array($usua_id));

    $horarios_encontrados = array();
    $response['debug_total_registros'] = 0;

    if ($rs_todos) {
        while (!$rs_todos->EOF) {
            $response['debug_total_registros']++;

            $dia_id_bd = trim($rs_todos->fields["dia_id"]);
            $dia_nombre_bd = trim($rs_todos->fields["dia_nombre"]);

            // Verificar si tiene la columna horario_activo
            $activo = '1';
            if (isset($rs_todos->fields["horario_activo"])) {
                $activo = $rs_todos->fields["horario_activo"];
            }

            $horarios_encontrados[] = array(
                'dia_id' => $dia_id_bd,
                'dia_id_comparado' => ($dia_id_bd == $dia_semana ? 'SI' : 'NO'),
                'dia_nombre' => $dia_nombre_bd,
                'hora_inicio' => $rs_todos->fields["horario_hora"],
                'hora_fin' => $rs_todos->fields["horario_horafin"],
                'activo' => $activo
            );

            // Comparar el dia_id con el día de la semana calculado
            // Y verificar que esté activo (si existe la columna)
            $es_dia_correcto = ($dia_id_bd == $dia_semana);
            $es_activo = (!isset($rs_todos->fields["horario_activo"]) ||
                $rs_todos->fields["horario_activo"] == '1' ||
                $rs_todos->fields["horario_activo"] == 1);

            if ($es_dia_correcto && $es_activo) {
                $hora_inicio = $rs_todos->fields["horario_hora"];
                $hora_fin = $rs_todos->fields["horario_horafin"];

                // Manejar intervalo con valor por defecto
                $intervalo = 15;
                if (isset($rs_todos->fields["horario_intervalo"]) &&
                    !is_null($rs_todos->fields["horario_intervalo"]) &&
                    $rs_todos->fields["horario_intervalo"] > 0) {
                    $intervalo = intval($rs_todos->fields["horario_intervalo"]);
                }

                // Limpiar formato de hora (quitar segundos si existen)
                $hora_inicio_clean = substr($hora_inicio, 0, 5);
                $hora_fin_clean = substr($hora_fin, 0, 5);

                // Generar horas
                $horas_rango = generar_horas_manual($hora_inicio_clean, $hora_fin_clean, $intervalo);

                if (count($horas_rango) > 0) {
                    $response['horas'] = array_merge($response['horas'], $horas_rango);
                }

                $response['debug_horario_usado'] = array(
                    'hora_inicio' => $hora_inicio_clean,
                    'hora_fin' => $hora_fin_clean,
                    'intervalo' => $intervalo,
                    'horas_generadas' => count($horas_rango)
                );
            }

            $rs_todos->MoveNext();
        }
    }

    $response['debug_dia_buscado'] = $dia_semana;
    $response['debug_horarios_encontrados'] = $horarios_encontrados;

    if (count($response['horas']) > 0) {
        $response['success'] = true;
        // Eliminar duplicados y ordenar
        $response['horas'] = array_values(array_unique($response['horas']));
        sort($response['horas']);

        // Limpiar debug en producción
        unset($response['debug_dia_buscado']);
        unset($response['debug_horarios_encontrados']);
        unset($response['debug_total_registros']);
        unset($response['debug_horario_usado']);
    } else {
        // Mapeo de días para mensaje de error
        $dias_map = array(
            '1' => 'Lunes',
            '2' => 'Martes',
            '3' => 'Miércoles',
            '4' => 'Jueves',
            '5' => 'Viernes',
            '6' => 'Sábado',
            '7' => 'Domingo'
        );

        $dia_seleccionado = isset($dias_map[$dia_semana]) ? $dias_map[$dia_semana] : 'este día';

        if ($response['debug_total_registros'] == 0) {
            $response['mensaje'] = 'El profesional no tiene horarios configurados en el sistema';
        } else {
            $response['mensaje'] = 'El profesional no tiene horarios para ' . $dia_seleccionado;

            // Mostrar días disponibles
            $dias_disponibles = array();
            foreach ($horarios_encontrados as $h) {
                if (!in_array($h['dia_nombre'], $dias_disponibles)) {
                    $dias_disponibles[] = $h['dia_nombre'];
                }
            }

            if (count($dias_disponibles) > 0) {
                $response['mensaje'] .= '. Días disponibles: ' . implode(', ', $dias_disponibles);
            }
        }
    }

    echo json_encode($response);
} else {
    echo json_encode(array(
        'success' => false,
        'mensaje' => 'Sesión expirada'
    ));
}

// Función auxiliar para generar horas manualmente
function generar_horas_manual($hora_inicio, $hora_fin, $intervalo = 15) {
    $horas = array();

    try {
        // Asegurar formato correcto HH:MM
        if (strlen($hora_inicio) > 5) {
            $hora_inicio = substr($hora_inicio, 0, 5);
        }
        if (strlen($hora_fin) > 5) {
            $hora_fin = substr($hora_fin, 0, 5);
        }

        // Convertir a timestamp usando fecha base
        $fecha_base = '2025-01-01';
        $inicio = strtotime($fecha_base . ' ' . $hora_inicio);
        $fin = strtotime($fecha_base . ' ' . $hora_fin);

        if ($inicio === false || $fin === false) {
            return $horas;
        }

        // Si la hora de fin es menor que la de inicio, significa que cruza medianoche
        if ($fin < $inicio) {
            $fin = strtotime('+1 day', $fin);
        }

        // Generar array de horas
        $current = $inicio;
        $contador = 0;
        $max_iteraciones = 200;

        while ($current <= $fin && $contador < $max_iteraciones) {
            $horas[] = date('H:i', $current);
            $current = strtotime("+{$intervalo} minutes", $current);
            $contador++;
        }
    } catch (Exception $e) {
        // Error al generar horas
    }

    return $horas;
}
?>