<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=44450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_SESSION['ces1313777_sessid_inicio'])
{
$table='dns_egresocentros'; 
$subindice='_egresocentros';
$director='../../../../../../';
include("../../../../../../cfg/clases.php");
include("../../../../../../cfg/declaracion.php");
$objformulario= new  ValidacionesFormulario();


$leeplantilla=leer_contenido_completo("../../../../../../plantillas/egresovarios_lista.php");	

$id_mob=base64_decode($_GET["aleat"]);
$lista_data="select * from  dns_egresocentros where egrec_id='".base64_decode($_GET["aleat"])."'";
$lista_data = $DB_gogess->executec($lista_data,array());


$busca_g="select distinct * from gogess_sisfield where tab_name='".$table."'";
$rs_buscag = $DB_gogess->executec($busca_g,array());
				if($rs_buscag)
                   {
	                  while (!$rs_buscag->EOF) {	
					  
					  if ($rs_buscag->fields["fie_value"]=="replace")
									 {
									      $valorbus=$lista_data->fields[$rs_buscag->fields["fie_name"]];
										  $rmp= $objformulario->replace_cmb($rs_buscag->fields["fie_tabledb"],$rs_buscag->fields["fie_datadb"],$rs_buscag->fields["fie_sql"],$valorbus,$DB_gogess); 
									      $leeplantilla=str_replace("-".$rs_buscag->fields["fie_name"]."-",$rmp,$leeplantilla);
									 }
									 else
									 {
									 
									 
										 if($rs_buscag->fields["fie_typeweb"]=='tiempobloque')
											{
											   $separa_fecha=array();
											   $separa_fecha=explode("-",$lista_data->fields[$rs_buscag->fields["fie_name"]]);					   
											   $rmp=@$separa_fecha[0]." a&ntilde;os ".@$separa_fecha[1]." meses";
											}
											else
											{
												   if($rs_buscag->fields["fie_typeweb"]=='checkbox_peke')
												   {
														if($lista_data->fields[$rs_buscag->fields["fie_name"]]==1)
														{
														$rmp='<img src="visto_dns.png" width="20" height="18" />';
														}
														else
														{
														$rmp='';
														}
												   }
												   else
												   {
												   $rmp=$lista_data->fields[$rs_buscag->fields["fie_name"]];  
												   }
												   
											}
									 
									     if($rs_buscag->fields["fie_name"]=='egrec_id')
										 {
									     
                                         $rmp=str_pad($rmp, 10, "0", STR_PAD_LEFT);
									     }
										 
									     $leeplantilla=str_replace("-".$rs_buscag->fields["fie_name"]."-",utf8_encode($rmp),$leeplantilla);
									 
									 }
					  
					  $rs_buscag->MoveNext();
					  }
				   }	 
				   
				   
$suma_grantotal=0;

$lista_mivdata="select * from dns_temporaldespacho inner join dns_cuadrobasicomedicamentos on dns_temporaldespacho.cuadrobm_id=dns_cuadrobasicomedicamentos.cuadrobm_id inner join dns_principalmovimientoinventario on dns_temporaldespacho.moviin_id=dns_principalmovimientoinventario.moviin_id where dns_temporaldespacho.egrec_id='".$id_mob."'";
$rs_mivdata = $DB_gogess->executec($lista_mivdata,array());

$categ_id=0;
$categ_id=$rs_mivdata->fields["categ_id"];


$lista_pro='';
$lista_miv="select * from dns_temporaldespacho inner join dns_cuadrobasicomedicamentos on dns_temporaldespacho.cuadrobm_id=dns_cuadrobasicomedicamentos.cuadrobm_id inner join dns_principalmovimientoinventario on dns_temporaldespacho.moviin_id=dns_principalmovimientoinventario.moviin_id where dns_temporaldespacho.egrec_id='".$id_mob."'";

$rs_miv = $DB_gogess->executec($lista_miv,array());
if($rs_miv)
      {
	        while (!$rs_miv->EOF) {
			
	$total_cal=0;
	$total_cal=$rs_miv->fields["cantidad_val"]*$rs_miv->fields["moviin_preciocompra"];
				
	$lista_pro.='<tr>
	
    <td>'.$rs_miv->fields["cuadrobm_codigoatc"].'</td>
    <td>'.utf8_encode($rs_miv->fields["cuadrobm_principioactivo"].$rs_miv->fields["cuadrobm_nombredispositivo"]).'</td>';
    if($categ_id==1)
	{	
	$lista_pro.='<td>'.$rs_miv->fields["moviin_presentacioncomercial"].'</td>
    <td>'.utf8_encode($rs_miv->fields["cuadrobm_primerniveldesagregcion"]).'</td>
    <td>'.$rs_miv->fields["cuadrobm_concentracion"].'</td>
	<td></td>';
	}
	
	$lista_pro.='<td>'.$rs_miv->fields["moviin_nlote"].'</td>
	<td>'.$rs_miv->fields["moviin_fechadecaducidad"].'</td>	
	<td>'.$rs_miv->fields["cantidad_val"].'</td>
	<td>'.$rs_miv->fields["moviin_preciocompra"].'</td>	
	<td>'.$total_cal.'</td>	
  </tr>	';
  
  $suma_grantotal=$suma_grantotal+$total_cal;
					  
			  $rs_miv->MoveNext();
			}					  
	}  

$lista_valor='<table width="100%" border="1" cellpadding="0" cellspacing="0">
  <tr>
  			  <td ><strong>CUM</strong></td>
			  <td ><strong>Nombre Generico</strong></td>';
		if($categ_id==1)
	{		  
	$lista_valor.='<td ><strong>Presentaci&oacute;n Comercial</strong></td>
			  <td ><strong>Forma Farmaceutica</strong></td>
			  <td ><strong>Concentraci&oacute;n</strong></td>
			  <td ><strong>Presentaci&oacute;n</strong></td>';
		}	  
	$lista_valor.='<td ><strong>Lote</strong></td>
	          <td ><strong>Fecha de Caducidad</strong></td>
			  <td ><strong>Cantidad(Unidades)</strong></td>
			  <td ><strong>Valor Unitario (USD)</strong></td>
			  <td ><strong>Valor Total (USD)</strong></td>
	</tr>
  '.$lista_pro.'
  <tr>
    <td></td>
    <td></td>';

if($categ_id==1)
	{		
$lista_valor.='<td></td>
    <td> </td>
    <td></td>
	<td></td>';
	}
$lista_valor.='<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td><b>'.$suma_grantotal.'</b></td>
  </tr>
</table>';

$leeplantilla=str_replace("-lista-",$lista_valor,$leeplantilla);

echo $leeplantilla;
			    
}
?>
