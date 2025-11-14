<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=44544000;
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename="."reporte_depositocuentas.xls");
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
    <td colspan="4">BANCO DEL PICHINCHA RECAUDACION   DEL <?php echo $desde_val; ?> AL <?php echo $hasta_val; ?> POR DEPOSITOS SUCURSALES DE PICHINCHA HUMANA </td>
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
  $comision_total=0;
 if($rs_centros)
	 {

	  while (!$rs_centros->EOF) {
	  
	  
	  //cierre de caja
	 $gtvar_valor=0;
	 $gtvar_comision=0;
	 
	 $busca_caja="select sum(gtvar_valor)as gtvar_valor,sum(gtvar_comision) as gtvar_comision from dns_cierrecaja inner join cesdb_arextension.app_gastosvarios gvarios on dns_cierrecaja.cierr_enlace=gvarios.cierr_enlace where centro_id='".$rs_centros->fields["centro_id"]."' and (cierr_fecha>='".$desde_val."' and cierr_fecha<='".$hasta_val."')";
	 $rs_caja = $DB_gogess->executec($busca_caja,array());	 
	 
	 $gtvar_valor=$rs_caja->fields["gtvar_valor"];
	 $gtvar_comision=$rs_caja->fields["gtvar_comision"];
	 //cierre de caja
	 
	 if(!($gtvar_valor))
	 {
	   $gtvar_valor=0;
	 }
		 
	 if(!($gtvar_comision))
	 {
	   $gtvar_comision=0;
	 }
			 
	 $comision_total=$comision_total+$gtvar_comision;
	 
	 $busca_cuentas="select * from cesdb_arextension.dns_gridcuentascontables grcuenta inner join cesdb_aroriginal.dns_centrosalud cent on grcuenta.centro_enlace=cent.centro_enlace where cent.centro_id='".$rs_centros->fields["centro_id"]."' and cta_tipo=3";	 
	 $rs_bcuentas = $DB_gogess->executec($busca_cuentas,array());	
	 if($rs_bcuentas)
	 {
	  while (!$rs_bcuentas->EOF) {
	  ?>
	  <tr>
		<td><?php echo $rs_bcuentas->fields["cta_ctadebito"];  ?></td>
		<td><?php echo $rs_bcuentas->fields["cta_nombredebito"];  ?></td>
		<td><?php echo $gtvar_valor; ?></td>
		<td>0</td>
	  </tr> 
	  
	  <tr>
		<td><?php echo $rs_bcuentas->fields["cta_ctahaber"];  ?></td>
		<td><?php echo $rs_bcuentas->fields["cta_nombrehaber"];  ?></td>
		<td>0</td>
		<td><?php echo $gtvar_valor; ?></td>
	  </tr> 
	  <?php
	    $rs_bcuentas->MoveNext();
	  }
	 } 
	 
	 
	 $busca_cuentas="select * from cesdb_arextension.dns_gridcuentascontables grcuenta inner join cesdb_aroriginal.dns_centrosalud cent on grcuenta.centro_enlace=cent.centro_enlace where cent.centro_id='".$rs_centros->fields["centro_id"]."' and cta_tipo=5";	 
	 $rs_bcuentas = $DB_gogess->executec($busca_cuentas,array());	
	 if($rs_bcuentas)
	 {
	  while (!$rs_bcuentas->EOF) {
	  ?>
	  <tr>
		<td><?php echo $rs_bcuentas->fields["cta_ctadebito"];  ?></td>
		<td><?php echo $rs_bcuentas->fields["cta_nombredebito"];  ?></td>
		<td><?php echo $gtvar_comision; ?></td>
		<td>0</td>
	  </tr> 
	  
	  <tr>
		<td><?php echo $rs_bcuentas->fields["cta_ctahaber"];  ?></td>
		<td><?php echo $rs_bcuentas->fields["cta_nombrehaber"];  ?></td>
		<td>0</td>
		<td><?php echo $gtvar_comision; ?></td>
	  </tr> 
	  <?php
	    $rs_bcuentas->MoveNext();
	  }
	 } 
	 

	 
        
		$totalesdebe=$totalesdebe+number_format($gtvar_valor, 2, '.', '')+number_format($gtvar_comision, 2, '.', '');
        $totaleshaber=$totaleshaber+number_format($gtvar_valor, 2, '.', '')+number_format($gtvar_comision, 2, '.', '');
      
  
  
         $rs_centros->MoveNext();
	  
	  }
	 }
	 
	 
	 
	 $busca_cuentast="select * from cesdb_arextension.dns_gridcuentascontables grcuenta inner join cesdb_aroriginal.dns_centrosalud cent on grcuenta.centro_enlace=cent.centro_enlace where  cta_tipo=4 limit 1";	 
	 $rs_bcuentast = $DB_gogess->executec($busca_cuentast,array());
	 
	 
  ?>  
      <tr>
		<td><?php echo $rs_bcuentast->fields["cta_ctadebito"];  ?></td>
		<td><?php echo $rs_bcuentast->fields["cta_nombredebito"];  ?></td>
		<td><?php echo $comision_total; ?></td>
		<td>0</td>
	  </tr> 
	  
	  <tr>
		<td><?php echo $rs_bcuentast->fields["cta_ctahaber"];  ?></td>
		<td><?php echo $rs_bcuentast->fields["cta_nombrehaber"];  ?></td>
		<td>0</td>
		<td><?php echo $comision_total; ?></td>
	  </tr> 
  
  
    <tr>
    <td></td>
    <td><div align="right"><strong>TOTALES:</strong></div></td>
    <td><?php echo number_format($totalesdebe, 2, '.', '');  ?></td>
    <td><?php echo number_format($totaleshaber, 2, '.', ''); ?></td>
  </tr>
</table>

<?php

?> 
