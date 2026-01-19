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
    if ($tags[$i]=='iddata' || $tags[$i]=='pVar2' || $tags[$i]=='pVar3' || $tags[$i]=='pVar4' || $tags[$i]=='pVar5') {
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

    $partop_id = isset($pVar5) ? $pVar5 : 0;
    $mnupan_id = isset($pVar3) ? $pVar3 : 0;

    $director='../';
    include("../cfg/clases.php");
    include("../cfg/declaracion.php");

    $objformulario = new ValidacionesFormulario();

    // Obtener datos del parte operatorio
    $sql_partop = "SELECT * FROM lpin_parteoperatorio WHERE partop_id = ?";
    $rs_partop = $DB_gogess->executec($sql_partop, array($partop_id));

    if(!$rs_partop || $rs_partop->EOF) {
        die("No se encontró el registro del parte operatorio");
    }

    // Extraer datos del parte operatorio
    $partop_sala = $rs_partop->fields["partop_sala"];
    $partop_fecha = $rs_partop->fields["partop_fecha"];
    $partop_hora = $rs_partop->fields["partop_hora"];
    $partop_hab = $rs_partop->fields["partop_hab"];
    $partop_paciente = $rs_partop->fields["partop_paciente"];
    $partop_edad = $rs_partop->fields["partop_edad"];
    $partop_procedimiento = $rs_partop->fields["partop_procedimiento"];
    $partop_cirujano = $rs_partop->fields["partop_cirujano"];
    $partop_ayudante = $rs_partop->fields["partop_ayudante"];
    $partop_descripcion = $rs_partop->fields["partop_descripcion"];
    $partop_tquirofano = $rs_partop->fields["partop_tquirofano"];
    $partop_anesteciologo = $rs_partop->fields["partop_anesteciologo"];
    $partop_teamqx = $rs_partop->fields["partop_teamqx"];
    $partop_destino = $rs_partop->fields["partop_destino"];
    $partop_observacion = $rs_partop->fields["partop_observacion"];
    $partop_cedula = $rs_partop->fields["partop_cedula"];
    $partop_fecharegistro = $rs_partop->fields["partop_fecharegistro"];

    // Buscar datos del paciente en app_cliente usando la cédula
    $nombre_paciente = '';
    $apellido_paciente = '';
    $clie_genero = '';
    $clie_fechanacimiento = '';
    $clie_rucci = $partop_cedula;
    $conve_id = 0;
    $hc = '';

    if(!empty($partop_cedula)) {
        $sql_cliente = "SELECT * FROM app_cliente WHERE clie_rucci = ?";
        $rs_cliente = $DB_gogess->executec($sql_cliente, array($partop_cedula));

        if($rs_cliente && !$rs_cliente->EOF) {
            $nombre_paciente = $rs_cliente->fields["clie_nombre"];
            $apellido_paciente = $rs_cliente->fields["clie_apellido"];
            $clie_genero = $rs_cliente->fields["clie_genero"];
            $clie_fechanacimiento = $rs_cliente->fields["clie_fechanacimiento"];
            $conve_id = $rs_cliente->fields["conve_id"];

            // Intentar obtener HC del paciente desde dns_atencion
            $clie_id = $rs_cliente->fields["clie_id"];
            $sql_hc = "SELECT atenc_hc FROM dns_atencion WHERE clie_id = ? ORDER BY atenc_id DESC LIMIT 1";
            $rs_hc = $DB_gogess->executec($sql_hc, array($clie_id));
            if($rs_hc && !$rs_hc->EOF) {
                $hc = $rs_hc->fields["atenc_hc"];
            }
        }
    }

    // Obtener datos del centro
    $nomb_centro = $objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre","where centro_id=",1,$DB_gogess);
    $uni_codiog = $objformulario->replace_cmb("dns_centrosalud","centro_id,centro_codigo","where centro_id=",1,$DB_gogess);

    // Obtener logo y datos de la empresa
    $logo = $objformulario->replace_cmb("app_empresa", "emp_id,emp_logoreporte", "where emp_id=", 1, $DB_gogess);
    $emp_nombre = $objformulario->replace_cmb("app_empresa", "emp_id,emp_nombre", "where emp_id=", 1, $DB_gogess);
    $emp_piedepagina = $objformulario->replace_cmb("app_empresa", "emp_id,emp_piedepagina", "where emp_id=", 1, $DB_gogess);

    // Calcular edad
    $edad_texto = $partop_edad;
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

    // Sexo formato
    $valor_sexo = '';
    if($clie_genero=='M') {
        $valor_sexo='MASCULINO';
    }
    if($clie_genero=='F') {
        $valor_sexo='FEMENINO';
    }

    // Nombre completo del paciente
    if(empty($nombre_paciente) && empty($apellido_paciente)) {
        $nombre_completo_paciente = $partop_paciente;
    } else {
        $nombre_completo_paciente = trim($apellido_paciente . ' ' . $nombre_paciente);
    }

    // HTML DE GENERACIÓN
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
                margin: 15px;
            }
            .header-tabla {
                width: 100%;
                border: 2px solid #000;
                border-collapse: collapse;
                margin-bottom: 12px;
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
                font-size: 12px;
                font-weight: bold;
            }
            
            .codigo-cell {
                width: 100px;
                text-align: center;
                font-size: 8px;
            }
            
            .linea-datos {
                width: 100%;
                border: 1px solid #000;
                border-collapse: collapse;
                margin-bottom: 6px;
            }
            
            .linea-datos td {
                border: 1px solid #000;
                padding: 4px 6px;
                font-size: 9px;
            }
            
            .etiqueta {
                font-weight: bold;
                background-color: #E8E8E8;
            }
            
            .checkbox-container {
                display: inline-block;
                margin-right: 15px;
            }
            
            .checkbox {
                display: inline-block;
                width: 12px;
                height: 12px;
                border: 2px solid #000;
                margin-right: 5px;
                vertical-align: middle;
            }
            
            .tabla-quirofano {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 6px;
            }
            
            .tabla-quirofano td {
                border: 1px solid #000;
                padding: 6px;
                text-align: center;
                font-weight: bold;
            }
            
            .titulo-seccion {
                background-color: #CCCCCC;
                font-weight: bold;
                text-align: center;
                padding: 5px;
                font-size: 10px;
            }
            
            .firma-box {
                text-align: center;
                padding: 30px 5px 5px 5px;
                border-top: 1px solid #000;
                margin-top: 20px;
            }
            
            .page-break {
                page-break-after: always;
            }
            
            .consentimiento-titulo {
                text-align: center;
                font-size: 13px;
                font-weight: bold;
                margin: 20px 0 15px 0;
            }
            
            .consentimiento-texto {
                text-align: justify;
                line-height: 1.6;
                font-size: 10px;
                margin-bottom: 15px;
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
    
    <!-- PÁGINA 1 -->
    <table class="header-tabla">
            <tr>
                <td class="logo-cell">
                    <img src="../archivo/' . $logo . '" alt="Logo">
                </td>
                <td class="titulo-cell">
                    <div class="titulo-principal">' . $emp_nombre . '</div>
                    <div class="subtitulo">PARTE OPERATORIO</div>
                </td>
                <td class="codigo-cell">
                    <strong>FECHA:</strong><br>' . ($partop_fecha && $partop_fecha != '0000-00-00' ? date("d/m/Y", strtotime($partop_fecha)) : '-') . '
                </td>
            </tr>
    </table>
    
    <!-- LINEA 1: PACIENTE, H.C, SEXO -->
    <table class="linea-datos">
        <tr>
            <td class="etiqueta" width="12%">PACIENTE:</td>
            <td width="48%">' . strtoupper(htmlspecialchars($nombre_completo_paciente)) . '</td>
            <td class="etiqueta" width="8%">H.C:</td>
            <td width="12%">' . ($hc ? $hc : '-') . '</td>
            <td class="etiqueta" width="8%">SEXO:</td>
            <td width="12%">' . $valor_sexo . '</td>
        </tr>
    </table>
    
    <!-- LINEA 2: SERVICIO, PISO, EDAD -->
    <table class="linea-datos">
        <tr>
            <td class="etiqueta" width="12%">SERVICIO:</td>
            <td width="38%">' . htmlspecialchars($partop_destino) . '</td>
            <td class="etiqueta" width="10%">PISO:</td>
            <td width="20%">-</td>
            <td class="etiqueta" width="8%">EDAD:</td>
            <td width="12%">' . $edad_texto . '</td>
        </tr>
    </table>
    
    <!-- LINEA 3: AREA, CAMA -->
    <table class="linea-datos">
        <tr>
            <td class="etiqueta" width="12%">ÁREA:</td>
            <td width="53%">' . htmlspecialchars($partop_sala) . '</td>
            <td class="etiqueta" width="10%">CAMA:</td>
            <td width="25%">' . htmlspecialchars($partop_hab) . '</td>
        </tr>
    </table>
    
    <!-- LINEA 4: GRADO DE COMPLEJIDAD CON CHECKBOXES -->
    <table class="linea-datos">
        <tr>
            <td class="etiqueta" width="25%">GRADO DE COMPLEJIDAD:</td>
            <td width="75%">
                <span class="checkbox-container">
                    <span class="checkbox"></span> I
                </span>
                <span class="checkbox-container">
                    <span class="checkbox"></span> II
                </span>
                <span class="checkbox-container">
                    <span class="checkbox"></span> III
                </span>
                <span class="checkbox-container">
                    <span class="checkbox"></span> IV
                </span>
                <span class="checkbox-container">
                    <span class="checkbox"></span> V
                </span>
            </td>
        </tr>
    </table>
    
    <!-- LINEA 5: DIAGNOSTICO PREOPERATORIO, TIEMPO CALCULADO -->
    <table class="linea-datos">
        <tr>
            <td class="etiqueta" width="25%">DIAGNÓSTICO PREOPERATORIO:</td>
            <td width="55%">' . htmlspecialchars($partop_descripcion) . '</td>
            <td class="etiqueta" width="15%">TIEMPO CALCULADO:</td>
            <td width="10%">' . $partop_tquirofano . '</td>
        </tr>
    </table>
    
    <!-- LINEA 6: PROCEDIMIENTO QUIRURGICO, TIEMPO REAL -->
    <table class="linea-datos">
        <tr>
            <td class="etiqueta" width="25%">PROCEDIMIENTO QUIRÚRGICO:</td>
            <td width="55%">' . htmlspecialchars($partop_procedimiento) . '</td>
            <td class="etiqueta" width="12%">TIEMPO REAL:</td>
            <td width="8%">' . $partop_hora . '</td>
        </tr>
    </table>
    
    <!-- LINEA 7: TEAM OPERATORIO -->
    <table class="linea-datos">
        <tr>
            <td class="etiqueta" width="18%" rowspan="3" style="vertical-align: middle;">TEAM OPERATORIO:</td>
            <td class="etiqueta" width="15%">CIRUJANO:</td>
            <td width="67%">' . htmlspecialchars($partop_cirujano) . '</td>
        </tr>
        <tr>
            <td class="etiqueta" width="15%">AYUDANTE:</td>
            <td width="67%">' . htmlspecialchars($partop_ayudante) . '</td>
        </tr>
        <tr>
            <td class="etiqueta" width="15%">AYUDANTE:</td>
            <td width="67%">' . htmlspecialchars($partop_anesteciologo) . '</td>
        </tr>
    </table>
    
    <!-- QUIROFANO PREFERIDO -->
    <table class="linea-datos">
        <tr>
            <td class="etiqueta" colspan="6">QUIRÓFANO PREFERIDO:</td>
        </tr>
    </table>
    <table class="tabla-quirofano">
        <tr>
            <td width="20%">1</td>
            <td width="20%">2</td>
            <td width="20%">3</td>
            <td width="20%">4</td>
            <td width="20%">5</td>
        </tr>
    </table>
    
    <!-- FECHA DESEADA, HORA, SESION -->
    <table class="linea-datos">
        <tr>
            <td class="etiqueta" width="18%">FECHA DESEADA:</td>
            <td width="28%"></td>
            <td class="etiqueta" width="10%">HORA:</td>
            <td width="18%"></td>
            <td class="etiqueta" width="10%">SESIÓN:</td>
            <td width="8%" style="text-align: center;">
                <span class="checkbox"></span>
            </td>
            <td width="8%" style="text-align: left;">MATUTINA</td>
        </tr>
        <tr>
            <td colspan="5"></td>
            <td width="8%" style="text-align: center;">
                <span class="checkbox"></span>
            </td>
            <td width="8%" style="text-align: left;">VESPERTINA</td>
        </tr>
    </table>
    
    <!-- REQUERIMIENTOS ESPECIALES DESEADOS -->
    <table class="linea-datos">
        <tr>
            <td class="titulo-seccion" colspan="4">REQUERIMIENTOS ESPECIALES DESEADOS</td>
        </tr>
        <tr>
            <td class="etiqueta" width="25%">BCO. SANGRE</td>
            <td width="25%"></td>
            <td class="etiqueta" width="25%">MATERIALES</td>
            <td width="25%"></td>
        </tr>
        <tr>
            <td class="etiqueta" width="25%">PERSONAL</td>
            <td width="25%"></td>
            <td class="etiqueta" width="25%">VIDEO</td>
            <td width="25%"></td>
        </tr>
        <tr>
            <td class="etiqueta" width="25%">EQUIPOS</td>
            <td width="25%"></td>
            <td class="etiqueta" width="25%">TV. CIRCUITO CERRADO</td>
            <td width="25%"></td>
        </tr>
        <tr>
            <td class="etiqueta" width="25%">RAYOS X</td>
            <td width="25%"></td>
            <td class="etiqueta" width="25%">MÁS UN QUIRÓFANO</td>
            <td width="25%"></td>
        </tr>
    </table>
    
    <!-- ANALISIS PREOPERATORIO -->
    <table class="linea-datos">
        <tr>
            <td class="titulo-seccion" colspan="4">ANÁLISIS PREOPERATORIO</td>
        </tr>
        <tr>
            <td class="etiqueta" width="25%">HCTO</td>
            <td width="25%"></td>
            <td class="etiqueta" width="25%">TTP</td>
            <td width="25%"></td>
        </tr>
        <tr>
            <td class="etiqueta" width="25%">GLUCOSA</td>
            <td width="25%"></td>
            <td class="etiqueta" width="25%">BUN</td>
            <td width="25%"></td>
        </tr>
        <tr>
            <td class="etiqueta" width="25%">RX TÓRAX</td>
            <td width="25%"></td>
            <td class="etiqueta" width="25%">CC + FKG</td>
            <td width="25%"></td>
        </tr>
        <tr>
            <td class="etiqueta" width="25%">HB</td>
            <td width="25%"></td>
            <td class="etiqueta" width="25%">OTROS</td>
            <td width="25%"></td>
        </tr>
        <tr>
            <td class="etiqueta" width="25%">CREATININA</td>
            <td width="25%"></td>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td class="etiqueta" width="25%">TP</td>
            <td width="25%"></td>
            <td colspan="2"></td>
        </tr>
    </table>
    
    <!-- FIRMAS -->
    <table class="linea-datos" style="margin-top: 15px;">
        <tr>
            <td width="33%" style="border-right: none; border-bottom: none;">
                <div class="firma-box">Cirujano Solicitante</div>
            </td>
            <td width="34%" style="border-right: none; border-bottom: none; border-left: none;">
                <div class="firma-box">Jefe de Servicio</div>
            </td>
            <td width="33%" style="border-bottom: none; border-left: none;">
                <div class="firma-box">FIRMA:</div>
            </td>
        </tr>
    </table>
    
    <div class="page-break"></div>
    
    <!-- PÁGINA 2: CONSENTIMIENTO INFORMADO -->
    <div class="consentimiento-titulo">CONSENTIMIENTO INFORMATIVO</div>
    
    <table class="linea-datos">
        <tr>
            <td class="etiqueta" width="5%">YO</td>
            <td width="95%">' . strtoupper(htmlspecialchars($nombre_completo_paciente)) . '</td>
        </tr>
    </table>
    
    <div class="consentimiento-texto">
        He sido informado por los facultativos de la <strong>' . strtoupper($emp_nombre) . '</strong> de la naturaleza de la dolencia de (mi persona, hijo, hermano, allegado), de los beneficios del procedimiento quirúrgico a que (seré, será) sometido. Así mismo, del riesgo que (Correré, correrá), de las complicaciones e inclusive del peligro de muerte. Conocedor del prestigio de la Institución y de su cuerpo Médico, me someto libremente al tratamiento del caso y revelo al personal de la Clínica de toda responsabilidad por cualquier complicación posterior.
    </div>
    
    <table class="linea-datos" style="margin-top: 30px;">
        <tr>
            <td width="50%" style="border-right: none;">
                <div class="firma-box">Testigo<br>Firma</div>
            </td>
            <td width="50%" style="border-left: none;">
                <div class="firma-box">Firma</div>
            </td>
        </tr>
    </table>
    
    <!-- SERVICIO DE ANESTESIOLOGÍA -->
    <div class="consentimiento-titulo" style="margin-top: 30px;">SERVICIO DE ANESTESIOLOGÍA<br>PROGRAMACIÓN</div>
    
    <table class="linea-datos">
        <tr>
            <td class="etiqueta" colspan="2">Parte Quirúrgico aceptado</td>
            <td class="etiqueta" colspan="2">Parte Quirúrgico rechazado</td>
        </tr>
        <tr>
            <td class="etiqueta" width="15%">Fecha:</td>
            <td width="35%">' . ($partop_fecha && $partop_fecha != '0000-00-00' ? date("d-m-Y", strtotime($partop_fecha)) : '') . '</td>
            <td class="etiqueta" width="15%">Razón:</td>
            <td width="35%"></td>
        </tr>
        <tr>
            <td class="etiqueta" width="15%">Hora:</td>
            <td width="35%">' . $partop_hora . '</td>
            <td class="etiqueta" width="15%">Observaciones:</td>
            <td width="35%" rowspan="3" style="vertical-align: top;"></td>
        </tr>
        <tr>
            <td class="etiqueta" width="15%">Quirófano:</td>
            <td width="35%"></td>
        </tr>
        <tr>
            <td class="etiqueta" width="15%">Anestesiólogo (s):</td>
            <td width="35%">' . htmlspecialchars($partop_anesteciologo) . '</td>
        </tr>
    </table>
    
    <table class="linea-datos">
        <tr>
            <td class="etiqueta" colspan="4">TIPO DE ANESTESIA:</td>
        </tr>
        <tr>
            <td width="25%">
                <span class="checkbox"></span> General
            </td>
            <td width="25%">
                <span class="checkbox"></span> Local
            </td>
            <td width="25%">
                <span class="checkbox"></span> Raquídea
            </td>
            <td width="25%">
                Otra: ______________
            </td>
        </tr>
    </table>
    
    <table class="linea-datos" style="margin-top: 20px;">
        <tr>
            <td width="50%" style="border-right: none;">
                <div class="firma-box">Jefe de Servicio</div>
            </td>
            <td width="50%" style="border-left: none;">
                <div class="firma-box">Anestesiólogo<br>C.I. _______________<br>Reg. Senescyt. _______________</div>
            </td>
        </tr>
    </table>
    
    <table class="linea-datos" style="margin-top: 20px;">
        <tr>
            <td class="etiqueta" colspan="2">Recepción parte operatorio en centro quirúrgico</td>
        </tr>
        <tr>
            <td class="etiqueta" width="30%">Fecha / Hora:</td>
            <td width="70%"></td>
        </tr>
        <tr>
            <td class="etiqueta" width="30%">Responsable:</td>
            <td width="70%"></td>
        </tr>
    </table>
    
    <div class="footer">
        <p>' . $emp_piedepagina . '</p>
        <p>Este documento contiene información médica confidencial del paciente</p>
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
    $nombre_archivo = "parte_operatorio_".($hc ? $hc : $partop_cedula)."_".$separa_fecha_hora[0].".pdf";
    $dompdf->stream($nombre_archivo, array("Attachment" => false));
}
?>