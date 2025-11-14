<?php
$tiempossss = 455550000;
ini_set("session.cookie_lifetime", $tiempossss);
ini_set("session.gc_maxlifetime", $tiempossss);
session_start();

if ($_SESSION['ces1313777_sessid_inicio']) {
    $director = '../../../';
    include("../../../cfg/clases.php");
    include("../../../cfg/declaracion.php");
    $sqltotal = "";


    $objformulario = new  ValidacionesFormulario();


    $buscacliente = "select * from app_proveedor where provee_id='" . $_POST["proveevar_id"] . "'";
    $rs_bcliente = $DB_gogess->executec($buscacliente, array());

    $provee_diasvencimiento = $rs_bcliente->fields["provee_diasvencimiento"];

    if ($provee_diasvencimiento == 0) {
        $provee_diasvencimiento = 30;
    }
?>
    <script type="text/javascript">
        <!--
        $('#compra_vencimiento').val('<?php echo $provee_diasvencimiento; ?>');
        -->
    </script>
<?php
}
?>