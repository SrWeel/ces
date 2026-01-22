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

    // Obtener nacionalidad
    $nacionalidad_valor = '';
    if($nac_id > 0) {
        $sql_nac = "SELECT nac_nombre FROM app_nacionalidad WHERE nac_id=?";
        $rs_nac = $DB_gogess->executec($sql_nac, array($nac_id));
        if($rs_nac && !$rs_nac->EOF) {
            $nacionalidad_valor = $rs_nac->fields["nac_nombre"];
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

    // CONSULTA DE ACTIVIDADES GENERALES
    $sql_actividades = "
        SELECT 
            ag.actemfgen_id, 
            ag.actemfgen_observacion,
            ag.actemfgen_fecharegistro,
            ag.enferm_enlace,
            
            -- Datos de la actividad
            a.activi_nombre,
            a.activi_tipo,
            
            -- Datos del usuario responsable
            u.usua_nombre, 
            u.usua_apellido, 
            u.usua_codigo, 
            u.usua_codigoiniciales
            
        FROM cesdb_aroriginal.dns_actividadesgenerales AS ag
        
        LEFT JOIN cesdb_aroriginal.dns_actividades AS a 
               ON ag.activigen_id = a.activi_id
               
        LEFT JOIN cesdb_aroriginal.app_usuario AS u 
               ON ag.usua_id = u.usua_id
               
        WHERE ag.enferm_enlace = ?
        
        ORDER BY ag.actemfgen_fecharegistro DESC, a.activi_nombre ASC
    ";

    $rs_actividades = $DB_gogess->executec($sql_actividades, array($enferm_enlace));

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
            
            .tabla-actividades { 
                width: 100%; 
                border-collapse: collapse; 
                margin-top: 10px;
            }
            
            .tabla-actividades th { 
                background-color: #CCFFCC; 
                color: black; 
                padding: 6px 4px; 
                text-align: left; 
                border: 1px solid #000;
                font-size: 7px;
                font-weight: bold;
            }
            
            .tabla-actividades td { 
                padding: 5px 4px; 
                border: 1px solid #000; 
                vertical-align: top;
                font-size: 8px;
            }
            
            .tabla-actividades tr:nth-child(even) { 
                background-color: #f8f9fa; 
            }
            
            .usuario-info {
                font-size: 7px;
                color: #666;
                font-style: italic;
                margin-top: 2px;
            }
            
            .observacion {
                max-width: 300px;
                word-wrap: break-word;
                line-height: 1.3;
            }
            
            .tipo-actividad {
                display: inline-block;
                padding: 2px 6px;
                border-radius: 3px;
                font-size: 7px;
                font-weight: bold;
            }
            
            .tipo-1 {
                background-color: #d4edda;
                color: #155724;
            }
            
            .tipo-2 {
                background-color: #d1ecf1;
                color: #0c5460;
            }
            
            .tipo-3 {
                background-color: #fff3cd;
                color: #856404;
            }
            
            .sin-datos {
                text-align: center;
                padding: 20px;
                color: #999;
                font-style: italic;
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
                    <div class="subtitulo">ACTIVIDADES GENERALES DE ENFERMERÍA</div>
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
        </table>
        
        <table class="tabla-actividades">
            <thead>
                <tr>                
                    <td class="titulo-azul" colspan="4">B. REGISTRO DE ACTIVIDADES GENERALES DE ENFERMERÍA</td>
                </tr>
                <tr>
                    <th width="25%">ACTIVIDAD</th>
                    <th width="45%">OBSERVACIONES</th>
                    <th width="25%">RESPONSABLE</th>
                    <th width="14%">FECHA REGISTRO</th>
                </tr>
            </thead>
            <tbody>';

    // Agregar filas de datos de actividades
    $hay_datos = false;
    if($rs_actividades && !$rs_actividades->EOF) {
        while (!$rs_actividades->EOF) {
            $hay_datos = true;

            $actividad_id = $rs_actividades->fields["actemfgen_id"];
            $actividad_nombre = htmlspecialchars($rs_actividades->fields["activi_nombre"]);
//            $actividad_tipo = $rs_actividades->fields["activi_tipo"];
            $observacion = htmlspecialchars($rs_actividades->fields["actemfgen_observacion"]);
            $fecha_registro = $rs_actividades->fields["actemfgen_fecharegistro"];

            // Determinar etiqueta de tipo
            $tipo_clase = 'tipo-1';
            $tipo_texto = 'General';

//            if($actividad_tipo == 1) {
//                $tipo_clase = 'tipo-1';
//                $tipo_texto = 'Cuidados';
//            } elseif($actividad_tipo == 2) {
//                $tipo_clase = 'tipo-2';
//                $tipo_texto = 'Monitoreo';
//            } elseif($actividad_tipo == 3) {
//                $tipo_clase = 'tipo-3';
//                $tipo_texto = 'Procedimiento';
//            }

            $nombre_usuario = trim($rs_actividades->fields["usua_nombre"].' '.$rs_actividades->fields["usua_apellido"]);
            $codigo_usuario = $rs_actividades->fields["usua_codigo"];
            $iniciales_usuario = $rs_actividades->fields["usua_codigoiniciales"];

            $info_usuario = '';
            if($nombre_usuario && $nombre_usuario != ' ') {
                $info_usuario = '<strong>'.$nombre_usuario.'</strong>';
                if($iniciales_usuario) {
                    $info_usuario .= '<div class="usuario-info">'.$iniciales_usuario.'</div>';
                }
                if($codigo_usuario) {
                    $info_usuario .= '<div class="usuario-info">Cód: '.$codigo_usuario.'</div>';
                }
            }

            $html_reporte .= '
                <tr>
                    <td><strong>'.$actividad_nombre.'</strong></td>
                    
                    <td class="observacion">'.nl2br($observacion).'</td>
                    <td>'.$info_usuario.'</td>
                    <td style="text-align: center;">'.($fecha_registro && $fecha_registro != '0000-00-00 00:00:00' ? date("d/m/Y H:i", strtotime($fecha_registro)) : '-').'</td>
                </tr>';

            $rs_actividades->MoveNext();
        }
    }

    if(!$hay_datos) {
        $html_reporte .= '
            <tr>
                <td colspan="5" class="sin-datos">
                    No hay actividades generales registradas para este paciente
                </td>
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
    $dompdf->set_paper('A4', 'portrait');
    $dompdf->load_html($html_reporte, 'UTF-8');
    $dompdf->render();

    // Agregar numeración de páginas
    $canvas = $dompdf->get_canvas();
    $font = Font_Metrics::get_font("helvetica", "normal");
    $canvas->page_text(520, 820, "Página {PAGE_NUM} de {PAGE_COUNT}", $font, 7, array(0,0,0));

    // Descargar PDF
    $separa_fecha_hora = explode(" ", date("Y-m-d H:i:s"));
    $nombre_archivo = "ActividadesGenerales_".$hc."_".$separa_fecha_hora[0].".pdf";
    $dompdf->stream($nombre_archivo, array("Attachment" => false));
}
?>