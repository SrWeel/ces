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
    $enc_id=$pVar4; // ID de la encuesta

    $director='../';
    include("../cfg/clases.php");
    include("../cfg/declaracion.php");

    $objformulario= new ValidacionesFormulario();

    // Obtener datos de la encuesta
    $sql_encuesta = "SELECT * FROM dns_encuesta WHERE enc_id = ?";
    $rs_encuesta = $DB_gogess->executec($sql_encuesta, array($enc_id));

    if($rs_encuesta && !$rs_encuesta->EOF) {
        $enc_cedula = $rs_encuesta->fields["enc_cedula"];
        $enc_paciente = $rs_encuesta->fields["enc_paciente"];
        $enc_institucion = $rs_encuesta->fields["enc_institucion"];
        $enc_otros = $rs_encuesta->fields["enc_otros"];
        $enc_tiempo = $rs_encuesta->fields["enc_tiempo"];
        $enc_tratante = $rs_encuesta->fields["enc_tratante"];
        $enc_residente = $rs_encuesta->fields["enc_residente"];
        $enc_enfermeras = $rs_encuesta->fields["enc_enfermeras"];
        $enc_administrativos = $rs_encuesta->fields["enc_administrativos"];
        $enc_laboratorio = $rs_encuesta->fields["enc_laboratorio"];
        $enc_imagen = $rs_encuesta->fields["enc_imagen"];
        $enc_mantenimiento = $rs_encuesta->fields["enc_mantenimiento"];
        $enc_deberes = $rs_encuesta->fields["enc_deberes"];
        $enc_conocemedico = $rs_encuesta->fields["enc_conocemedico"];
        $enc_infoclara = $rs_encuesta->fields["enc_infoclara"];
        $enc_consentimiento = $rs_encuesta->fields["enc_consentimiento"];
        $enc_explicacion = $rs_encuesta->fields["enc_explicacion"];
        $enc_ayuda = $rs_encuesta->fields["enc_ayuda"];
        $enc_cuidados = $rs_encuesta->fields["enc_cuidados"];
        $enc_control = $rs_encuesta->fields["enc_control"];
        $enc_pago = $rs_encuesta->fields["enc_pago"];
        $enc_recomendacion = $rs_encuesta->fields["enc_recomendacion"];
        $enc_porqueno = $rs_encuesta->fields["enc_porqueno"];
        $enc_alimentacion = $rs_encuesta->fields["enc_alimentacion"];
        $enc_limpieza = $rs_encuesta->fields["enc_limpieza"];
        $enc_iluminacion = $rs_encuesta->fields["enc_iluminacion"];
        $enc_senalizacion = $rs_encuesta->fields["enc_senalizacion"];
        $enc_queja = $rs_encuesta->fields["enc_queja"];
        $enc_sugerencia = $rs_encuesta->fields["enc_sugerencia"];
        $convepr_id = $rs_encuesta->fields["convepr_id"];
        $usua_id = $rs_encuesta->fields["usua_id"];
        $enc_fecharegistro = $rs_encuesta->fields["enc_fecharegistro"];
    }

    // Obtener datos del cliente
    $datos_cliente="SELECT * FROM app_cliente WHERE clie_id=?";
    $rs_dcliente = $DB_gogess->executec($datos_cliente,array($clie_id));

    $nombre_paciente=$rs_dcliente->fields["clie_nombre"];
    $apellido_paciente=$rs_dcliente->fields["clie_apellido"];
    $clie_direccion=$rs_dcliente->fields["clie_direccion"];
    $clie_telefono=$rs_dcliente->fields["clie_telefono"];
    $clie_celular=$rs_dcliente->fields["clie_celular"];
    $clie_rucci=$rs_dcliente->fields["clie_rucci"];

    // Obtener datos del centro
    $nomb_centro=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre","where centro_id=",1,$DB_gogess);
    $uni_codiog=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_codigo","where centro_id=",1,$DB_gogess);

    // Calcular edad
    $edad_texto = '';
    $diferencia = null;
    $clie_fechanacimiento=$rs_dcliente->fields["clie_fechanacimiento"];
    $clie_genero=$rs_dcliente->fields["clie_genero"];

    if($clie_fechanacimiento && $clie_fechanacimiento != '0000-00-00') {
        $fecha_nac = new DateTime($clie_fechanacimiento);
        $fecha_actual = new DateTime();
        $diferencia = $fecha_actual->diff($fecha_nac);

        if($diferencia->y > 0) {
            $edad_texto = $diferencia->y;
        } elseif($diferencia->m > 0) {
            $edad_texto = $diferencia->m;
        } else {
            $edad_texto = $diferencia->d;
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

    // Obtener logo y datos de la empresa
    $logo = $objformulario->replace_cmb("app_empresa", "emp_id,emp_logoreporte", "where emp_id=", 1, $DB_gogess);
    $emp_nombre = $objformulario->replace_cmb("app_empresa", "emp_id,emp_nombre", "where emp_id=", 1, $DB_gogess);
    $emp_piedepagina = $objformulario->replace_cmb("app_empresa", "emp_id,emp_piedepagina", "where emp_id=", 1, $DB_gogess);

    // Obtener nombre de la institución
    $institucion_nombre = '';
    switch($enc_institucion) {
        case 1: $institucion_nombre = 'MSP'; break;
        case 2: $institucion_nombre = 'IESS'; break;
        case 3: $institucion_nombre = 'ISSFA'; break;
        case 4: $institucion_nombre = 'ISSPOL'; break;
        default: $institucion_nombre = $enc_otros;
    }

    // Función para checkbox
    function getCheckbox($valor) {
        return $valor == 1 ? 'X' : '';
    }

    // Función para opciones de tiempo
    function getTiempoCheckbox($enc_tiempo, $opcion) {
        return $enc_tiempo == $opcion ? 'X' : '';
    }

    // Función para calificación de trato
    function getCalificacionTrato($valor) {
        $calificaciones = [
            1 => ['muy_bueno' => 'X', 'bueno' => '', 'regular' => '', 'malo' => ''],
            2 => ['muy_bueno' => '', 'bueno' => 'X', 'regular' => '', 'malo' => ''],
            3 => ['muy_bueno' => '', 'bueno' => '', 'regular' => 'X', 'malo' => ''],
            4 => ['muy_bueno' => '', 'bueno' => '', 'regular' => '', 'malo' => 'X'],
        ];
        return isset($calificaciones[$valor]) ? $calificaciones[$valor] : ['muy_bueno' => '', 'bueno' => '', 'regular' => '', 'malo' => ''];
    }

    // Función para SI/NO
    function getSiNo($valor) {
        return [
            'si' => $valor == 1 ? 'X' : '',
            'no' => $valor == 0 ? 'X' : ''
        ];
    }

    // HTML DE GENERACIÓN - PÁGINA 1
    $html_reporte = '
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <style>
            body 
            { 
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
            
            .tabla-calificacion {
                width: 100%;
                border-collapse: collapse;
                margin-top: 5px;
            }
            .tabla-calificacion td, .tabla-calificacion th {
                border: 1px solid #000;
                padding: 3px;
                text-align: center;
                font-size: 7px;
            }
            .tabla-calificacion th {
                background-color: #CCFFCC;
                color: black;
                font-weight: bold;
            }
            .pregunta-row {
                text-align: left;
                padding-left: 5px !important;
            }
            .footer {
                margin-top: 15px;
                font-size: 7px;
                text-align: center;
                color: #666;
                border-top: 1px solid #ccc;
                padding-top: 5px;
            }
            .page-break {
                page-break-after: always;
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
                    <div class="subtitulo">ENCUESTA DE SATISFACCIÓN DEL PACIENTE</div>
                </td>
                <td class="codigo-cell">
                    <strong>N° ENCUESTA:</strong><br>' . $enc_id. '
                </td>
            </tr>
    </table>

    <!-- DATOS DEL ESTABLECIMIENTO Y PACIENTE -->
    <table class="tabla-datos">
            <tr>
                <td class="titulo-azul" colspan="8">A. DATOS DEL ESTABLECIMIENTO DE SALUD Y USUARIO / PACIENTE</td>
            </tr>
            <tr>
                <td class="encabezado-verde" colspan="2">INSTITUCIÓN DEL SISTEMA</td>
                <td class="encabezado-verde">UNICÓDIGO</td>
                <td class="encabezado-verde" colspan="2">ESTABLECIMIENTO DE SALUD</td>
                <td class="encabezado-verde">CÉDULA</td>
                <td class="encabezado-verde">PARENTESCO</td>
                <td class="encabezado-verde">N° ENCUESTA</td>
            </tr>
            <tr>
                <td class="celda-dato" colspan="2">' . $nomb_centro . '</td>
                <td class="celda-dato">' . $uni_codiog . '</td>
                <td class="celda-dato" colspan="2">' . $nomb_centro . '</td>
                <td class="celda-dato">' . htmlspecialchars($enc_cedula) . '</td>
                <td class="celda-dato">' . htmlspecialchars($enc_paciente) . '</td>
                <td class="celda-dato">' . $enc_id . '</td>
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
            <tr>
                <td class="encabezado-verde" colspan="2">DIRECCIÓN DOMICILIO</td>
                <td class="encabezado-verde" colspan="2">TELÉFONO</td>
                <td class="encabezado-verde" colspan="2">CELULAR</td>
                <td class="encabezado-verde" colspan="2">FECHA REGISTRO</td>
            </tr>
            <tr>
                <td class="celda-dato" colspan="2">' . htmlspecialchars($clie_direccion) . '</td>
                <td class="celda-dato" colspan="2">' . htmlspecialchars($clie_telefono) . '</td>
                <td class="celda-dato" colspan="2">' . htmlspecialchars($clie_celular) . '</td>
                <td class="celda-dato" colspan="2">' . date("d/m/Y H:i", strtotime($enc_fecharegistro)) . '</td>
            </tr>
    </table>

    <!-- INSTITUCIÓN -->
    <table class="tabla-datos">
        <tr>
            <td class="titulo-azul" colspan="6">INSTITUCIÓN A LA QUE PERTENECE</td>
        </tr>
        <tr>
            <td class="encabezado-verde" width="10%">MSP</td>
            <td class="encabezado-verde" width="10%">IESS</td>
            <td class="encabezado-verde" width="10%">ISSFA</td>
            <td class="encabezado-verde" width="10%">ISSPOL</td>
            <td class="encabezado-verde" width="20%">OTROS</td>
            <td class="encabezado-verde" width="40%">ESPECIFIQUE</td>
        </tr>
        <tr>
            <td class="celda-dato">' . getCheckbox($enc_institucion == 1) . '</td>
            <td class="celda-dato">' . getCheckbox($enc_institucion == 2) . '</td>
            <td class="celda-dato">' . getCheckbox($enc_institucion == 3) . '</td>
            <td class="celda-dato">' . getCheckbox($enc_institucion == 4) . '</td>
            <td class="celda-dato">' . getCheckbox($enc_institucion == 5) . '</td>
            <td class="celda-dato">' . htmlspecialchars($enc_otros) . '</td>
        </tr>
    </table>

    <!-- TIEMPO DE ESPERA -->
    <table class="tabla-datos">
        <tr>
            <td class="titulo-azul" colspan="4">EL TIEMPO QUE TUVO QUE ESPERAR HASTA QUE LE ASIGNEN CAMA FUE</td>
        </tr>
        <tr>
            <td class="encabezado-verde" width="25%">MENOS DE 30 MIN</td>
            <td class="encabezado-verde" width="25%">DE 30 A 60 MIN</td>
            <td class="encabezado-verde" width="25%">MÁS DE 60 MIN</td>
            <td class="encabezado-verde" width="25%">OTROS</td>
        </tr>
        <tr>
            <td class="celda-dato">' . getTiempoCheckbox($enc_tiempo, 1) . '</td>
            <td class="celda-dato">' . getTiempoCheckbox($enc_tiempo, 2) . '</td>
            <td class="celda-dato">' . getTiempoCheckbox($enc_tiempo, 3) . '</td>
            <td class="celda-dato">' . getTiempoCheckbox($enc_tiempo, 4) . '</td>
        </tr>
    </table>

    <!-- CALIFICACIÓN DEL TRATO -->';

    $personal = [
        ['label' => 'MÉDICO TRATANTE', 'valor' => $enc_tratante],
        ['label' => 'MÉDICO RESIDENTE', 'valor' => $enc_residente],
        ['label' => 'ENFERMERAS', 'valor' => $enc_enfermeras],
        ['label' => 'ADMINISTRATIVOS', 'valor' => $enc_administrativos],
        ['label' => 'LABORATORIO', 'valor' => $enc_laboratorio],
        ['label' => 'IMAGEN', 'valor' => $enc_imagen],
        ['label' => 'MANTENIMIENTO', 'valor' => $enc_mantenimiento]
    ];

    $html_reporte .= '
    <table class="tabla-calificacion">
        <tr>
            <td colspan="5" class="titulo-azul">B. CÓMO CALIFICA EL TRATO DEL PERSONAL DE LA CASA DE SALUD</td>
        </tr>
        <tr>
            <th width="40%">TRATO</th>
            <th width="15%">MUY BUENO</th>
            <th width="15%">BUENO</th>
            <th width="15%">REGULAR</th>
            <th width="15%">MALO</th>
        </tr>';

    foreach($personal as $item) {
        $cal = getCalificacionTrato($item['valor']);
        $html_reporte .= '
        <tr>
            <td class="pregunta-row">' . $item['label'] . '</td>
            <td>' . $cal['muy_bueno'] . '</td>
            <td>' . $cal['bueno'] . '</td>
            <td>' . $cal['regular'] . '</td>
            <td>' . $cal['malo'] . '</td>
        </tr>';
    }

    $html_reporte .= '
    </table>';

    // INFORMACIÓN RECIBIDA
    $preguntas_info = [
        ['label' => 'LE COMUNICARON SOBRE SUS DEBERES Y DERECHOS COMO PACIENTE', 'valor' => $enc_deberes],
        ['label' => 'CONOCE EL NOMBRE DE SU MÉDICO TRATANTE', 'valor' => $enc_conocemedico],
        ['label' => 'LE DIERON INFORMACIÓN CLARA SOBRE PROCEDIMIENTO QUE LE REALIZARÁN', 'valor' => $enc_infoclara],
        ['label' => 'USTED DIO SU CONSENTIMIENTO PARA LA REALIZACIÓN DE LOS PROCEDIMIENTOS', 'valor' => $enc_consentimiento],
        ['label' => 'LAS EXPLICACIONES QUE LE DIO EL MÉDICO SATISFACIERON SUS INQUIETUDES', 'valor' => $enc_explicacion],
        ['label' => 'CUANDO SOLICITÓ AYUDA LA RESPUESTA FUE OPORTUNA', 'valor' => $enc_ayuda],
        ['label' => 'LE INFORMARON LOS CUIDADOS A SEGUIR EN CASA', 'valor' => $enc_cuidados],
        ['label' => 'LE INFORMARON CUÁNDO Y DÓNDE REGRESAR A CONTROL', 'valor' => $enc_control],
        ['label' => 'LE PIDIERON PAGO POR ALGÚN SERVICIO MIENTRAS ESTUVO HOSPITALIZADO', 'valor' => $enc_pago]
    ];

    $html_reporte .= '
    <table class="tabla-calificacion" style="margin-top: 10px;">
        <tr>
            <td colspan="3" class="titulo-azul">C. CÓMO FUE LA INFORMACIÓN QUE RECIBIÓ</td>
        </tr>
        <tr>
            <th width="70%">INFORMACIÓN RECIBIDA</th>
            <th width="15%">SÍ</th>
            <th width="15%">NO</th>
        </tr>';

    foreach($preguntas_info as $pregunta) {
        $respuesta = getSiNo($pregunta['valor']);
        $html_reporte .= '
        <tr>
            <td class="pregunta-row">' . $pregunta['label'] . '</td>
            <td>' . $respuesta['si'] . '</td>
            <td>' . $respuesta['no'] . '</td>
        </tr>';
    }

    $html_reporte .= '
    </table>
    
    <div class="page-break"></div>
    
    <!-- PÁGINA 2 -->
    <table class="header-tabla">
            <tr>
                <td class="logo-cell">
                    <img src="../archivo/' . $logo . '" alt="Logo">
                </td>
                <td class="titulo-cell">
                    <div class="titulo-principal">' . $emp_nombre . '</div>
                    <div class="subtitulo">ENCUESTA DE SATISFACCIÓN DEL PACIENTE (Página 2)</div>
                </td>
                <td class="codigo-cell">
                    <strong>N° ENCUESTA:</strong><br>' . $enc_id. '
                </td>
            </tr>
    </table>';

    // RECOMENDACIÓN
    $respuesta_rec = getSiNo($enc_recomendacion);
    $html_reporte .= '
    <table class="tabla-datos">
        <tr>
            <td class="titulo-azul" colspan="3">D. ¿RECOMENDARÍA ESTA CASA DE SALUD?</td>
        </tr>
        <tr>
            <td class="encabezado-verde" width="15%">SÍ</td>
            <td class="encabezado-verde" width="15%">NO</td>
            <td class="encabezado-verde" width="70%">SI LA RESPUESTA ES NO, ¿POR QUÉ?</td>
        </tr>
        <tr>
            <td class="celda-dato">' . $respuesta_rec['si'] . '</td>
            <td class="celda-dato">' . $respuesta_rec['no'] . '</td>
            <td class="celda-dato" style="text-align: left; padding-left: 5px;">' . nl2br(htmlspecialchars($enc_porqueno)) . '</td>
        </tr>
    </table>';

    // SERVICIOS GENERALES
    $servicios = [
        ['label' => 'ALIMENTACIÓN', 'valor' => $enc_alimentacion],
        ['label' => 'LIMPIEZA', 'valor' => $enc_limpieza],
        ['label' => 'ILUMINACIÓN', 'valor' => $enc_iluminacion],
        ['label' => 'SEÑALIZACIÓN', 'valor' => $enc_senalizacion]
    ];

    $html_reporte .= '
    <table class="tabla-calificacion" style="margin-top: 10px;">
        <tr>
            <td colspan="5" class="titulo-azul">E. EN GENERAL CÓMO CALIFICA EL CONFORT Y CALIDAD DE LOS SERVICIOS GENERALES</td>
        </tr>
        <tr>
            <th width="40%">SERVICIO</th>
            <th width="15%">MUY BUENO</th>
            <th width="15%">BUENO</th>
            <th width="15%">REGULAR</th>
            <th width="15%">MALO</th>
        </tr>';

    foreach($servicios as $item) {
        $cal = getCalificacionTrato($item['valor']);
        $html_reporte .= '
        <tr>
            <td class="pregunta-row">' . $item['label'] . '</td>
            <td>' . $cal['muy_bueno'] . '</td>
            <td>' . $cal['bueno'] . '</td>
            <td>' . $cal['regular'] . '</td>
            <td>' . $cal['malo'] . '</td>
        </tr>';
    }

    $html_reporte .= '
    </table>';

    // QUEJA Y SUGERENCIA
    $html_reporte .= '
    <table class="tabla-datos" style="margin-top: 10px;">
        <tr>
            <td class="titulo-azul" colspan="2">F. QUEJAS, RECLAMOS Y SUGERENCIAS</td>
        </tr>
        <tr>
            <td class="encabezado-verde" colspan="2">QUEJA O RECLAMO</td>
        </tr>
        <tr>
            <td colspan="2" style="min-height: 50px; text-align: left; padding: 5px;">' . nl2br(htmlspecialchars($enc_queja)) . '</td>
        </tr>
        <tr>
            <td class="encabezado-verde" colspan="2">SUGERENCIA</td>
        </tr>
        <tr>
            <td colspan="2" style="min-height: 50px; text-align: left; padding: 5px;">' . nl2br(htmlspecialchars($enc_sugerencia)) . '</td>
        </tr>
        <tr>
            <td class="encabezado-verde" width="50%">FIRMA DEL PACIENTE</td>
            <td class="encabezado-verde" width="50%">FECHA DE REGISTRO</td>
        </tr>
        <tr>
            <td style="min-height: 40px;"></td>
            <td class="celda-dato">' . date("d/m/Y H:i", strtotime($enc_fecharegistro)) . '</td>
        </tr>
    </table>

    <div class="footer">
        <p>'.$emp_piedepagina.'</p>
        <p>Gracias por su colaboración en esta encuesta</p>
    </div>
    </body>
    </html>
    ';

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
    $nombre_archivo = "encuesta_satisfaccion_".$enc_id."_".$separa_fecha_hora[0].".pdf";
    $dompdf->stream($nombre_archivo, array("Attachment" => false));
}
?>