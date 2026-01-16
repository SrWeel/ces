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

    // Sexo formato
    $valor_sexo = ($clie_genero=='M') ? 'HOMBRE' : (($clie_genero=='F') ? 'MUJER' : '');

    // Dividir nombres y apellidos
    $partes_apellido = explode(' ', trim($apellido_paciente), 2);
    $primer_apellido = isset($partes_apellido[0]) ? $partes_apellido[0] : '';
    $segundo_apellido = isset($partes_apellido[1]) ? $partes_apellido[1] : '';

    $partes_nombre = explode(' ', trim($nombre_paciente), 2);
    $primer_nombre = isset($partes_nombre[0]) ? $partes_nombre[0] : '';
    $segundo_nombre = isset($partes_nombre[1]) ? $partes_nombre[1] : '';

    // ===============================================
    // CONSULTAS: IMPLEMENTOS HOSPITALARIOS POR GRUPO
    // ===============================================

    // GRUPO A
    $sql_grupo_a = "
    SELECT 
        ih.imphos_id,
        ih.imphos_cantidad,
        ih.imphos_entrega,
        ih.imphos_recepcion,
        ih.imphos_descripcion,
        ih.imphos_fecharegistro,
        ga.ga_nombre,
        CASE 
            WHEN ih.imphos_entrega = 1 THEN 'SI'
            WHEN ih.imphos_entrega = 0 THEN 'NO'
            ELSE '-'
        END as entrega_texto,
        CASE 
            WHEN ih.imphos_recepcion = 1 THEN 'SI'
            WHEN ih.imphos_recepcion = 0 THEN 'NO'
            ELSE '-'
        END as recepcion_texto,
        u.usua_nombre, 
        u.usua_apellido, 
        u.usua_codigo, 
        u.usua_codigoiniciales
    FROM cesdb_arextension.dns_implementoshospi AS ih
    INNER JOIN dns_enfermeria AS e ON ih.enferm_enlace = e.enferm_enlace
    LEFT JOIN cesdb_arcombos.dns_grupoa AS ga ON ih.ga_id = ga.ga_id
    LEFT JOIN app_usuario AS u ON ih.usua_id = u.usua_id
    WHERE e.enferm_id = ? AND ih.ga_id > 0
    ORDER BY ih.imphos_fecharegistro DESC, ga.ga_nombre ASC";

    $rs_grupo_a = $DB_gogess->executec($sql_grupo_a, array($enferm_id));

    // GRUPO B
    $sql_grupo_b = "
    SELECT 
        ih.imphos_id,
        ih.imphos_cantidad,
        ih.imphos_entrega,
        ih.imphos_recepcion,
        ih.imphos_descripcion,
        ih.imphos_fecharegistro,
        gb.gb_nombre,
        CASE 
            WHEN ih.imphos_entrega = 1 THEN 'SI'
            WHEN ih.imphos_entrega = 0 THEN 'NO'
            ELSE '-'
        END as entrega_texto,
        CASE 
            WHEN ih.imphos_recepcion = 1 THEN 'SI'
            WHEN ih.imphos_recepcion = 0 THEN 'NO'
            ELSE '-'
        END as recepcion_texto,
        u.usua_nombre, 
        u.usua_apellido, 
        u.usua_codigo, 
        u.usua_codigoiniciales
    FROM cesdb_arextension.dns_implementoshospi AS ih
    INNER JOIN dns_enfermeria AS e ON ih.enferm_enlace = e.enferm_enlace
    LEFT JOIN cesdb_arcombos.dns_grupob AS gb ON ih.gb_id = gb.gb_id
    LEFT JOIN app_usuario AS u ON ih.usua_id = u.usua_id
    WHERE e.enferm_id = ? AND ih.gb_id > 0
    ORDER BY ih.imphos_fecharegistro DESC, gb.gb_nombre ASC";

    $rs_grupo_b = $DB_gogess->executec($sql_grupo_b, array($enferm_id));

    // GRUPO C
    $sql_grupo_c = "
    SELECT 
        ih.imphos_id,
        ih.imphos_cantidad,
        ih.imphos_entrega,
        ih.imphos_recepcion,
        ih.imphos_descripcion,
        ih.imphos_fecharegistro,
        gc.gc_nombre,
        CASE 
            WHEN ih.imphos_entrega = 1 THEN 'SI'
            WHEN ih.imphos_entrega = 0 THEN 'NO'
            ELSE '-'
        END as entrega_texto,
        CASE 
            WHEN ih.imphos_recepcion = 1 THEN 'SI'
            WHEN ih.imphos_recepcion = 0 THEN 'NO'
            ELSE '-'
        END as recepcion_texto,
        u.usua_nombre, 
        u.usua_apellido, 
        u.usua_codigo, 
        u.usua_codigoiniciales
    FROM cesdb_arextension.dns_implementoshospi AS ih
    INNER JOIN dns_enfermeria AS e ON ih.enferm_enlace = e.enferm_enlace
    LEFT JOIN cesdb_arcombos.dns_grupoc AS gc ON ih.gc_id = gc.gc_id
    LEFT JOIN app_usuario AS u ON ih.usua_id = u.usua_id
    WHERE e.enferm_id = ? AND ih.gc_id > 0
    ORDER BY ih.imphos_fecharegistro DESC, gc.gc_nombre ASC";

    $rs_grupo_c = $DB_gogess->executec($sql_grupo_c, array($enferm_id));

    // ===============================================
    // FUNCIÓN PARA GENERAR FILAS DE TABLA
    // ===============================================
    function generarFilasImplementos($recordset, $campo_nombre) {
        $html = '';
        $hay_datos = false;

        if($recordset && !$recordset->EOF) {
            while (!$recordset->EOF) {
                $hay_datos = true;

                $implemento_nombre = htmlspecialchars($recordset->fields[$campo_nombre]);
                $cantidad = htmlspecialchars($recordset->fields["imphos_cantidad"]);
                $entrega = htmlspecialchars($recordset->fields["entrega_texto"]);
                $recepcion = htmlspecialchars($recordset->fields["recepcion_texto"]);
                $descripcion = htmlspecialchars($recordset->fields["imphos_descripcion"]);
                $fecha_registro = $recordset->fields["imphos_fecharegistro"];

                $nombre_usuario = trim($recordset->fields["usua_nombre"].' '.$recordset->fields["usua_apellido"]);
                $codigo_usuario = $recordset->fields["usua_codigo"];
                $iniciales_usuario = $recordset->fields["usua_codigoiniciales"];

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

                $html .= '
                <tr>
                    <td><strong>'.$implemento_nombre.'</strong></td>
                    <td style="text-align: center;">'.$cantidad.'</td>
                    <td style="text-align: center;">'.$entrega.'</td>
                    <td style="text-align: center;">'.$recepcion.'</td>
                    <td class="descripcion">'.nl2br($descripcion).'</td>
                    <td>'.$info_usuario.'</td>
                    <td style="text-align: center;">'.($fecha_registro && $fecha_registro != '0000-00-00 00:00:00' ? date("d/m/Y H:i", strtotime($fecha_registro)) : '-').'</td>
                </tr>';

                $recordset->MoveNext();
            }
        }

        if(!$hay_datos) {
            $html .= '
            <tr>
                <td colspan="7" class="sin-datos">No hay implementos registrados en este grupo</td>
            </tr>';
        }

        return $html;
    }

    // ===============================================
    // HTML DEL REPORTE
    // ===============================================
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
            .texto-informativo {
                background-color: #F0F8FF;
                border: 1px solid #000;
                padding: 10px;
                margin: 10px 0;
                text-align: justify;
                font-size: 10px;
                line-height: 1.4;
            }
            .tabla-implementos { 
                width: 100%; 
                border-collapse: collapse; 
                margin-top: 10px;
            }
            .tabla-implementos th { 
                background-color: #CCFFCC; 
                color: black; 
                padding: 6px 4px; 
                text-align: left; 
                border: 1px solid #000;
                font-size: 7px;
                font-weight: bold;
            }
            .tabla-implementos td { 
                padding: 5px 4px; 
                border: 1px solid #000; 
                vertical-align: top;
                font-size: 8px;
            }
            .titulo-grupo {
                background-color: #CCCCFF;
                color: black;
                font-weight: bold;
                text-align: center;
                padding: 6px 5px;
                font-size: 9px;
            }
            .tabla-implementos .descripcion {
                font-size: 7px;
                line-height: 1.3;
            }
            .tabla-implementos .sin-datos {
                text-align: center;
                color: #666;
                font-style: italic;
                padding: 15px;
            }
            .tabla-implementos .usuario-info {
                font-size: 7px;
                color: #555;
                margin-top: 2px;
            }
            .tabla-firmas {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
                margin-bottom: 10px;
            }
            .tabla-firmas td {
                border: 1px solid #000;
                padding: 8px;
                vertical-align: top;
            }
            .titulo-firma {
                font-weight: bold;
                text-align: center;
                font-size: 9px;
                background-color: #E8E8E8;
                padding: 5px;
            }
            .subtabla-checks {
                width: 100%;
                border-collapse: collapse;
            }
            .subtabla-checks td {
                border: none;
                padding: 3px 5px;
                vertical-align: top;
            }
            .subtitulo-check {
                font-weight: bold;
                font-size: 8px;
                text-align: center;
                padding: 3px 0;
            }
            .fila-check {
                padding: 4px 0;
                font-size: 8px;
                display: block;
            }
            .fila-fecha {
                font-weight: bold;
                font-size: 7px;
                text-align: left;
                padding: 5px 0 0 0;
            }
            .checkbox {
                display: inline-block;
                width: 12px;
                height: 12px;
                border: 1px solid #000;
                margin-right: 5px;
                vertical-align: middle;
            }
            .linea-firma {
                display: inline-block;
                width: 130px;
                border-bottom: 1px solid #000;
                margin-left: 10px;
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
                    <div class="subtitulo">REGISTRO DE IMPLEMENTOS HOSPITALARIOS</div>
                </td>
                <td class="codigo-cell">
                    <strong>N° HCU:</strong><br>' . $hc. '
                </td>
            </tr>
        </table>
        <div class="texto-informativo">
            <strong>BIENVENIDOS A LA CLÍNICA DE ESPECIALIDADES SUR</strong>, para una mejor atención y comodidad en nuestra institución le será entregado los siguientes implementos. Los implementos <strong>GRUPO A</strong> deberán ser devueltos en su totalidad al momento de alta. Los implementos <strong>GRUPO B</strong> son de uso personal del paciente, por lo cual no existe necesidad de devolución y los implementos <strong>GRUPO C</strong> pertenecen al paciente.
        </div>
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
        
        
        
        <table class="tabla-implementos">
            <thead>
                <tr>                
                    <td class="titulo-grupo" colspan="7">IMPLEMENTOS HOSPITALARIOS - GRUPO A</td>
                </tr>
                <tr>
                    <th width="20%">IMPLEMENTO</th>
                    <th width="8%">CANTIDAD</th>
                    <th width="8%">ENTREGA</th>
                    <th width="8%">RECEPCIÓN</th>
                    <th width="28%">DESCRIPCIÓN</th>
                    <th width="18%">RESPONSABLE</th>
                    <th width="10%">FECHA</th>
                </tr>
            </thead>
            <tbody>
                ' . generarFilasImplementos($rs_grupo_a, "ga_nombre") . '
            </tbody>
        </table>
        
        <table class="tabla-implementos" style="margin-top: 15px;">
            <thead>
                <tr>                
                    <td class="titulo-grupo" colspan="7">IMPLEMENTOS HOSPITALARIOS - GRUPO B</td>
                </tr>
                <tr>
                    <th width="20%">IMPLEMENTO</th>
                    <th width="8%">CANTIDAD</th>
                    <th width="8%">ENTREGA</th>
                    <th width="8%">RECEPCIÓN</th>
                    <th width="28%">DESCRIPCIÓN</th>
                    <th width="18%">RESPONSABLE</th>
                    <th width="10%">FECHA</th>
                </tr>
            </thead>
            <tbody>
                ' . generarFilasImplementos($rs_grupo_b, "gb_nombre") . '
            </tbody>
        </table>
        
        <table class="tabla-implementos" style="margin-top: 15px;">
            <thead>
                <tr>                
                    <td class="titulo-grupo" colspan="7">IMPLEMENTOS HOSPITALARIOS - GRUPO C</td>
                </tr>
                <tr>
                    <th width="20%">IMPLEMENTO</th>
                    <th width="8%">CANTIDAD</th>
                    <th width="8%">ENTREGA</th>
                    <th width="8%">RECEPCIÓN</th>
                    <th width="28%">DESCRIPCIÓN</th>
                    <th width="18%">RESPONSABLE</th>
                    <th width="10%">FECHA</th>
                </tr>
            </thead>
            <tbody>
                ' . generarFilasImplementos($rs_grupo_c, "gc_nombre") . '
            </tbody>
        </table>
        
        <table class="tabla-firmas">
            <tr>
                <td class="titulo-firma" width="50%">PACIENTE</td>
                <td class="titulo-firma" width="50%">PERSONAL C.E.S</td>
            </tr>
            <tr>
                <td>
                    <table class="subtabla-checks">
                        <tr>
                            <td class="subtitulo-check" width="50%">ENTREGA</td>
                            <td class="subtitulo-check" width="50%">RECEPCIÓN</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="fila-check">GRUPO A &nbsp;&nbsp;<span class="checkbox"></span><span class="linea-firma"></span></div>
                                <div class="fila-check">GRUPO B &nbsp;&nbsp;<span class="checkbox"></span><span class="linea-firma"></span></div>
                                <div class="fila-check">GRUPO C &nbsp;&nbsp;<span class="checkbox"></span><span class="linea-firma"></span></div>
                            </td>
                            <td>
                                <div class="fila-check"><span class="checkbox"></span><span class="linea-firma"></span></div>
                                <div class="fila-check"><span class="checkbox"></span><span class="linea-firma"></span></div>
                                <div class="fila-check"><span class="checkbox"></span><span class="linea-firma"></span></div>
                            </td>
                        </tr>
                    </table>
                    <table class="subtabla-checks" style="margin-top: 5px;">
                        <tr>
                            <td class="fila-fecha" width="50%">FECHA ENTREGA: ____________/____________/____________</td>
                            <td class="fila-fecha" width="50%">FECHA RECEPCIÓN: ____________/____________/____________</td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table class="subtabla-checks">
                        <tr>
                            <td class="subtitulo-check" width="50%">ENTREGA</td>
                            <td class="subtitulo-check" width="50%">RECEPCIÓN</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="fila-check">GRUPO A &nbsp;&nbsp;<span class="checkbox"></span><span class="linea-firma"></span></div>
                                <div class="fila-check">GRUPO B &nbsp;&nbsp;<span class="checkbox"></span><span class="linea-firma"></span></div>
                                <div class="fila-check">GRUPO C &nbsp;&nbsp;<span class="checkbox"></span><span class="linea-firma"></span></div>
                            </td>
                            <td>
                                <div class="fila-check"><span class="checkbox"></span><span class="linea-firma"></span></div>
                                <div class="fila-check"><span class="checkbox"></span><span class="linea-firma"></span></div>
                                <div class="fila-check"><span class="checkbox"></span><span class="linea-firma"></span></div>
                            </td>
                        </tr>
                    </table>
                    <table class="subtabla-checks" style="margin-top: 5px;">
                        <tr>
                            <td class="fila-fecha" width="50%">FECHA ENTREGA: ____________/____________/____________</td>
                            <td class="fila-fecha" width="50%">FECHA RECEPCIÓN: ____________/____________/____________</td>
                        </tr>
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
    $nombre_archivo = "implementos_hospitalarios_".$hc."_".$separa_fecha_hora[0].".pdf";
    $dompdf->stream($nombre_archivo, array("Attachment" => false));
}
?>