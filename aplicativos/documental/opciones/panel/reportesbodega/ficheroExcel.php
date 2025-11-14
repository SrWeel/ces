<?php
header("Content-type: application/vnd.ms-excel; name='excel'");
header("Content-Disposition: filename=resultado_".date("Ymd").".xls");
header("Pragma: no-cache");
header("Expires: 0");

if (isset($_POST['datos_a_enviar']) && $_POST['datos_a_enviar'] != '') echo utf8_decode($_POST['datos_a_enviar']);
?>