<?php
$tiempossss=544445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");


if($_SESSION['ces1313777_sessid_inicio'])
{

$doccab_idvalor=$_POST["doccab_idvalor"];

$doccab_id_origen='';
$tipocmp_codigo_origen='';
$doccab_ndocumento_origen='';

$listac_camposx="proveeve_id,doccab_rucci_cliente,tipoident_codigo,doccab_nombrerazon_cliente,doccab_direccion_cliente,doccab_telefono_cliente,doccab_email_cliente";

$lista_campos=array();
$lista_campos=explode(",",$listac_camposx);


$n_catturavalor=$n_catturavalor=$_POST["n_catturavalor"];

$lista_tomadata='';
$bandera_aut='';

$lista_data="select * from beko_documentocabecera where doccab_estadosri='AUTORIZADO' and doccab_ndocumento='".$n_catturavalor."'";
$rs_data = $DB_gogess->executec($lista_data,array());

		   if($rs_data)
		   {

				while (!$rs_data->EOF) {
				
				
				   	for($i=0;$i<count($lista_campos);$i++)
				     { 

				        $nombrevarget='';
					    $nombrevarget=$lista_campos[$i];
					    $$nombrevarget=$rs_data->fields[$lista_campos[$i]];
						
						$lista_tomadata.="$('#".$lista_campos[$i]."').val('".$$nombrevarget."');
						
						";
				     }
				
				  $doccab_fechaemision_clienteorigen=$rs_data->fields["doccab_fechaemision_cliente"];					
				  $doccab_id_origen=$rs_data->fields["doccab_id"];
				  $tipocmp_codigo_origen=$rs_data->fields["tipocmp_codigo"];
				  $doccab_ndocumento_origen=$rs_data->fields["doccab_ndocumento"];
				  $doccab_nautorizacion_origen=$rs_data->fields["doccab_nautorizacion"];
				
				  $bandera_aut=1;
				
				  $rs_data->MoveNext();
				}
			}	

if($bandera_aut==1)
{
//obtiene datos

$extra_datos1="INSERT INTO beko_documentodetalle (doccab_id, docdet_codprincipal, docdet_codaux, docdet_cantidad, docdet_descripcion, docdet_detallea, docdet_detalleb, docdet_detallec, docdet_preciou, impu_codigo, tari_codigo, docdet_porcentaje, docdet_valorimpuesto, docdet_descuento, docdet_porcent_descuento, docdet_descuento_general, docdet_total, usua_id, eteneva_id, terap_id, atenc_hc, docdet_codigoterapeutas, docdet_nombreterapeutas, usuaat_id, prof_id, docdet_fecharegistro, unid_id, docdet_peciocosto, doccab_enlace, precu_id, doccab_obs) SELECT '".$doccab_idvalor."' as doccab_id, docdet_codprincipal, docdet_codaux, docdet_cantidad, docdet_descripcion, docdet_detallea, docdet_detalleb, docdet_detallec, docdet_preciou, impu_codigo, tari_codigo, docdet_porcentaje, docdet_valorimpuesto, docdet_descuento, docdet_porcent_descuento, docdet_descuento_general, docdet_total, usua_id, eteneva_id, terap_id, atenc_hc, docdet_codigoterapeutas, docdet_nombreterapeutas, usuaat_id, prof_id, docdet_fecharegistro, unid_id, docdet_peciocosto, '".$doccab_idvalor."' as doccab_enlace, precu_id, doccab_obs FROM beko_documentodetalle where doccab_id='".$doccab_id_origen."'";

$rs_datos1 = $DB_gogess->executec($extra_datos1,array());



$extra_datos2="INSERT INTO beko_mhdetallefactura (doccab_id, mhdetfac_codprincipal, mhdetfac_codaux, mhdetfac_cantidad, mhdetfac_descripcion, mhdetfac_detallea, mhdetfac_detalleb, mhdetfac_detallec, mhdetfac_preciou, impumh_codigo, tarimh_codigo, mhdetfac_porcentaje, mhdetfac_valorimpuesto, mhdetfac_descuento, mhdetfac_porcent_descuento, mhdetfac_descuento_general, mhdetfac_total, usua_id, eteneva_id, terap_id, atenc_hc, mhdetfac_codigoterapeutas, mhdetfac_nombreterapeutas, usuaat_id, prof_id, mhdetfac_fecharegistro, unid_id, mhdetfac_peciocosto, doccab_enlace, mhdetfac_porcentajemh, precu_id, mhdetfac_obs)  select  '".$doccab_idvalor."' as doccab_id, mhdetfac_codprincipal, mhdetfac_codaux, mhdetfac_cantidad, mhdetfac_descripcion, mhdetfac_detallea, mhdetfac_detalleb, mhdetfac_detallec, mhdetfac_preciou, impumh_codigo, tarimh_codigo, mhdetfac_porcentaje, mhdetfac_valorimpuesto, mhdetfac_descuento, mhdetfac_porcent_descuento, mhdetfac_descuento_general, mhdetfac_total, usua_id, eteneva_id, terap_id, atenc_hc, mhdetfac_codigoterapeutas, mhdetfac_nombreterapeutas, usuaat_id, prof_id, mhdetfac_fecharegistro, unid_id, mhdetfac_peciocosto, doccab_enlace, mhdetfac_porcentajemh, precu_id, mhdetfac_obs from beko_mhdetallefactura  where doccab_id='".$doccab_id_origen."'"; 

$rs_datos2 = $DB_gogess->executec($extra_datos2,array());



$extra_datos3="INSERT INTO lpin_cuentaventa ( doccab_id, planv_codigoc, cueven_cantidad, cueven_preciounitario, taric_idv, cueven_ice, cueven_descuento, cueven_descuentodolar, cueven_subtotal, usua_id, cueven_fecharegistro, porcecr_id, porceci_id, cueven_obs)  select  '".$doccab_idvalor."' as doccab_id, planv_codigoc, cueven_cantidad, cueven_preciounitario, taric_idv, cueven_ice, cueven_descuento, cueven_descuentodolar, cueven_subtotal, usua_id, cueven_fecharegistro, porcecr_id, porceci_id, cueven_obs from lpin_cuentaventa where doccab_id='".$doccab_id_origen."'";

$rs_datos3 = $DB_gogess->executec($extra_datos3,array());
//otiene datos
			
}
					
?>

<script language="javascript">
<!--
<?php
if($bandera_aut==1)
{
?>
<?php echo $lista_tomadata; ?>

$('#doccab_ndocuafecta').val('<?php echo $doccab_ndocumento_origen; ?>');
$('#tipocmp_codigoafectado').val('<?php echo $tipocmp_codigo_origen; ?>');
$('#doccab_fechadocmodi').val('<?php echo $doccab_fechaemision_clienteorigen; ?>');
$('#doccab_autoirzacionmodif').val('<?php echo $doccab_nautorizacion_origen; ?>');

<?php
}
else
{

 echo "alert('DOCUMENTO A PROCESAR NO ESTA AUTORIZADO...')";
}
?>

//-->
</script>	
<?php
}
?>
