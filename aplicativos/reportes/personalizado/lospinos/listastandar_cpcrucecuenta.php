<?php
ini_set('display_errors', 0);
error_reporting(E_ALL);
ini_set("session.cookie_lifetime", 36000);
ini_set("session.gc_maxlifetime", 36000);
session_start();
if ($_SESSION['ces1313777_sessid_inicio']) {

  $nombre_mes2 = array();
  $nombre_mes2["01"] = 'ENERO';
  $nombre_mes2["02"] = 'FEBRERO';
  $nombre_mes2["03"] = 'MARZO';
  $nombre_mes2["04"] = 'ABRIL';
  $nombre_mes2["05"] = 'MAYO';
  $nombre_mes2["06"] = 'JUNIO';
  $nombre_mes2["07"] = 'JULIO';
  $nombre_mes2["08"] = 'AGOSTO';
  $nombre_mes2["09"] = 'SEPTIEMBRE';
  $nombre_mes2["10"] = 'OCTUBRE';
  $nombre_mes2["11"] = 'NOVIEMBRE';
  $nombre_mes2["12"] = 'DICIEMBRE';
  //2 excel
  //3 pdf

  function ver_ciudadpaciente($ci, $DB_gogess)
  {

    $lista_hijos = "select distinct centro_id from app_cliente inner join dns_representante on app_cliente.clie_enlace=dns_representante.clie_enlace where repres_ci='" . trim($ci) . "'";
    $rs_datahijos = $DB_gogess->executec($lista_hijos, array());

    $centro_id = @$rs_datahijos->fields["centro_id"];
    if (!(@$rs_datahijos->fields["centro_id"])) {
      $centro_id = 1;
    }

    return $centro_id;
  }

  $previsual = 0;
  if (@$_POST["previsual"]) {
    $previsual = @$_POST["previsual"];
    $fecha_i = @$_POST["fecha_inicio"];
    $fecha_f = @$_POST["fecha_fin"];
    $centro_id = @$_POST["centro_id"];
    $clie_institucionval = @$_POST["clie_institucionval"];
    $ireport = @$_POST["ireport"];
    $clie_id = @$_POST["clie_id"];

    $precu_activo = @$_POST["precu_activo"];
    $convepr_id = @$_POST["convepr_id"];
    $categesp_id = @$_POST["categesp_id"];
    $especipr_id = @$_POST["especipr_id"];
    $precu_facturar = @$_POST["precu_facturar"];
  } else {
    $previsual = @$_GET["previsual"];
    $fecha_i = @$_GET["fecha_inicio"];
    $fecha_f = @$_GET["fecha_fin"];
    $centro_id = @$_GET["centro_id"];
    $clie_institucionval = @$_GET["clie_institucionval"];
    $ireport = @$_GET["ireport"];
    $clie_id = @$_GET["clie_id"];

    $precu_activo = @$_GET["precu_activo"];
    $convepr_id = @$_GET["convepr_id"];
    $categesp_id = @$_GET["categesp_id"];
    $especipr_id = @$_GET["especipr_id"];
    $precu_facturar = @$_GET["precu_facturar"];
  }

  if ($previsual == 2) {
    header('Content-type: application/vnd.ms-excel');
    $fechahoy = date("Y-m-d");
    header("Content-Disposition: attachment; filename=" . "repxls_" . $fechahoy . ".xls");
  }

  $director = '../../../../';
  include("../../../../cfg/clases.php");
  include("../../../../cfg/declaracion.php");
  require_once('tcpdf_include.php');

  $objformulario = new  ValidacionesFormulario();

  $bandera_t1 = 0;
  $actual = strtotime(date("Y-m-d"));
  $mesmenos = date("Y-m-d", strtotime("-2 month", $actual));




  $sql1 = "";
  $sql2 = "";
  $sql3 = "";
  $sql4 = "";
  $sql5 = "";
  $sql6 = "";
  $sql7 = "";
  $sql8 = "";
  $sql9 = "";

  if ($centro_id) {
    // $sql2=" app_cliente.centro_id=".$centro_id." and ";
  }


  if ($fecha_i != '' and $fecha_f != '') {
    $sql3 = " DATE_FORMAT(crudoc_fechaemision,'%Y-%m-%d')>='" . $fecha_i . "' and DATE_FORMAT(crudoc_fechaemision,'%Y-%m-%d')<='" . $fecha_f . "' and ";
  } else {

    if ($fecha_i != '' and $fecha_f == '') {
      $sql3 = " DATE_FORMAT(crudoc_fechaemision,'%Y-%m-%d')>='" . $fecha_i . "' and ";
    } else {
      if ($fecha_i == '' and $fecha_f != '') {
        $sql3 = " DATE_FORMAT(crudoc_fechaemision,'%Y-%m-%d')<='" . $fecha_f . "' and ";
      }
    }
  }



  if ($clie_id) {
    $sql5 = " lpin_cobropago.proveep_id = '" . trim($clie_id) . "' and ";
  }

  if ($clie_institucionval) {
    $sql6 = " lpin_cobropago.frocob_id in (" . $clie_institucionval . ") and ";
  }

  if ($convepr_id) {
    $sql7 = " convepr_id ='" . $convepr_id . "' and ";
  }

  if ($categesp_id) {
    $sql8 = " categesp_id ='" . $categesp_id . "' and ";
  }

  if ($especipr_id) {
    $sql9 = " especipr_id ='" . $especipr_id . "' and ";
  }

  if ($precu_facturar) {
    $sql10 = " precu_facturar ='" . $precu_facturar . "' and ";
  }




  $concatena_sql = $sql1 . $sql2 . $sql3 . $sql4 . $sql5 . $sql6 . $sql7 . $sql8 . $sql9 . $sql10;
  $concatena_sql = substr($concatena_sql, 0, -4);


  $nciudad = '';
  $nciudad = $objformulario->replace_cmb("dns_centrosalud", "centro_id,centro_nombre", " where centro_id =", $centro_id, $DB_gogess);



  //area datos
  $documento = '';
  $cabecera = '';
  $cabecera = $objformulario->replace_cmb("app_empresa", "emp_id,emp_cabecerareportes", " where emp_id=", 1, $DB_gogess);

  $css = "<style type='text/css'>
<!--
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
}
-->
</style>";

  $reporte_pg = "select * from sth_report where rept_id=" . $ireport;
  $rs_reportepg = $DB_gogess->executec($reporte_pg, array());

  $rept_nombre = $rs_reportepg->fields["rept_nombre"];
  $documento = $css . "<div align='center' >" . $rept_nombre . "</div><p align='center'>" . $rs_reportepg->fields["rept_observacion"] . "</p>" . utf8_decode($cabecera) . "<br><center><b>" . $nciudad . "</b></center>";

  $subtotalnc = 0;
  $subtotadelmes = 0;
  //echo $lista_servicios;
  //$xmldata=53;

  $cuenta_fac = 0;
  $documento .= '<center>
Desde: ' . $fecha_i . ' Hasta: ' . $fecha_f . '<br>
<br>';

  ///programacion reporte



  $documento .= '<table border="1" cellpadding="0" cellspacing="0">
  <tr>
  
  <td></td>	
  <td>ID Cruce</td>	
  <td>Tipo Cruce</td>

  <td>Tipo de Transacci&oacute;n</td>
	<td>Fecha de Emisi&oacute;n</td>
	<td>Persona</td>
	<td># de Comprobante compra principal</td>
  <td># de Comprobante venta principal</td>
  <td>Total</td>  
  <td>Saldo actual del documento principal</td>  
  <td>Descripci&oacute;n</td>

  <td>Documento cruce cuenta</td>
  <td>Fecha Emisi&oacute;n</td>
  <td>Valor cruce</td>

  </tr>';

  if ($concatena_sql) {



    $lista_doc = "
    select * from lpin_crucedocumentos 
    inner join app_proveedor on proveecru_id=provee_id 
    left join lpin_ttransac on crudoc_tipotransaccion=ttra_id
    left join lpin_tipopago on lpin_crucedocumentos.tipop_id=lpin_tipopago.tipop_id
    where " . $concatena_sql . " order by crudoc_fechaemision asc";
  } else {


    $lista_doc = "select * from lpin_crucedocumentos 
    inner join app_proveedor on proveecru_id=provee_id 
    left join lpin_ttransac on crudoc_tipotransaccion=ttra_id
    left join lpin_tipopago on lpin_crucedocumentos.tipop_id=lpin_tipopago.tipop_id
    ";
  }

  $arra_sumacateg = array();

  //echo $lista_doc;
  $contador_t = 0;
  $rs_data = $DB_gogess->executec($lista_doc, array());
  if ($rs_data) {
    while (!$rs_data->EOF) {

      $array_iva = array();
      $ivarete = 0;
      $nretencion = '';
      $compretcab_clavedeaccesos = '';

      $tipoc = '';
      $tipoc = $objformulario->replace_cmb("cesdb_arcombos.efacfactura_tipoidentificacion", "tipoident_codigo,tipoident_nombre", " where tipoident_codigo =", $rs_data->fields["tipoident_codigocl"], $DB_gogess);

      $valor_saldo = 0;
      $compra_nfactura = '';
      $doccab_ndocumento = '';
      $total_valor = 0;

      if ($rs_data->fields["crudoc_ndocumento"] > 0) {
        $saca_saldo = "select saldo,compra_nfactura,compra_total from dns_compras_vista where compra_id='" . $rs_data->fields["crudoc_ndocumento"] . "'";
        $rs_sacsaldo = $DB_gogess->executec($saca_saldo, array());
        $valor_saldo = $rs_sacsaldo->fields["saldo"];
        $compra_nfactura = $rs_sacsaldo->fields["compra_nfactura"];
        $compra_total = $rs_sacsaldo->fields["compra_total"];
        $total_valor = $compra_total;
      }

      if ($rs_data->fields["crudoc_ndocumentoventa"] != '') {
        $saca_saldo = "select saldo,doccab_ndocumento,doccab_total from beko_documentocabecera_vista where doccab_id='" . $rs_data->fields["crudoc_ndocumentoventa"] . "'";
        $rs_sacsaldo = $DB_gogess->executec($saca_saldo, array());
        $valor_saldo = $rs_sacsaldo->fields["saldo"];
        $doccab_ndocumento = $rs_sacsaldo->fields["doccab_ndocumento"];
        $doccab_total = $rs_sacsaldo->fields["doccab_total"];
        $total_valor = $doccab_total;
      }



      $tipo_cruceval = '';
      $crudet_documento = '';
      $crudet_documentoventa = '';
      $crudet_fechaemision = '';
      $crudet_tipodocumento = '';
      $crudet_valor = '';
      $ndocumento_compraval = '';
      $ndocumento_ventaval = '';
      $saldo_final = 0;

      //CUENTA CONTABLE
      $docu_cru = "select * from cesdb_arextension.lpin_crucecuentas left join cesdb_aroriginal.app_proveedor on cesdb_arextension.lpin_crucecuentas.crucue_persona=cesdb_aroriginal.app_proveedor.provee_id where crudoc_enlace='" . $rs_data->fields["crudoc_enlace"] . "'";
      $rs_cuentacontablecrudeta = $DB_gogess->executec($docu_cru, array());
      if ($rs_cuentacontablecrudeta) {
        while (!$rs_cuentacontablecrudeta->EOF) {

          $tipo_cruceval = 'CUENTA CONTABLE';
          $crudet_documento = $rs_cuentacontablecrudeta->fields["crudet_documento"];
          $crudet_documentoventa = $rs_cuentacontablecrudeta->fields["crudet_documentoventa"];
          $crudet_fechaemision = $rs_cuentacontablecrudeta->fields["crudet_fechaemision"];
          $crudet_tipodocumento = $rs_cuentacontablecrudeta->fields["crudet_tipodocumento"];
          $crucue_valorpago = $rs_cuentacontablecrudeta->fields["crucue_valorpago"];

          $ndocumento_compraval = '';

          $ndocumento_ventaval = '';


          //lista data

          $contador_t++;
          $documento .= '<tr>';
          $documento .= '<td  nowrap="nowrap">' . $contador_t . '</td>';
          $documento .= '<td  style=mso-number-format:"@" >' . $rs_data->fields["crudoc_id"] . '</td>';
          $documento .= '<td  style=mso-number-format:"@" >' . $tipo_cruceval . '</td>';
          $documento .= '<td >' . $rs_data->fields["ttra_nombre"] . '</td>';
          $documento .= '<td  style=mso-number-format:"@" >' . $rs_data->fields["crudoc_fechaemision"] . '</td>';
          $documento .= '<td  style=mso-number-format:"@" >' . $rs_data->fields["provee_nombre"] . '</td>';
          $documento .= '<td  style=mso-number-format:"@" >' . $compra_nfactura . '</td>';
          $documento .= '<td  style=mso-number-format:"@" >' . $doccab_ndocumento . '</td>';
          $documento .= '<td>' . str_replace(".", ",", $total_valor) . '</td>';
          $documento .= '<td>' . str_replace(".", ",", $valor_saldo) . '</td>';
          //$documento .= '<td  style=mso-number-format:"@"  nowrap="nowrap" >' . str_replace(".", ",", $valor_saldo) . '</td>';
          $documento .= '<td  style=mso-number-format:"@" >' . $rs_data->fields["crudoc_descripcion"] . '</td>';

          //cruce cc
          $documento .= '<td  style=mso-number-format:"@" >' . $rs_cuentacontablecrudeta->fields["crucue_cuenta"] . '</td>';
          $documento .= '<td  style=mso-number-format:"@" >' . $rs_data->fields["crudoc_fechaemision"] . '</td>';
          $documento .= '<td  style=mso-number-format:"@" >' . str_replace(".", ",", $crucue_valorpago) . '</td>';
          //cruce cc
          //lista data
          $documento .= '</tr>';


          $rs_cuentacontablecrudeta->MoveNext();
        }
      }

      //CUENTA CONTABLE



      $rs_data->MoveNext();
    }
  }



  $documento .= '<tr>
    <td  nowrap="nowrap"></td>
	<td  nowrap="nowrap"></td>
    <td ></td>
	<td ></td>
	<td ></td>
	<td></td>
    <td ></td>
	<td></td>
    <td></td>
     <td></td>
      <td></td>
       <td></td>
        <td></td>
        <td></td>
  </tr>
</table><br>';

  ///programacion reporte


  //area datos 
  if ($previsual == 1) {
    echo $documento;
  }
  if ($previsual == 2) {
    echo utf8_decode($documento);
  }


  if ($previsual == 3) {

    $comprobantepdf = '';
    $comprobantepdf = $documento;


    // Extend the TCPDF class to create custom Header and Footer
    class MYPDF extends TCPDF
    {
      var $filtro_valor_h1;
      var $filtro_valor_h2;
      var $filtro_valor_h3;
      //Page header

      // Page footer
      public function Footer()
      {
        // Position at 15 mm from bottom		
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
        //$image_file = 'logopie.fw.png';
        // $this->Image($image_file, 80, 273, 40, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);		
      }
    }


    $pdf = new MYPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('CERENI');
    $pdf->SetTitle('CERENI');
    $pdf->SetSubject('CERENI');
    $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
    $pdf->filtro_valor_h1 = '';
    $pdf->filtro_valor_h2 = '';
    $pdf->filtro_valor_h3 = '';
    // set default header data
    $pdf->setPrintHeader(false);
    //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 048', PDF_HEADER_STRING);
    // set header and footer fonts
    //$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, 20, PDF_MARGIN_RIGHT);
    //$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
      require_once(dirname(__FILE__) . '/lang/eng.php');
      $pdf->setLanguageArray($l);
    }
    // ---------------------------------------------------------
    // set font
    $pdf->SetFont('helvetica', 'B', 15);
    // add a page
    $pdf->AddPage();
    //$pdf->Write(0, 'HANOR', '', 0, 'L', true, 0, false, false, 0);
    $pdf->SetFont('helvetica', '', 7);
    $pdf->writeHTML(utf8_encode($comprobantepdf), true, false, false, false, '');
    /*if($_GET["dhoja"]==1)
{
$pdf->AddPage();
$pdf->writeHTML(utf8_encode("<strong>V. RESPONSABLES </strong><div align='center'>".$responsables_cuadro."</div>"), true, false, false, false, '');
}*/
    //echo $lee_plantilla;
    //echo $comprobantepdf="Holaa";
    $nombre_pdf = "pdfdocumento_" . date("Y-m-d") . ".pdf";
    $pdf->Output($nombre_pdf, 'I');
  }
}
