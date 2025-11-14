<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=44450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_SESSION['ces1313777_sessid_inicio'])
{
$table='dns_compras'; 
$subindice='_compras';
$director='../../../../../../';
include("../../../../../../cfg/clases.php");
include("../../../../../../cfg/declaracion.php");
$objformulario= new  ValidacionesFormulario();


$leeplantilla=leer_contenido_completo("../../../../../../plantillas/ingresosv_lista.php");	

$mes_n=array();
$mes_n['01']='enero';
$mes_n['02']='febrero';
$mes_n['03']='marzo';
$mes_n['04']='abril';
$mes_n['05']='mayo';
$mes_n['06']='junio';
$mes_n['07']='julio';
$mes_n['08']='agosto';
$mes_n['09']='septiembre';
$mes_n['10']='octubre';
$mes_n['11']='noviembre';
$mes_n['12']='diciembre';

$id_mob=base64_decode($_GET["aleat"]);
$lista_data="select * from  dns_compras where compra_id='".base64_decode($_GET["aleat"])."'";
$lista_data = $DB_gogess->executec($lista_data,array());

$compra_id=$lista_data->fields["compra_id"];
$compra_iizqc='';
$compra_iizqc=str_pad($compra_id, 10, "0", STR_PAD_LEFT);
$leeplantilla=str_replace("-nacta-",$compra_iizqc,$leeplantilla);

$busca_g="select distinct * from gogess_sisfield where tab_name='".$table."'";
$rs_buscag = $DB_gogess->executec($busca_g,array());
				if($rs_buscag)
                   {
	                  while (!$rs_buscag->EOF) {
					  
					  $separa_fechaig=array();	
					  
					  if($rs_buscag->fields["fie_name"]=='centro_id')
					  {
					     $direccion_val=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_direccion","where centro_id=",$lista_data->fields[$rs_buscag->fields["fie_name"]],$DB_gogess); 
						 $idciudad_val=$objformulario->replace_cmb("dns_centrosalud","centro_id,cant_codigo","where centro_id=",$lista_data->fields[$rs_buscag->fields["fie_name"]],$DB_gogess);
						 $ciudad_val=$objformulario->replace_cmb("app_canton","cant_codigo,cant_nombre","where cant_codigo like ",$idciudad_val,$DB_gogess);
						 $centro_nombrejefe=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombrejefe","where centro_id=",$lista_data->fields[$rs_buscag->fields["fie_name"]],$DB_gogess);
						 $leeplantilla=str_replace("-representante-",$centro_nombrejefe,$leeplantilla);
					  }
					  
					  if($rs_buscag->fields["fie_name"]=='compra_fechaaprobacion')
					  {
					     $separa_fechaig=explode("-",$lista_data->fields[$rs_buscag->fields["fie_name"]]);
						 
						 $leeplantilla=str_replace("-d-",$separa_fechaig[2],$leeplantilla);
						 $leeplantilla=str_replace("-m-",$mes_n[$separa_fechaig[1]],$leeplantilla);
						 $leeplantilla=str_replace("-anio-",$separa_fechaig[0],$leeplantilla);					 
					  
					  }
					  
					  if($rs_buscag->fields["fie_name"]=='proveevar_id')
					  {
					     $n_empresa=$objformulario->replace_cmb("app_proveedor","provee_id,provee_nombrecomercial","where provee_id =",$lista_data->fields[$rs_buscag->fields["fie_name"]],$DB_gogess);
					     $n_representante=$objformulario->replace_cmb("app_proveedor","provee_id,provee_representante","where provee_id =",$lista_data->fields[$rs_buscag->fields["fie_name"]],$DB_gogess);
						 
						 $leeplantilla=str_replace("-empresav-","<b>".$n_empresa."</b>",$leeplantilla);
						 $leeplantilla=str_replace("-repre1-","<b>".$n_representante."</b>",$leeplantilla);
						 
						 
					  }
					  
					  
					  if ($rs_buscag->fields["fie_value"]=="replace")
									 {
									      $valorbus=$lista_data->fields[$rs_buscag->fields["fie_name"]];
										  $rmp=$objformulario->replace_cmb($rs_buscag->fields["fie_tabledb"],$rs_buscag->fields["fie_datadb"],$rs_buscag->fields["fie_sql"],$valorbus,$DB_gogess); 
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
									 
									     $leeplantilla=str_replace("-".$rs_buscag->fields["fie_name"]."-",utf8_encode($rmp),$leeplantilla);
									 
									 }
					  
					  $rs_buscag->MoveNext();
					  }
				   }	 
				   

//================================================



//================================================
				   
$suma_grantotal=0;

$lista_pro='';
$lista_miv="select *,concat(cuadrobm_principioactivo,' ',cuadrobm_nombredispositivo,' ',cuadrobm_primerniveldesagregcion,' ',cuadrobm_presentacion,' ',cuadrobm_concentracion) nombre_med from  dns_temporalovimientoinventario inner join dns_cuadrobasicomedicamentos on dns_temporalovimientoinventario.cuadrobm_id=dns_cuadrobasicomedicamentos.cuadrobm_id where compra_id='".$id_mob."'";
$rs_miv = $DB_gogess->executec($lista_miv,array());
if($rs_miv)
      {
	        while (!$rs_miv->EOF) {
				
	 
  	$lista_pro.='<tr>
	<td>'.$rs_miv->fields["cuadrobm_codigoatc"].'</td>
	<td>'.utf8_encode($rs_miv->fields["nombre_med"]).'</td>
	<td>'.$rs_miv->fields["moviin_rsanitario"].'</td>
    <td>'.$rs_miv->fields["moviin_nlote"].'</td>
    <td>'.$rs_miv->fields["moviin_fechadecaducidad"].'</td>
    <td>'.$rs_miv->fields["moviin_fechadeelaboracion"].'</td>
    <td>'.$rs_miv->fields["centrorecibe_cantidad"].'</td>
	<td>'.number_format($rs_miv->fields["moviin_preciocompra"], 4, '.', '').'</td>
	<td>'.number_format($rs_miv->fields["moviin_total"], 2, '.', '').'</td>	
  </tr>	';
    
  $suma_grantotal=$suma_grantotal+$rs_miv->fields["moviin_total"];
					  
			  $rs_miv->MoveNext();
			}					  
	}  

$lista_valor='<table width="100%" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td><b>CUM</b></td>
	<td><b>NOMBRE GENERICO (forma farmac&eacute;utica, concentraci&oacute;n)</b></td>	
	<td><b>No REGISTRO SANITARIO</b></td>	
    <td><b>No Lote</b></td>
    <td><b>Fecha de Caducidad</b></td>
    <td><b>Fecha Elaboraci&oacute;n</b></td>
    <td><b>Cantidad</b></td>
	<td><b>Valor Unitario (USD)</b></td>
	<td><b>Valor Total (USD)</b></td>
  </tr>
  '.$lista_pro.'
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td> </td>
    <td></td>
	<td></td>
	<td></td>
	<td></td>
	<td><b>'.number_format($suma_grantotal, 2, '.', '').'</b></td>
  </tr>
</table>';

$leeplantilla=str_replace("-lista-",$lista_valor,$leeplantilla);
$leeplantilla=str_replace("-direccion-",$direccion_val,$leeplantilla);
$leeplantilla=str_replace("-ciudad-",$ciudad_val,$leeplantilla);

echo $leeplantilla;
			    
}
?>
