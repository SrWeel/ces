<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors', 0);
error_reporting(E_ALL);
$tiempossss = 44400000;
ini_set("session.cookie_lifetime", $tiempossss);
ini_set("session.gc_maxlifetime", $tiempossss);
session_start();

$director = '../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

if ($_SESSION['ces1313777_sessid_inicio']) {

    $compra_enlace = $_POST["compra_enlace"];

    if ($compra_enlace != '') {
        //===========================================

        $lista_detalles = "select porcer_id,porcei_id  from lpin_productocompra where compra_enlace='" . $compra_enlace . "' order by prcomp_id desc limit 1";
        $rs_data = $DB_gogess->executec($lista_detalles, array());


        $porcer_id = $rs_data->fields["porcer_id"];
        $porcei_id = $rs_data->fields["porcei_id"];

        $lista_detalles = "select *  from lpin_productocompra where compra_enlace='" . $compra_enlace . "' order by prcomp_id desc";
        $rs_data = $DB_gogess->executec($lista_detalles, array());
        if ($rs_data) {
            while (!$rs_data->EOF) {

                $sacatari = "update lpin_productocompra set porcer_id='" . $porcer_id . "',porcei_id='" . $porcei_id . "' where prcomp_id='" . $rs_data->fields["prcomp_id"] . "' and compra_enlace='" . $compra_enlace . "'";
                // echo $sacatari."<br>";
                $rs_d13 = $DB_gogess->executec($sacatari, array());


                $rs_data->MoveNext();
            }
        }

        //===========================================
    }

    //saca totales
    //print_r($lista_valor);



}
