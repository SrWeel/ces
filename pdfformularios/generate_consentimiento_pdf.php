<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
header('Content-Type: text/html; charset=UTF-8');
$tiempossss=4444000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_SESSION['ces1313777_sessid_inicio']) {

    $director='../';
    include("../cfg/clases.php");
    include("../cfg/declaracion.php");

    $objformulario = new ValidacionesFormulario();

    // Obtener datos del consentimiento
    $conset_id = $_POST["conset_id"];
    $clie_id = $_POST["clie_id"];
    $atenc_id = $_POST["atenc_id"];

    $lista_tablaspop = "SELECT * FROM api_consentimientoi WHERE conset_id=?";
    $rs_tablastop = $DB_gogess->executec($lista_tablaspop, array($conset_id));

    $conset_nombre = $rs_tablastop->fields["conset_nombre"];
    $archiv_data = $rs_tablastop->fields["conset_archivo"];

    // Obtener datos del paciente
    $datos_cliente = "SELECT * FROM app_cliente WHERE clie_id=?";
    $rs_dcliente = $DB_gogess->executec($datos_cliente, array($clie_id));

    $nombre_paciente = $rs_dcliente->fields["clie_nombre"];
    $apellido_paciente = $rs_dcliente->fields["clie_apellido"];
    $clie_rucci = $rs_dcliente->fields["clie_rucci"];
    $nombre_completo = trim($nombre_paciente . ' ' . $apellido_paciente);
    $apellidos = preg_split('/\s+/', trim($apellido_paciente), 2);

    $apellido_paterno = $apellidos[0];
    $apellido_materno = isset($apellidos[1]) ? $apellidos[1] : '';
    $nombres = preg_split('/\s+/', trim($nombre_paciente), 2);

    $nombre_primero = $nombres[0];
    $nombre_segundo = isset($nombres[1]) ? $nombres[1] : '';

    $sql = "
SELECT 
    c.clie_nombre,
    c.clie_apellido,
    c.clie_rucci,
    c.clie_registrado,
    u.usua_nombre,
    u.usua_apellido,
    u.usua_cargo
FROM app_cliente c
INNER JOIN app_usuario u ON u.usua_id = c.usua_id
WHERE c.clie_id = ?
";

    $rs = $DB_gogess->executec($sql, array($clie_id));
    $nombre_usuario = trim(
        $rs->fields['usua_nombre'] . ' ' . $rs->fields['usua_apellido']
    );

    $cargo_usuario = $rs->fields['usua_cargo'];
    $usuario_registra = $nombre_usuario;
    if ($cargo_usuario) {
        $usuario_registra .= " ({$cargo_usuario})";
    }


    // Obtener datos de atención
    $lista_atencion = "SELECT * FROM dns_atencion WHERE atenc_id=?";
    $rs_atencion = $DB_gogess->executec($lista_atencion, array($atenc_id));
    $hc = $rs_atencion->fields["atenc_hc"];

    // Obtener logo y datos de la empresa
    $logo = $objformulario->replace_cmb("app_empresa", "emp_id,emp_logoreporte", "where emp_id=", 1, $DB_gogess);
    $emp_nombre = $objformulario->replace_cmb("app_empresa", "emp_id,emp_nombre", "where emp_id=", 1, $DB_gogess);
    $emp_piedepagina = $objformulario->replace_cmb("app_empresa", "emp_id,emp_piedepagina", "where emp_id=", 1, $DB_gogess);

    // Fecha actual
    $fecha_actual = new DateTime();
    $dia = $fecha_actual->format('d');
    $anio = $fecha_actual->format('Y');

    // Mes en español
    $meses = array(
        1 => 'enero', 2 => 'febrero', 3 => 'marzo', 4 => 'abril',
        5 => 'mayo', 6 => 'junio', 7 => 'julio', 8 => 'agosto',
        9 => 'septiembre', 10 => 'octubre', 11 => 'noviembre', 12 => 'diciembre'
    );
    $mes = $meses[(int)$fecha_actual->format('n')];

    $fecha_texto = "Quito, " . $dia . " de " . $mes . " de " . $anio;
    $fecha_atencion = $dia . " de " . $mes . " del " . $anio;
    $hora_atencion = date('H:i');


    // Determinar qué PDF generar según el nombre del consentimiento
    $html_reporte = '';

    // ============================================================================
    // PDF 1: AUTORIZACIÓN EXPRESA
    // ============================================================================
    if ($conset_nombre == 'CES AUTORIZACION EXPRESA') {

        $html_reporte = '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <style>
                body { 
                    font-family: Arial, sans-serif; 
                    font-size: 11px; 
                    margin: 20px;
                    line-height: 1.6;
                }
                
                .header-tabla {
                    width: 100%;
                    border: 2px solid #000;
                    border-collapse: collapse;
                    margin-bottom: 20px;
                }
                
                .header-tabla td {
                    padding: 8px;
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
                    margin-bottom: 5px;
                }
                
                .subtitulo {
                    font-size: 12px;
                    font-weight: bold;
                    color: #0066CC;
                }
                
                .codigo-cell {
                    width: 100px;
                    text-align: center;
                    font-size: 10px;
                }
                
                .fecha-derecha {
                    text-align: right;
                    margin-bottom: 20px;
                    font-size: 11px;
                }
                
                .destinatario {
                    margin-bottom: 20px;
                    line-height: 1.4;
                }
                
                .contenido {
                    text-align: justify;
                    margin-bottom: 30px;
                }
                
                .contenido p {
                    margin-bottom: 15px;
                }
                
                .firma-seccion {
                    margin-top: 80px;
                    text-align: left;
                }
                
                .linea-firma {
                    border-top: 1px solid #000;
                    width: 170px;
                    text-align: left;
                }
                
                .nombre-cedula {
                    font-weight: bold;
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
                        <div class="subtitulo">AUTORIZACIÓN EXPRESA</div>
                    </td>
                    <td class="codigo-cell">
                        <strong>N° HCU:</strong><br>' . $hc . '
                    </td>
                </tr>
            </table>
            
            <div class="fecha-derecha">
                ' . $fecha_texto . '
            </div>
            
            <div class="destinatario">
                <strong>Señores</strong><br>
                <strong>CLÍNICA DE ESPECIALIDADES SUR</strong><br>
                <strong>Dr. Hugo Barros</strong><br>
                <strong>GERENTE GENERAL</strong><br>
                <strong>Presente. -</strong>
            </div>
            
            <div class="contenido">
                <p><strong>De mi consideración:</strong></p>
                
                <p>Yo, <strong>' . strtoupper($nombre_completo) . '</strong>, Cédula de identidad <strong>' . $clie_rucci . '</strong> en calidad de paciente (…X.…) o representante (…...), AUTORIZO a CLÍNICA DE ESPECIALIDADES SUR, la entrega de mi historial clínico, o de mi representado, así como los resultados de los exámenes de laboratorio o de imagen u otra documentación referente a mi atención médica. Dicha entrega podrá realizarse de acuerdo a los requerimientos judiciales-administrativos de entidades públicas y privadas. Se entregará a las instituciones que componen la Red Pública Integral de Salud y/o Compañía de Seguros la documentación que requieran para sus procesos de Auditoría Médica/Reembolso al Hospital, correspondiente a la atención recibida el <strong>' . $fecha_atencion . '</strong> o asegurado.</p>
                
                <p>En caso de no autorizar la entrega de la documentación señalada en el párrafo anterior, comprendo y acepto que esto podría limitar la cobertura, deslindando de responsabilidad a CLÍNICA DE ESPECIALIDADES SUR. En este sentido.</p>
                
                <p>Las compañías de seguros y/o instituciones que componen la Red Pública Integral de Salud, darán el uso que corresponda a la información proporcionada bajo mi autorización por lo cual, desvinculo de toda responsabilidad administrativa, civil o penal a CLÍNICA DE ESPECIALIDADES SUR por la entrega de ésta.</p>
            </div>
            
            <div style="text-align: left; margin-top: 60px;">
                <p><strong>Atentamente,</strong></p>
            </div>
            
            <div class="firma-seccion">
                <div class="linea-firma"></div>
                <p >FIRMA</p>
                <p class="nombre-cedula">' . strtoupper($nombre_completo) . '</p>
                <p class="nombre-cedula">CI: ' . $clie_rucci . '</p>
            </div>
        </body>
        </html>';
    }

    // ============================================================================
    // PDF 2: AUTORIZACIONES MÉDICAS HOSPITALIZACIÓN
    // ============================================================================

    elseif ($conset_nombre == 'CES AUTORIZACIONES MEDICAS HOSPITALIZACION') {

        $html_reporte = '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <style>
                body { 
                    font-family: Arial, sans-serif; 
                    font-size: 9px; 
                    margin: 15px;
                }
                
                .header-tabla {
                    width: 100%;
                    border: 2px solid #000;
                    border-collapse: collapse;
                    margin-bottom: 15px;
                }
                
                .header-tabla td {
                    padding: 6px;
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
                    color: #0066CC;
                }
                
                .codigo-cell {
                    width: 100px;
                    text-align: center;
                    font-size: 8px;
                }
                
                .seccion-titulo {
                    background-color: #CCCCFF;
                    padding: 5px;
                    font-weight: bold;
                    margin-top: 10px;
                    margin-bottom: 5px;
                    font-size: 10px;
                }
                
                .tabla-datos {
                    width: 100%;
                    border-collapse: collapse;
                    margin-bottom: 10px;
                }
                
                .tabla-datos td {
                    border: 1px solid #000;
                    padding: 5px;
                    font-size: 9px;
                }
                
                .label {
                    font-weight: bold;
                    background-color: #f0f0f0;
                    width: 30%;
                }
                
                .valor {
                    width: 70%;
                }
                
                .fecha-derecha {
                    text-align: right;
                    margin-bottom: 10px;
                    font-weight: bold;
                }
                
              .atencion-td {
                    white-space: nowrap;        
                    overflow: hidden;           
                    text-overflow: clip;
                    font-size: 12px;             
                }
                
                .checkbox-group {
                    display: inline-block;
                    margin-right: 10px;
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
                        <div class="subtitulo">AUTORIZACIÓN ATENCIÓN</div>
                    </td>
                    <td class="codigo-cell">
                        <strong>N° HCU:</strong><br>' . $hc . '
                    </td>
                </tr>
            </table>
            
            <div class="fecha-derecha">
                FECHA: ' . strtoupper($fecha_texto) . '
            </div>
            
            <table class="tabla-datos">
                <tr>
                    <td class="label">Nombre Titular:</td>
                    <td class="valor">&nbsp;</td>
                    <td class="label">Nombre del Paciente:</td>
                    <td class="valor">' . strtoupper($nombre_completo) . '</td>
                </tr>
                <tr>
                    <td class="label">Empresa Titular:</td>
                    <td class="valor">&nbsp;</td>
                    <td class="label">Cédula Identidad:</td>
                    <td class="valor">' . $clie_rucci . '</td>
                </tr>
                <tr>
                    <td class="label">Cargo Titular:</td>
                    <td class="valor" colspan="3">&nbsp;</td>
                </tr>
            </table>
            
            <table style="width:100%; border-collapse:collapse; table-layout:fixed;">
                <tr>
                    <td class="atencion-td">
                        <strong>Tipo de atención:</strong>
                        <span >Emergencia: _____</span>
                        <span >Hospitalización: _____</span>
                        <span class="checkbox-group">Consulta Externa: _____</span>
                        <strong>Habitación N°:</strong>
                    </td>
                </tr>
            </table>

            
            <div class="seccion-titulo">DATOS PARA LA FACTURACIÓN</div>
            <table class="tabla-datos">
                <tr>
                    <td class="label">Nombre:</td>
                    <td class="valor">&nbsp;</td>
                    <td class="label">RUC Y/O CÉDULA:</td>
                    <td class="valor">&nbsp;</td>
                </tr>
                <tr>
                    <td class="label">Dirección:</td>
                    <td class="valor">&nbsp;</td>
                    <td class="label">Teléfono:</td>
                    <td class="valor">&nbsp;</td>
                </tr>
            </table>
            
            <div class="seccion-titulo">INFORMACIÓN AUTORIZACIÓN SEGURO MÉDICO</div>
            <table class="tabla-datos">
                <tr>
                    <td class="label">Compañía de Seguros Médicos:</td>
                    <td class="valor" colspan="3">&nbsp;</td>
                </tr>
                <tr>
                    <td class="label">Bróker de gestión:</td>
                    <td class="valor">&nbsp;</td>
                    <td class="label">Póliza No.:</td>
                    <td class="valor">&nbsp;</td>
                </tr>
                <tr>
                    <td class="label">Contrato No.:</td>
                    <td class="valor">&nbsp;</td>
                    <td class="label">Garantía Tipo:</td>
                    <td class="valor">&nbsp;</td>
                </tr>
                <tr>
                    <td class="label">Número de tránsito:</td>
                    <td class="valor">&nbsp;</td>
                    <td class="label">Autorizado por:</td>
                    <td class="valor">&nbsp;</td>
                </tr>
                <tr>
                    <td class="label">Porcentaje de Autorización:</td>
                    <td class="valor">&nbsp;</td>
                    <td class="label">Tope Cobertura (USD):</td>
                    <td class="valor">&nbsp;</td>
                </tr>
            </table>
            
            <div style="margin: 10px 0; padding: 8px; border: 1px solid #000;">
                <strong>Garantía:</strong> 
                TARJETA ___ CHEQUE ___ VOUCHER ___ EFECTIVO ___
            </div>
            
            <table class="tabla-datos">
                <tr>
                    <td class="label">Tipo:</td>
                    <td class="valor">&nbsp;</td>
                    <td class="label">Banco/Emisor:</td>
                    <td class="valor">&nbsp;</td>
                </tr>
                <tr>
                    <td class="label">No.:</td>
                    <td class="valor">&nbsp;</td>
                    <td class="label">Titular:</td>
                    <td class="valor">&nbsp;</td>
                </tr>
                <tr>
                    <td class="label">Recibido por:</td>
                    <td class="valor">&nbsp;</td>
                    <td class="label">Fecha:</td>
                    <td class="valor">&nbsp;</td>
                </tr>
            </table>
            
            <div class="seccion-titulo">DIAGNÓSTICO</div>
            <table class="tabla-datos">
                <tr>
                    <td style="height: 40px;">&nbsp;</td>
                </tr>
            </table>
            
            <div class="seccion-titulo">NOMBRE DE MÉDICOS Y ESPECIALIDAD</div>
            <table class="tabla-datos">
                <tr>
                    <td class="label" style="width: 50%;">PACIENTE CES</td>
                    <td class="valor" style="width: 50%;">PACIENTE DE MÉDICO</td>
                </tr>
                <tr>
                    <td>DR. SANTIAGO BARROS</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>DR. HUGO BARROS</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>DR. SUÁREZ PATRICIO</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="2" style="height: 30px;">&nbsp;</td>
                </tr>
            </table>
            
            <table class="tabla-datos" style="margin-top: 15px;">
                <tr>
        <td class="label">Ingreso realizado por:</td>
        <td class="valor">' .$usuario_registra.'</td>
    </tr>
    <tr>
        <td class="label">Elaborado por:</td>
        <td class="valor">' . $usuario_registra. ' </td>
    </tr>
            </table>
        </body>
        </html>';
    }
    elseif ($conset_nombre == 'CES CONSENTIMIENTO DE TRATAMIENTO DE DATOS PERSONALES') {
        $html_reporte = '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <style>
                body { 
                    font-family: Arial, sans-serif; 
                    font-size: 11px; 
                    margin: 20px;
                    line-height: 1.6;
                }
                
                .header-tabla {
                    width: 100%;
                    border: 2px solid #000;
                    border-collapse: collapse;
                    margin-bottom: 20px;
                }
                
                .header-tabla td {
                    padding: 8px;
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
                    margin-bottom: 5px;
                }
                
                .subtitulo {
                    font-size: 12px;
                    font-weight: bold;
                    color: #0066CC;
                }
                
                .codigo-cell {
                    width: 100px;
                    text-align: center;
                    font-size: 10px;
                }
                
                .fecha-derecha {
                    text-align: right;
                    margin-bottom: 20px;
                    font-size: 11px;
                }
                
                .destinatario {
                    margin-bottom: 20px;
                    line-height: 1.4;
                }
                
                .contenido {
                    text-align: justify;
                    margin-bottom: 30px;
                }
                
                .contenido p {
                    margin-bottom: 15px;
                }
                
                .firma-seccion {
                    margin-top: 80px;
                    text-align: left;
                }
                
                .linea-firma {
                    border-top: 1px solid #000;
                    width: 170px;
                    text-align: left;
                }
                
                .nombre-cedula {
                    font-weight: bold;
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
                        <div class="subtitulo">CONSENTIMIENTO EXPRESO PARA TRATAMIENTO DE DATOS PERSONALES DE PACIENTES</div>
                    </td>
                    <td class="codigo-cell">
                        <strong>N° HCU:</strong><br>' . $hc . '
                    </td>
                </tr>
            </table>   
            <div class="contenido"> 
                <p>
                   BARROS MORETA MEDICOS CIA. LTDA., con nombre comercial CLINICA DE ESPECIALIDADES SUR CES. a quien
                   en adelante se le denominará con su nombre comercial, con el propósito de dar cumplimiento a la Ley Orgánica de Protección de Datos Personales, Informa:
                </p>
                <p>
                a)	Los datos personales solicitados y facilitados por usted, son requeridos con la finalidad de brindarle servicios de salud, atenciones médicas en consulta externa y/o hospitalaria, en actividades relacionadas con el manejo de su salud.
                </p>
                <p>
                b)	El único destinatario de la Información será CLINICA DE ESPECIALIDADES SUR y también a quienes expresamente el paciente autorice ceder sus datos en este formulario. Dicho esto, autorizan para que sus datos sean cedidos a favor de la persona natural o jurídica que se encargue de realizar la cobranza extrajudicial y/o judicial en caso de que mantenga valores pendientes con la CLINICA DE ESPECIALIDADES SUR.
                </p>
                <p>
                c)	Los datos proporcionados cuentan con el compromiso de confidencialidad y, para el caso de datos de salud, el personal médico respalda la protección de las mismos por medio del secreto profesional.
                </p>
                <p>
                d)	La conservación y custodia de la documentación en el archivo se realizará acorde a lo estipulado en el Acuerdo Nro. 0457 emitido por el Ministerio de Salud Pública o la norma que lo reemplace.
                </p>
                <p>
                e)	Los datos personales recabados y recibidos serán utilizados para fines de facturación, cobranza, contacto, realización de encuestas de satisfacción, participación en eventos y envío de publicidad.
                </p>
                <p>
f)	Los pacientes que tengan 15, 16 o 17 años, podrán y se encuentran legalmente facultados para suscribir este formulario de consentimiento, sin necesidad de que su representante legal lo ratifique.
En función de lo expuesto, al <strong>' . strtoupper($nombre_completo) . '</strong> presente documento otorgo mi consentimiento libre, 
voluntario, especifico, informado e inequívoco a CLINICA DE ESPECIALIDADES SUR para que trate
 los datos personales acorde a lo detallado previamente.
                </p>
                
               <p>
               Así mismo, declaro que se me ha informado sobre el derecho de acceso, rectificación, actualización, eliminación y oposición que tengo respecto de mis datos personales. Por lo que, en caso de que deba ejercer cualquiera de ellos, informaré oportunamente al correo: convenios@ces.med.ec / bbarros@ces.med.ec o a la persona que CLINICA DE ESPECIALIDADES SUR señale para el efecto.
                </p>
                
               <p>
               De la misma manera, tal como lo prevé el Art. 8 de la Ley Orgánica de Protección de Datos Personales, se me ha informado que puedo revocar en cualquier momento el consentimiento que  por medio de este instrumento estoy entregando para el tratamiento de mis datos personales, por lo que, en caso de así hacerlo, remitiré un escrito al correo: convenios@ces.med.ec / bbarros@ces.med.ecg
               </p>
               <p>
               Dado en la ciudad de Quito,<strong>' . $fecha_atencion . '</strong> 
               </p>                    
      
            </div>
            
            <div style="text-align: left; margin-top: 7px;">
                <p><strong>Atentamente,</strong></p>
            </div>
            
            <div class="firma-seccion">
                <div class="linea-firma"></div>
                <p >FIRMA</p>
                <p class="nombre-cedula">' . strtoupper($nombre_completo) . '</p>
                <p class="nombre-cedula">CI: ' . $clie_rucci . '</p>
            </div>
        </body>
        </html>';
    }


    elseif ($conset_nombre == 'CES CONTRATO DE ADMISION') {
        $html_reporte = '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <style>
                body { 
                    font-family: Arial, sans-serif; 
                    font-size: 11px; 
                    margin: 20px;
                    line-height: 1.6;
                }
                
                .header-tabla {
                    width: 100%;
                    border: 2px solid #000;
                    border-collapse: collapse;
                    margin-bottom: 20px;
                }
                
                .header-tabla td {
                    padding: 8px;
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
                    margin-bottom: 5px;
                }
                
                .subtitulo {
                    font-size: 12px;
                    font-weight: bold;
                    color: #0066CC;
                }
                
                .codigo-cell {
                    width: 100px;
                    text-align: center;
                    font-size: 10px;
                }
                
                .flecha-der {
                    text-align: center;
                    margin-bottom: 20px;
                    font-size: 11px;
                }
                
                .destinatario {
                    margin-bottom: 20px;
                    line-height: 1.4;
                }
                
                .contenido {
                    text-align: justify;
                    margin-bottom: 30px;
                }
                
                .contenido p {
                    margin-bottom: 15px;
                }
                
                .firma-seccion {
                    margin-top: 80px;
                    text-align: left;
                }
                
                .linea-firma {
                    border-top: 1px solid #000;
                    width: 170px;
                    text-align: left;
                }
                
                .nombre-cedula {
                    font-weight: bold;
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
                        <div class="subtitulo">CONTRATO DE ADMISIÓN A CLÍNICA DE ESPECIALIDADES SUR</div>
                    </td>
                    <td class="codigo-cell">
                        <strong>N° HCU:</strong><br>' . $hc . '
                    </td>
                </tr>
            </table>   
              <div class="flecha-der">
Antes de firmar este contrato de adhesión léalo integralmente            </div>
            <div class="contenido"> 
                <p>
                Comparecen a la celebración del presente contrato de adhesión de admisión al Servicio de Salud denominado BARROS MORETA MEDICOS CIA. LTDA., conocida con nombre comercial CLÍNICA DE ESPECIALIDADES SUR, por una parte, a quien en el adelante se le denominará como "LA CLÍNICA", y por otra parte, el Sr./a <strong>' . strtoupper($nombre_completo) . '</strong>  por sus propios derechos, como paciente o por los derechos que representa de quien será el o la paciente, sea en su calidad de representante legal o sea interviniendo según los artículos 1465 y 1466 del Código Civil, y a quien en adelante se le conocerá como “EL O LA CONTRATANTE”, quienes en forma libre y voluntariamente celebran este contrato de conformidad con las siguientes cláusulas: 
                </p>
                <p>
                <strong>CLAÚSULA PRIMERA: ANTECEDENTES.</strong> -a) La Compañía BARROS MORETA MEDICOS CIA. LTDA., con
nombre comercial CLÍNICA DE ESPECIALIDADES SUR, es un Clínica Privada que brinda servicios de salud en consulta externa y hospitalización, que cuenta con todos los permisos de funcionamiento otorgados por las entidades reguladoras, conforme a su nivel de servicios de la salud en base a lo dispuesto por la autoridad competente, para poder ingresar a pacientes y brindarle un servicio hospitalario de acuerdo con la categorización otorgada; b) CLINICA DE ESPECIALIDADES SUR aplica para honorarios médicos el libro de códigos Tarifario Ingenix o Mc Graw Hill, c) CLÍNICA DE ESPECIALIDADES SUR  publica los costes hospitalarios para conocimiento del paciente.

                </p>
                <p>
                <strong>CLAÚSULA SEGUNDA: OBJETO. </strong>- El presente contrato tiene como objeto el admitir que el Sr./a <strong>' . strtoupper($nombre_completo) . '</strong>  a quien en adelante se le conocerá como El o La Paciente, a fin  de prestarle los servicios hospitalarios que sean ordenados por el médico tratante , los cuales, siendo propios del servicio hospitalario, siendo consisten, pero no se limitan, en hospitalización, y facilitación de instalaciones, uso de equipos para el diagnóstico y/o tratamiento, suministro de fármacos e insumos, atención a cargo de personal médico, servicios de enfermería y personal paramédico, intervenciones quirúrgicas y procedimientos que se requieran, relacionados con las enfermedades del paciente y de las posibles eventualidades que pudieran presentarse durante la atención hospitalaria. Cabe indicar que los servicios hospitalarios son independientes y distintos de los servicios médicos, toda vez que éstos son los brindados a los pacientes por uno o más de los Médicos Tratantes titulados, con fines de diagnóstico, terapia y tratamiento que pueden incluir prestaciones ambulatorias o de internamiento, preventivas o de recuperación, invasivas o no, intermedias o finales o cualquier otro tipo de clasificación de servicio médico que el profesional pueda prestar dentro o fuera de las instalaciones de "La Clínica”. Cabe indicar que los datos del paciente constan en el formulario de admisión y que es parte integrante de este contrato.
                </p>
                <p>
                <strong>CLAÚSULA TERCERA:  OBLIGACIONES DE PAGO.</strong> -El o La Contratante se obliga en forma expresa a
pagar una vez dado el alta por parte del Médico Tratante, todas las facturas por los servicios prestados al Paciente, sobre la base de las tarifas vigentes a la fecha de contratación del servicio y los términos establecidos por "LA CLÍNICA" y que son de conocimiento del Paciente. Si el Paciente, para cubrir sus gastos médicos tuviere algún tipo de seguro, o plan de medicina prepagada, o se atendiere por cuenta de una compañía con la cual tenga convenio “LA CLINICA” el paciente o representante legal tiene la obligación de comunicarlo al momento de su admisión al personal de dicha área, a fin de que se efectúen los correspondientes procedimientos con las instancias antes mencionadas; el Contratante asumirá los gastos no incluidos o no cubiertos por el plan de la institución o compañía, así como el pago de coaseguros, deducibles u otros valores establecidos por la entidad contratante. Si por cualquier razón la entidad pagadora no cancelare los valores respectivos, el Contratante se obliga a cancelar directa e inmediatamente los valores adeudados. En caso de accidente de tránsito comprobado si sobrepasa la cobertura máxima de gastos médicos del SPPAT, el Paciente, cancelara la totalidad de la diferencia que exceda. De ser requeridos los servicios de un Abogado para el cobro de la obligación, el Contratante cancelará todos los gastos de las gestiones judiciales o extrajudiciales que se hayan demandado para el cobro, así como el máximo interés convencional más el máximo interés de mora permitidos por la ley desde el alta del paciente. El Contratante declara conocer y acepta que los médicos no dependientes de "LA CLÍNICA” que le presten sus servicios, facturarán sus honorarios en base al Tarifario establecido, a través de la caja de la Clínica, los que serán considerados adicionales a los servicios facturados por "LA CLÍNICA". De igual manera los pacientes que ingresen bajo el cuidado de su Médico Tratante, derivado de una atención externa previa en la consulta privada de su médico, o solicitaren expresamente la atención de un médico que no se encuentre en su turno de llamada, podrían acordar los honorarios por sus servicios de forma particular (paciente "Privado"), "LA CLÍNICA" solicitará abonos parciales, a su criterio, durante la estadía del paciente.
Se deja expresa constancia de que en caso de que EL o La Contratante haya adquirido algún plan y/o paquete ofertado por "LA CLÍNICA", El o La Contratante se compromete a cancelar los valores extras que podrían generarse en caso de complicaciones médicas, medicinas adicionales, pruebas de PCR y otros gastos no contemplados dentro del plan y/o paquete escogido.


                </p>
                <p>
                <strong>CLAÚSULA CUARTA: TARIFA DE SERVICIOS MEDICOS.</strong> -Se entiende como "Tarifa de servicios médicos" aquella que se refiere y cubre exclusivamente los servicios que se requieren de una prestación humana, lo cual es conocido y entendido por el paciente. Los rubros que se cobran aparte de la Tarifa de honorarios médicos son los siguientes:
a).	Medicinas, insumos, material de curación, suministros de cirugía y suministros médicos, drogas controladas, soluciones parenterales, material de uso menor, material de esterilización y oxígeno o gases médicos;
b).	El uso de todos los equipos instalados en "LA CLÍNICA" que sean necesarios para la atención médica o quirúrgica del paciente;
c).	El uso de las instalaciones de la Clínica como habitaciones, quirófanos, salas de emergencia, sala de la Unidad de Cuidados Intensivos, sala de recuperación, fisioterapia, rehabilitación, etc.;
d). Otros servicios complementarios adicionales requeridos por el paciente y/o su representante
legal.

                </p>
                <p>
                 <strong>CLAÚSULA QUINTA DE LA TERMINACION DE LOS SERVICIOS. </strong> - Los servicios de la Compañía BARROS
MORETA MEDICOS CIA. LTDA., con nombre comercial CLÍNICA DE ESPECIALIDADES SUR, terminaran para con el Paciente en el momento en el cual el o los Médicos Tratantes dieren el alta al Paciente o si el paciente solicitara el alta voluntaria, quien deberá entregar la habitación en la que se hubiera encontrado, pudiendo permanecer en ella, sin recargo, (hasta tres horas después de la indicación médica del alta). En la eventualidad de que el paciente se negare a dejar la habitación, habrá un recargo del cien por ciento del valor de la habitación y, "LA CLÍNICA" no estará obligado a prestar ningún tipo de servicio de enfermería, alimentación o aseo desde el momento del alta, excepto en el caso de que el paciente llegare a estar en una situación de urgencia o emergencia situación en la cual se brindará el servicio en forma inmediata.

                </p>
                <p>
                <strong> CLAUSULA SEXTA: RESPONSABILIDAD SOLIDARIA.</strong>  - En el caso de que el Paciente no sea la persona que suscriba el presente contrato y que una tercera persona lo haga en su nombre basado en lo que determinan los artículos 1465 y 1466 del Código Civil, el contratante o suscriptor de este contrato se hace responsable solidario de la falta de pago de la cuenta por parte del Paciente, a menos que el Paciente hubiere aceptado o ratificado expresa o tácitamente el contrato.
El Paciente declara conocer que la relación contractual con el o los médicos es distinta de la relación contractual con la Compañía BARROS MORETA MEDICOS CIA. LTDA., con nombre comercial CLÍNICA DE ESPECIALIDADES SUR como servicio de salud, por lo que, manifiesta expresamente que los servicios hospitalarios son de exclusiva responsabilidad de la Compañía BARROS MORETA MEDICOS CIA. LTDA., con nombre comercial CLÍNICA DE ESPECIALIDADES SUR, obligación diferente de la obligación que tienen los facultativos médicos para con el Paciente. Si el Paciente ingresare a la Compañía BARROS MORETA MEDICOS CIA. LTDA., con nombre comercial CLÍNICA DE ESPECIALIDADES SUR, por su propia cuenta, es decir que no lo hizo por pedido o recomendación de médico alguno y si no tuviere un profesional médico de su predilección, la Institución podrá referirle al médico que estuviere de llamada de la especialidad que correspondiere, en este caso la Compañía BARROS MORETA MEDICOS CIA. LTDA., con nombre comercial CLÍNICA DE ESPECIALIDADES SUR,
tampoco asume responsabilidad alguna de las actuaciones del médico referido, ya que se limita a realizar dicha referencia como un servicio adicional al Paciente, quien tiene la libertad de aceptar o rechazar al profesional médico referido, pudiendo inclusive escoger el médico que deseare Si el Paciente ingresare a la Compañía BARROS MORETA MEDICOS CIA. LTDA., con nombre comercial CLÍNICA DE ESPECIALIDADES SUR, a través de un organismo, fundación, organización, programa o a través de cualquier otra persona natural o jurídica que se dedica a la prestación de servicios médicos, sea de carácter lucrativo o de beneficencia, las actuaciones de dichas personas o entidades no serán imputables LA CLÍNICA, aun cuando tuvieren convenio.

                </p>
                <p>
              <strong> CLAÚSULA SÉPTIMA: CONDICIONES GENERALES. </strong> -Las partes de común acuerdo se sujetan expresamente a las siguientes Condiciones Generales de Admisión a la Compañía BARROS MORETA
MEDICOS CIA. LTDA., con nombre comercial CLÍNICA DE ESPECIALIDADES SUR, y las aceptan en su totalidad:
Con lo Relacionado a la Atención de Enfermería. Si el paciente o sus familiares solicitaren por escrito en forma exclusiva la atención de un miembro del personal de enfermería, a la Compañía BARROS MORETA MEDICOS CIA. LTDA., con nombre comercial   CLÍNICA DE ESPECIALIDADES SUR,
proporcionará estos servicios a través del Servicio de Enfermería a coste del paciente o Contratante.
Con relación al Reglamento de Visitas, Circulación y Restricción de áreas.-El Paciente se compromete a respetar y hacer respetar a sus visitantes el horario de visitas, la prohibición de fumar e ingerir bebidas alcohólicas, la prohibición del ingreso de alimentos o bebidas en general a las instalaciones de la clínica, así como la observancia de los letreros, normas, derechos y deberes de los pacientes que rigen para el funcionamiento de "LA CLÍNICA"; de igual forma, estar consciente que "LA CLÍNICA" no es un lugar apropiado para niños o para eventos festivos, por lo que se requiere se mantenga silencio y se conserve actitud de respeto para los pacientes, bajo la prevención de restringir las visitas en caso contrario.
Con relación al Inventario y Valores Personales. El Paciente o su Representante se compromete a respetar y entregar debidamente cuidado el inventario tanto de mobiliario cuanto de la ropa que se le entregue para su uso. Así mismo el Paciente o su Representante liberan a la Compañía BARROS MORETA MEDICOS CIA. LTDA., con nombre comercial CLÍNICA DE ESPECIALIDADES SUR, por la pérdida o daños que puedan sufrir las pertenencias que no hayan sido expresamente entregadas en custodia para ser guardados en la caja de valores que posee "LA CLÍNICA"

                </p>
                <p>
            <strong> CLAÚSULA OCTAVA: DECLARACIONES.  </strong>- El Paciente o su Representante declara:
a)	Que ha sido informado sobre cuáles son los derechos y deberes que tiene el paciente en la Compañía BARROS MORETA MEDICOS CIA. LTDA., con nombre comercial CLÍNICA DE ESPECIALIDADES SUR, sobre la política de seguridad del paciente y más indicaciones generales durante la estancia en la clínica, por lo que sujetará a las políticas y normas internas de administración de LA CLÍNICA sin excepción.
b)	Que conoce sobre la obligatoriedad de que todo adulto mayor de sesenta y cinco (65) años, niños hasta los catorce (14) años once (11) meses y personas con discapacidad requieren todo el tiempo de la compañía de un familiar, y, que en caso de no estar acompañado la Compañía BARROS MORETA MEDICOS CIA. LTDA., con nombre comercial CLÍNICA DE ESPECIALIDADES SUR, proporcionará a un miembro del personal de enfermería a coste del paciente o Contratante.
c)	Que conoce que la Compañía BARROS MORETA MEDICOS CIA. LTDA., con nombre comercial CLÍNICA DE ESPECIALIDADES SUR, es una Institución de Salud Privada con fines de lucro que. Por esta razón, el paciente declara que el ingreso a nuestra casa de salud es de carácter voluntario y como paciente particular, asumiendo totalmente el pago de los costos generados por la atención y todos los servicios recibidos durante su permanencia en nuestra Institución. Cabe mencionar que, si la condición de salud que presente el paciente al momento del ingreso, compromete la vida, recibirá la atención inmediata e integral y posteriormente si es necesario y/o por su propia decisión solicitará transferencia a otra casa de salud ya sea esta pública o privada.
                </p>
                <p>
               <strong> CLAÚSULA NOVENA: CONTROVERSIA.</strong> - Cualquier controversia que se llegare a suscitar entre la Compañía BARROS MORETA MEDICOS CIA. LTDA., con nombre comercial CLÍNICA DE ESPECIALIDADES SUR, y El Contratante acerca de la ejecución, validez, nulidad, interpretación, aplicación, cumplimiento o resolución de este contrato, cobro de valores adeudados o con cualquier otra materia que con él se relacione, como la Indemnización de daños y perjuicios y daño moral será sometido al arbitraje administrado por el Centro de Arbitraje de la Cámara de Comercio de Quito El Tribunal Arbitral deberá estar integrado por 3 árbitros que serán designados de conformidad con la Ley de Arbitraje y Mediación, el arbitraje será confidencial, los árbitros resolverán en derecho y quedan facultados para dictar medidas cautelares, solicitando el auxilio de funcionarios públicos para su ejecución. Las partes señalan como su domicilio para futuras citaciones y notificaciones relacionadas con el arbitraje, los que constan en este contrato indistintamente de ser el paciente o su representante y reconozco que leí con detenimiento este contrato y por ende entiendo su total contenido y que acepto todas las condiciones que se encuentran descritas en el mismo.
             </p>
              <table width="100%" style="margin-top: 15px;">
                <tr>
                    <td style="text-align: left;">
                        Quito, ' . $fecha_atencion . '
                    </td>
                    <td style="text-align: right;">
                        Hora: ' . $hora_atencion . '
                    </td>
                </tr>
            </table>     
            <br>
            <br>              

           <table width="100%" style="margin-top: 15px;">
    <tr>
        <td style="text-align: left;">
            <strong>CLÍNICA DE ESPECIALIDADES SUR</strong>
        </td>
        <td style="text-align: right;">
            <strong>EL CONTRATANTE</strong>
        </td>
    </tr>
</table>

  
               <p>
DECLARACION DE VOLUNTAD.- El Contratante o el Paciente en su calidad de Consumidores, una vez que hayan leído y entendido en su totalidad el presente contrato, y conocedor de los derechos que le otorga la Ley Orgánica de Defensa del Consumidor, declara en forma expresa su pleno consentimiento y conformidad con el convenio y sobre todo la cláusula arbitral contenida en el presente contrato y que además se le ha explicado claramente, dejando constancia que no renuncia a derecho alguno, y que al contrario hace uso de los derechos al escoger la jurisdicción convencional establecida para la solución de cualquier conflicto.               </p>    
               <p>
           <table width="100%" style="margin-top: 15px;">
                <tr>
                    <td style="text-align: left;">
                        Quito, ' . $fecha_atencion . '
                    </td>
                    <td style="text-align: right;">
                        Hora: ' . $hora_atencion . '
                    </td>
                </tr>
            </table>
<br>
            <br>   
<p style="text-align: center; margin-top: 20px;">
    <strong>EL CONTRATANTE</strong>
</p>
     
                            
      
            </div>
            
            
        </body>
        </html>';
    }
    elseif($conset_nombre == 'CES CONSENTIMIENTO INFORMADO FISIOTERAPIA')
    {
        $html_reporte = '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <style>
                body { 
                    font-family: Arial, sans-serif; 
                    font-size: 11px; 
                    margin: 20px;
                    line-height: 1.6;
                }
                
                .header-tabla {
                    width: 100%;
                    border: 2px solid #000;
                    border-collapse: collapse;
                    margin-bottom: 20px;
                }
                
                .header-tabla td {
                    padding: 8px;
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
                    margin-bottom: 5px;
                }
                
                .subtitulo {
                    font-size: 12px;
                    font-weight: bold;
                    color: #0066CC;
                }
                
                .codigo-cell {
                    width: 100px;
                    text-align: center;
                    font-size: 10px;
                }

                .destinatario {
                    margin-bottom: 20px;
                    line-height: 1.4;
                }
                
                .contenido {
                    text-align: justify;
                    margin-bottom: 30px;
                }
                
                .contenido p {
                    margin-bottom: 15px;
                }
                
                .firma-seccion {
                    margin-top: 80px;
                    text-align: left;
                }
                
                .linea-firma {
                    border-top: 1px solid #000;
                    width: 170px;
                    text-align: left;
                }
                
                .nombre-cedula {
                    font-weight: bold;
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
                        <div class="subtitulo">CONSENTIMIENTO INFORMADO FISIOTERAPIA</div>
                    </td>
                    <td class="codigo-cell">
                        <strong>N° HCU:</strong><br>' . $hc . '
                    </td>
                </tr>
            </table>   
            <div class="contenido"> 
                <p>
                <strong>Paciente: </strong>' . strtoupper($nombre_completo) . '
                </p>
                <p>
                <strong>Cédula:&nbsp;&nbsp;&nbsp;&nbsp;</strong>' . $clie_rucci . '<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fecha: </strong>' . $fecha_atencion . '
                </p>
                <p>
                Declaro que he sido informado/a de manera clara y comprensible sobre el tratamiento de <strong>fisioterapia</strong>, el cual puede incluir evaluación, ejercicios terapéuticos, terapia manual y aplicación de agentes físicos (electroterapia, termoterapia, crioterapia u otros), según mi condición clínica.
                </p>
                <p>
                Comprendo que el objetivo del tratamiento es mejorar mi función, movilidad y calidad de vida, y que los resultados pueden variar según mi evolución. Se me ha explicado que pueden presentarse molestias leves y temporales como dolor muscular o fatiga.
                </p>
                <p>
                Entiendo que puedo realizar preguntas, rechazar o suspender el tratamiento en cualquier momento, sin que esto afecte mi atención, y autorizo el manejo confidencial de mi información clínica conforme a la normativa vigente.
                </p>
                <p>
                Por lo anterior <strong>, ACEPTO VOLUNTARIAMENTE</strong> recibir tratamiento fisioterapéutico.
                </p>
                <br>
                <br>
                <p>
                <strong>Firma del paciente: </strong>__________________________
                </p>
                <p>
                <strong>Firma del fisioterapeuta: </strong>_____________________
                </p>  
            </div>
        </body>
        </html>';
    }
    elseif  ($conset_nombre == 'CES CONSENTIMIENTO INFORMADO LABORATORIO CLINICO')
    {
        $html_reporte = '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <style>
                body { 
                    font-family: Arial, sans-serif; 
                    font-size: 11px; 
                    margin: 20px;
                    line-height: 1.6;
                }
                
                .header-tabla {
                    width: 100%;
                    border: 2px solid #000;
                    border-collapse: collapse;
                    margin-bottom: 20px;
                }
                
                .header-tabla td {
                    padding: 8px;
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
                    margin-bottom: 5px;
                }
                
                .subtitulo {
                    font-size: 12px;
                    font-weight: bold;
                    color: #0066CC;
                }
                
                .codigo-cell {
                    width: 100px;
                    text-align: center;
                    font-size: 10px;
                }

                .destinatario {
                    margin-bottom: 20px;
                    line-height: 1.4;
                }
                
                .contenido {
                    text-align: justify;
                    margin-bottom: 30px;
                }
                
                .contenido p {
                    margin-bottom: 15px;
                }
                
                .firma-seccion {
                    margin-top: 80px;
                    text-align: left;
                }
                
                .linea-firma {
                    border-top: 1px solid #000;
                    width: 170px;
                    text-align: left;
                }
                
                .nombre-cedula {
                    font-weight: bold;
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
                        <div class="subtitulo">CONSENTIMIENTO INFORMADO LABORATORIO CLÍNICO</div>
                    </td>
                    <td class="codigo-cell">
                        <strong>N° HCU:</strong><br>' . $hc . '
                    </td>
                </tr>
            </table>   
            <div class="contenido"> 
            
                <p>
                <strong>Paciente: </strong>' . strtoupper($nombre_completo) . '
                </p>
                <p>
                <strong>Cédula:&nbsp;&nbsp;&nbsp;&nbsp;</strong>' . $clie_rucci . '<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fecha: </strong>' . $fecha_atencion . '
                </p>
                <p>
                    Declaro que he sido informado/a de manera clara, suficiente y comprensible sobre los procedimientos de laboratorio clínico que se me realizarán, los cuales pueden incluir la toma de muestras biológicas como sangre, orina, heces, secreciones u otras, de acuerdo con la solicitud médica y mi condición clínica.               
                </p>
                <p>
                    Comprendo que dichos exámenes tienen como finalidad contribuir al diagnóstico, control, seguimiento y prevención de enfermedades, y que los resultados pueden variar según múltiples factores. Se me ha explicado que la toma de muestras puede ocasionar molestias leves y temporales, tales como dolor, ardor, hematomas u otros efectos poco frecuentes.
                </p>
                <p>
                    Asimismo, autorizo el manejo confidencial de mi información clínica y de los resultados de los exámenes, conforme a la normativa legal vigente.                
                </p>
                <p>
                    Por lo anterior <strong>, ACEPTO VOLUNTARIAMENTE</strong> la realización de los procedimientos de laboratorio clínico indicados.
                </p>
                <br>
                <br>
                <p>
                <strong>Firma del paciente: </strong>__________________________
                </p>
                <p>
                <strong>Firma del profesional responsable: </strong>_____________________
                </p>  
            </div>
        </body>
        </html>';
    }
    elseif  ($conset_nombre == 'CES CONSENTIMIENTO INFORMADO RX')
    {
        $html_reporte = '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <style>
                body { 
                    font-family: Arial, sans-serif; 
                    font-size: 11px; 
                    margin: 20px;
                    line-height: 1.6;
                }
                
                .header-tabla {
                    width: 100%;
                    border: 2px solid #000;
                    border-collapse: collapse;
                    margin-bottom: 20px;
                }
                
                .header-tabla td {
                    padding: 8px;
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
                    margin-bottom: 5px;
                }
                
                .subtitulo {
                    font-size: 12px;
                    font-weight: bold;
                    color: #0066CC;
                }
                
                .codigo-cell {
                    width: 100px;
                    text-align: center;
                    font-size: 10px;
                }

                .destinatario {
                    margin-bottom: 20px;
                    line-height: 1.4;
                }
                
                .contenido {
                    text-align: justify;
                    margin-bottom: 30px;
                }
                
                .contenido p {
                    margin-bottom: 15px;
                }
                
                .firma-seccion {
                    margin-top: 80px;
                    text-align: left;
                }
                
                .linea-firma {
                    border-top: 1px solid #000;
                    width: 170px;
                    text-align: left;
                }
                
                .nombre-cedula {
                    font-weight: bold;
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
                        <div class="subtitulo">CONSENTIMIENTO INFORMADO PARA LA REALIZACIÓN DE EXÁMENES RADIOLÓGICOS</div>
                    </td>
                    <td class="codigo-cell">
                        <strong>N° HCU:</strong><br>' . $hc . '
                    </td>
                </tr>
            </table>   
            <div class="contenido"> 
                <p>
                    Yo <strong>' . strtoupper($nombre_completo) . '</strong> con cédula de identidad <strong>' . $clie_rucci . '</strong>, he solicitado por mi voluntad los servicios médicos de la CLÍNICA DE ESPECIALIDADES SUR y encontrándome en pleno uso de mis facultades mentales y con plena capacidad legal de autorización, por medio del presente documento DOY mi CONSENTIMIENTO INFORMADO  para la realización de procedimientos médicos y/o radiológicos que sean necesarios bajo los siguientes criterios:
                </p>
                <p>
                <strong>1.	INFORMACIÓN MÉDICA: </strong>RECONOZCO que he sido debidamente informado en lenguaje comprensible de mi estado de salud, por la cual según me informa el médico tratante se requiere de atención y de procedimientos médicos y/o radiológicos, los cuales yo he escogido dentro de un grupo de alternativas terapéuticas que he discutido con el médico tratante y <strong>AUTORIZO</strong> estos en particular, comprendiendo los riesgos y beneficios que estos procedimientos con llevan. 
                </p>                
                <p>
                <strong>2.	RIESGOS Y COMPLICACIONES: </strong>ACEPTO que la medicina no es una ciencia exacta y he sido debidamente informado de los riesgos y complicaciones específicos que pueden surgir a raíz de estos procedimientos mencionados , estos posibles riesgos y/o complicaciones COMPRENDO y soy consciente que no existen garantías absolutas de los resultados, pero que estos procedimientos están plenamente justificados para la recuperación de la salud como paciente y que la necesidad de realizarlos supera los riesgos de las posibles complicaciones.
                </p>                
                <p>
                <strong>3.	RIESGOS DE LOS RAYOS X: </strong> ENTIENDO que cuando se usan adecuadamente, los beneficios diagnósticos de los rayos x superan los riesgos considerablemente. Los rayos x pueden diagnosticar condiciones potencialmente mortales, tales como vasos sanguíneos bloqueados, cáncer de huesos e infecciones. Sin embargo, los rayos X producen radiación ionizante, una forma de radiación que tiene el potencial de dañar el tejido vivo. Este es un riesgo que aumenta con el número de exposiciones sumadas a lo largo de la vida de una persona. Sin embargo, el riesgo de desarrollar cáncer por exposición a la radiación es generalmente bajo.
                </p>                
                <br>
                <br>
                <p>
                <strong>Firma del paciente: </strong>__________________________
                </p> 
            </div>
        </body>
        </html>';
    }
    elseif  ($conset_nombre == 'CES ARTROSCOPIA HOMBRO DERECHO')
    {
        $html_reporte = '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <style>
                body { 
                    font-family: Arial, sans-serif; 
                    font-size: 11px; 
                    margin: 20px;
                    line-height: 1.6;
                }
                
                .header-tabla {
                    width: 100%;
                    border: 2px solid #000;
                    border-collapse: collapse;
                    margin-bottom: 20px;
                }
                
                .header-tabla td {
                    padding: 8px;
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
                    margin-bottom: 5px;
                }
                
                .subtitulo {
                    font-size: 12px;
                    font-weight: bold;
                    color: #0066CC;
                }
                
                .codigo-cell {
                    width: 100px;
                    text-align: center;
                    font-size: 10px;
                }

                .destinatario {
                    margin-bottom: 20px;
                    line-height: 1.4;
                }
                
                .contenido {
                    text-align: justify;
                }
                
                .contenido p {
                    margin-bottom: 15px;
                }
                
                .firma-seccion {
                    margin-top: 80px;
                    text-align: left;
                }
                
                .linea-firma {
                    border-top: 1px solid #000;
                    width: 170px;
                    text-align: left;
                }
                
                .nombre-cedula {
                    font-weight: bold;
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
                        <div class="subtitulo">Consentimiento Informado HOSPITALIZACIÓN</div>
                    </td>
                    <td class="codigo-cell">
                        <strong>Servicio TRAUMATOLOGÍA </strong><br>
                        <strong>N° HCU:</strong><br>' . $hc . '
                    </td>
                </tr>
            </table>        
            <div class="contenido"> 
                            <p style="font-size: 10px">
NÚMERO DE CÉDULA:<strong>' . $clie_rucci . '</strong> HCU DEL PACIENTE: <strong>' . $hc . '</strong></p>
            <table width="100%" >
                <tr>
                    <td style="text-align: left; font-size: 9px;">
                        Quito, ' . $fecha_atencion . '
                    </td>
                    <td style="text-align: right; font-size: 9px;">
                        Hora: ' . $hora_atencion . '
                    </td>
                </tr>
            </table>
                           <p style="font-size: 10px">
APELLIDO PATERNO: '.$apellido_paterno.' / APELLIDO MATERNO: '.$apellido_materno.' / PRIMER NOMBRE: '.$nombre_primero.' / SEGUNDO NOMBRE: '.$nombre_segundo.'</p>
               
                <p style="font-size: 10px">
                TIPO DE ATENCIÓN: Ambulatoria:___ 	Hospitalización:_X_	
                </p> 
                <p style="font-size: 10px">
                NOMBRE DEL DIAGNÓSTICO (codificación CIE10) <strong>SINDROME DE MANGUITO ROTADOR CIE10.- M751</strong>
                </p>  
                <p style="font-size: 10px">
                NOMBRE DEL PROCEDIMIENTO RECOMENDADO: <strong>ARTROSCOPIA DIAGNOSTICA Y TERAPÉUTICA DE HOMBRO </strong>                
                </p>             
                <p style="font-size: 9px">
                ¿EN QUÉ CONSISTE?  ES UNA CIRUGÍA EN LA CUAL SE UTILIZA UNA PEQUEÑA CÁMARA (ARTROSCOPIO) PARA EXAMINAR Y REPARAR LOS TEJIDOS DENTRO O ALREDEDOR DE LA ARTICULACIÓN DE HOMBRO
                ¿CÓMO SE REALIZA?  SE INTRODUCE EL ARTROSCOPIO EN EL HOMBRO A TRAVÉS DE PEQUEÑAS INCISIONES, SE CONECTA A UN MONITOR DE VIDEO DE QUIRÓFANO, SE INSPECCIONAN LOS TEJIDOS DE LA ARTICULACIÓN DEL HOMBRO, SE REPARA EL TEJIDO DAÑADO CON INSTRUMENTACIÓN ARTROSCÓPICA, SE PROCEDE A SÍNTESIS POR PLANOS 
                GRÁFICO DE LA INTERVENCIÓN (incluya un gráfico previamente seleccionado que facilite la comprensión al paciente)
                </p>                
                
                <div align="center" style="margin:10px 0;">
                    <img src="../archivo/manguito.jpg" width="380" height="auto">
                </div>
                <p style="font-size: 10px">
                DURACIÓN ESTIMADA DE LA INTERVENCIÓN:  <strong>2-3H</strong>
                </p>
                <p style="font-size: 10px">
                BENEFICIOS DEL PROCEDIMIENTO: mejoría clínica y funcional: <strong>ALIVIO DEL DOLOR, RECUPERACION ANATÓMICA Y FUNCIONAL</strong> 
                 </p>
                <p style="font-size: 10px">
                RIESGOS FRECUENTES (POCO GRAVES): <strong>INFECCIÓN DE SITIO QUIRURGICO, SANGRADO, SHOCK</strong> 
                </p>
                <p style="font-size: 10px">
                RIESGOS POCO FRECUENTES (GRAVES): <strong> ROTURA DE MANGUITO</strong>
                 </p>
                <p style="font-size: 10px">
                DE EXISTIR, ESCRIBA LOS RIESGOS ESPECÍFICOS RELACIONADOS CON EL PACIENTE (edad, estado de salud, creencias, valores, etc.): dolor, edema, sangrado
                 </p>
                <p style="font-size: 10px">
                ALTERNATIVAS AL PROCEDIMIENTO: <strong>TRATAMIENTO CLÍNICO</strong>
                </p>
                <p style="font-size: 10px">
                DESCRIPCIÓN DEL MANEJO POSTERIOR AL PROCEDIMIENTO:  <strong>REHABILITACIÓN FÍSICA</strong>	
                </p>
                <p style="font-size: 10px">
                CONSECUENCIAS POSIBLES SI NO SE REALIZA EL PROCEDIMIENTO: <strong>IMPOTENCIA FUNCIONAL</strong>

                </p>
  <p style="font-size: 10px">
                  <strong>DECLARACIÓN DE CONSENTIMIENTO INFORMADO</strong>&nbsp;&nbsp;&nbsp;&nbsp;<strong>Fecha:</strong> 	' . $fecha_atencion . '                                    <strong>    Hora:</strong> ' . $hora_atencion . ' 
                   </p>
                <p style="font-size: 9px">
He facilitado la información completa que conozco, y me ha sido solicitada, sobre los antecedentes personales, familiares y de mi estado de salud. Soy consciente de que omitir estos datos puede afectar los resultados del tratamiento. Estoy de acuerdo con el procedimiento que se me ha propuesto; he sido informado de las ventajas e inconvenientes del mismo; se me ha explicado de forma clara en qué consiste, los beneficios y posibles riesgos del procedimiento. He escuchado, leído y comprendido la información recibida y se me ha dado la oportunidad de preguntar sobre el procedimiento. He tomado consciente y libremente la decisión de autorizar el procedimiento. Consiento que, durante la intervención, me realicen otro procedimiento adicional, si es considerado necesario según el juicio del profesional de la salud, para mi beneficio. También conozco que puedo retirar mi consentimiento cuando lo estime oportuno.

</p>
<table width="100%" cellspacing="0" cellpadding="2"
      style="border-collapse:collapse; font-size:9px; color:#000;">
    <tr>
        <td style="border:1px solid #999; width:45%; background:#f2f2f2;">
            Nombre completo del paciente
        </td>
        <td style="border:1px solid #999; width:25%; background:#f2f2f2;">
            Cédula de ciudadanía
        </td>
        <td style="border:1px solid #999; width:30%; background:#f2f2f2;">
            Firma del paciente o huella, según el caso
        </td>
    </tr>
    <tr>
        <td style="border:1px solid #999;">
            '.$nombre_completo.'
        </td>
        <td style="border:1px solid #999;">
            '.$clie_rucci.'
        </td>
        <td style="border:1px solid #999; text-align:center;">
            __________________________
        </td>
    </tr>
</table>
<br>
<table width="100%" cellspacing="0" cellpadding="2"
      style="border-collapse:collapse; font-size:8px; color:#000;">
    <tr>
        <td style="border:1px solid #999; width:50%; background:#f2f2f2;">
            Nombre de profesional que realiza el procedimiento
        </td>
        <td style="border:1px solid #999; width:50%; background:#f2f2f2;">
            Sello y código del profesional
        </td>
    </tr>
    <tr>
        <td style="border:1px solid #999; height:40px; text-align:center;">
        </td>
        <td style="border:1px solid #999; height:40px;">
            
        </td>
    </tr>
</table>
<p style="font-size: 9px">Si el paciente no está en capacidad para firmar el consentimiento informado:</p>
<table width="100%" cellspacing="0" cellpadding="2"
      style="border-collapse:collapse; font-size:9px; color:#000;">
    <tr>
        <td style="border:1px solid #999; width:45%; background:#f2f2f2;">
            Nombre del representante legal
        </td>
        <td style="border:1px solid #999; width:25%; background:#f2f2f2;">
            Cédula de ciudadanía
        </td>
        <td style="border:1px solid #999; width:30%; background:#f2f2f2;">
            Firma del representante legal Parentesco
        </td>
    </tr>
    <tr>
        <td style="border:1px solid #999;">
        </td>
        <td style="border:1px solid #999;">
        </td>
        <td style="border:1px solid #999; text-align:center;">
            __________________________
        </td>
    </tr>
</table>
<p>
<strong>NEGATIVA DEL CONSENTIMIENTO INFORMADO</strong> &nbsp;&nbsp;&nbsp;&nbsp;	Fecha: <strong>'.$fecha_atencion.'</strong>&nbsp;&nbsp;&nbsp;&nbsp;Hora: <strong>'.$hora_atencion.'</strong>
</p>
<p style="font-size: 9px">
Una vez que he entendido claramente el procedimiento propuesto, así como las consecuencias posibles si no se realiza la intervención, no autorizo y me niego a que se me realice el procedimiento propuesto y desvinculo de responsabilidades futuras de cualquier índole al establecimiento de salud y al profesional sanitario que me atiende, por no realizar la intervención sugerida.


</p>
<table width="100%" cellspacing="0" cellpadding="2"
      style="border-collapse:collapse; font-size:9px; color:#000;">
    <tr>
        <td style="border:1px solid #999; width:45%; background:#f2f2f2;">
            Nombre completo del paciente
        </td>
        <td style="border:1px solid #999; width:25%; background:#f2f2f2;">
            Cédula de ciudadanía
        </td>
        <td style="border:1px solid #999; width:30%; background:#f2f2f2;">
            Firma del paciente o huella, según el caso
        </td>
    </tr>
    <tr>
        <td style="border:1px solid #999;">
            '.$nombre_completo.'
        </td>
        <td style="border:1px solid #999;">
            '.$clie_rucci.'
        </td>
        <td style="border:1px solid #999; text-align:center;">
            __________________________
        </td>
    </tr>
</table>
<br>
<table width="100%" cellspacing="0" cellpadding="2"
      style="border-collapse:collapse; font-size:8px; color:#000;">
    <tr>
        <td style="border:1px solid #999; width:50%; background:#f2f2f2;">
            Nombre de profesional que realiza el procedimiento
        </td>
        <td style="border:1px solid #999; width:50%; background:#f2f2f2;">
            Sello y código del profesional
        </td>
    </tr>
    <tr>
        <td style="border:1px solid #999; height:40px; text-align:center;">
        </td>
        <td style="border:1px solid #999; height:40px;">
            
        </td>
    </tr>
</table>
<p style="font-size: 9px">Si el paciente no está en capacidad para firmar el consentimiento informado:</p>
<table width="100%" cellspacing="0" cellpadding="2"
      style="border-collapse:collapse; font-size:9px; color:#000;">
    <tr>
        <td style="border:1px solid #999; width:45%; background:#f2f2f2;">
            Nombre del representante legal
        </td>
        <td style="border:1px solid #999; width:25%; background:#f2f2f2;">
            Cédula de ciudadanía
        </td>
        <td style="border:1px solid #999; width:30%; background:#f2f2f2;">
            Firma del representante legal Parentesco
        </td>
    </tr>
    <tr>
        <td style="border:1px solid #999;">
        </td>
        <td style="border:1px solid #999;">
        </td>
        <td style="border:1px solid #999; text-align:center;">
            __________________________
        </td>
    </tr>
</table>
         <p>
<strong>REVOCATORIA DE CONSENTIMIENTO INFORMADO</strong> &nbsp;&nbsp;&nbsp;&nbsp;	Fecha: <strong>'.$fecha_atencion.'</strong>&nbsp;&nbsp;&nbsp;&nbsp;Hora: <strong>'.$hora_atencion.'</strong>
</p>
<p style="font-size: 9px">
De forma libre y voluntaria, revoco el consentimiento realizado en fecha y manifiesto expresamente mi deseo de no continuar con el procedimiento médico que doy por finalizado en esta fecha:
Libero de responsabilidades futuras de cualquier índole al establecimiento de salud y al profesional sanitario que me atiende.


</p>
<table width="100%" cellspacing="0" cellpadding="2"
      style="border-collapse:collapse; font-size:9px; color:#000;">
    <tr>
        <td style="border:1px solid #999; width:45%; background:#f2f2f2;">
            Nombre completo del paciente
        </td>
        <td style="border:1px solid #999; width:25%; background:#f2f2f2;">
            Cédula de ciudadanía
        </td>
        <td style="border:1px solid #999; width:30%; background:#f2f2f2;">
            Firma del paciente o huella, según el caso
        </td>
    </tr>
    <tr>
        <td style="border:1px solid #999;">
            '.$nombre_completo.'
        </td>
        <td style="border:1px solid #999;">
            '.$clie_rucci.'
        </td>
        <td style="border:1px solid #999; text-align:center;">
            __________________________
        </td>
    </tr>
</table>
<br>
<table width="100%" cellspacing="0" cellpadding="2"
      style="border-collapse:collapse; font-size:8px; color:#000;">
    <tr>
        <td style="border:1px solid #999; width:50%; background:#f2f2f2;">
            Nombre de profesional que realiza el procedimiento
        </td>
        <td style="border:1px solid #999; width:50%; background:#f2f2f2;">
            Sello y código del profesional
        </td>
    </tr>
    <tr>
        <td style="border:1px solid #999; height:40px; text-align:center;">
        </td>
        <td style="border:1px solid #999; height:40px;">
            
        </td>
    </tr>
</table>
<p style="font-size: 9px">Si el paciente no está en capacidad para firmar el consentimiento informado:</p>
<table width="100%" cellspacing="0" cellpadding="2"
      style="border-collapse:collapse; font-size:9px; color:#000;">
    <tr>
        <td style="border:1px solid #999; width:45%; background:#f2f2f2;">
            Nombre del representante legal
        </td>
        <td style="border:1px solid #999; width:25%; background:#f2f2f2;">
            Cédula de ciudadanía
        </td>
        <td style="border:1px solid #999; width:30%; background:#f2f2f2;">
            Firma del representante legal Parentesco
        </td>
    </tr>
    <tr>
        <td style="border:1px solid #999;">
        </td>
        <td style="border:1px solid #999;">
        </td>
        <td style="border:1px solid #999; text-align:center;">
            __________________________
        </td>
    </tr>
</table>
                     
            </div>
        </body>
        </html>';
    }
    // ============================================================================
    // Si no coincide con ningún tipo conocido, mostrar mensaje
    // ============================================================================
    else {

        if (!empty($archiv_data)) {

            $ruta_archivo = "../archivo/" . $archiv_data;

            if (file_exists($ruta_archivo)) {

                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="' . basename($ruta_archivo) . '"');
                header('Content-Length: ' . filesize($ruta_archivo));
                header('Pragma: public');
                header('Cache-Control: must-revalidate');

                readfile($ruta_archivo);
                exit;

            } else {
                die('Archivo de consentimiento no encontrado.');
            }

        } else {
            die('No existe archivo asociado a este consentimiento.');
        }
    }


    // Generar PDF
    $dompdf = new DOMPDF();
    $dompdf->set_paper('A4', 'portrait');
    $dompdf->load_html($html_reporte, 'UTF-8');
    $dompdf->render();

    // Agregar numeración de páginas
    $canvas = $dompdf->get_canvas();
    $font = Font_Metrics::get_font("helvetica", "normal");
    $canvas->page_text(520, 820, "Página {PAGE_NUM} de {PAGE_COUNT}", $font, 7, array(0,0,0));

    // Determinar nombre del archivo según el tipo
    $nombre_base = ($conset_nombre == 'CES AUTORIZACION EXPRESA') ? 'AutorizacionExpresa' : 'AutorizacionAtencion';
    $nombre_archivo = $nombre_base . "_" . $hc . "_" . date("Y-m-d") . ".pdf";

    // Descargar PDF
    $dompdf->stream($nombre_archivo, array("Attachment" => false));
}
?>