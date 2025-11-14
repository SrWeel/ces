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

?><style type="text/css">
<!--
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.Estilo1 {
	font-size: 10px;
	font-weight: bold;
}
.Estilo2 {font-size: 10px}
-->
</style>

<table width="100%" border="0" align="center" cellpadding="3" cellspacing="2">
  <tr>
    <td width="50%"><img src="../../../../images/logo2.png" width="123" height="98" /></td>
    <td width="50%"><div align="right"><img src="../../../../images/ministerio.jpg"  height="98" /></div></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center">
      <p><strong>PICHINCHA HUMANA</strong><BR />
      <strong>PLANILLA CONSOLIDADA UNIDADES DE PRIMER NIVEL</strong></p>
    </div></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" valign="top"><table width="300" border="1" cellpadding="0" cellspacing="0">
        <tr>
          <td width="160"><span class="Estilo1">NUMERO DE PLANILLA </span></td>
          <td width="134"><span class="Estilo2"><?php echo $numero_mes."-".$nombremes."-".str_replace("ESTABLECIMIENTO DE ","",$nombre_establ)."-".$anio_valor; ?></span></td>
        </tr>
        <tr>
          <td><span class="Estilo2"><strong>SERVICIO AMBULATORIO: </strong></span></td>
          <td><span class="Estilo2">MEDICINA <?php echo $_GET["prase_valor"] ?>% </span></td>
        </tr>
        <tr>
          <td><span class="Estilo2"><strong>VALOR SOLICITADO <?php echo $_GET["prase_valor"] ?>% : </strong></span></td>
          <td><span class="Estilo2"></span></td>
        </tr>
        <tr>
          <td><span class="Estilo2"><strong>NUMERO DE EXPEDIENTES <?php echo $_GET["prase_valor"] ?>% : </strong></span></td>
          <td><span class="Estilo2"></span></td>
        </tr>
        <tr>
          <td><span class="Estilo2"><strong>ESTABLECIMIENTO DE SALUD: </strong></span></td>
          <td><span class="Estilo2"><?php echo str_replace("ESTABLECIMIENTO DE ","",$nombre_establ); ?></span></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
<!-- INFORME CONSOLIDADO DE LIQUIDACI&Oacute;N No. <?php echo $_GET["mes_valor"]."-".$_GET["anio_valor"]; ?>-HQ-HOSP-001 -->
<table width="200" border="1" cellpadding="3" cellspacing="1">
  <tr>
    <td nowrap bgcolor="#E0EBF1"><div align="center"><strong>TIPO DE SERVICIO</strong></div></td>
    <td nowrap bgcolor="#E0EBF1"><div align="center"><strong>MES y A&Ntilde;O DE PRESTACION</strong></div></td>
    <td nowrap bgcolor="#E0EBF1"><div align="center"><strong>NRO. DE EXPEDIENTES</strong></div></td>
    <td nowrap bgcolor="#E0EBF1"><div align="center"><strong>FECHA</strong></div></td>
    <td nowrap bgcolor="#E0EBF1"><div align="center"><strong>Nro. C&Eacute;DULA </strong></div></td>
    <td nowrap bgcolor="#E0EBF1"><div align="center"><strong>BENEFICIARIO</strong></div></td>
    <td nowrap bgcolor="#E0EBF1"><div align="center"><strong>COBERTURA</strong></div></td>
    <td nowrap bgcolor="#E0EBF1"><div align="center"><strong>CIE 10</strong></div></td>
    <td nowrap bgcolor="#E0EBF1"><div align="center"><strong>CLASIFICACION POR CARGO</strong></div></td>
    <td nowrap bgcolor="#E0EBF1"><div align="center"><strong>C&Oacute;DIGO TNS</strong></div></td>
    <td nowrap bgcolor="#E0EBF1"><div align="center"><strong>DESCRIPCI&Oacute;N</strong></div></td>
	<td nowrap bgcolor="#E0EBF1"><div align="center"><strong>CANTIDAD</strong></div></td>
	<td nowrap bgcolor="#E0EBF1"><div align="center"><strong>VALOR UNITARIO</strong></div></td>
	<td nowrap bgcolor="#E0EBF1"><div align="center"><strong>VALOR TOTAL SOLICITADO</strong></div></td>
	<td nowrap bgcolor="#E0EBF1"><div align="center"><strong>VALOR 68 % ISSPOL SOLICITADO</strong></div></td>
	<td nowrap bgcolor="#E0EBF1"><div align="center"><strong>VALOR 32% MSP </strong></div></td>
	<td nowrap bgcolor="#E0EBF1"><div align="center"><strong>OBSERVACIONES</strong></div></td>
  </tr>
  <?php
  
  
$lista_servicios="select * from  dns_atencion inner join app_cliente on dns_atencion.clie_id=app_cliente.clie_id where dns_atencion.centro_id='".$_GET["centro_id"]."' and atenc_fecharegistro like '".$_GET["anio_valor"]."-".$_GET["mes_valor"]."-%' and clie_aseguradora='".$_GET["prase_valor"]."'";

 $rs_data = $DB_gogess->executec($lista_servicios,array());

 if($rs_data)
 {

	  while (!$rs_data->EOF) {	

//covertura
$nvalorase=$objformulario->replace_cmb("dns_porcentajeasegurado","prase_valor,prase_nombre","where prase_valor=",$rs_data->fields["clie_aseguradora"],$DB_gogess);
//covertura	  

//Anamnesis y Examen Físico

 $busca_anamesisexamenfisico="select  sum(prod_precio) as total,count(cuabas_id) num from dns_anamesisexamenfisico inner join dns_cuadrobasico on dns_anamesisexamenfisico.anam_enlace=dns_cuadrobasico.anam_enlace where atenc_id =".$rs_data->fields["atenc_id"];
 $rs_anamesisexamenfisico = $DB_gogess->executec($busca_anamesisexamenfisico,array());

$valor1=0;
$cantidad1=0;
$valor1=$rs_anamesisexamenfisico->fields["total"];
$cantidad1=$rs_anamesisexamenfisico->fields["num"];
//Anamnesis y Examen Físico

//Consulta externa

 $dns_consultaexterna="select  sum(prod_precio) as total,count(cuabas_id) num from dns_consultaexterna inner join dns_cuadrobasicocexterno on dns_consultaexterna.conext_enlace=dns_cuadrobasicocexterno.conext_enlace  where atenc_id =".$rs_data->fields["atenc_id"];
 $rs_consultaexterna = $DB_gogess->executec($dns_consultaexterna,array());

$valor2=0;
$cantidad2=0;
$valor2=$rs_consultaexterna->fields["total"];
$cantidad2=$rs_consultaexterna->fields["num"];
//Consulta externa

//Laboratorio
 $dns_laboratorio="select  sum(prod_precio) as total,count(cuabas_id) num from dns_laboratorio inner join dns_cuadrobasicolab on dns_laboratorio.lab_enlace=dns_cuadrobasicolab.lab_enlace  where atenc_id =".$rs_data->fields["atenc_id"];
 $rs_laboratorio = $DB_gogess->executec($dns_laboratorio,array());

$valor3=0;
$cantidad3=0;
$valor3=$rs_laboratorio->fields["total"];
$cantidad3=$rs_laboratorio->fields["num"];
//Laboratorio

//Imagen
$dns_odontologia="select  sum(prod_precio) as total,count(cuabas_id) num from dns_odontologia inner join dns_cuadrobasicoodontologia on dns_odontologia.imgag_enlace=dns_cuadrobasicoodontologia.imgag_enlace  where atenc_id =".$rs_data->fields["atenc_id"];
 $rs_imagenologia = $DB_gogess->executec($dns_odontologia,array());

$valor4=0;
$cantidad4=0;
$valor4=$rs_imagenologia->fields["total"];
$cantidad4=$rs_imagenologia->fields["num"];
//Imagen

$numero_exp=0;
$numero_exp=$cantidad1+$cantidad2+$cantidad3+$cantidad4;

//Tipo servicio

$ntiposervicio='';
$ntiposervicio=$objformulario->replace_cmb("dns_tiposervicio","tiposerv_id,tiposerv_nombre","where tiposerv_id=",$rs_data->fields["tiposerv_id"],$DB_gogess);
//Tipo servicio

//Fecha registro
$saca_datasep=array();
$saca_datasep=explode("-",$rs_data->fields["atenc_fecharegistro"]);

$mesanio=$nombre_mes[$saca_datasep[1]]."-".$saca_datasep[0];
$dia=array();
$dia=explode(" ",$saca_datasep[2]);

//CIE 10
$busca_detallesexterno="select * from dns_consultaexterna inner join dns_diagnosticoexterna on dns_consultaexterna.conext_enlace=dns_diagnosticoexterna.conext_enlace where atenc_id=".$rs_data->fields["atenc_id"];
 $rs_externo = $DB_gogess->executec($busca_detallesexterno,array());
//CIE 10 

//lista cuadro basico 
$busca_anamesisexamenfisicol="select catgp_nombre,dns_cuadrobasico.prod_codigo,prod_nombre,'1' as cantidad,dns_cuadrobasico.prod_precio,dns_cuadrobasico.prod_precio from dns_anamesisexamenfisico inner join dns_cuadrobasico on dns_anamesisexamenfisico.anam_enlace=dns_cuadrobasico.anam_enlace inner join efacsistema_producto on dns_cuadrobasico.prod_codigo=efacsistema_producto.prod_codigo inner join efacfactura_categproducto on efacsistema_producto.catgp_id=efacfactura_categproducto.catgp_id where prod_nivel=1 and atenc_id =".$rs_data->fields["atenc_id"];



$rs_anamesisexamenfisicol = $DB_gogess->executec($busca_anamesisexamenfisicol,array());

 if($rs_anamesisexamenfisicol)
 {
	  while (!$rs_anamesisexamenfisicol->EOF) {
	  
	  
  ?>
  <tr>
    <td nowrap bgcolor="#E9F1F5"><?php echo $ntiposervicio; ?></td>
    <td nowrap bgcolor="#E9F1F5"><?php echo $mesanio; ?></td>
    <td nowrap bgcolor="#E9F1F5"><?php echo $numero_exp; ?></td>
    <td nowrap bgcolor="#E9F1F5"><?php echo $saca_datasep[0]."-".$saca_datasep[1]."-".$dia[0]; ?></td>
    <td nowrap bgcolor="#E9F1F5"><?php echo $rs_data->fields["clie_rucci"]; ?></td>
    <td nowrap bgcolor="#E9F1F5"><?php echo $rs_data->fields["clie_apellido"]." ".$rs_data->fields["clie_nombre"]; ?></td>
    <td nowrap bgcolor="#E9F1F5"><?php echo $nvalorase; ?></td>
    <td nowrap bgcolor="#E9F1F5"><?php echo $rs_externo->fields["diagn_cie"]; ?></td>
    <td nowrap bgcolor="#E9F1F5"><?php echo $rs_anamesisexamenfisicol->fields["catgp_nombre"]; ?></td>
    <td nowrap bgcolor="#E9F1F5"><?php echo $rs_anamesisexamenfisicol->fields["prod_codigo"]; ?></td>
    <td nowrap bgcolor="#E9F1F5"><?php echo $rs_anamesisexamenfisicol->fields["prod_nombre"]; ?></td>
	<td nowrap bgcolor="#E9F1F5"><?php echo $rs_anamesisexamenfisicol->fields["cantidad"]; ?></td>
	<td nowrap bgcolor="#E9F1F5"><?php echo $rs_anamesisexamenfisicol->fields["prod_precio"]; ?></td>
	<td nowrap bgcolor="#E9F1F5"><?php echo $rs_anamesisexamenfisicol->fields["prod_precio"]; ?></td>
	<td nowrap bgcolor="#E9F1F5"><?php ?></td>
	<td nowrap bgcolor="#E9F1F5"><?php  ?></td>
	<td bgcolor="#E9F1F5"><?php  ?></td>
  </tr>
 <?php
      $rs_anamesisexamenfisicol->MoveNext();
       }
  } 
 

$busca_anamesisexamenfisicol="select catgp_nombre,dns_cuadrobasicocexterno.prod_codigo,prod_nombre,'1' as cantidad,dns_cuadrobasicocexterno.prod_precio,dns_cuadrobasicocexterno.prod_precio from dns_consultaexterna inner join dns_cuadrobasicocexterno on dns_consultaexterna.conext_enlace=dns_cuadrobasicocexterno.conext_enlace inner join efacsistema_producto on dns_cuadrobasicocexterno.prod_codigo=efacsistema_producto.prod_codigo inner join efacfactura_categproducto on efacsistema_producto.catgp_id=efacfactura_categproducto.catgp_id where prod_nivel=1 and atenc_id =".$rs_data->fields["atenc_id"];

$rs_anamesisexamenfisicol = $DB_gogess->executec($busca_anamesisexamenfisicol,array());

 if($rs_anamesisexamenfisicol)
 {
	  while (!$rs_anamesisexamenfisicol->EOF) {
  ?>
  <tr>
    <td nowrap bgcolor="#E9F1F5"><?php echo $ntiposervicio; ?></td>
    <td nowrap bgcolor="#E9F1F5"><?php echo $mesanio; ?></td>
    <td nowrap bgcolor="#E9F1F5"><?php echo $numero_exp; ?></td>
    <td nowrap bgcolor="#E9F1F5"><?php echo $saca_datasep[0]."-".$saca_datasep[1]."-".$dia[0]; ?></td>
    <td nowrap bgcolor="#E9F1F5"><?php echo $rs_data->fields["clie_rucci"]; ?></td>
    <td nowrap bgcolor="#E9F1F5"><?php echo $rs_data->fields["clie_apellido"]." ".$rs_data->fields["clie_nombre"]; ?></td>
    <td nowrap bgcolor="#E9F1F5"><?php echo $nvalorase; ?></td>
    <td nowrap bgcolor="#E9F1F5"><?php echo $rs_externo->fields["diagn_cie"]; ?></td>
    <td nowrap bgcolor="#E9F1F5"><?php echo $rs_anamesisexamenfisicol->fields["catgp_nombre"]; ?></td>
    <td nowrap bgcolor="#E9F1F5"><?php echo $rs_anamesisexamenfisicol->fields["prod_codigo"]; ?></td>
    <td nowrap bgcolor="#E9F1F5"><?php echo $rs_anamesisexamenfisicol->fields["prod_nombre"]; ?></td>
	<td nowrap bgcolor="#E9F1F5"><?php echo $rs_anamesisexamenfisicol->fields["cantidad"]; ?></td>
	<td nowrap bgcolor="#E9F1F5"><?php echo $rs_anamesisexamenfisicol->fields["prod_precio"]; ?></td>
	<td nowrap bgcolor="#E9F1F5"><?php echo $rs_anamesisexamenfisicol->fields["prod_precio"]; ?></td>
	<td nowrap bgcolor="#E9F1F5"><?php ?></td>
	<td nowrap bgcolor="#E9F1F5"><?php  ?></td>
	<td bgcolor="#E9F1F5"><?php  ?></td>
  </tr>
 <?php
      $rs_anamesisexamenfisicol->MoveNext();
       }
  } 


 $busca_anamesisexamenfisicol="select catgp_nombre,dns_cuadrobasicoodontologia.prod_codigo,prod_nombre,'1' as cantidad,dns_cuadrobasicoodontologia.prod_precio,dns_cuadrobasicoodontologia.prod_precio from dns_odontologia inner join dns_cuadrobasicoodontologia on dns_odontologia.imgag_enlace=dns_cuadrobasicoodontologia.imgag_enlace inner join efacsistema_producto on dns_cuadrobasicoodontologia.prod_codigo=efacsistema_producto.prod_codigo inner join efacfactura_categproducto on efacsistema_producto.catgp_id=efacfactura_categproducto.catgp_id where prod_nivel=1 and atenc_id =".$rs_data->fields["atenc_id"];


$rs_anamesisexamenfisicol = $DB_gogess->executec($busca_anamesisexamenfisicol,array());

 if($rs_anamesisexamenfisicol)
 {
	  while (!$rs_anamesisexamenfisicol->EOF) {
  ?>
  <tr>
    <td nowrap bgcolor="#E9F1F5"><?php echo $ntiposervicio; ?></td>
    <td nowrap bgcolor="#E9F1F5"><?php echo $mesanio; ?></td>
    <td nowrap bgcolor="#E9F1F5"><?php echo $numero_exp; ?></td>
    <td nowrap bgcolor="#E9F1F5"><?php echo $saca_datasep[0]."-".$saca_datasep[1]."-".$dia[0]; ?></td>
    <td nowrap bgcolor="#E9F1F5"><?php echo $rs_data->fields["clie_rucci"]; ?></td>
    <td nowrap bgcolor="#E9F1F5"><?php echo $rs_data->fields["clie_apellido"]." ".$rs_data->fields["clie_nombre"]; ?></td>
    <td nowrap bgcolor="#E9F1F5"><?php echo $nvalorase; ?></td>
    <td nowrap bgcolor="#E9F1F5"><?php echo $rs_externo->fields["diagn_cie"]; ?></td>
    <td nowrap bgcolor="#E9F1F5"><?php echo $rs_anamesisexamenfisicol->fields["catgp_nombre"]; ?></td>
    <td nowrap bgcolor="#E9F1F5"><?php echo $rs_anamesisexamenfisicol->fields["prod_codigo"]; ?></td>
    <td nowrap bgcolor="#E9F1F5"><?php echo $rs_anamesisexamenfisicol->fields["prod_nombre"]; ?></td>
	<td nowrap bgcolor="#E9F1F5"><?php echo $rs_anamesisexamenfisicol->fields["cantidad"]; ?></td>
	<td nowrap bgcolor="#E9F1F5"><?php echo $rs_anamesisexamenfisicol->fields["prod_precio"]; ?></td>
	<td nowrap bgcolor="#E9F1F5"><?php echo $rs_anamesisexamenfisicol->fields["prod_precio"]; ?></td>
	<td nowrap bgcolor="#E9F1F5"><?php ?></td>
	<td nowrap bgcolor="#E9F1F5"><?php  ?></td>
	<td bgcolor="#E9F1F5"><?php  ?></td>
  </tr>
<?php
      $rs_anamesisexamenfisicol->MoveNext();
       }
  } 

   $rs_data->MoveNext();	   

	  }

  }

  ?></table>
<?php
}

?>
<p>
<table width="700" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td width="276"><div align="center"><strong>RECEPCION/REVISION/ ORGANIZACI&Oacute;N /DOCUMENTAL Y PLANILLAJE.</strong></div></td>
    <td width="49">&nbsp;</td>
    <td width="62">&nbsp;</td>
    <td width="285"><div align="center"><strong>APROBADO Y VALIDADO POR LA MAXIMA AUTORIDAD DE LA UNIDAD DE SALUD.</strong></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="50" valign="top">FIRMA</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td valign="top">FIRMA</td>
  </tr>
  <tr>
    <td>NOMBRE</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>NOMBRE</td>
  </tr>
  <tr>
    <td>Nro. CC. </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Nro. CC. </td>
  </tr>
  <tr>
    <td>SELLO</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>SELLO</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<p>