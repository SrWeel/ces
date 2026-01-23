<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
header('Content-Type: text/html; charset=UTF-8');
$tiempossss=4444000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

// Validación de parámetros GET
$numero = count($_GET);
$tags = array_keys($_GET);
$valores = array_values($_GET);

for($i=0;$i<$numero;$i++){
    if ($tags[$i]=='ssr') {
        $nombrevarget='';
        if (preg_match('/^[a-z\d_=]{1,200}$/i', $valores[$i])) {
            $nombrevarget=$tags[$i];
            $$nombrevarget=$valores[$i];
        } else {
            $nombrevarget=$tags[$i];
            $$nombrevarget=0;
        }
    }
}

if($_SESSION['ces1313777_sessid_inicio']) {

    // Decodificar parámetros
    $decodifica='';
    $separa_campos=explode("|",$_GET["ssr"]);
    $decodifica=base64_decode($separa_campos[0]);

    $splitvar=explode("&",@$decodifica);
    $nombreget='';

    for($ivari=0;$ivari<count($splitvar);$ivari++) {
        $sacadatav=explode("=",$splitvar[$ivari]);
        $nombreget=$sacadatav[0];
        @$$nombreget=$sacadatav[1];
    }

    $clie_id=$pVar2;
    $mnupan_id=$pVar3;
    $atenc_id=$pVar4;
    $anam_id=$separa_campos[1];

    $director='../';
    include("../cfg/clases.php");
    include("../cfg/declaracion.php");

    $objformulario= new ValidacionesFormulario();

    // PASO 1: Obtener datos desde dns_newsalarecuperacionanamesis
    $sql_anamesis = "SELECT * FROM dns_newsalarecuperacionanamesis WHERE anam_id = ?";
    $rs_anamesis = $DB_gogess->executec($sql_anamesis, array($anam_id));

    $anam_enlace = '';
    $anam_nhoja = '';
    $anam_motivoconsulta = '';
    $anam_cama = '';
    $anam_mantenimiento = '';
    $anam_personarecibe = '';
    $anam_induccion = '';
    $anam_personaentrega = '';
    $anam_fechallegada = '';
    $anam_fechasalida = '';
    $anam_sala = '';
    $anam_observacionap = '';
    $anam_medicamentos = '';
    $anam_posicion = '';
    $anam_oxigeno = '';
    $anam_notasenfermeria = '';
    $estaatenc_id = 0;
    $anam_anestesia = 0;

    if($rs_anamesis && !$rs_anamesis->EOF) {
        $anam_enlace = $rs_anamesis->fields["anam_enlace"];
        $anam_nhoja = $rs_anamesis->fields["anam_nhoja"];
        $anam_motivoconsulta = $rs_anamesis->fields["anam_motivoconsulta"];
        $anam_cama = $rs_anamesis->fields["anam_cama"];
        $anam_mantenimiento = $rs_anamesis->fields["anam_mantenimiento"];
        $anam_personarecibe = $rs_anamesis->fields["anam_personarecibe"];
        $anam_induccion = $rs_anamesis->fields["anam_induccion"];
        $anam_personaentrega = $rs_anamesis->fields["anam_personaentrega"];
        $anam_fechallegada = $rs_anamesis->fields["anam_fechallegada"];
        $anam_fechasalida = $rs_anamesis->fields["anam_fechasalida"];
        $anam_sala = $rs_anamesis->fields["anam_sala"];
        $anam_observacionap = $rs_anamesis->fields["anam_observacionap"];
        $anam_medicamentos = $rs_anamesis->fields["anam_medicamentos"];
        $anam_posicion = $rs_anamesis->fields["anam_posicion"];
        $anam_oxigeno = $rs_anamesis->fields["anam_oxigeno"];
        $anam_notasenfermeria = $rs_anamesis->fields["anam_notasenfermeria"];
        $estaatenc_id = $rs_anamesis->fields["estaatenc_id"];
        $anam_anestesia = $rs_anamesis->fields["anam_anestesia"];
    }

    // Obtener datos del paciente
    $datos_cliente="SELECT * FROM app_cliente WHERE clie_id=?";
    $rs_dcliente = $DB_gogess->executec($datos_cliente,array($clie_id));

    $nombre_paciente=$rs_dcliente->fields["clie_nombre"];
    $apellido_paciente=$rs_dcliente->fields["clie_apellido"];
    $clie_genero=$rs_dcliente->fields["clie_genero"];
    $clie_fechanacimiento=$rs_dcliente->fields["clie_fechanacimiento"];
    $clie_rucci=$rs_dcliente->fields["clie_rucci"];
    $conve_id=$rs_dcliente->fields["conve_id"];
    $nac_id=$rs_dcliente->fields["nac_id"];

    // Obtener datos de atención
    $lista_atencion="SELECT * FROM dns_atencion WHERE atenc_id=?";
    $rs_atencion = $DB_gogess->executec($lista_atencion,array($atenc_id));
    $hc=$rs_atencion->fields["atenc_hc"];
    $atenc_enlace = $rs_atencion->fields["atenc_enlace"];

    // Obtener datos del centro
    $nomb_centro=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre","where centro_id=",1,$DB_gogess);
    $uni_codiog=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_codigo","where centro_id=",1,$DB_gogess);

    // Obtener logo y datos de la empresa
    $logo = $objformulario->replace_cmb("app_empresa", "emp_id,emp_logoreporte", "where emp_id=", 1, $DB_gogess);
    $emp_nombre = $objformulario->replace_cmb("app_empresa", "emp_id,emp_nombre", "where emp_id=", 1, $DB_gogess);
    $emp_piedepagina = $objformulario->replace_cmb("app_empresa", "emp_id,emp_piedepagina", "where emp_id=", 1, $DB_gogess);

    // Calcular edad
    $edad_texto = '';
    $diferencia = null;
    if($clie_fechanacimiento && $clie_fechanacimiento != '0000-00-00') {
        $fecha_nac = new DateTime($clie_fechanacimiento);
        $fecha_actual = new DateTime();
        $diferencia = $fecha_actual->diff($fecha_nac);

        if($diferencia->y > 0) {
            $edad_texto = $diferencia->y . " años";
        } elseif($diferencia->m > 0) {
            $edad_texto = $diferencia->m . " meses";
        } else {
            $edad_texto = $diferencia->d . " días";
        }
    }

    // Obtener institución
    $institucion_valor = '';
    if($conve_id > 0) {
        $sql_inst = "SELECT conve_nombre FROM app_convenio WHERE conve_id=?";
        $rs_inst = $DB_gogess->executec($sql_inst, array($conve_id));
        if($rs_inst && !$rs_inst->EOF) {
            $institucion_valor = $rs_inst->fields["conve_nombre"];
        }
    }

    // Sexo formato
    $valor_sexo = '';
    if($clie_genero=='M') {
        $valor_sexo='HOMBRE';
    }
    if($clie_genero=='F') {
        $valor_sexo='MUJER';
    }

    // Dividir nombres y apellidos
    $partes_apellido = explode(' ', trim($apellido_paciente), 2);
    $primer_apellido = isset($partes_apellido[0]) ? $partes_apellido[0] : '';
    $segundo_apellido = isset($partes_apellido[1]) ? $partes_apellido[1] : '';

    $partes_nombre = explode(' ', trim($nombre_paciente), 2);
    $primer_nombre = isset($partes_nombre[0]) ? $partes_nombre[0] : '';
    $segundo_nombre = isset($partes_nombre[1]) ? $partes_nombre[1] : '';

    // Estado del paciente
    $estado_paciente = '';
    if($estaatenc_id == 1) {
        $estado_paciente = 'CONSCIENTE';
    } elseif($estaatenc_id == 2) {
        $estado_paciente = 'SEMICONSCIENTE';
    } elseif($estaatenc_id == 3) {
        $estado_paciente = 'INCONSCIENTE';
    }

    // Anestesia
    $tipo_anestesia = '';
    if($anam_anestesia == 1) {
        $tipo_anestesia = 'GENERAL';
    } elseif($anam_anestesia == 2) {
        $tipo_anestesia = 'LOCAL';
    } elseif($anam_anestesia == 3) {
        $tipo_anestesia = 'RAQUÍDEA';
    } elseif($anam_anestesia == 4) {
        $tipo_anestesia = 'OTRA';
    }

    // CONSULTA DE SIGNOS VITALES (CONSTANTES VITALES)
    $sql_constantes = "
    SELECT 
        sv.signovita_id,
        sv.signovita_frecuenciacardiaca AS pulso,
        sv.signovita_temperaturabucal AS temperatura,
        sv.signovita_presionarterial,
        sv.signovita_frecuenciarespiratoria,
        sv.signovita_saturacionoxigeno,
        sv.signovita_peso,
        sv.signovita_talla,
        sv.signovita_fecharegistro,
        u.usua_nombre, 
        u.usua_apellido, 
        u.usua_codigo, 
        u.usua_codigoiniciales
    FROM dns_signosvitales AS sv
    INNER JOIN dns_atencion AS a
           ON sv.atenc_enlace = a.atenc_enlace
    LEFT JOIN app_usuario AS u 
           ON sv.usua_id = u.usua_id
           
    WHERE a.atenc_id = ?
    
    ORDER BY sv.signovita_fecharegistro ASC
    ";
    $rs_constantes = $DB_gogess->executec($sql_constantes, array($atenc_id));

    // CONSULTA DE LÍQUIDOS ADMINISTRADOS
    $sql_liq_admin = "
        SELECT 
            la.srladm_id,
            la.srladm_hora,
            la.srladm_tipo,
            la.srladm_cantidad,
            la.srladm_fecharegistro,
            tpa.tplq_nombre AS tipo_nombre,
            u.usua_nombre, 
            u.usua_apellido, 
            u.usua_codigo, 
            u.usua_codigoiniciales
        FROM cesdb_arextension.dns_gridsalareculiqadministrados AS la
        LEFT JOIN cesdb_arcombos.dns_tipoliquidosadm AS tpa
               ON la.srladm_tipo = tpa.tplq_id
        LEFT JOIN cesdb_aroriginal.app_usuario AS u 
               ON la.usua_id = u.usua_id
        WHERE la.anam_enlace = ?
        ORDER BY la.srladm_fecharegistro DESC
    ";
    $rs_liq_admin = $DB_gogess->executec($sql_liq_admin, array($anam_enlace));

    // CONSULTA DE LÍQUIDOS ELIMINADOS
    $sql_liq_elim = "
        SELECT 
            le.srleli_id,
            le.srleli_hora,
            le.srleli_tipo,
            le.srleli_cantidad,
            le.srleli_fecharegistro,
            tpe.tplqeli_nombre AS tipo_nombre,
            u.usua_nombre, 
            u.usua_apellido, 
            u.usua_codigo, 
            u.usua_codigoiniciales
        FROM cesdb_arextension.dns_gridsalareculiqeliminados AS le
        LEFT JOIN cesdb_arcombos.dns_tipoliquidoseli AS tpe
               ON le.srleli_tipo = tpe.tplqeli_id
        LEFT JOIN cesdb_aroriginal.app_usuario AS u 
               ON le.usua_id = u.usua_id
        WHERE le.anam_enlace = ?
        ORDER BY le.srleli_fecharegistro DESC
    ";
    $rs_liq_elim = $DB_gogess->executec($sql_liq_elim, array($anam_enlace));

    // Construir HTML del reporte
    $html_reporte = '
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <style>
            body { 
                font-family: Arial, sans-serif; 
                font-size: 9px; 
                margin: 10px;
            }

            .header-tabla {
                width: 100%;
                border: 2px solid #000;
                border-collapse: collapse;
                margin-bottom: 10px;
            }

            .header-tabla td {
                padding: 5px;
                vertical-align: middle;
            }

            .logo-cell {
                width: 100px;
                text-align: center;
                border-right: 1px solid #000;
            }

            .logo-cell img {
                max-width: 90px;
                height: auto;
            }

            .titulo-cell {
                text-align: center;
                border-right: 1px solid #000;
            }

            .titulo-principal {
                font-size: 14px;
                font-weight: bold;
                margin-bottom: 3px;
            }

            .subtitulo {
                font-size: 11px;
                font-weight: bold;
            }

            .codigo-cell {
                width: 100px;
                text-align: center;
                font-size: 8px;
            }

            .tabla-datos {
                width: 100%;
                border: 1px solid #000;
                border-collapse: collapse;
                margin-bottom: 3px;
            }

            .tabla-datos td {
                border: 1px solid #000;
                padding: 3px 2px;
                font-size: 7px;
                line-height: 1.1;
            }

            .titulo-azul {
                background-color: #CCCCFF;
                color: black;
                font-weight: bold;
                text-align: left;
                padding: 4px 5px;
                font-size: 9px;
            }

            .encabezado-verde {
                background-color: #CCFFCC;
                color: black;
                font-weight: bold;
                text-align: center;
                padding: 2px 1px;
                font-size: 6.5px;
                white-space: nowrap;
                line-height: 1.2;
            }

            .celda-dato {
                background-color: white;
                text-align: center;
                padding: 3px 2px;
                font-size: 7px;
            }

            .etiqueta-campo {
                background-color: #e9ecef;
                font-weight: bold;
                width: 20%;
                font-size: 7px;
                text-align: left;
                padding: 4px;
            }

            /* TABLA DE CONSTANTES VITALES - 3 COLUMNAS POR DÍA */
            .tabla-grafica-constantes {
                width: 100%;
                border-collapse: collapse;
                margin-top: 10px;
                margin-bottom: 15px;
                page-break-inside: avoid;
            }

            .tabla-grafica-constantes th {
                background-color: #CCFFCC;
                color: black;
                padding: 3px 2px;
                text-align: center;
                border: 1px solid #000;
                font-size: 7px;
                font-weight: bold;
                line-height: 1.1;
            }

            .tabla-grafica-constantes td {
                padding: 3px 2px;
                border: 1px solid #000;
                text-align: center;
                font-size: 7px;
                min-height: 20px;
            }

            .celda-parametro {
                background-color: #e9ecef;
                font-weight: bold;
                width: 8%;
                font-size: 7px;
            }

            .celda-dia {
                background-color: #d1e7dd;
                font-weight: bold;
                text-align: center;
                font-size: 7px;
            }

            .celda-valor {
                background-color: white;
                width: 4%;
            }

            /* TABLAS DE LÍQUIDOS */
            .tabla-liquidos {
                width: 100%;
                border-collapse: collapse;
                margin-top: 10px;
                margin-bottom: 10px;
            }

            .tabla-liquidos th {
                background-color: #CCFFCC;
                color: black;
                padding: 5px;
                text-align: left;
                border: 1px solid #000;
                font-size: 7px;
                font-weight: bold;
            }

            .tabla-liquidos td {
                padding: 5px;
                border: 1px solid #000;
                font-size: 8px;
            }

            .sin-datos {
                text-align: center;
                padding: 10px;
                color: #999;
                font-style: italic;
                font-size: 7px;
            }

            .footer {
                margin-top: 15px;
                font-size: 7px;
                text-align: center;
                color: #666;
                border-top: 1px solid #ccc;
                padding-top: 5px;
            }
        </style>
    </head>
    <body>
        <table class="header-tabla">
            <tr>
                <td class="logo-cell">
                    <img src="../archivo/' . $logo . '" alt="Logo">
                </td>
                <td class="titulo-cell">
                    <div class="titulo-principal">' . $emp_nombre . '</div>
                    <div class="subtitulo">SALA DE RECUPERACIÓN</div>
                </td>
                <td class="codigo-cell">
                    <strong>N° HCU:</strong><br>' . $hc. '
                </td>
            </tr>
        </table>
        
        <table class="tabla-datos">
            <tr>
                <td class="titulo-azul" colspan="8">A. DATOS DEL ESTABLECIMIENTO DE SALUD Y USUARIO / PACIENTE</td>
            </tr>
            <tr>
                <td class="encabezado-verde" colspan="2">INSTITUCIÓN DEL SISTEMA</td>
                <td class="encabezado-verde">UNICÓDIGO</td>
                <td class="encabezado-verde" colspan="2">ESTABLECIMIENTO DE SALUD</td>
                <td class="encabezado-verde">N° HCU</td>
                <td class="encabezado-verde">N° ARCHIVO</td>
                <td class="encabezado-verde">N° DE HOJA</td>
            </tr>
            <tr>
                <td class="celda-dato" colspan="2">' . ($institucion_valor ? $institucion_valor : $nomb_centro) . '</td>
                <td class="celda-dato">' . $uni_codiog . '</td>
                <td class="celda-dato" colspan="2">' . $nomb_centro . '</td>
                <td class="celda-dato">' . $hc . '</td>
                <td class="celda-dato">' . $clie_rucci . '</td>
                <td class="celda-dato">' . $anam_nhoja . '</td>
            </tr>
            <tr>
                <td class="encabezado-verde">PRIMER APELLIDO</td>
                <td class="encabezado-verde">SEGUNDO APELLIDO</td>
                <td class="encabezado-verde">PRIMER NOMBRE</td>
                <td class="encabezado-verde">SEGUNDO NOMBRE</td>
                <td class="encabezado-verde">SEXO</td>
                <td class="encabezado-verde">FECHA NACIMIENTO</td>
                <td class="encabezado-verde">EDAD</td>
                <td class="encabezado-verde">CONDICIÓN DE EDAD</td>
            </tr>
            <tr>
                <td class="celda-dato">' . htmlspecialchars($primer_apellido) . '</td>
                <td class="celda-dato">' . htmlspecialchars($segundo_apellido) . '</td>
                <td class="celda-dato">' . htmlspecialchars($primer_nombre) . '</td>
                <td class="celda-dato">' . htmlspecialchars($segundo_nombre) . '</td>
                <td class="celda-dato">' . $valor_sexo . '</td>
                <td class="celda-dato">' . ($clie_fechanacimiento != '0000-00-00' ? date("d/m/Y", strtotime($clie_fechanacimiento)) : '-') . '</td>
                <td class="celda-dato">' . $edad_texto . '</td>
                <td class="celda-dato">' . ($diferencia && $diferencia->y > 0 ? 'AÑOS' : ($diferencia && $diferencia->m > 0 ? 'MESES' : 'DÍAS')) . '</td>
            </tr>
        </table>

        <table class="tabla-datos">
            <tr>
                <td class="titulo-azul" colspan="4">B. DATOS GENERALES - SALA RECUPERACIÓN</td>
            </tr>
            <tr>
                <td class="etiqueta-campo">Operación Realizada:</td>
                <td class="celda-dato" colspan="3" style="text-align: left;">' . nl2br(htmlspecialchars($anam_motivoconsulta)) . '</td>
            </tr>
            <tr>
                <td class="etiqueta-campo">Estado Paciente:</td>
                <td class="celda-dato">' . $estado_paciente . '</td>
                <td class="etiqueta-campo">Sala:</td>
                <td class="celda-dato">' . htmlspecialchars($anam_sala) . '</td>
            </tr>
            <tr>
                <td class="etiqueta-campo">Cama:</td>
                <td class="celda-dato">' . htmlspecialchars($anam_cama) . '</td>
                <td class="etiqueta-campo">Fecha y Hora de Llegada:</td>
                <td class="celda-dato">' . ($anam_fechallegada && $anam_fechallegada != '0000-00-00' ? date("d/m/Y", strtotime($anam_fechallegada)) : '-') . '</td>
            </tr>
            <tr>
                <td class="etiqueta-campo">Fecha y Hora de Salida:</td>
                <td class="celda-dato">' . ($anam_fechasalida && $anam_fechasalida != '0000-00-00' ? date("d/m/Y", strtotime($anam_fechasalida)) : '-') . '</td>
                <td class="etiqueta-campo">Anestesia Administrada:</td>
                <td class="celda-dato">' . $tipo_anestesia . '</td>
            </tr>
            <tr>
                <td class="etiqueta-campo">Agente Inducción:</td>
                <td class="celda-dato">' . htmlspecialchars($anam_induccion) . '</td>
                <td class="etiqueta-campo">Agente Mantenimiento:</td>
                <td class="celda-dato">' . htmlspecialchars($anam_mantenimiento) . '</td>
            </tr>
            <tr>
                <td class="etiqueta-campo">Persona Entrega:</td>
                <td class="celda-dato">' . htmlspecialchars($anam_personaentrega) . '</td>
                <td class="etiqueta-campo">Persona Recibe:</td>
                <td class="celda-dato">' . htmlspecialchars($anam_personarecibe) . '</td>
            </tr>
            <tr>
                <td class="etiqueta-campo">Observaciones:</td>
                <td class="celda-dato" colspan="3" style="text-align: left;">' . nl2br(htmlspecialchars($anam_observacionap)) . '</td>
            </tr>
        </table>';

    // SECCIÓN C: CONSTANTES VITALES - 7 DÍAS CON 3 COLUMNAS CADA UNO (AM, PM, HS)
    $html_reporte .= '
    <table class="tabla-datos">
        <tr>
            <td class="titulo-azul">C. CONSTANTES VITALES</td>
        </tr>
    </table>
    
    <table class="tabla-grafica-constantes">
        <thead>
            <tr>
                <th rowspan="2">PULSO</th>
                <th rowspan="2">TEMPERATURA</th>';

    $dias_nombres = array('DÍA 1', 'DÍA 2', 'DÍA 3', 'DÍA 4', 'DÍA 5');
    foreach($dias_nombres as $dia_nombre) {
        $html_reporte .= '<th colspan="3">' . $dia_nombre . '</th>';
    }

    $html_reporte .= '
            </tr>
            <tr>';

    // Generar sub-encabezados AM, PM, HS para cada día
    for ($dia = 0; $dia < 5; $dia++) {
        $html_reporte .= '<th>AM</th>';
        $html_reporte .= '<th>PM</th>';
        $html_reporte .= '<th>HS</th>';
    }

    $html_reporte .= '
            </tr>
        </thead>
        <tbody>';

    // Estructura de datos mejorada: [dia][periodo][tipo] = array de valores
    $datos_grid = array();
    for($d = 0; $d < 5; $d++) {
        $datos_grid[$d] = array(
            'AM' => array('pulsos' => array(), 'temperaturas' => array(), 'fechas' => array(), 'observaciones' => array()),
            'PM' => array('pulsos' => array(), 'temperaturas' => array(), 'fechas' => array(), 'observaciones' => array()),
            'HS' => array('pulsos' => array(), 'temperaturas' => array(), 'fechas' => array(), 'observaciones' => array())
        );
    }

    // Función para determinar el período según la hora
    function obtener_periodo($hora) {
        if ($hora >= 6 && $hora < 12) {
            return 'AM';
        } elseif ($hora >= 12 && $hora < 20) {
            return 'PM';
        } else {
            return 'HS';
        }
    }

    // Agrupar registros por fecha (sin hora) para determinar los días
    $registros_por_fecha = array();

    if($rs_constantes && !$rs_constantes->EOF) {
        while (!$rs_constantes->EOF) {
            $fecha_registro = $rs_constantes->fields["signovita_fecharegistro"];
            if($fecha_registro && $fecha_registro != '0000-00-00 00:00:00') {
                $dt = new DateTime($fecha_registro);
                $fecha_solo = $dt->format('Y-m-d');

                if(!isset($registros_por_fecha[$fecha_solo])) {
                    $registros_por_fecha[$fecha_solo] = array();
                }

                $registros_por_fecha[$fecha_solo][] = array(
                    'pulso' => $rs_constantes->fields["pulso"] ?? '',
                    'temperatura' => $rs_constantes->fields["temperatura"] ?? '',
                    'observacion' => $rs_constantes->fields["signovita_observacion"] ?? '',
                    'fecha_completa' => date("d/m/Y H:i", strtotime($fecha_registro)),
                    'hora' => (int)$dt->format('H'),
                    'datetime' => $dt
                );
            }
            $rs_constantes->MoveNext();
        }
    }

    // Ordenar fechas de más antigua a más reciente
    ksort($registros_por_fecha);

    // Asignar días (0-6) según antigüedad
    $dia_actual = 0;
    foreach($registros_por_fecha as $fecha => $registros) {
        if($dia_actual >= 5) break;

        foreach($registros as $registro) {
            $periodo = obtener_periodo($registro['hora']);

            // Guardar TODOS los pulsos (con decimales)
            if(!empty($registro['pulso']) && is_numeric($registro['pulso'])) {
                $valor_pulso = floatval($registro['pulso']);
                $datos_grid[$dia_actual][$periodo]['pulsos'][] = $valor_pulso;
            }

            // Guardar TODAS las temperaturas (con decimales)
            if(!empty($registro['temperatura']) && is_numeric($registro['temperatura'])) {
                $valor_temp = floatval($registro['temperatura']);
                $datos_grid[$dia_actual][$periodo]['temperaturas'][] = $valor_temp;
            }

            // Guardar TODAS las fechas/horas
            $datos_grid[$dia_actual][$periodo]['fechas'][] = $registro['fecha_completa'];

            // Guardar observaciones
            if(!empty($registro['observacion'])) {
                $datos_grid[$dia_actual][$periodo]['observaciones'][] = htmlspecialchars($registro['observacion']);
            }
        }

        $dia_actual++;
    }

    // Definir valores para columnas de PULSO y TEMPERATURA
    $valores_pulso = array(140, 130, 120, 110, 100, 90, 80, 70, 60, 50, 40);
    $valores_temperatura = array(42, 41, 40, 39, 38, 37, 36, 35);

    // Encontrar el rango máximo de filas necesario
    $max_filas = max(count($valores_pulso), count($valores_temperatura));

    // Generar filas
    for($fila = 0; $fila < $max_filas; $fila++) {
        $html_reporte .= '<tr>';

        // Columna PULSO
        $valor_pulso_fila = isset($valores_pulso[$fila]) ? $valores_pulso[$fila] : '';
        $html_reporte .= '<td class="celda-parametro">' . $valor_pulso_fila . '</td>';

        // Columna TEMPERATURA
        $valor_temp_fila = isset($valores_temperatura[$fila]) ? $valores_temperatura[$fila] : '';
        $html_reporte .= '<td class="celda-parametro">' . $valor_temp_fila . '</td>';

        // Para cada día y cada período (AM, PM, HS)
        for($d = 0; $d < 5; $d++) {
            foreach(array('AM', 'PM', 'HS') as $periodo) {
                $contenido_celda = '';

                // Verificar si hay pulsos que coincidan con el valor de esta fila
                if(!empty($valor_pulso_fila)) {
                    // Buscar pulsos cercanos al valor de la fila (±5 unidades de tolerancia)
                    foreach($datos_grid[$d][$periodo]['pulsos'] as $pulso) {
                        if($pulso >= $valor_pulso_fila - 5 && $pulso <= $valor_pulso_fila + 5) {
                            if(!empty($contenido_celda)) {
                                $contenido_celda .= '<br>';
                            }
                            $contenido_celda .= number_format($pulso, 1, '.', '');
                        }
                    }
                }

                // Verificar si hay temperaturas que coincidan con el valor de esta fila
                if(!empty($valor_temp_fila)) {
                    // Buscar temperaturas cercanas al valor de la fila (±0.5 grados de tolerancia)
                    foreach($datos_grid[$d][$periodo]['temperaturas'] as $temp) {
                        if($temp >= $valor_temp_fila - 0.5 && $temp <= $valor_temp_fila + 0.5) {
                            if(!empty($contenido_celda)) {
                                $contenido_celda .= '<br>';
                            }
                            $contenido_celda .= number_format($temp, 1, '.', '');
                        }
                    }
                }

                $html_reporte .= '<td class="celda-valor">' . $contenido_celda . '</td>';
            }
        }

        $html_reporte .= '</tr>';
    }

    // FILA ADICIONAL PARA MOSTRAR FECHAS/HORAS
    $html_reporte .= '<tr>';
    $html_reporte .= '<td class="celda-parametro" colspan="2" style="background-color: #d1e7dd; font-weight: bold;">FECHA/HORA</td>';

    for($d = 0; $d < 5; $d++) {
        foreach(array('AM', 'PM', 'HS') as $periodo) {
            $fechas_html = '';
            if(!empty($datos_grid[$d][$periodo]['fechas'])) {
                $fechas_html = implode('<br>', $datos_grid[$d][$periodo]['fechas']);
            }
            $html_reporte .= '<td class="celda-valor" style="font-size: 6px;">' . $fechas_html . '</td>';
        }
    }

    $html_reporte .= '</tr>';

    // FILA ADICIONAL PARA MOSTRAR OBSERVACIONES
    $html_reporte .= '<tr>';
    $html_reporte .= '<td class="celda-parametro" colspan="2" style="background-color: #FFE5CC; font-weight: bold;">OBSERVACIONES</td>';

    for($d = 0; $d < 5; $d++) {
        foreach(array('AM', 'PM', 'HS') as $periodo) {
            $obs_html = '';
            if(!empty($datos_grid[$d][$periodo]['observaciones'])) {
                $obs_html = implode('<br>', $datos_grid[$d][$periodo]['observaciones']);
            }
            $html_reporte .= '<td class="celda-valor" style="font-size: 6px; text-align: left;">' . $obs_html . '</td>';
        }
    }

    $html_reporte .= '</tr>';

    $html_reporte .= '
        </tbody>
    </table>';

    // SECCIÓN D: MEDICAMENTOS ADMINISTRADOS
    $html_reporte .= '
    <table class="tabla-datos">
        <tr>
            <td class="titulo-azul" colspan="4">D. MEDICAMENTOS ADMINISTRADOS</td>
        </tr>
        <tr>
            <td class="etiqueta-campo">Medicamentos Administrados:</td>
            <td class="celda-dato" colspan="3" style="text-align: left;">' . nl2br(htmlspecialchars($anam_medicamentos)) . '</td>
        </tr>
        <tr>
            <td class="etiqueta-campo">Posición:</td>
            <td class="celda-dato" style="text-align: left;">' . htmlspecialchars($anam_posicion) . '</td>
            <td class="etiqueta-campo">Oxígeno Lt/min:</td>
            <td class="celda-dato" style="text-align: left;">' . htmlspecialchars($anam_oxigeno) . '</td>
        </tr>
    </table>';

    // SECCIÓN E: NOTAS DE ENFERMERÍA
    $html_reporte .= '
    <table class="tabla-datos">
        <tr>
            <td class="titulo-azul">E. NOTAS DE ENFERMERÍA</td>
        </tr>
        <tr>
            <td class="celda-dato" style="text-align: left; padding: 10px;">' . nl2br(htmlspecialchars($anam_notasenfermeria)) . '</td>
        </tr>
    </table>';

    // SECCIÓN DE LÍQUIDOS ADMINISTRADOS
    $html_reporte .= '
    <table class="tabla-datos">
        <tr>
            <td class="titulo-azul">F. LÍQUIDOS ADMINISTRADOS</td>
        </tr>
    </table>
    
    <table class="tabla-liquidos">
        <thead>
            <tr>
                <th width="15%">HORA</th>
                <th width="30%">TIPO</th>
                <th width="20%">CANTIDAD</th>
                <th width="20%">RESPONSABLE</th>
                <th width="15%">FECHA REGISTRO</th>
            </tr>
        </thead>
        <tbody>';

    $hay_liq_admin = false;
    if($rs_liq_admin && !$rs_liq_admin->EOF) {
        while (!$rs_liq_admin->EOF) {
            $hay_liq_admin = true;

            $hora = htmlspecialchars($rs_liq_admin->fields["srladm_hora"]);
            $tipo = htmlspecialchars($rs_liq_admin->fields["tipo_nombre"]);
            $cantidad = htmlspecialchars($rs_liq_admin->fields["srladm_cantidad"]);
            $fecha_registro = $rs_liq_admin->fields["srladm_fecharegistro"];

            $nombre_usuario = trim($rs_liq_admin->fields["usua_nombre"].' '.$rs_liq_admin->fields["usua_apellido"]);

            $html_reporte .= '
            <tr>
                <td>' . $hora . '</td>
                <td>' . $tipo . '</td>
                <td>' . $cantidad . '</td>
                <td>' . $nombre_usuario . '</td>
                <td style="text-align: center;">' . ($fecha_registro && $fecha_registro != '0000-00-00 00:00:00' ? date("d/m/Y H:i", strtotime($fecha_registro)) : '-') . '</td>
            </tr>';

            $rs_liq_admin->MoveNext();
        }
    }

    if(!$hay_liq_admin) {
        $html_reporte .= '
        <tr>
            <td colspan="5" class="sin-datos">No hay registros de líquidos administrados</td>
        </tr>';
    }

    $html_reporte .= '</tbody></table>';

    // SECCIÓN DE LÍQUIDOS ELIMINADOS
    $html_reporte .= '
    <table class="tabla-datos">
        <tr>
            <td class="titulo-azul">G. LÍQUIDOS ELIMINADOS</td>
        </tr>
    </table>
    
    <table class="tabla-liquidos">
        <thead>
            <tr>
                <th width="15%">HORA</th>
                <th width="30%">TIPO</th>
                <th width="20%">CANTIDAD</th>
                <th width="20%">RESPONSABLE</th>
                <th width="15%">FECHA REGISTRO</th>
            </tr>
        </thead>
        <tbody>';

    $hay_liq_elim = false;
    if($rs_liq_elim && !$rs_liq_elim->EOF) {
        while (!$rs_liq_elim->EOF) {
            $hay_liq_elim = true;

            $hora = htmlspecialchars($rs_liq_elim->fields["srleli_hora"]);
            $tipo = htmlspecialchars($rs_liq_elim->fields["tipo_nombre"]);
            $cantidad = htmlspecialchars($rs_liq_elim->fields["srleli_cantidad"]);
            $fecha_registro = $rs_liq_elim->fields["srleli_fecharegistro"];

            $nombre_usuario = trim($rs_liq_elim->fields["usua_nombre"].' '.$rs_liq_elim->fields["usua_apellido"]);

            $html_reporte .= '
            <tr>
                <td>' . $hora . '</td>
                <td>' . $tipo . '</td>
                <td>' . $cantidad . '</td>
                <td>' . $nombre_usuario . '</td>
                <td style="text-align: center;">' . ($fecha_registro && $fecha_registro != '0000-00-00 00:00:00' ? date("d/m/Y H:i", strtotime($fecha_registro)) : '-') . '</td>
            </tr>';

            $rs_liq_elim->MoveNext();
        }
    }

    if(!$hay_liq_elim) {
        $html_reporte .= '
        <tr>
            <td colspan="5" class="sin-datos">No hay registros de líquidos eliminados</td>
        </tr>';
    }

    $html_reporte .= '
        </tbody>
    </table>
    
    <div class="footer">
        <p>'.$emp_piedepagina.'</p>
        <p>Este documento contiene información médica confidencial del paciente</p>
    </div>
    </body>
    </html>';

    // Generar PDF
    $dompdf = new DOMPDF();
    $dompdf->set_paper('A4');
    $dompdf->load_html($html_reporte, 'UTF-8');
    $dompdf->render();

    // Agregar numeración de páginas
    $canvas = $dompdf->get_canvas();
    $font = Font_Metrics::get_font("helvetica", "normal");
    $canvas->page_text(750, 560, "Página {PAGE_NUM} de {PAGE_COUNT}", $font, 7, array(0,0,0));

    // Descargar PDF
    $separa_fecha_hora = explode(" ", date("Y-m-d H:i:s"));
    $nombre_archivo = "SalaRecuperacion_".$hc."_".$separa_fecha_hora[0].".pdf";
    $dompdf->stream($nombre_archivo, array("Attachment" => false));
}
?>