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

    // Obtener atenc_enlace desde dns_atencion
    $sql_atenc_enlace = "SELECT atenc_enlace FROM dns_atencion WHERE atenc_id = ?";
    $rs_atenc_enlace = $DB_gogess->executec($sql_atenc_enlace, array($atenc_id));

    $atenc_enlace = '';
    if($rs_atenc_enlace && !$rs_atenc_enlace->EOF) {
        $atenc_enlace = $rs_atenc_enlace->fields["atenc_enlace"];
    }
// ===============================================
// CONSULTA: DIETAS
// ===============================================
    $sql_dietas = "
    SELECT 
        d.diet_id,
        d.diet_general,
        d.diet_liqestricta,
        d.diet_blandagastrica,
        d.diet_blandahipograsa,
        d.diet_hiposodica,
        d.diet_diabetico,
        d.diet_observacion,
        d.diet_fecharegistro,
        d.enferm_enlace,
        
        -- Datos del tipo de dieta
        td.tipodiet_nombre,
        
        -- Datos del usuario responsable
        u.usua_nombre, 
        u.usua_apellido, 
        u.usua_codigo, 
        u.usua_codigoiniciales
        
    FROM cesdb_arextension.dns_dietas AS d
    
    -- JOIN con dns_enfermeria para filtrar por enferm_id
    INNER JOIN dns_enfermeria AS e
           ON d.enferm_enlace = e.enferm_enlace
    
    -- JOIN con tipo de dieta
    LEFT JOIN cesdb_arcombos.dns_tipodieta AS td
           ON d.tipodiet_id = td.tipodiet_id
           
    -- JOIN con usuario
    LEFT JOIN app_usuario AS u 
           ON d.usua_id = u.usua_id
           
    WHERE e.enferm_id = ?
    
    ORDER BY d.diet_fecharegistro DESC
";

    $rs_dietas = $DB_gogess->executec($sql_dietas, array($enferm_id));


//    HTML DE GENERACIÓN
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
            
            .tabla-dietas { 
                width: 100%; 
                border-collapse: collapse; 
                margin-top: 10px;
            }
            
            .tabla-dietas th { 
                background-color: #CCFFCC; 
                color: black; 
                padding: 6px 4px; 
                text-align: left; 
                border: 1px solid #000;
                font-size: 7px;
                font-weight: bold;
            }
            
            .tabla-dietas td { 
                padding: 5px 4px; 
                border: 1px solid #000; 
                vertical-align: top;
                font-size: 8px;
            }
            
            .tabla-dietas .detalle-dieta {
                font-size: 7px;
                line-height: 1.4;
            }
            
            .tabla-dietas .observacion {
                font-size: 8px;
                line-height: 1.3;
            }
            
            .tabla-dietas .sin-datos {
                text-align: center;
                color: #666;
                font-style: italic;
                padding: 15px;
            }
            
            .tabla-dietas .usuario-info {
                font-size: 7px;
                color: #555;
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
                    <div class="subtitulo">REGISTRO DE DIETAS SUMINISTRADAS</div>
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
$html_reporte .= '
        <table class="tabla-dietas">
            <thead>
                <tr>                
                    <td class="titulo-azul" colspan="5">B. DIETAS</td>
                </tr>
                <tr>
                    <th width="15%">TIPO DIETA</th>
                    <th width="45%">DETALLE</th>
                    <th width="20%">OBSERVACIONES</th>
                    <th width="15%">RESPONSABLE</th>
                    <th width="12%">FECHA REGISTRO</th>
                </tr>
            </thead>
            <tbody>';

// Agregar filas de datos de dietas
$hay_datos_dietas = false;
if($rs_dietas && !$rs_dietas->EOF) {
    while (!$rs_dietas->EOF) {
        $hay_datos_dietas = true;

        $diet_id = $rs_dietas->fields["diet_id"];
        $tipo_dieta = htmlspecialchars($rs_dietas->fields["tipodiet_nombre"]);
        $observacion = htmlspecialchars($rs_dietas->fields["diet_observacion"]);
        $fecha_registro = $rs_dietas->fields["diet_fecharegistro"];

        // Construir detalle de la dieta
        $detalle_dieta = array();

        if(!empty($rs_dietas->fields["diet_general"]) && $rs_dietas->fields["diet_general"] != '-') {
            $detalle_dieta[] = '<strong>General:</strong> '.htmlspecialchars($rs_dietas->fields["diet_general"]);
        }
        if(!empty($rs_dietas->fields["diet_liqestricta"]) && $rs_dietas->fields["diet_liqestricta"] != '-') {
            $detalle_dieta[] = '<strong>Líquida Estricta:</strong> '.htmlspecialchars($rs_dietas->fields["diet_liqestricta"]);
        }
        if(!empty($rs_dietas->fields["diet_blandagastrica"]) && $rs_dietas->fields["diet_blandagastrica"] != '-') {
            $detalle_dieta[] = '<strong>Blanda Gástrica:</strong> '.htmlspecialchars($rs_dietas->fields["diet_blandagastrica"]);
        }
        if(!empty($rs_dietas->fields["diet_blandahipograsa"]) && $rs_dietas->fields["diet_blandahipograsa"] != '-') {
            $detalle_dieta[] = '<strong>Blanda Hipograsa:</strong> '.htmlspecialchars($rs_dietas->fields["diet_blandahipograsa"]);
        }
        if(!empty($rs_dietas->fields["diet_hiposodica"]) && $rs_dietas->fields["diet_hiposodica"] != '-') {
            $detalle_dieta[] = '<strong>Hiposódica:</strong> '.htmlspecialchars($rs_dietas->fields["diet_hiposodica"]);
        }
        if(!empty($rs_dietas->fields["diet_diabetico"]) && $rs_dietas->fields["diet_diabetico"] != '-') {
            $detalle_dieta[] = '<strong>Diabético:</strong> '.htmlspecialchars($rs_dietas->fields["diet_diabetico"]);
        }

        $detalle_texto = !empty($detalle_dieta) ? implode('<br>', $detalle_dieta) : '-';

        $nombre_usuario = trim($rs_dietas->fields["usua_nombre"].' '.$rs_dietas->fields["usua_apellido"]);
        $codigo_usuario = $rs_dietas->fields["usua_codigo"];
        $iniciales_usuario = $rs_dietas->fields["usua_codigoiniciales"];

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
                <td><strong>'.$tipo_dieta.'</strong></td>
                <td class="detalle-dieta">'.$detalle_texto.'</td>
                <td class="observacion">'.nl2br($observacion).'</td>
                <td>'.$info_usuario.'</td>
                <td style="text-align: center;">'.($fecha_registro && $fecha_registro != '0000-00-00 00:00:00' ? date("d/m/Y H:i", strtotime($fecha_registro)) : '-').'</td>
            </tr>';

        $rs_dietas->MoveNext();
    }
}

if(!$hay_datos_dietas) {
    $html_reporte .= '
        <tr>
            <td colspan="5" class="sin-datos">
    No hay dietas registradas para este paciente
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
    </html>
        ';




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
    $nombre_archivo = "dietas_suministradas_".$hc."_".$separa_fecha_hora[0].".pdf";
    $dompdf->stream($nombre_archivo, array("Attachment" => false));
}
    ?>