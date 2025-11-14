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
    $usua_id = @$_POST["usua_id"];
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
    $usua_id = @$_GET["usua_id"];
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
  $sql10 = "";
  $sql11 = "";

  if ($centro_id) {
    // $sql2=" app_cliente.centro_id=".$centro_id." and ";
  }


  if ($fecha_i != '' and $fecha_f != '') {
    $sql3 = " compra_fecha >='" . $fecha_i . "' and compra_fecha <='" . $fecha_f . "' and ";
  } else {

    if ($fecha_i != '' and $fecha_f == '') {
      $sql3 = " compra_fecha >='" . $fecha_i . "' and ";
    } else {
      if ($fecha_i == '' and $fecha_f != '') {
        $sql3 = " compra_fecha<='" . $fecha_f . "' and ";
      }
    }
  }



  if ($clie_institucionval) {
    $sql5 = " ( cuadrobm_principioactivo like '%" . trim($clie_institucionval) . "%' or cuadrobm_nombrecomercial like '%" . trim($clie_institucionval) . "%' ) and ";
  }



  if ($precu_activo) {
    $sql6 = " app_cliente.conve_id ='" . $precu_activo . "' and ";
  }

  if ($clie_id) {
    $sql7 = " proveevar_id ='" . $clie_id . "' and ";
  }

  if ($categesp_id) {
    $sql8 = " categesp_id ='" . $categesp_id . "' and ";
  }
  if ($especipr_id) {
    $sql9 = " especipr_id ='" . $especipr_id . "' and ";
  }
  if ($precu_facturar) {
    $sql10 = " cuadrobm_privada ='" . $precu_facturar . "' and ";
  }


  $lista_pacientesx = "";


  $concatena_sql = $sql1 . $sql2 . $sql3 . $sql4 . $sql5 . $sql6 . $sql7 . $sql8 . $sql9 . $sql10 . $sql11;
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

  $sumagrantotal1g = 0;
  $may120tg = 0;
  $ent90_120tg = 0;
  $ent60_90tg = 0;
  $ent30_60tg = 0;
  $ent0_30tg = 0;
  $sumagrantotal2g = 0;
  $ent0_30xtg = 0;
  $ent30_60xtg = 0;
  $ent60_90xtg = 0;
  $ent90_120xtg = 0;
  $may120xtg = 0;
  $sumagrantotal3g = 0;


  $documento .= '<table border="1" cellpadding="0" cellspacing="0">
  <tr>
       <td colspan="11">DATOS</td>
       <td colspan="6">Vencidos (DIAS)</td>
       <td colspan="6">Por Vencer (DIAS)</td>
  </tr>
  <tr>
        <td bgcolor="#F0F0F0"><strong>TIPO DOC</strong></td>
        <td bgcolor="#F0F0F0"><strong>IDENTIFICACION RUC</strong></td>
        <td bgcolor="#F0F0F0"><strong>IDENTIFICACION CEDULA</strong></td>
        <td bgcolor="#F0F0F0"><strong>NOMBRE</strong></td>
        <td bgcolor="#F0F0F0"><strong>NUMERO COMPROBANTE</strong></td>
        <td bgcolor="#F0F0F0"><strong>FECHA EMISION</strong></td>
        <td bgcolor="#F0F0F0"><strong>FECHA VENCIMIENTO</strong></td>
        <td bgcolor="#F0F0F0"><strong>VENCIDO</strong></td>
        <td bgcolor="#F0F0F0"><strong>USUARIO</strong></td>
         <td bgcolor="#F0F0F0"><strong>DESCRIPCION</strong></td>
        <td bgcolor="#F0F0F0"><strong>SALDO</strong></td>

        <td bgcolor="#F0F0F0"><strong>Mayo a 120</strong></td>
        <td bgcolor="#F0F0F0"><strong>90-120</strong></td>
        <td bgcolor="#F0F0F0"><strong>60-90</strong></td>
        <td bgcolor="#F0F0F0"><strong>30-60</strong></td>
        <td bgcolor="#F0F0F0"><strong>0-30</strong></td>
        <td bgcolor="#F0F0F0"><strong>Total</strong></td>

        <td bgcolor="#F0F0F0"><strong>0-30</strong></td>
        <td bgcolor="#F0F0F0"><strong>30-60</strong></td>
        <td bgcolor="#F0F0F0"><strong>60-90</strong></td>
        <td bgcolor="#F0F0F0"><strong>90-120</strong></td>
        <td bgcolor="#F0F0F0"><strong>Mayor a 120</strong></td>
        <td bgcolor="#F0F0F0"><strong>Total</strong></td>

  </tr>
  
  
  ';

  if ($concatena_sql) {

    $lista_doc = "select distinct proveevar_id from dns_compras_vista  where saldo>0 and compra_anulado=0 and tipdoc_id!=9 and " . $concatena_sql . " order by provee_nombre asc";
  } else {

    $lista_doc = "select distinct proveevar_id from dns_compras_vista  where saldo>0 and compra_anulado=0 and tipdoc_id!=9 order by provee_nombre asc";
  }

  //echo $lista_doc;
  $arra_sumacateg = array();

  $suma_debe = 0;
  $suma_haber = 0;
  $suma_totalv = 0;
  //echo $lista_doc;
  $contador_t = 0;
  $rs_datax = $DB_gogess->executec($lista_doc, array());
  if ($rs_datax) {
    while (!$rs_datax->EOF) {


      $sumagrantotal = 0;
      $sumagrantotal1 = 0;
      $sumagrantotal2 = 0;
      $sumagrantotal3 = 0;
      $sumagrantotal4 = 0;

      $may120t = 0;
      $ent90_120t = 0;
      $ent60_90t = 0;
      $ent30_60t = 0;
      $ent0_30t = 0;

      if ($concatena_sql) {
        $lista_docx = "select *,DATE_ADD(compra_fecha, INTERVAL compra_vencimiento DAY) AS fecha_vencimiento,DATEDIFF(CURDATE(), (DATE_ADD(compra_fecha, INTERVAL compra_vencimiento DAY))) as diasvencido, DATEDIFF((DATE_ADD(compra_fecha, INTERVAL compra_vencimiento DAY)),CURDATE()) as porvencer from dns_compras_vista  where saldo>0 and compra_anulado=0 and tipdoc_id!=9 and " . $concatena_sql . " and proveevar_id='" . $rs_datax->fields["proveevar_id"] . "' order by compra_fecha asc";
      } else {

        $lista_docx = "select *,DATE_ADD(compra_fecha, INTERVAL compra_vencimiento DAY) AS fecha_vencimiento,DATEDIFF(CURDATE(), (DATE_ADD(compra_fecha, INTERVAL compra_vencimiento DAY))) as diasvencido, DATEDIFF((DATE_ADD(compra_fecha, INTERVAL compra_vencimiento DAY)),CURDATE()) as porvencer  from dns_compras_vista  where saldo>0 and compra_anulado=0 and tipdoc_id!=9 and proveevar_id='" . $rs_datax->fields["proveevar_id"] . "' order by compra_fecha asc";
      }
      $rs_data = $DB_gogess->executec($lista_docx, array());
      if ($rs_data) {
        while (!$rs_data->EOF) {
          ///agrupa

          $array_iva = array();
          $ivarete = 0;
          $nretencion = '';
          $compretcab_clavedeaccesos = '';

          $colord_data = '';


          $banderad = 1;
          $diferente = '';

          $banderad = 1;

          $busca_us = "select * from app_usuario where 	usua_id='" . $rs_data->fields["usuarc_id"] . "'";
          $rs_usnomn = $DB_gogess->executec($busca_us);


          $contador_t++;
          $busca_tipo = "select * from dns_tipodocumentogeneral where tipdoc_id='" . $rs_data->fields["tipdoc_id"] . "'";
          $rs_tipo = $DB_gogess->executec($busca_tipo);

          $documento .= '<tr>';
          $documento .= '<td style=mso-number-format:"@" >' . $rs_tipo->fields["tipdoc_nombre"] . '</td>';
          $documento .= '<td style=mso-number-format:"@" >' . $rs_data->fields["provee_ruc"] . '</td>';
          $documento .= '<td style=mso-number-format:"@" >' . $rs_data->fields["provee_cedula"] . '</td>';
          $documento .= '<td style=mso-number-format:"@" >' . $rs_data->fields["provee_nombre"] . '</td>';
          $documento .= '<td style=mso-number-format:"@" >' . $rs_data->fields["compra_nfactura"] . '</td>';
          $documento .= '<td style=mso-number-format:"@" >' . $rs_data->fields["compra_fecha"] . '</td>';
          $documento .= '<td style=mso-number-format:"@" >' . $rs_data->fields["fecha_vencimiento"] . '</td>';

          $dias_vencidos = 0;
          if ($rs_data->fields["fecha_vencimiento"] <= date("Y-m-d")) {
            $dias_vencidos = $rs_data->fields["diasvencido"];
          }



          $documento .= '<td  >' . $dias_vencidos . '</td>';
          $documento .= '<td style=mso-number-format:"@" >' . $rs_usnomn->fields["usua_nombre"] . " " . $rs_usnomn->fields["usua_apellido"] . '</td>';
          $documento .= '<td style=mso-number-format:"@" >' . $rs_data->fields["compra_descripcion"] . '</td>';
          $documento .= '<td  >' . $rs_data->fields["saldo"] . '</td>';

          $may120 = 0;
          $ent90_120 = 0;
          $ent60_90 = 0;
          $ent30_60 = 0;
          $ent0_30 = 0;

          $may120x = 0;
          $ent90_120x = 0;
          $ent60_90x = 0;
          $ent30_60x = 0;
          $ent0_30x = 0;

          switch (true) {
            case ($dias_vencidos > 120):
              $may120 = $rs_data->fields["saldo"];
              break;

            case ($dias_vencidos >= 90 && $dias_vencidos <= 120):
              $ent90_120 = $rs_data->fields["saldo"];
              break;

            case ($dias_vencidos >= 60 && $dias_vencidos < 90):
              $ent60_90 = $rs_data->fields["saldo"];
              break;

            case ($dias_vencidos >= 30 && $dias_vencidos < 60):
              $ent30_60 = $rs_data->fields["saldo"];
              break;
            case ($dias_vencidos > 0 && $dias_vencidos < 30):
              $ent0_30 = $rs_data->fields["saldo"];
              break;
          }


          $documento .= '<td  >' . $may120 . '</td>';
          $documento .= '<td  >' . $ent90_120 . '</td>';
          $documento .= '<td  >' . $ent60_90 . '</td>';
          $documento .= '<td  >' . $ent30_60 . '</td>';
          $documento .= '<td  >' . $ent0_30 . '</td>';


          $may120t = $may120t + $may120;
          $ent90_120t = $ent90_120t + $ent90_120;
          $ent60_90t = $ent60_90t + $ent60_90;
          $ent30_60t = $ent30_60t + $ent30_60;
          $ent0_30t = $ent0_30t + $ent0_30;

          $total1 = 0;
          $total1 = $may120 + $ent90_120 + $ent60_90 + $ent30_60 + $ent0_30;

          $documento .= '<td >' . $total1 . '</td>';

          $may120x = 0;
          $ent90_120x = 0;
          $ent60_90x = 0;
          $ent30_60x = 0;
          $ent0_30x = 0;

          $dias_porvencerx = 0;
          if ($rs_data->fields["porvencer"] > 0) {
            $dias_porvencerx = $rs_data->fields["porvencer"];
          }


          switch (true) {
            case ($dias_porvencerx > 120):
              $may120x = $rs_data->fields["saldo"];
              break;

            case ($dias_porvencerx >= 90 && $dias_porvencer <= 120):
              $ent90_120x = $rs_data->fields["saldo"];
              break;

            case ($dias_porvencerx >= 60 && $dias_porvencer < 90):
              $ent60_90x = $rs_data->fields["saldo"];
              break;

            case ($dias_porvencerx >= 30 && $dias_porvencer < 60):
              $ent30_60x = $rs_data->fields["saldo"];
              break;
            case ($dias_porvencerx > 0 && $dias_porvencerx < 30):
              $ent0_30x = $rs_data->fields["saldo"];
              break;
          }


          $documento .= '<td  >' . $ent0_30x . '</td>';
          $documento .= '<td  >' . $ent30_60x . '</td>';
          $documento .= '<td  >' . $ent60_90x . '</td>';
          $documento .= '<td  >' . $ent90_120x . '</td>';
          $documento .= '<td  >' . $may120x . '</td>';

          $may120xt = $may120xt + $may120x;
          $ent90_120xt = $ent90_120xt + $ent90_120x;
          $ent60_90xt = $ent60_90xt + $ent60_90x;
          $ent30_60xt = $ent30_60xt + $ent30_60x;
          $ent0_30xt = $ent0_30xt + $ent0_30x;

          $total2 = 0;
          $total2 = $may120x + $ent90_120x + $ent60_90x + $ent30_60x + $ent0_30x;

          $documento .= '<td>' . $total2 . '</td>';

          $sumagrantotal = $sumagrantotal + $total2;

          $sumagrantotal1 = $sumagrantotal1 + $rs_data->fields["saldo"];

          $sumagrantotal2 = $sumagrantotal2 + $total1;
          $sumagrantotal3 = $sumagrantotal3 + $total2;

          $documento .= '</tr>';
          ///agrupa
          $rs_data->MoveNext();
        }
      }


      $documento .= '<tr style="background-color: #00BFFF">';

      $documento .= '<td style=mso-number-format:"@" >TOTAL</td>';
      $documento .= '<td style=mso-number-format:"@" >&nbsp;</td>';
      $documento .= '<td style=mso-number-format:"@" >&nbsp;</td>';
      $documento .= '<td style=mso-number-format:"@" >&nbsp;</td>';
      $documento .= '<td style=mso-number-format:"@" >&nbsp;</td>';
      $documento .= '<td style=mso-number-format:"@" >&nbsp;</td>';
      $documento .= '<td style=mso-number-format:"@" >&nbsp;</td>';
      $documento .= '<td style=mso-number-format:"@" >&nbsp;</td>';
      $documento .= '<td style=mso-number-format:"@" >&nbsp;</td>';
      $documento .= '<td style=mso-number-format:"@" >&nbsp;</td>';
      $documento .= '<td  >' . $sumagrantotal1 . '</td>';
      $documento .= '<td  >' . $may120t . '</td>';
      $documento .= '<td  >' . $ent90_120t . '</td>';
      $documento .= '<td >' . $ent60_90t . '</td>';
      $documento .= '<td  >' . $ent30_60t . '</td>';
      $documento .= '<td  >' . $ent0_30t . '</td>';
      $documento .= '<td >' . $sumagrantotal2  . '</td>';
      $documento .= '<td  >' . $ent0_30xt . '</td>';
      $documento .= '<td  >' . $ent30_60xt . '</td>';
      $documento .= '<td  >' . $ent60_90xt . '</td>';
      $documento .= '<td  >' . $ent90_120xt . '</td>';
      $documento .= '<td  >' . $may120xt . '</td>';
      $documento .= '<td  >' . $sumagrantotal3  . '</td>';

      $documento .= '</tr>';

      $sumagrantotal1g = $sumagrantotal1g + $sumagrantotal1;
      $may120tg = $may120tg + $may120t;
      $ent90_120tg = $ent90_120tg + $ent90_120t;
      $ent60_90tg = $ent60_90tg + $ent60_90t;
      $ent30_60tg = $ent30_60tg + $ent30_60t;
      $ent0_30tg = $ent0_30tg + $ent0_30t;
      $sumagrantotal2g = $sumagrantotal2g + $sumagrantotal2;
      $ent0_30xtg = $ent0_30xtg + $ent0_30xt;
      $ent30_60xtg = $ent30_60xtg + $ent30_60xt;
      $ent60_90xtg = $ent60_90xtg + $ent60_90xt;
      $ent90_120xtg = $ent90_120xtg + $ent90_120xt;
      $may120xtg = $may120xtg + $may120xt;
      $sumagrantotal3g = $sumagrantotal3g + $sumagrantotal3;


      $rs_datax->MoveNext();
    }
  }

  $documento .= '<tr style="background-color: #00BFFF">';
  $documento .= '<td style=mso-number-format:"@" >GRAN TOTAL</td>';
  $documento .= '<td style=mso-number-format:"@" >&nbsp;</td>';
  $documento .= '<td style=mso-number-format:"@" >&nbsp;</td>';
  $documento .= '<td style=mso-number-format:"@" >&nbsp;</td>';
  $documento .= '<td style=mso-number-format:"@" >&nbsp;</td>';
  $documento .= '<td style=mso-number-format:"@" >&nbsp;</td>';
  $documento .= '<td style=mso-number-format:"@" >&nbsp;</td>';
  $documento .= '<td style=mso-number-format:"@" >&nbsp;</td>';
  $documento .= '<td style=mso-number-format:"@" >&nbsp;</td>';
  $documento .= '<td style=mso-number-format:"@" >&nbsp;</td>';
  $documento .= '<td  >' . $sumagrantotal1g . '</td>';
  $documento .= '<td  >' . $may120tg . '</td>';
  $documento .= '<td  >' . $ent90_120tg . '</td>';
  $documento .= '<td  >' . $ent60_90tg . '</td>';
  $documento .= '<td  >' . $ent30_60tg . '</td>';
  $documento .= '<td  >' . $ent0_30tg . '</td>';
  $documento .= '<td  >' . $sumagrantotal2g  . '</td>';
  $documento .= '<td  >' . $ent0_30xtg . '</td>';
  $documento .= '<td  >' . $ent30_60xtg . '</td>';
  $documento .= '<td  >' . $ent60_90xtg . '</td>';
  $documento .= '<td  >' . $ent90_120xtg . '</td>';
  $documento .= '<td  >' . $may120xtg . '</td>';
  $documento .= '<td  >' . $sumagrantotal3g . '</td>';
  $documento .= '</tr>';



  $documento .= '</table>';

  //notas de credito
  $documento = str_replace(".", ",", $documento);

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
