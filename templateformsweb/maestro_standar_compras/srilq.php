<?php
ini_set('display_errors', 0);
error_reporting(E_ALL);
@$tiempossss = 5444000;
ini_set("session.cookie_lifetime", $tiempossss);
ini_set("session.gc_maxlifetime", $tiempossss);
session_start();

if ($_SESSION['ces1313777_sessid_inicio']) {

  $director = '../../';
  include("../../cfg/clases.php");
  include("../../cfg/declaracion.php");

  $compra_id = $_POST["pVar1"];

  $busca_auto = "select * from dns_compras where compra_id='" . $compra_id . "'";
  $result_baut = $DB_gogess->executec($busca_auto, array());

  $compra_estadosri = $result_baut->fields["compra_estadosri"];

  //echo $compra_estadosri;

}

?>



<div id="ultima_vez"></div>
<div id="img_datav">
  <div align="center"><img src="images/img_procesando.gif" width="200" height="200" /></div>
</div>
<div id="co_data">



  <div id="valor_a_facturar"></div>

  <div class="row" align="center">
    <div id="div_firma" class="col-sm-3">
      <div id="firma_btn">
        <div onClick="firma_directalq($('#compra_id').val())" style="cursor:pointer"><img src="images/firma.png"></div>
      </div>
    </div>

    <div id="div_srienviar" class="col-sm-3">
      <div id="sri_btn">
        <div onClick="enviar_srilq($('#compra_id').val())" style="cursor:pointer"><img src="images/sri.png"></div>
      </div>
    </div>

    <div id="div_sriobtener" class="col-sm-3">
      <div onClick="obtener_srilq($('#compra_id').val())" style="cursor:pointer"><img src="images/srirecibir.png"></div>
    </div>

    <!-- <div id="div_sriemail" class="col-xs-3">
      <div onClick="enviar_correolq()" style="cursor:pointer"><img src="images/sriemail.png"></div>
    </div> -->
  </div>

</div>

<div id="area_srilq"></div>

<?php
if ($compra_estadosri != 'AUTORIZADO' and $compra_estadosri != 'RECIBIDA') {
?>
  <script language="javascript">
    <!--
    // $('#co_data').hide();
    $('#img_datav').hide();
    //enviar_formulariodata('form_dns_compras');
    //
    -->
  </script>
<?php
} else {
?>
  <script language="javascript">
    <!--
    $('#co_data').show();
    $('#img_datav').hide();
    //
    -->
  </script>
<?php
}
?>