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
    $enferm_id=$separa_campos[1];

    $director='../';
    include("../cfg/clases.php");
    include("../cfg/declaracion.php");

    $objformulario= new ValidacionesFormulario();

    // PASO 1: Obtener el enferm_enlace desde dns_enfermeria
    $sql_enfermeria = "SELECT enferm_enlace FROM dns_enfermeria WHERE enferm_id = ?";
    $rs_enfermeria = $DB_gogess->executec($sql_enfermeria, array($enferm_id));

    $enferm_enlace = '';
    if($rs_enfermeria && !$rs_enfermeria->EOF) {
        $enferm_enlace = $rs_enfermeria->fields["enferm_enlace"];
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

    // CONSULTA DE CONSTANTES VITALES
    $sql_constantes = "
        SELECT 
            cv.*,
            u.usua_nombre, 
            u.usua_apellido, 
            u.usua_codigo, 
            u.usua_codigoiniciales
        FROM cesdb_arextension.dns_gridconstantesvitales AS cv
        LEFT JOIN cesdb_aroriginal.app_usuario AS u 
               ON cv.usua_id = u.usua_id
        WHERE cv.enferm_enlace = ?
        ORDER BY cv.gconsv_fecharegistro ASC
    ";
    $rs_constantes = $DB_gogess->executec($sql_constantes, array($enferm_enlace));

    // CONSULTA DE INGESTA
    $sql_ingesta = "
        SELECT 
            gi.ginge_id, 
            gi.ginge_detalle,
            gi.ginge_fecharegistro,
            i.inge_descripcion,
            u.usua_nombre, 
            u.usua_apellido, 
            u.usua_codigo, 
            u.usua_codigoiniciales
        FROM cesdb_arextension.dns_gridingesta AS gi
        LEFT JOIN cesdb_arcombos.dns_ingesta AS i 
               ON gi.ginge_ingesta = i.inge_id
        LEFT JOIN cesdb_aroriginal.app_usuario AS u 
               ON gi.usua_id = u.usua_id
        WHERE gi.enferm_enlace = ?
        ORDER BY gi.ginge_fecharegistro DESC
    ";
    $rs_ingesta = $DB_gogess->executec($sql_ingesta, array($enferm_enlace));

    // CONSULTA DE ELIMINACIÓN
    $sql_eliminacion = "
        SELECT 
            ge.geli_id, 
            ge.geli_detalle,
            ge.geli_fecharegistro,
            e.eli_descripcion,
            u.usua_nombre, 
            u.usua_apellido, 
            u.usua_codigo, 
            u.usua_codigoiniciales
        FROM cesdb_arextension.dns_grideliminacion AS ge
        LEFT JOIN cesdb_arcombos.dns_eliminacion AS e 
               ON ge.geli_eliminacion = e.eli_id
        LEFT JOIN cesdb_aroriginal.app_usuario AS u 
               ON ge.usua_id = u.usua_id
        WHERE ge.enferm_enlace = ?
        ORDER BY ge.geli_fecharegistro DESC
    ";
    $rs_eliminacion = $DB_gogess->executec($sql_eliminacion, array($enferm_enlace));

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
            
            /* TABLA BALANCE HÍDRICO CON TÍTULOS VERTICALES ROTADOS */
            .tabla-balance-hidrico {
                width: 100%;
                border-collapse: collapse;
                margin-top: 10px;
                table-layout: fixed;
            }
            
            .titulo-vertical-rotado {
                background-color: #CCFFCC;
                border: 1px solid #000;
                width: 20px;
                height: 150px;
                text-align: center;
                vertical-align: middle;
                padding: 5px 2px;
            }

            .titulo-vertical-rotado .texto-rotado {
                transform: rotate(270deg);
                white-space: nowrap;
                font-weight: bold;
                font-size: 9px;
                display: inline-block;
            }
        
            .seccion-contenido {
                vertical-align: top;
                padding: 0;
                border: 1px solid #000;
            }
            
            .tabla-interna {
                width: 100%;
                border-collapse: collapse;
            }
            
            .tabla-interna th {
                background-color: #e9ecef;
                color: black;
                padding: 4px 3px;
                text-align: left;
                border: 1px solid #000;
                font-size: 7px;
                font-weight: bold;
            }
            
            .tabla-interna td {
                padding: 4px 3px;
                border: 1px solid #000;
                font-size: 7px;
            }
            
            .sin-datos {
                text-align: center;
                padding: 10px;
                color: #999;
                font-style: italic;
                font-size: 7px;
            }
            
            .usuario-info {
                font-size: 6px;
                color: #666;
                font-style: italic;
                margin-top: 2px;
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
                    <div class="subtitulo">CONSTANTES VITALES Y BALANCE HÍDRICO</div>
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
                <td class="celda-dato" colspan="2">' . $nomb_centro . '</td>
                <td class="celda-dato">' . $uni_codiog . '</td>
                <td class="celda-dato" colspan="2">' . $nomb_centro . '</td>
                <td class="celda-dato">' . $hc . '</td>
                <td class="celda-dato">-</td>
                <td class="celda-dato">' . $clie_rucci . '</td>
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
                <td class="celda-dato">' . $primer_apellido . '</td>
                <td class="celda-dato">' . $segundo_apellido . '</td>
                <td class="celda-dato">' . $primer_nombre . '</td>
                <td class="celda-dato">' . $segundo_nombre . '</td>
                <td class="celda-dato">' . $valor_sexo . '</td>
                <td class="celda-dato">' . ($clie_fechanacimiento != '0000-00-00' ? date("d/m/Y", strtotime($clie_fechanacimiento)) : '-') . '</td>
                <td class="celda-dato">' . $edad_texto . '</td>
                <td class="celda-dato">' . ($diferencia && $diferencia->y > 0 ? 'AÑOS' : ($diferencia && $diferencia->m > 0 ? 'MESES' : 'DÍAS')) . '</td>
            </tr>
        </table>';

    // SECCIÓN B: CONSTANTES VITALES - 7 DÍAS CON 3 COLUMNAS CADA UNO (AM, PM, HS)
    $html_reporte .= '
        <table class="tabla-datos">
            <tr>
                <td class="titulo-azul">B. CONSTANTES VITALES</td>
            </tr>
        </table>
        
        <table class="tabla-grafica-constantes">
            <thead>
                <tr>
                    <th>PULSO</th>
                    <th>TEMPERATURA</th>
                    <th>HORA</th>';

    // Generar encabezados de días (DÍA 1 a DÍA 7) con 3 columnas cada uno
    $dias_nombres = array('DÍA 1', 'DÍA 2', 'DÍA 3', 'DÍA 4', 'DÍA 5', 'DÍA 6', 'DÍA 7');
    foreach($dias_nombres as $dia_nombre) {
        $html_reporte .= '<th colspan="3">' . $dia_nombre . '</th>';
    }

    $html_reporte .= '
                </tr>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>';

    // Generar sub-encabezados AM, PM, HS para cada día
    for ($dia = 0; $dia < 7; $dia++) {
        $html_reporte .= '<th>AM</th>';
        $html_reporte .= '<th>PM</th>';
        $html_reporte .= '<th>HS</th>';
    }

    $html_reporte .= '
                </tr>
            </thead>
            <tbody>';

    // Estructura de datos: [dia][periodo] = array de valores
    // periodo: 0=AM (06:00-11:59), 1=PM (12:00-19:59), 2=HS (20:00-05:59)
    $datos_por_dia_periodo = array();
    for($d = 0; $d < 7; $d++) {
        $datos_por_dia_periodo[$d] = array(
            'AM' => array('temperatura' => '', 'fc' => '', 'fr' => '', 'pa' => '', 'sat_o2' => '', 'peso' => '', 'talla' => ''),
            'PM' => array('temperatura' => '', 'fc' => '', 'fr' => '', 'pa' => '', 'sat_o2' => '', 'peso' => '', 'talla' => ''),
            'HS' => array('temperatura' => '', 'fc' => '', 'fr' => '', 'pa' => '', 'sat_o2' => '', 'peso' => '', 'talla' => '')
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

    // Llenar datos existentes
    if($rs_constantes && !$rs_constantes->EOF) {
        $fecha_inicio = null;

        while (!$rs_constantes->EOF) {
            $fecha_registro = $rs_constantes->fields["gconsv_fecharegistro"];
            if($fecha_registro && $fecha_registro != '0000-00-00 00:00:00') {
                $dt = new DateTime($fecha_registro);

                // Establecer fecha de inicio si es el primer registro
                if($fecha_inicio === null) {
                    $fecha_inicio = clone $dt;
                    $fecha_inicio->setTime(0, 0, 0);
                }

                // Calcular días desde el inicio
                $fecha_actual_sin_hora = clone $dt;
                $fecha_actual_sin_hora->setTime(0, 0, 0);
                $diff = $fecha_inicio->diff($fecha_actual_sin_hora);
                $dia = $diff->days;

                // Solo procesar si está dentro de los 7 días
                if($dia >= 0 && $dia < 7) {
                    $hora = (int)$dt->format('H');
                    $periodo = obtener_periodo($hora);

                    // Si ya hay datos en ese período, no sobreescribir (mantener el primero)
                    if(empty($datos_por_dia_periodo[$dia][$periodo]['temperatura'])) {
                        $datos_por_dia_periodo[$dia][$periodo]['temperatura'] = $rs_constantes->fields["gconsv_temperatura"] ?? '';
                        $datos_por_dia_periodo[$dia][$periodo]['fc'] = $rs_constantes->fields["gconsv_frecuenciacardiaca"] ?? '';
                        $datos_por_dia_periodo[$dia][$periodo]['fr'] = $rs_constantes->fields["gconsv_frecuenciarespiratoria"] ?? '';
                        $datos_por_dia_periodo[$dia][$periodo]['pa'] = $rs_constantes->fields["gconsv_presionarterial"] ?? '';
                        $datos_por_dia_periodo[$dia][$periodo]['sat_o2'] = $rs_constantes->fields["gconsv_saturacionoxigeno"] ?? '';
                        $datos_por_dia_periodo[$dia][$periodo]['peso'] = $rs_constantes->fields["gconsv_peso"] ?? '';
                        $datos_por_dia_periodo[$dia][$periodo]['talla'] = $rs_constantes->fields["gconsv_talla"] ?? '';
                    }
                }
            }
            $rs_constantes->MoveNext();
        }
    }

    // Definir valores para columnas de PULSO y TEMPERATURA
    $valores_pulso = array(140, 130, 120, 110, 100, 90, 80, 70, 60, 50, 40);
    $valores_temperatura = array('', '', 42, 41, 40, 39, 38, 37, 36, 35, '');

    // Generar filas (11 filas para cubrir todos los valores)
    for($fila = 0; $fila < 11; $fila++) {
        $html_reporte .= '<tr>';

        // Columna PULSO
        $html_reporte .= '<td class="celda-parametro">' . $valores_pulso[$fila] . '</td>';

        // Columna TEMPERATURA
        $html_reporte .= '<td class="celda-parametro">' . $valores_temperatura[$fila] . '</td>';

        // Columna HORA (vacía)
        $html_reporte .= '<td class="celda-parametro"></td>';

        // Para cada día y cada período (AM, PM, HS) - celdas vacías para marcar valores
        for($d = 0; $d < 7; $d++) {
            foreach(array('AM', 'PM', 'HS') as $periodo) {
                $html_reporte .= '<td class="celda-valor"></td>';
            }
        }

        $html_reporte .= '</tr>';
    }

    $html_reporte .= '
            </tbody>
        </table>';

    // SECCIÓN D: BALANCE HÍDRICO CON TÍTULOS VERTICALES ROTADOS 90°
    $html_reporte .= '
        <table class="tabla-datos">
            <tr>
                <td class="titulo-azul">D. INGESTA, ELIMINACIÓN Y BALANCE HÍDRICO</td>
            </tr>
        </table>
        
        <table class="tabla-balance-hidrico">
            <tr>
                <td class="titulo-vertical-rotado">
                    <div class="texto-rotado">INGESTA</div>
                </td>
                <td class="seccion-contenido">';

    // Contenido de INGESTA
    $html_reporte .= '
                    <table class="tabla-interna">
                        <thead>
                            <tr>
                                <th width="25%">TIPO DE INGESTA</th>
                                <th width="40%">DETALLE</th>
                                <th width="20%">RESPONSABLE</th>
                                <th width="15%">FECHA/HORA</th>
                            </tr>
                        </thead>
                        <tbody>';

    $hay_ingesta = false;
    if($rs_ingesta && !$rs_ingesta->EOF) {
        while (!$rs_ingesta->EOF) {
            $hay_ingesta = true;
            $tipo_ingesta = htmlspecialchars($rs_ingesta->fields["inge_descripcion"]);
            $detalle = htmlspecialchars($rs_ingesta->fields["ginge_detalle"]);
            $fecha_registro = $rs_ingesta->fields["ginge_fecharegistro"];

            $nombre_usuario = trim($rs_ingesta->fields["usua_nombre"].' '.$rs_ingesta->fields["usua_apellido"]);
            $iniciales_usuario = $rs_ingesta->fields["usua_codigoiniciales"];

            $info_usuario = '';
            if($nombre_usuario && $nombre_usuario != ' ') {
                $info_usuario = '<strong>'.$nombre_usuario.'</strong>';
                if($iniciales_usuario) {
                    $info_usuario .= '<div class="usuario-info">'.$iniciales_usuario.'</div>';
                }
            }

            $html_reporte .= '
                            <tr>
                                <td><strong>'.$tipo_ingesta.'</strong></td>
                                <td>'.nl2br($detalle).'</td>
                                <td>'.$info_usuario.'</td>
                                <td style="text-align: center;">'.($fecha_registro && $fecha_registro != '0000-00-00 00:00:00' ? date("d/m/Y H:i", strtotime($fecha_registro)) : '-').'</td>
                            </tr>';

            $rs_ingesta->MoveNext();
        }
    }

    if(!$hay_ingesta) {
        $html_reporte .= '
                            <tr>
                                <td colspan="4" class="sin-datos">No hay registros de ingesta</td>
                            </tr>';
    }

    $html_reporte .= '
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="titulo-vertical-rotado">
                    <div class="texto-rotado">ELIMINACIÓN</div>
                </td>
                <td class="seccion-contenido">';

    // Contenido de ELIMINACIÓN
    $html_reporte .= '
                    <table class="tabla-interna">
                        <thead>
                            <tr>
                                <th width="25%">TIPO DE ELIMINACIÓN</th>
                                <th width="40%">DETALLE</th>
                                <th width="20%">RESPONSABLE</th>
                                <th width="15%">FECHA/HORA</th>
                            </tr>
                        </thead>
                        <tbody>';

    $hay_eliminacion = false;
    if($rs_eliminacion && !$rs_eliminacion->EOF) {
        while (!$rs_eliminacion->EOF) {
            $hay_eliminacion = true;
            $tipo_eliminacion = htmlspecialchars($rs_eliminacion->fields["eli_descripcion"]);
            $detalle = htmlspecialchars($rs_eliminacion->fields["geli_detalle"]);
            $fecha_registro = $rs_eliminacion->fields["geli_fecharegistro"];

            $nombre_usuario = trim($rs_eliminacion->fields["usua_nombre"].' '.$rs_eliminacion->fields["usua_apellido"]);
            $iniciales_usuario = $rs_eliminacion->fields["usua_codigoiniciales"];

            $info_usuario = '';
            if($nombre_usuario && $nombre_usuario != ' ') {
                $info_usuario = '<strong>'.$nombre_usuario.'</strong>';
                if($iniciales_usuario) {
                    $info_usuario .= '<div class="usuario-info">'.$iniciales_usuario.'</div>';
                }
            }

            $html_reporte .= '
                            <tr>
                                <td><strong>'.$tipo_eliminacion.'</strong></td>
                                <td>'.nl2br($detalle).'</td>
                                <td>'.$info_usuario.'</td>
                                <td style="text-align: center;">'.($fecha_registro && $fecha_registro != '0000-00-00 00:00:00' ? date("d/m/Y H:i", strtotime($fecha_registro)) : '-').'</td>
                            </tr>';

            $rs_eliminacion->MoveNext();
        }
    }

    if(!$hay_eliminacion) {
        $html_reporte .= '
                            <tr>
                                <td colspan="4" class="sin-datos">No hay registros de eliminación</td>
                            </tr>';
    }

    $html_reporte .= '
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>
        
        <div class="footer">
            <p>'.$emp_piedepagina.'</p>
            <p>Este documento contiene información médica confidencial del paciente</p>
        </div>
    </body>
    </html>';

    // Generar PDF
    $dompdf = new DOMPDF();
    $dompdf->set_paper('A4', 'landscape');
    $dompdf->load_html($html_reporte, 'UTF-8');
    $dompdf->render();

    // Agregar numeración de páginas
    $canvas = $dompdf->get_canvas();
    $font = Font_Metrics::get_font("helvetica", "normal");
    $canvas->page_text(750, 560, "Página {PAGE_NUM} de {PAGE_COUNT}", $font, 7, array(0,0,0));

    // Descargar PDF
    $separa_fecha_hora = explode(" ", date("Y-m-d H:i:s"));
    $nombre_archivo = "ConstantesVitales_BalanceHidrico_".$hc."_".$separa_fecha_hora[0].".pdf";
    $dompdf->stream($nombre_archivo, array("Attachment" => false));
}
?>