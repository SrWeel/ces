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
    
    -- JOIN con dns_enfermeria para filtrar por enferm_id
    INNER JOIN cesdb_aroriginal.dns_enfermeria AS e
           ON ag.enferm_enlace = e.enferm_enlace
    
    LEFT JOIN cesdb_aroriginal.dns_actividades AS a 
           ON ag.activigen_id = a.activi_id
           
    LEFT JOIN cesdb_aroriginal.app_usuario AS u 
           ON ag.usua_id = u.usua_id
           
    WHERE e.enferm_id = ?
    
    ORDER BY ag.actemfgen_fecharegistro DESC, a.activi_nombre ASC
";

    $rs_actividades = $DB_gogess->executec($sql_actividades, array($enferm_id));

// CONSULTA: Dispositivos Médicos
    $sql_dispositivos = "
    SELECT 
        dm.dismed_id,
        dm.dismed_observacion,
        dm.dismed_fecharegistro,
        dm.enferm_enlace,
        
        -- Datos del dispositivo
        d.dis_nombre,
        
        -- Datos del usuario responsable
        u.usua_nombre, 
        u.usua_apellido, 
        u.usua_codigo, 
        u.usua_codigoiniciales
        
    FROM cesdb_arextension.dns_dispositivosmedicos AS dm
    
    -- JOIN con dns_enfermeria para filtrar por enferm_id
    INNER JOIN dns_enfermeria AS e
           ON dm.enferm_enlace = e.enferm_enlace
    
    -- JOIN con la tabla de dispositivos
    LEFT JOIN cesdb_arcombos.dns_dispositivos AS d
           ON dm.dis_id = d.dis_id
           
    -- JOIN con usuario
    LEFT JOIN app_usuario AS u 
           ON dm.usua_id = u.usua_id
           
    WHERE e.enferm_id = ?
    
    ORDER BY dm.dismed_fecharegistro DESC, d.dis_nombre ASC
";

    $rs_dispositivos = $DB_gogess->executec($sql_dispositivos, array($enferm_id));

    $sql_balance_hidrico = "
    SELECT 
        gbh.gbh_id,
        gbh.gbh_balancehidrico,
        gbh.gbh_detalle,
        gbh.gbh_fecharegistro,
        gbh.enferm_enlace,
        
        -- Datos de la descripción del balance hídrico
        bh.bh_descripcion,
        
        -- Datos del usuario responsable
        u.usua_nombre, 
        u.usua_apellido, 
        u.usua_codigo, 
        u.usua_codigoiniciales
        
    FROM cesdb_arextension.dns_gridbalancehidrico AS gbh
    
    -- JOIN con dns_enfermeria para filtrar por enferm_id
    INNER JOIN dns_enfermeria AS e
           ON gbh.enferm_enlace = e.enferm_enlace
    
    -- JOIN con dns_banacehidrico (tabla de catálogo)
    LEFT JOIN cesdb_arcombos.dns_banacehidrico AS bh
           ON gbh.gbh_balancehidrico = bh.bh_id
           
    -- JOIN con usuario
    LEFT JOIN app_usuario AS u 
           ON gbh.usua_id = u.usua_id
           
    WHERE e.enferm_id = ?
    
    ORDER BY gbh.gbh_fecharegistro DESC
";

    $rs_balance_hidrico = $DB_gogess->executec($sql_balance_hidrico, array($enferm_id));


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

/* TABLA DE ACTIVIDADES */
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

/* TABLA DE DISPOSITIVOS */
.tabla-dispositivos { 
    width: 100%; 
    border-collapse: collapse; 
    margin-top: 10px;
}

.tabla-dispositivos th { 
    background-color: #CCFFCC; 
    color: black; 
    padding: 6px 4px; 
    text-align: left; 
    border: 1px solid #000;
    font-size: 7px;
    font-weight: bold;
}

.tabla-dispositivos td { 
    padding: 5px 4px; 
    border: 1px solid #000; 
    vertical-align: top;
    font-size: 8px;
}

.tabla-dispositivos .observacion {
    font-size: 8px;
    line-height: 1.3;
}

.tabla-dispositivos .sin-datos {
    text-align: center;
    color: #666;
    font-style: italic;
    padding: 15px;
}

.tabla-dispositivos .usuario-info {
    font-size: 7px;
    color: #555;
    margin-top: 2px;
}

/* TABLA DE DIETAS - Estilo genérico reutilizable */
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
                <th rowspan="2">PULSO</th>
                <th rowspan="2">TEMPERATURA</th>';

// Generar encabezados de días (DÍA 1 a DÍA 7) con 3 columnas cada uno
    $dias_nombres = array('DÍA 1', 'DÍA 2', 'DÍA 3', 'DÍA 4', 'DÍA 5', 'DÍA 6', 'DÍA 7');
    foreach($dias_nombres as $dia_nombre) {
        $html_reporte .= '<th colspan="3">' . $dia_nombre . '</th>';
    }

    $html_reporte .= '
            </tr>
            <tr>';

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

// Estructura de datos mejorada: [dia][periodo][tipo] = array de valores
    $datos_grid = array();
    for($d = 0; $d < 7; $d++) {
        $datos_grid[$d] = array(
            'AM' => array('pulsos' => array(), 'temperaturas' => array(), 'fechas' => array()),
            'PM' => array('pulsos' => array(), 'temperaturas' => array(), 'fechas' => array()),
            'HS' => array('pulsos' => array(), 'temperaturas' => array(), 'fechas' => array())
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
        if($dia_actual >= 7) break;

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
        }

        $dia_actual++;
    }

// Crear un índice invertido: valor -> lista de [dia, periodo]
    $indice_pulsos = array();
    $indice_temperaturas = array();

    for($d = 0; $d < 7; $d++) {
        foreach(array('AM', 'PM', 'HS') as $periodo) {
            // Indexar pulsos
            foreach($datos_grid[$d][$periodo]['pulsos'] as $pulso) {
                if(!isset($indice_pulsos[$pulso])) {
                    $indice_pulsos[$pulso] = array();
                }
                $indice_pulsos[$pulso][] = array('dia' => $d, 'periodo' => $periodo);
            }

            // Indexar temperaturas
            foreach($datos_grid[$d][$periodo]['temperaturas'] as $temp) {
                if(!isset($indice_temperaturas[$temp])) {
                    $indice_temperaturas[$temp] = array();
                }
                $indice_temperaturas[$temp][] = array('dia' => $d, 'periodo' => $periodo);
            }
        }
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
        for($d = 0; $d < 7; $d++) {
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

    for($d = 0; $d < 7; $d++) {
        foreach(array('AM', 'PM', 'HS') as $periodo) {
            $fechas_html = '';
            if(!empty($datos_grid[$d][$periodo]['fechas'])) {
                $fechas_html = implode('<br>', $datos_grid[$d][$periodo]['fechas']);
            }
            $html_reporte .= '<td class="celda-valor" style="font-size: 6px;">' . $fechas_html . '</td>';
        }
    }

    $html_reporte .= '</tr>';

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
        </table>';
    $html_balance_hidrico = '
<table class="tabla-dietas">
    <thead>
        <tr>                
            <td class="titulo-azul" colspan="4">BALANCE HÍDRICO</td>
        </tr>
        <tr>
            <th width="25%">TIPO DE BALANCE</th>
            <th width="35%">DETALLE</th>
            <th width="25%">RESPONSABLE</th>
            <th width="15%">FECHA REGISTRO</th>
        </tr>
    </thead>
    <tbody>';

// Agregar filas de datos de balance hídrico
    $hay_datos_balance = false;
    if($rs_balance_hidrico && !$rs_balance_hidrico->EOF) {
        while (!$rs_balance_hidrico->EOF) {
            $hay_datos_balance = true;

            $gbh_id = $rs_balance_hidrico->fields["gbh_id"];
            $tipo_balance = htmlspecialchars($rs_balance_hidrico->fields["bh_descripcion"]);
            $detalle = htmlspecialchars($rs_balance_hidrico->fields["gbh_detalle"]);
            $fecha_registro = $rs_balance_hidrico->fields["gbh_fecharegistro"];

            // Información del usuario
            $nombre_usuario = trim($rs_balance_hidrico->fields["usua_nombre"].' '.$rs_balance_hidrico->fields["usua_apellido"]);
            $codigo_usuario = $rs_balance_hidrico->fields["usua_codigo"];
            $iniciales_usuario = $rs_balance_hidrico->fields["usua_codigoiniciales"];

            $info_usuario = '';
            if($nombre_usuario && $nombre_usuario != ' ') {
                $info_usuario = '<strong>'.$nombre_usuario.'</strong>';
                if($iniciales_usuario) {
                    $info_usuario .= '<div class="usuario-info">'.$iniciales_usuario.'</div>';
                }
                if($codigo_usuario) {
                    $info_usuario .= '<div class="usuario-info">Cód: '.$codigo_usuario.'</div>';
                }
            } else {
                $info_usuario = '-';
            }

            $html_balance_hidrico .= '
            <tr>
                <td><strong>'.$tipo_balance.'</strong></td>
                <td class="observacion">'.nl2br($detalle).'</td>
                <td>'.$info_usuario.'</td>
                <td style="text-align: center;">'.($fecha_registro && $fecha_registro != '0000-00-00 00:00:00' ? date("d/m/Y H:i", strtotime($fecha_registro)) : '-').'</td>
            </tr>';

            $rs_balance_hidrico->MoveNext();
        }
    }

    if(!$hay_datos_balance) {
        $html_balance_hidrico .= '
        <tr>
            <td colspan="4" class="sin-datos">
                No hay registros de balance hídrico para este paciente
            </td>
        </tr>';
    }

    $html_balance_hidrico .= '
    </tbody>
</table>';

// Agregar al reporte principal
    $html_reporte .= $html_balance_hidrico;
    $html_reporte .='   <table class="tabla-actividades">
            <thead>
                <tr>                
                    <td class="titulo-azul" colspan="4">E. CUIDADOS GENERALES</td>
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
        </table>';
    // HTML para Dispositivos Médicos
    $html_reporte .= '
        <table class="tabla-dispositivos">
            <thead>
                <tr>                
                    <td class="titulo-azul" colspan="4">F. FECHA DE COLOCACIÓN DE DISPOSITIVOS MÉDICOS</td>
                </tr>
                <tr>
                    <th width="25%">DISPOSITIVO</th>
                    <th width="45%">OBSERVACIONES</th>
                    <th width="25%">RESPONSABLE</th>
                    <th width="14%">FECHA REGISTRO</th>
                </tr>
            </thead>
            <tbody>';

// Agregar filas de datos de dispositivos
    $hay_datos_dispositivos = false;
    if($rs_dispositivos && !$rs_dispositivos->EOF) {
        while (!$rs_dispositivos->EOF) {
            $hay_datos_dispositivos = true;

            $dispositivo_id = $rs_dispositivos->fields["dismed_id"];
            $dispositivo_nombre = htmlspecialchars($rs_dispositivos->fields["dis_nombre"]);
            $observacion = htmlspecialchars($rs_dispositivos->fields["dismed_observacion"]);
            $fecha_registro = $rs_dispositivos->fields["dismed_fecharegistro"];

            $nombre_usuario = trim($rs_dispositivos->fields["usua_nombre"].' '.$rs_dispositivos->fields["usua_apellido"]);
            $codigo_usuario = $rs_dispositivos->fields["usua_codigo"];
            $iniciales_usuario = $rs_dispositivos->fields["usua_codigoiniciales"];

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
                <td><strong>'.$dispositivo_nombre.'</strong></td>
                <td class="observacion">'.nl2br($observacion).'</td>
                <td>'.$info_usuario.'</td>
                <td style="text-align: center;">'.($fecha_registro && $fecha_registro != '0000-00-00 00:00:00' ? date("d/m/Y H:i", strtotime($fecha_registro)) : '-').'</td>
            </tr>';

            $rs_dispositivos->MoveNext();
        }
    }

    if(!$hay_datos_dispositivos) {
        $html_reporte .= '
        <tr>
            <td colspan="4" class="sin-datos">
                No hay dispositivos médicos registrados para este paciente
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
    $dompdf->set_paper('A4');
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