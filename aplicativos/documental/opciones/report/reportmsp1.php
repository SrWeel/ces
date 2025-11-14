<style type="text/css">
<!--
.css_txtval {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; }
.css_txttitulo {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
-->
</style>
<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=44454000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if(@$_SESSION['ces1313777_sessid_inicio'])
{
$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");

for($itbl=0;$itbl<count($lista_tbldata);$itbl++)
 {

  include(@$director."libreria/estructura/".$lista_tbldata[$itbl].".php");

 } 
 
function calculaedad($date2){
$diff = abs(strtotime($date2) - strtotime('1999-11-04'));
$years = floor($diff / (365*60*60*24));
$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
return $years;
} 
 
$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();

$centro_id=$_GET["centro_id"];
$numero_mes=$_GET["mes_valor"];
$anio_valor=$_GET["anio_valor"];
$nombremes=$nombre_mes[$_GET["mes_valor"]];

$nombre_establ=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre"," where centro_id=",$centro_id,$DB_gogess);

?>
<table width="100%" border="1" cellpadding="2" cellspacing="0">
  <tr>
    <td nowrap><div align="center"><span class="css_txttitulo">RUC DEL PRESTADOR</span></div></td>
	<td nowrap><div align="center"><span class="css_txttitulo">NOMBRE DEL PRESTADOR</span></div></td>
	<td nowrap><div align="center"><span class="css_txttitulo">NRO. DE EXPEDIENTES</span></div></td>	
    <td nowrap><div align="center"><span class="css_txttitulo">TIPO DE SERVICIO</span></div></td>
	<td nowrap><div align="center"><span class="css_txttitulo">PERIODO</span></div></td>
	<td nowrap><div align="center"><span class="css_txttitulo">CODIGO DE VALIDACIO SOLO RPIS</span></div></td>
	<td nowrap><div align="center"><span class="css_txttitulo">MOTIVO DE REFERENCIA</span></div></td>
	<td nowrap><div align="center"><span class="css_txttitulo">FORMA DE INGRESO</span></div></td>
    <td nowrap><div align="center"><span class="css_txttitulo">HISTORIA CLINICA</span></div></td>

	<td nowrap><div align="center"><span class="css_txttitulo">CEDULA DEL PACIENTE</span></div></td>
    <td nowrap><div align="center"><span class="css_txttitulo">BENEFICIARIO</span></div></td>
	<td nowrap><div align="center"><span class="css_txttitulo">MES DE RECLAMO</span></div></td>
    <td nowrap><div align="center"><span class="css_txttitulo">GRUPO/TIPO DE ITEM</span></div></td>
	<td nowrap><div align="center"><span class="css_txttitulo">TIPO DE PROCEDIMIENTO</span></div></td>
	<td nowrap><div align="center"><span class="css_txttitulo">CEDULA DEL MEDICO</span></div></td>
	<td nowrap><div align="center"><span class="css_txttitulo">FECHA DE PRESTACION</span></div></td>
	<td nowrap><div align="center"><span class="css_txttitulo">CIE 10</span></div></td>
	<td nowrap><div align="center"><span class="css_txttitulo">CODIGO  DEL ITEM</span></div></td>
	<td nowrap><div align="center"><span class="css_txttitulo">DESCRIPCION DEL ITEM</span></div></td>
	<td nowrap><div align="center"><span class="css_txttitulo">ANESTESIA SI/NO</span></div></td>
	<td nowrap><div align="center"><span class="css_txttitulo">%PAGO</span></div></td>
	<td nowrap><div align="center"><span class="css_txttitulo">CANTIDAD</span></div></td>
	<td nowrap><div align="center"><span class="css_txttitulo">VALOR UNITARIO </span></div></td>
	<td nowrap><div align="center"><span class="css_txttitulo">SUBTOTAL</span></div></td>
	<td nowrap><div align="center"><span class="css_txttitulo">% BODEGA</span></div></td>
	<td nowrap><div align="center"><span class="css_txttitulo">% IVA</span></div></td>
	<td nowrap><div align="center"><span class="css_txttitulo">TOTAL</span></div></td>
  </tr>
  <?php
  //---------------------------------------------------------------------
// TARIFARIO
$busca_paratarifar="select * from dns_atencion 
inner join app_cliente on dns_atencion.clie_id=app_cliente.clie_id
inner join dns_anamesisexamenfisico on dns_atencion.clie_id=dns_anamesisexamenfisico.clie_id
inner join dns_cuadrobasico on dns_anamesisexamenfisico.anam_enlace=dns_cuadrobasico.anam_enlace
inner join dns_tiposervicio on dns_atencion.tiposerv_id=dns_tiposervicio.tiposerv_id
inner join efacsistema_producto on efacsistema_producto.prod_codigo=dns_cuadrobasico.prod_codigo 
inner join app_usuario on dns_cuadrobasico.usua_id=app_usuario.usua_id
inner join dns_centrosalud on dns_atencion.centro_id=dns_centrosalud.centro_id
where dns_atencion.centro_id='".$_GET["centro_id"]."' and cuabas_fecharegistro like '".$_GET["anio_valor"]."-".$_GET["mes_valor"]."-%' and  prod_nivel=1";
$numeracion_exp=0;

$rs_btarifario = $DB_gogess->executec($busca_paratarifar,array());

if($rs_btarifario)
	{
		while (!$rs_btarifario->EOF) {
	
		
$saca_datasep=array();
$saca_datasep=explode("-",$rs_btarifario->fields["cuabas_fecharegistro"]);
$mesanio=$saca_datasep[0]."-".$saca_datasep[1];

//------diagnostico
$lista_diag="select * from dns_diagnosticoanamnesis where anam_enlace='".$rs_btarifario->fields["anam_enlace"]."'";
$rs_diag = $DB_gogess->executec($lista_diag,array());

$numeracion_exp++;
//------diagnostico
		
		echo '  <tr>
	<td><span class="css_txtval">'.$rs_btarifario->fields["centro_ruc"].'</span></td>
	<td><span class="css_txtval">'.$rs_btarifario->fields["centro_nombre"].'</span></td>
	<td><span class="css_txtval">'.$numeracion_exp.'</span></td>	
	<td><span class="css_txtval">'.$rs_btarifario->fields["tiposerv_nombre"].'</span></td>	
	<td><span class="css_txtval">'.$mesanio.'</span></td>
	<td><span class="css_txtval">NO APLICA</span></td>
	<td><span class="css_txtval">NO APLICA</span></td>
	<td><span class="css_txtval">'.$rs_btarifario->fields["atenc_condiciondeingreso"].'</span></td>
	<td><span class="css_txtval">'.$rs_btarifario->fields["atenc_hc"].'</span></td>
	
    <td><span class="css_txtval">'.$rs_btarifario->fields["tiposerv_nombre"].'</span></td>
    <td><span class="css_txtval">'.$rs_btarifario->fields["clie_rucci"].'</span></td>
    <td><span class="css_txtval">'.$rs_btarifario->fields["clie_nombre"].''.$rs_btarifario->fields["clie_apellido"].'</span></td>
    <td><span class="css_txtval">'.$mesanio.'</span></td>
    <td><span class="css_txtval">'.$rs_btarifario->fields["prod_famprod"].'</span></td>
    <td><span class="css_txtval">NO APLICA</span></td>
    <td><span class="css_txtval">'.$rs_btarifario->fields["usua_ciruc"].'</span></td>
    <td><span class="css_txtval">'.$rs_btarifario->fields["cuabas_fecharegistro"].'</span></td>
	<td><span class="css_txtval">'.$rs_diag->fields["diagn_cie"].'</span></td>
	<td><span class="css_txtval">'.$rs_btarifario->fields["prod_codigo"].'</span></td>
	<td><span class="css_txtval">'.$rs_btarifario->fields["prod_descripcion"].'</span></td>
	<td><span class="css_txtval">NO</span></td>
	<td><span class="css_txtval">0</span></td>
	<td><span class="css_txtval">1</span></td>
	<td><span class="css_txtval">'.$rs_btarifario->fields["prod_precio"].'</span></td>
	<td><span class="css_txtval">'.$rs_btarifario->fields["prod_precio"].'</span></td>
	<td><span class="css_txtval">0</span></td>
	<td><span class="css_txtval">0</span></td>
	<td><span class="css_txtval">'.$rs_btarifario->fields["prod_precio"].'</span></td>
  </tr>';				
						
						
			$rs_btarifario->MoveNext();			
		}
	}	



//---------------------------------------------------------------------
  
  ?>
  
   <tr>
    <td><span class="css_txtval"></span></td>
    <td><span class="css_txtval"></span></td>
    <td><span class="css_txtval"></span></td>
    <td><span class="css_txtval"></span></td>
    <td><span class="css_txtval"></span></td>
    <td><span class="css_txtval"></span></td>
    <td><span class="css_txtval"></span></td>
    <td><span class="css_txtval"></span></td>
	<td><span class="css_txtval"></span></td>
	<td><span class="css_txtval"></span></td>
	<td><span class="css_txtval"></span></td>
	<td><span class="css_txtval"></span></td>
	<td><span class="css_txtval"></span></td>
	<td><span class="css_txtval"></span></td>
	<td><span class="css_txtval"></span></td>
	<td><span class="css_txtval"></span></td>
	<td><span class="css_txtval"></span></td>
	<td><span class="css_txtval"></span></td>
	<td><span class="css_txtval"><?php ?></span></td>
  </tr>

</table>

<?php
}

?>