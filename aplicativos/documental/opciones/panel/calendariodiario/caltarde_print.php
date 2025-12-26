<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
?>
<?php

// Conexi�n a la base de datos
//$host = "localhost";
$host = "localhost";
$db   = "cesdb_aroriginal";
$user = "root"; 
//$pass = "";     
$pass = "";
$conexion = new mysqli($host, $user, $pass, $db);
if ($conexion->connect_error) {
    die("Error de conexi�n: " . $conexion->connect_error);
}

// Captura filtros
$fecha_ini = isset($_GET['fecha_ini']) ? $_GET['fecha_ini'] : '';
$fecha_fin = isset($_GET['fecha_fin']) ? $_GET['fecha_fin'] : '';
$usua_id   = isset($_GET['usua_id']) ? intval($_GET['usua_id']) : 0;

// Construir condiciones din�micas
$condiciones = [];
if($fecha_ini != '') $condiciones[] = "t.terap_fecha >= '$fecha_ini'";
if($fecha_fin != '') $condiciones[] = "t.terap_fecha <= '$fecha_fin'";
if($usua_id > 0) $condiciones[] = "t.usua_id = $usua_id";

$where = '';
if(count($condiciones) > 0){
    $where = 'WHERE ' . implode(" AND ", $condiciones);
}

// Consulta de clientes agendados
$sql = "SELECT 
            t.terap_id,
            t.terap_fecha,
            t.terap_hora,
            t.terap_confirmado,
            t.terap_observacionconfirmado,
            c.clie_id,
            CONCAT(c.clie_nombre, ' ', c.clie_apellido) AS cliente_nombre,
            c.clie_celular,
            c.clie_email,
            u.usua_id,
            CONCAT(u.usua_nombre, ' ', u.usua_apellido) AS usuario_nombre
        FROM 
            faesa_terapiasregistro t
        INNER JOIN 
            app_cliente c ON t.clie_id = c.clie_id
        INNER JOIN
            app_usuario u ON t.usua_id = u.usua_id
        $where
        ORDER BY t.terap_fecha ASC, t.terap_hora ASC";

$result = $conexion->query($sql);

// Determinar columnas con datos
$columnas = [
    'terap_id' => 'ID',
    'terap_fecha' => 'Fecha',
    'terap_hora' => 'Hora',
    'cliente_nombre' => 'Cliente',
    'clie_celular' => 'Celular',
    'clie_email' => 'Email',
    'usuario_nombre' => 'Profesional',
    'terap_confirmado' => 'Confirmado',
    'terap_observacionconfirmado' => 'Observacion Confirmado'
];

$mostrarColumnas = array_fill_keys(array_keys($columnas), false);
$rows = [];
while($row = $result->fetch_assoc()){
    foreach($mostrarColumnas as $key => $valor){
        if(!empty($row[$key]) || $key == 'terap_confirmado') $mostrarColumnas[$key] = true;
    }
    $rows[] = $row;
}

// Exportar a Excel
if(isset($_GET['export']) && $_GET['export'] == 'excel'){
    header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
    header("Content-Disposition: attachment; filename=clientes_agendados.xls");
    header("Pragma: no-cache");
    header("Expires: 0");

    $output = '';
    // Cabecera
    foreach($mostrarColumnas as $key => $mostrar){
        if($mostrar) $output .= $columnas[$key]."\t";
    }
    $output .= "\n";

    // Filas
    foreach($rows as $row){
        foreach($mostrarColumnas as $key => $mostrar){
            if($mostrar){
                if($key == 'terap_confirmado'){
                    $output .= ($row[$key] == 1 ? 'SI' : 'NO')."\t";
                } else {
                    $dato = str_replace(["\t", "\n", "\r"], ' ', $row[$key]);
                    $output .= $dato."\t";
                }
            }
        }
        $output .= "\n";
    }

    echo $output;
    exit;
}

// Exportar a PDF usando TCPDF
if(isset($_GET['export']) && $_GET['export'] == 'pdf'){
    require_once('tcpdf_min/tcpdf.php'); 

    $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Sistema');
    $pdf->SetTitle('Clientes Agendados');
    $pdf->SetHeaderData('', 0, 'Clientes Agendados', '');
    $pdf->setHeaderFont(['helvetica', '', 10]);
    $pdf->setFooterFont(['helvetica', '', 8]);
    $pdf->SetMargins(10, 20, 10);
    $pdf->SetAutoPageBreak(TRUE, 15);
    $pdf->AddPage();

    $html = '<h2>Pacientes Agendados</h2>';
    $html .= '<table border="1" cellpadding="5" cellspacing="0">';
    $html .= '<tr>';
    foreach($mostrarColumnas as $key => $mostrar){
        if($mostrar) $html .= '<th style="background-color:#f2f2f2;">'.$columnas[$key].'</th>';
    }
    $html .= '</tr>';

    foreach($rows as $row){
        $bgcolor = ($row['terap_confirmado'] == 1) ? '#d4edda' : '#f8d7da';
        $html .= '<tr style="background-color:'.$bgcolor.';">';
        foreach($mostrarColumnas as $key => $mostrar){
            if($mostrar){
                if($key == 'terap_confirmado'){
                    $html .= '<td>'.($row[$key]==1?'SI':'NO').'</td>';
                } else {
                    $dato = htmlspecialchars($row[$key], ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
                    $html .= '<td>'.$dato.'</td>';
                }
            }
        }
        $html .= '</tr>';
    }
    $html .= '</table>';

    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Output('clientes_agendados.pdf', 'I');
    exit;
}

// Mostrar formulario de filtros
echo '<h2>Pacientes Agendados</h2>';
echo '<form method="get">';
echo 'Fecha inicio: <input type="date" name="fecha_ini" value="'.$fecha_ini.'"> ';
echo 'Fecha fin: <input type="date" name="fecha_fin" value="'.$fecha_fin.'"> ';
echo 'Profesional: <select name="usua_id"><option value="0">Todos</option>';
$usuarios = $conexion->query("SELECT usua_id, CONCAT(usua_nombre,' ',usua_apellido) AS nombre FROM app_usuario ORDER BY usua_nombre");
while($u = $usuarios->fetch_assoc()){
    $sel = ($u['usua_id'] == $usua_id) ? 'selected' : '';
    echo '<option value="'.$u['usua_id'].'" '.$sel.'>'.$u['nombre'].'</option>';
}
echo '</select> ';
echo '<input type="submit" value="Filtrar">';
echo '</form>';

// Enlaces de exportaci�n
$params = $_GET;
$params['export'] = 'excel';
$linkExcel = '?'.http_build_query($params);
$params['export'] = 'pdf';
$linkPDF = '?'.http_build_query($params);

echo '<a href="'.$linkExcel.'">Exportar a Excel</a> | <a href="'.$linkPDF.'"> </a>';

// Mostrar tabla en pantalla con colores seg�n confirmaci�n
echo '<table border="1" cellpadding="5">';
echo '<tr>';
foreach($mostrarColumnas as $key => $mostrar){
    if($mostrar) echo '<th>'.$columnas[$key].'</th>';
}
echo '</tr>';

foreach($rows as $row){
    $color = ($row['terap_confirmado'] == 1) ? '#d4edda' : '#f8d7da';
    echo '<tr style="background-color:'.$color.'">';
    foreach($mostrarColumnas as $key => $mostrar){
        if($mostrar){
            if($key == 'terap_confirmado'){
                echo '<td>'.($row[$key] == 1 ? 'SI' : 'NO').'</td>';
            } else {
                echo '<td>'.$row[$key].'</td>';
            }
        }
    }
    echo '</tr>';
}
echo '</table>';

$conexion->close();
?>
