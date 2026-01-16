<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=444456000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if(@$_SESSION['ces1313777_sessid_inicio'])
{
$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");

$lista_tablaspop="select * from api_consentimientoi where conset_id='".$_POST["conset_id"]."'";
$rs_tablastop = $DB_gogess->executec($lista_tablaspop,array());
$archiv_data=$rs_tablastop->fields["conset_archivo"];
$conset_nombre=$rs_tablastop->fields["conset_nombre"];
?>

<!--<a href="archivo/--><?php //echo $archiv_data; ?><!--" target="_blank">--><?php //echo $conset_nombre; ?><!--&nbsp;<img src="archivo/file.png" width="20px" ><span class="selected"></span></a>-->
    <?php $conset_id = $_POST['conset_id']; ?>

    <a href="#" onclick="generarPDFConsentimiento(<?php echo (int)$conset_id; ?>)">
        <?php echo $conset_nombre; ?>&nbsp;<img src="archivo/file.png" width="20px">
    </a>

    <script>
        function generarPDFConsentimiento(conset_id) {

            var clie_id  = $('#clie_id').val();
            var atenc_id = $('#atenc_id').val();

            if (!clie_id || !atenc_id) {
                alert('No se pudo identificar paciente o atención');
                return;
            }

            var form = document.createElement('form');
            form.method = 'POST';
            form.action = 'pdfformularios/generate_consentimiento_pdf.php';
            form.target = '_blank';

            var inputs = {
                conset_id: conset_id,
                clie_id: clie_id,
                atenc_id: atenc_id
            };

            for (var key in inputs) {
                var input = document.createElement('input');
                input.type = 'hidden';
                input.name = key;
                input.value = inputs[key];
                form.appendChild(input);
            }

            document.body.appendChild(form);
            form.submit();
            document.body.removeChild(form);
        }
    </script>

    <?php

}


?>