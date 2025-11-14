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
    <td><div align="center">
      <p><strong><?php echo $nombre_establ; ?></strong><BR />
      <strong>PLANILLA DE CARGOS CONSOLIDADO </strong></p>
    </div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
  </tr>
</table>
<!-- INFORME CONSOLIDADO DE LIQUIDACI&Oacute;N No. <?php echo $_GET["mes_valor"]."-".$_GET["anio_valor"]; ?>-HQ-HOSP-001 -->
<table width="800" border="1" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td colspan="5" nowrap bgcolor="#E0EBF1"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="2">No. Tr&aacute;mite: </td>
        <td width="17%">Fecha:</td>
        <td width="8%"><?php echo date("Y-m-d"); ?></td>
      </tr>
      <tr>
        <td colspan="2"><strong>Tipo Servicio:</strong> Ambulatorio </td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td width="26%"><strong>Monto Solicitado: </strong></td>
        <td width="49%">#</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2"><strong>Mes y A&ntilde;o de Prestaci&oacute;n: # </strong></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2"><strong>No de Expedientes:</strong> # </td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td nowrap bgcolor="#E0EBF1"><div align="center"><strong>No</strong></div></td>
	<td nowrap bgcolor="#E0EBF1"><div align="center"><strong>CODIGO DE VALIDACION/CARGA</strong></div></td>
	<td nowrap bgcolor="#E0EBF1"><div align="center"><strong>IDENTIFICACION No</strong></div></td>
	<td nowrap bgcolor="#E0EBF1"><div align="center"><strong>BENEFICIARIO</strong></div></td>
	<td nowrap bgcolor="#E0EBF1"><div align="center"><strong>VALOR TOTAL SOLICITADO</strong></div></td>
  </tr>
  <?php
  
  $numeracion_exp=0;
$lista_servicios="select * from  dns_atencion inner join app_cliente on dns_atencion.clie_id=app_cliente.clie_id where dns_atencion.centro_id='".$_GET["centro_id"]."' and atenc_fecharegistro like '".$_GET["anio_valor"]."-".$_GET["mes_valor"]."-%' and clie_aseguradora='".$_GET["prase_valor"]."'";

 $rs_data = $DB_gogess->executec($lista_servicios,array());

 if($rs_data)
 {

	  while (!$rs_data->EOF) {	
	  
$numeracion_exp++;
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
$dns_imagenologia="select  sum(prod_precio) as total,count(cuabas_id) num from dns_imagenologia inner join dns_cuadrobasicoimagen on dns_imagenologia.imgag_enlace=dns_cuadrobasicoimagen.imgag_enlace  where atenc_id =".$rs_data->fields["atenc_id"];
 $rs_imagenologia = $DB_gogess->executec($dns_imagenologia,array());

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

$mesanio=$saca_datasep[0]."-".$saca_datasep[1];
$dia=array();
$dia=explode(" ",$saca_datasep[2]);

//CIE 10
$busca_detallesexterno="select * from dns_consultaexterna inner join dns_diagnosticoexterna on dns_consultaexterna.conext_enlace=dns_diagnosticoexterna.conext_enlace where atenc_id=".$rs_data->fields["atenc_id"];
 $rs_externo = $DB_gogess->executec($busca_detallesexterno,array());
//CIE 10 

//lista cuadro basico 
$busca_anamesisexamenfisicol="select catgp_nombre,dns_cuadrobasico.prod_codigo,prod_nombre,'1' as cantidad,dns_cuadrobasico.prod_precio,dns_cuadrobasico.prod_precio from dns_anamesisexamenfisico inner join dns_cuadrobasico on dns_anamesisexamenfisico.anam_enlace=dns_cuadrobasico.anam_enlace inner join efacsistema_producto on dns_cuadrobasico.prod_codigo=efacsistema_producto.prod_codigo inner join efacfactura_categproducto on efacsistema_producto.catgp_id=efacfactura_categproducto.catgp_id where prod_nivel=1 and atenc_id =".$rs_data->fields["atenc_id"];


                       $totalexp=0;
$rs_anamesisexamenfisicol = $DB_gogess->executec($busca_anamesisexamenfisicol,array());

 if($rs_anamesisexamenfisicol)
 {
	  while (!$rs_anamesisexamenfisicol->EOF) {
	  
                       $totalexp++;
				   
	
  ?>
  <tr>
    <td nowrap bgcolor="#E9F1F5"><?php echo $totalexp; ?></td>
    <td nowrap bgcolor="#E9F1F5"></td>
	<td nowrap bgcolor="#E9F1F5"><?php echo $rs_data->fields["clie_rucci"]; ?></td>
	 <td nowrap bgcolor="#E9F1F5"><?php echo $rs_data->fields["clie_apellido"]." ".$rs_data->fields["clie_nombre"]; ?></td>
	 
	<td nowrap bgcolor="#E9F1F5"><?php echo $rs_anamesisexamenfisicol->fields["prod_precio"]; ?></td>
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
		  
		  $totalexp++;
  ?>
  <tr>
        <td nowrap bgcolor="#E9F1F5"><?php echo $totalexp; ?></td>
    <td nowrap bgcolor="#E9F1F5"></td>
	<td nowrap bgcolor="#E9F1F5"><?php echo $rs_data->fields["clie_rucci"]; ?></td>
	 <td nowrap bgcolor="#E9F1F5"><?php echo $rs_data->fields["clie_apellido"]." ".$rs_data->fields["clie_nombre"]; ?></td>
	 
	<td nowrap bgcolor="#E9F1F5"><?php echo $rs_anamesisexamenfisicol->fields["prod_precio"]; ?></td>
  </tr>
 <?php
      $rs_anamesisexamenfisicol->MoveNext();
       }
  } 


$busca_anamesisexamenfisicol="select catgp_nombre,dns_cuadrobasicolab.prod_codigo,prod_nombre,'1' as cantidad,dns_cuadrobasicolab.prod_precio,dns_cuadrobasicolab.prod_precio from dns_laboratorio inner join dns_cuadrobasicolab on dns_laboratorio.lab_enlace=dns_cuadrobasicolab.lab_enlace inner join efacsistema_producto on dns_cuadrobasicolab.prod_codigo=efacsistema_producto.prod_codigo inner join efacfactura_categproducto on efacsistema_producto.catgp_id=efacfactura_categproducto.catgp_id where prod_nivel=1 and atenc_id =".$rs_data->fields["atenc_id"];


$rs_anamesisexamenfisicol = $DB_gogess->executec($busca_anamesisexamenfisicol,array());

 if($rs_anamesisexamenfisicol)
 {
	  while (!$rs_anamesisexamenfisicol->EOF) {
		  
		  $totalexp++;
  ?>
  <tr>
       <td nowrap bgcolor="#E9F1F5"><?php echo $totalexp; ?></td>
    <td nowrap bgcolor="#E9F1F5"></td>
	<td nowrap bgcolor="#E9F1F5"><?php echo $rs_data->fields["clie_rucci"]; ?></td>
	 <td nowrap bgcolor="#E9F1F5"><?php echo $rs_data->fields["clie_apellido"]." ".$rs_data->fields["clie_nombre"]; ?></td>
	 
	<td nowrap bgcolor="#E9F1F5"><?php echo $rs_anamesisexamenfisicol->fields["prod_precio"]; ?></td>
  </tr>
 <?php
      $rs_anamesisexamenfisicol->MoveNext();
       }
  } 


 $busca_anamesisexamenfisicol="select catgp_nombre,dns_cuadrobasicoimagen.prod_codigo,prod_nombre,'1' as cantidad,dns_cuadrobasicoimagen.prod_precio,dns_cuadrobasicoimagen.prod_precio from dns_imagenologia inner join dns_cuadrobasicoimagen on dns_imagenologia.imgag_enlace=dns_cuadrobasicoimagen.imgag_enlace inner join efacsistema_producto on dns_cuadrobasicoimagen.prod_codigo=efacsistema_producto.prod_codigo inner join efacfactura_categproducto on efacsistema_producto.catgp_id=efacfactura_categproducto.catgp_id where prod_nivel=1 and atenc_id =".$rs_data->fields["atenc_id"];


$rs_anamesisexamenfisicol = $DB_gogess->executec($busca_anamesisexamenfisicol,array());

 if($rs_anamesisexamenfisicol)
 {
	  while (!$rs_anamesisexamenfisicol->EOF) {
		  $totalexp++;
  ?>
  <tr>
       <td nowrap bgcolor="#E9F1F5"><?php echo $totalexp; ?></td>
    <td nowrap bgcolor="#E9F1F5"></td>
	<td nowrap bgcolor="#E9F1F5"><?php echo $rs_data->fields["clie_rucci"]; ?></td>
	 <td nowrap bgcolor="#E9F1F5"><?php echo $rs_data->fields["clie_apellido"]." ".$rs_data->fields["clie_nombre"]; ?></td>
	 
	<td nowrap bgcolor="#E9F1F5"><?php echo $rs_anamesisexamenfisicol->fields["prod_precio"]; ?></td>
  </tr>
  
<?php
      $rs_anamesisexamenfisicol->MoveNext();
       }
  } 

   $rs_data->MoveNext();	   

	  }

  }



  ?>
  <tr>
    <td nowrap bgcolor="#E9F1F5">&nbsp;</td>
    <td nowrap bgcolor="#E9F1F5">VALOR TOTAL SOLICITADO</td>
    <td nowrap bgcolor="#E9F1F5">&nbsp;</td>
    <td nowrap bgcolor="#E9F1F5">&nbsp;</td>
    <td nowrap bgcolor="#E9F1F5">#</td>
  </tr>
  
</table>
<?php
}

?>

<table width="800" border="1" align="center" cellpadding="0" cellspacing="0">
  
  <tr>
    <td width="281">&nbsp;</td>
    <td width="513" rowspan="6"><div align="center">SELLO:__________________________</div></td>
  </tr>
  <tr>
    <td height="50" valign="top">NOMBRE:</td>
  </tr>
  <tr>
    <td>No. IDENTIFICION</td>
  </tr>
  <tr>
    <td>CARGO:</td>
  </tr>
  <tr>
    <td>SELLO</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>


<?php
//echo $totalexp;
?>
