<?php
ini_set('display_errors', 0);
error_reporting(E_ALL);
//header('Content-Type: text/html; charset=UTF-8'); 
$tiempossss = 4444000;
ini_set("session.cookie_lifetime", $tiempossss);
ini_set("session.gc_maxlifetime", $tiempossss);
session_start();
define("UTF_8", 1);
define("ASCII", 2);
?>
<?php
$numero = count($_GET);
$tags = array_keys($_GET); // obtiene los nombres de las varibles
$valores = array_values($_GET); // obtiene los valores de las varibles

for ($i = 0; $i < $numero; $i++) {
  ///
  if ($tags[$i] == 'xml') {
    ///
    $nombrevarget = '';
    if (preg_match('/^[a-z\d_=]{1,200}$/i', $valores[$i])) {
      //$$tags[$i]=$valores[$i];
      $nombrevarget = $tags[$i];
      $$nombrevarget = $valores[$i];
    } else {
      //$$tags[$i]=0;
      $nombrevarget = $tags[$i];
      $$nombrevarget = 0;
    }
    ///
  }
  ///
}


if ($_SESSION['ces1313777_sessid_inicio']) {

  $griddata = '';
  $valor_total = 0;
  $valorsiniva_total = 0;
  $valornograbado = 0;
  $pathextrap = '';

  $director = '../';
  include("../cfg/clases.php");
  include("../cfg/declaracion.php");
  include(@$director . "libreria/estructura/aqualis_master.php");
  $objformulario = new  ValidacionesFormulario();


  $idfac = $xml;

  // 


  //$plantilla=$objvarios->llena_plantilladata($plantilla,$table,$DB_gogess,$objformulario,$registros_data);

  //echo $plantilla;


  $lista_data = "select * from  lpin_comprobantecontable where comcont_id='" . $xml . "'";
  $registros_data = $DB_gogess->executec($lista_data, array());

  if ($registros_data) {
    while (!$registros_data->EOF) {


      $plantilla = '';
      $plantilla = '
      
      
<center>
      <img src="../archivo/gogess_data17856MZOWM20210824.png" alt="Logo" width="150"><br>
     <b> CL&Iacute,NICA DE ESPECIALIDADES DEL SUR </b>
</center>  <br>    
      <br><table width="90%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" bgcolor="#D8EDEC"><div align="center"><b>ASIENTOS CONTABLES</b></div></td>
  </tr>
  <tr>
    <td><b>C&oacute;digo:</b></td>
    <td>-comcont_id-</td>
  </tr>
  <tr>
    <td><b>Tipo:</b></td>
    <td>-tipoa_id-</td>
  </tr>  
  <tr>
    <td><b>Fecha:</b></td>
    <td>-comcont_fecha-</td>
  </tr>

  <tr>
    <td><b>N Comprobante:</b></td>
    <td>-comcont_numeroc-</td>
  </tr>  
  <tr>
    <td><b>Concepto:</b></td>
    <td>-comcont_concepto-</td>
  </tr>
  <tr>
    <td><b>Anulado:</b></td>
    <td>-comcont_anulado-</td>
  </tr>
</table>
';

      $table = 'lpin_comprobantecontable';
      $plantilla = $objvarios->llena_plantilladata($plantilla, $table, $DB_gogess, $objformulario, $registros_data);

      //echo $plantilla;

      $sumadebe = 0;
      $sumahaber = 0;


      $plantilla .= '<table class="table table-bordered" style="width:100%">
        <tr>
          <td bgcolor="#DFE9EE"><b>Cuenta</b></td>
          <td bgcolor="#DFE9EE"><b>Debe</b></td>
          <td bgcolor="#DFE9EE"><b>Haber</b></td>
          <td bgcolor="#DFE9EE"><b>Centro de Costos</b></td>
          <td bgcolor="#DFE9EE"><b>Fecha Registro</b></td>
        </tr>';

      $lista_asientos = "select * from lpin_detallecomprobantecontable left join lpin_plancuentas on lpin_detallecomprobantecontable.detcc_cuentacontable=lpin_plancuentas.planc_codigoc where comcont_enlace='" . $registros_data->fields["comcont_enlace"] . "' order by detcc_tipo asc";
      $lista_asientos = $DB_gogess->executec($lista_asientos, array());
      if ($lista_asientos) {
        while (!$lista_asientos->EOF) {

          $busca_ccostos = "select * from lpin_centrodecostos where centcost_id='" . $lista_asientos->fields["centcost_id"] . "'";
          $lista_ccostos = $DB_gogess->executec($busca_ccostos, array());

          $plantilla .= '<tr>
              <td>' . $lista_asientos->fields["planc_codigoc"] . ' ' . $lista_asientos->fields["planc_nombre"] . '</td>
              <td>' . $lista_asientos->fields["detcc_debe"] . '</td>
              <td>' . $lista_asientos->fields["detcc_haber"] . '</td>
              <td>' . $lista_ccostos->fields["centcost_nombre"] . '</td>
              <td>' . $lista_asientos->fields["detcc_fecharegistro"] . '</td>
            </tr>';


          $sumadebe = $sumadebe + $lista_asientos->fields["detcc_debe"];
          $sumahaber = $sumahaber + $lista_asientos->fields["detcc_haber"];

          $lista_asientos->MoveNext();
        }
      }


      $plantilla .= '<tr>
          <td><b>Totales</b></td>
          <td><b>' . $sumadebe . '</b></td>
          <td><b>' . $sumahaber . '</b></td>
          <td></td>
          <td></td>
        </tr>
      </table>';


      $registros_data->MoveNext();
    }
  }

  $footer = '';

  $cabecera_data = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FACTURA</title>
<style type="text/css">
<!--
.Estilo1 {
	font-size: 10px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
@page {
            margin-top: 0.1em;
			margin-bottom: 0.1em;
        }

body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
}

-->
</style>
<!-- <div class=TableScroll_factura  >	-->
<style type="text/css">
<!--
.css_bordesbarra {
	font-size: 10px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	border: 1px solid #000000;
	font-weight: bold;
}
.css_bordes {
	font-size: 10px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	border: 1px solid #000000;
	text-align: right;
}
.css_bordes_d {
	font-size: 10px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	border: 1px solid #000000;
	
}
.css_txtpie {
	font-size: 8px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.css_txtpie2 {
	font-size: 10px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
-->
</style>
</head>
<body>';

  $pie_data = '</body>
</html>';

  $comprobantepdf = $cabecera_data . $plantilla . $pie_data;
  $dompdf = new DOMPDF();
  $dompdf->set_paper('A4', 'portrait');
  $dompdf->load_html($comprobantepdf, 'UTF-8');
  $dompdf->render();
  $font = Font_Metrics::get_font("helvetica", "bold");
  $canvas = $dompdf->get_canvas();
  $footer = $canvas->open_object();

  ////$canvas->line(10,730,800,730,array(0,0,0),1);
  $canvas->page_text(
    530,
    833,
    "{PAGE_NUM} de {PAGE_COUNT}",
    $font,
    10,
    array(0, 0, 0)
  );

  $canvas->close_object();
  $canvas->add_object($footer, "all");

  $dompdf->stream("AS_" . $xml . ".pdf");
}
?>