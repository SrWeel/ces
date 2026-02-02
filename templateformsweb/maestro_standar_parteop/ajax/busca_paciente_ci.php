<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
header('Content-Type: application/json; charset=UTF-8');

session_start();
if(!$_SESSION['ces1313777_sessid_inicio']){
    echo json_encode(["ok"=>false]);
    exit;
}

$director = __DIR__ . '/../../../';
require_once $director . 'cfg/clases.php';
require_once $director . 'cfg/declaracion.php';

$ci = trim(isset($_POST["ci"]) ? $_POST["ci"] : '');

if(strlen($ci) < 1){
    echo json_encode(["ok"=>false, "data"=>[]]);
    exit;
}

$sql = "
SELECT 
    clie_id,
    clie_nombre,
    clie_apellido,
    clie_fechanacimiento,
    clie_rucci
FROM app_cliente
WHERE clie_rucci LIKE ?
ORDER BY clie_rucci
LIMIT 10
";

$rs = $DB_gogess->executec($sql, ["$ci%"]);

$data = [];

if($rs){
    while(!$rs->EOF){

        $edad = 0;
        if($rs->fields["clie_fechanacimiento"]){
            $fn = new DateTime($rs->fields["clie_fechanacimiento"]);
            $edad = (new DateTime())->diff($fn)->y;
        }

        $data[] = [
            "clie_id" => $rs->fields["clie_id"],
            "ci"      => $rs->fields["clie_rucci"],
            "nombre"  => $rs->fields["clie_nombre"]." ".$rs->fields["clie_apellido"],
            "edad"    => $edad
        ];

        $rs->MoveNext();
    }
}

echo json_encode([
    "ok" => true,
    "data" => $data
]);
