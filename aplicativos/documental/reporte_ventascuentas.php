<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=44544000;
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename="."reporte_ventascuentas.xls");
//ini_set("session.cookie_lifetime",$tiempossss);
//ini_set("session.gc_maxlifetime",$tiempossss);
//session_start();
$nombre_archivo_t='';
include("lib_excel.php");

$desde_val=$_GET["desde_val"];
$hasta_val=$_GET["hasta_val"];

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");
$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();
$comillasimple="'";

$su_quito='';
$su_quito=$_GET['centro_id'];
$fact_val="";
$arreglo_valorc=array();

 
//tippo_id
if($_GET['centro_id'])
{
$lista_centros="select * from dns_centrosalud where centro_activosistema=1 and centro_id = '".$_GET['centro_id']."'";
}
else
{
$lista_centros="select * from dns_centrosalud where centro_activosistema=1 order by centro_orden asc";
}
$rs_centros = $DB_gogess->executec($lista_centros,array());
$totaleshaber=0;
?>
<br /><br />
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><div align="right"><strong>RUC: </strong></div></td>
    <td>1768158840001 </td>
    <td>&nbsp;</td>
    <td><div align="right"><strong>Fecha Aprob: </strong></div></td>
    <td><?php echo $desde_val; ?></td>
  </tr>
  <tr>
    <td><div align="right"><strong>Beneficiario: </strong></div></td>
    <td>PICHINCHA HUMANA</td>
    <td>&nbsp;</td>
    <td><div align="right"><strong>Fecha Fact: </strong></div></td>
    <td><?php echo $desde_val; ?></td>
  </tr>
  <tr>
    <td><div align="right"><strong>Comporbante:</strong></div></td>
    <td>0</td>
    <td>&nbsp;</td>
    <td><div align="right"><strong>Estado:</strong></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><div align="right"><strong>Compromiso:</strong></div></td>
    <td>0</td>
    <td>&nbsp;</td>
    <td><div align="right"></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><div align="right"><strong>Descripci&oacute;n: </strong></div></td>
    <td colspan="4">VENTAS DEL <?php echo $desde_val; ?> AL <?php echo $hasta_val; ?> EN CAPACITACION, SALUD, DE PICHINCHA HUMANA </td>
  </tr>
</table>
<br />

<table width="100%" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td>Cuenta Contable </td>
    <td>Descripci&oacute;n</td>
    <td>Debe</td>
    <td>Haber</td>
  </tr>
  <?php
 if($rs_centros)
	 {

	  while (!$rs_centros->EOF) {
	  
	  
	 $lista_servicios="SELECT sum(doccab_total) as total,centro_id FROM beko_documentocabecera  where (DATE_FORMAT(doccab_fechaemision_cliente,'%Y-%m-%d')>='".$desde_val."' and DATE_FORMAT(doccab_fechaemision_cliente,'%Y-%m-%d')<='".$hasta_val."') and doccab_anulado=0 and beko_documentocabecera.centro_id='".$rs_centros->fields["centro_id"]."' and tippo_id!=1";
     $rs_ventas = $DB_gogess->executec($lista_servicios,array());
	  
	 $busca_cuentas="select * from cesdb_arextension.dns_gridcuentascontables grcuenta inner join cesdb_aroriginal.dns_centrosalud cent on grcuenta.centro_enlace=cent.centro_enlace where cent.centro_id='".$rs_centros->fields["centro_id"]."' and cta_tipo=1";	 
	 $rs_bcuentas = $DB_gogess->executec($busca_cuentas,array());	  
	 
	 //===================credito
	 $suma_credito=0;
	 $lista_credito="SELECT sum(doccab_total) as total,centro_id,doccab_rucci_cliente,doccab_nombrerazon_cliente,doccab_apellidorazon_cliente FROM beko_documentocabecera inner join beko_documentodetalle on beko_documentocabecera.doccab_id=beko_documentodetalle.doccab_id  where (DATE_FORMAT(doccab_fechaemision_cliente,'%Y-%m-%d')>='".$desde_val."' and DATE_FORMAT(doccab_fechaemision_cliente,'%Y-%m-%d')<='".$hasta_val."') and doccab_anulado=0 and beko_documentocabecera.centro_id='".$rs_centros->fields["centro_id"]."' and tippo_id=1 group by doccab_rucci_cliente";
     $rs_credito = $DB_gogess->executec($lista_credito,array());
     if($rs_credito)
	 {
	     while (!$rs_credito->EOF) {
		 
		 $busca_cuentaus="select * from dns_cuentasempleados where LPAD(ctaempl_ci,10,'0')='".$rs_credito->fields["doccab_rucci_cliente"]."'";
		 $rs_cuentaus = $DB_gogess->executec($busca_cuentaus,array());
		 
		 $cedula_info='';
		 $cuenta_nc='';
		 if(!($rs_cuentaus->fields["ctaempl_ctacontable"]))
		 {
		   $cedula_info='-'.$rs_credito->fields["doccab_rucci_cliente"];
		   //$cuenta_nc='1.1.3.14.01.03.02.004.000.'.$rs_credito->fields["doccab_rucci_cliente"].'001';
		 }
	 ?>
  <tr>
    <td><?php echo $rs_cuentaus->fields["ctaempl_ctacontable"];  ?></td>
    <td><?php echo $rs_credito->fields["doccab_nombrerazon_cliente"]." ".$rs_credito->fields["doccab_apellidorazon_cliente"].$cedula_info;  ?></td>
    <td><?php echo number_format($rs_credito->fields["total"], 2, '.', ''); ?></td>
    <td>0</td>
  </tr> 
	  <?php  
	     $suma_credito=$suma_credito+number_format($rs_credito->fields["total"], 2, '.', '');
		 $rs_credito->MoveNext();
		 }
	 }
	 //===================credito
	 
	 $valor_haber=0;
	 $valor_haber= $suma_credito+number_format($rs_ventas->fields["total"], 2, '.', '');
  ?>
  <tr>
    <td><?php echo $rs_bcuentas->fields["cta_ctadebito"];  ?></td>
    <td><?php echo $rs_bcuentas->fields["cta_nombredebito"];  ?></td>
    <td><?php echo number_format($rs_ventas->fields["total"], 2, '.', ''); ?></td>
    <td>0</td>
  </tr>
  <tr>
    <td><?php echo $rs_bcuentas->fields["cta_ctahaber"];  ?></td>
    <td><?php echo $rs_bcuentas->fields["cta_nombrehaber"];  ?></td>
    <td>0</td>
    <td><?php echo number_format($valor_haber, 2, '.', ''); ?></td>
  </tr>
  <?php
        
		$totalesdebe=$totalesdebe+$rs_ventas->fields["total"]+$suma_credito;
        $totaleshaber=$totaleshaber+$valor_haber;
      
  
  
         $rs_centros->MoveNext();
	  
	  }
	 }
  ?>
    <tr>
    <td></td>
    <td><div align="right"><strong>TOTALES:</strong></div></td>
    <td><?php echo number_format($totalesdebe, 2, '.', '');  ?></td>
    <td><?php echo number_format($totaleshaber, 2, '.', ''); ?></td>
  </tr>
</table>

<?php

?> 
