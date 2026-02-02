<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
session_start();

if (!isset($_SESSION['ces1313777_sessid_inicio'])) {
    exit('Sesión no válida');
}

if (!isset($_GET['atenc_id'])) {
    exit('Falta atenc_id');
}

$atenc_id = intval($_GET['atenc_id']);
$director='../../';
include("../cfg/clases.php");
include("../cfg/declaracion.php");

require_once('../../ces/libreria/srweel/FPDI/src/autoload.php');
require_once('../../ces/libreria/tcpdf/tcpdf.php');

use setasign\Fpdi\Tcpdf\Fpdi;
