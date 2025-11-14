<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4444450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

$objformulario= new  ValidacionesFormulario();
//echo $_POST["cuadrobm_id"]."<br>";
//echo $_POST["centro_id"];

 $lista_cus=array();
 $lista_us="select * from app_usuario";
 $rs_dataus = $DB_gogess->executec($lista_us,array());
 if($rs_dataus)
 {
	  while (!$rs_dataus->EOF) {
	  
	     $lista_cus[$rs_dataus->fields["usua_id"]]["nombre"]=$rs_dataus->fields["usua_nombre"]." ".$rs_dataus->fields["usua_apellido"];
	  
	  $rs_dataus->MoveNext();	 
	  }
  }	
 
 
 $lista_ctabla=array(); 
 $lista_tabla="select * from gogess_sistable inner join gogess_sisfield on gogess_sistable.tab_name=gogess_sisfield.tab_name where ttbl_id in (3,4)"; 
 $rs_tabla = $DB_gogess->executec($lista_tabla,array());
 if($rs_tabla)
 {
	  while (!$rs_tabla->EOF) {
	  //$rs_tabla->fields["tab_name"]."<br>";
	  $lista_ctabla[$rs_tabla->fields["fie_tablasubgrid"]]["nombre"]=$rs_tabla->fields["tab_title"];
	  $lista_ctabla[$rs_tabla->fields["fie_tablasubgrid"]]["tabla"]=$rs_tabla->fields["tab_name"];
	  $lista_ctabla[$rs_tabla->fields["fie_tablasubgrid"]]["enlace"]=$rs_tabla->fields["fie_campoenlacesub"];
	  
	  $rs_tabla->MoveNext();
	  }
  }	  
 
  
  //==================================
  
  $nproducto_sql="select * from dns_cuadrobasicomedicamentos where cuadrobm_id=".$_POST["cuadrobm_id"];
 $rs_npsql = $DB_gogess->executec($nproducto_sql);
 
	$nom='';					
	if($rs_npsql->fields["cuadrobm_principioactivo"])
	{
	$nom=$rs_npsql->fields["cuadrobm_principioactivo"].' ';
	}
	
	$nom1='';					
	if($rs_npsql->fields["cuadrobm_nombrecomercial"])
	{
	$nom1=$rs_npsql->fields["cuadrobm_nombrecomercial"].' ';
	}
	
	$nom2='';					
	if($rs_npsql->fields["cuadrobm_primerniveldesagregcion"])
	{
	$nom2=$rs_npsql->fields["cuadrobm_primerniveldesagregcion"].' ';
	}
	
	$nom3='';					
	if($rs_npsql->fields["cuadrobm_tercerniveldesagregcion"])
	{
	$nom3=$rs_npsql->fields["cuadrobm_tercerniveldesagregcion"].' ';
	}
	
	$nom4='';					
	if($rs_npsql->fields["cuadrobm_concentracion"])
	{
	$nom4=$rs_npsql->fields["cuadrobm_concentracion"].' ';
	}
	
	$nom5='';					
	if($rs_npsql->fields["cuadrobm_nombredispositivo"])
	{
	$nom5=$rs_npsql->fields["cuadrobm_nombredispositivo"].' ';
	}
	 
	
	$concatena_nom=$nom.$nom1.$nom2.$nom3.$nom4.$nom5;
 
 //echo "<b>".utf8_encode($concatena_nom)."</b>";
	//print_r($lista_ctabla);
?>
<style type="text/css">
<!--
.css_tituloliy {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 10px;
}
.lista_txtlit {font-size: 10px; font-family: Verdana, Arial, Helvetica, sans-serif; }
-->
</style>
<BR />
<span class="css_tituloliy">MOVIMIENTOS</span>
<table border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#BED5E4" class="css_tituloliy">FORMULARIO</td>
    <td bgcolor="#BED5E4" class="css_tituloliy">USUARIO PIDE </td>
	<td bgcolor="#BED5E4" class="css_tituloliy">FECHA PIDE </td>
    <td bgcolor="#BED5E4" class="css_tituloliy">USUARIO DESPACHA </td>
	<td bgcolor="#BED5E4" class="css_tituloliy">FECHA DESPACHA </td>
    <td bgcolor="#BED5E4" class="css_tituloliy">MEDICAMENTO/DISPOSITIVO</td>
    <td bgcolor="#BED5E4" class="css_tituloliy">CANTIDAD</td>
   
  </tr>
  <?php
  $total_suma=0;
 $lista_descarga="select * from dns_stockactual where centro_id=".$_POST["centro_id"]." and cuadrobm_id=".$_POST["cuadrobm_id"]." and (stock_fechaureg>='".$_POST["desde_fecha"]."' and stock_fechaureg<='".$_POST["hasta_fecha"]."') and stock_tabla!=''";
 
  $rs_data = $DB_gogess->executec($lista_descarga,array());
  if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	  
	  $busca_detalles="select * from ".$rs_data->fields["stock_tabla"]." where  plantra_id=".$rs_data->fields["stock_idtbla"];
	  $rs_detalles = $DB_gogess->executec($busca_detalles,array());
	  
	  $pide_usuario=$rs_detalles->fields["usua_id"];
	  $pide_fecha=$rs_detalles->fields["plantra_fecharegistro"];
	  
	  $n_formulario='';
	  //echo $rs_data->fields["stock_tabla"];
	  $n_formulario=$lista_ctabla[trim($rs_data->fields["stock_tabla"])]["nombre"];  
	  //echo ."<br>";
	  
	  $usuario_despacha=$rs_detalles->fields["usuad_id"];
	  $fecha_despacha=$rs_detalles->fields["plantra_fechadespacho"];
	  
	  if(!($usuario_despacha))
	  {
	     $usuario_despacha=$rs_detalles->fields["usua_id"];
	  }
	  
	  
	  //existe
	  
	 $busca_listexiste="select * from ".$lista_ctabla[trim($rs_data->fields["stock_tabla"])]["tabla"]." where ".$lista_ctabla[trim($rs_data->fields["stock_tabla"])]["enlace"]."='".$rs_detalles->fields[$lista_ctabla[trim($rs_data->fields["stock_tabla"])]["enlace"]]."' limit 1";
	 
	  $rs_busca_listexiste = $DB_gogess->executec($busca_listexiste,array());
	  
	  //existe
	  
	  if($rs_busca_listexiste->fields[$lista_ctabla[trim($rs_data->fields["stock_tabla"])]["enlace"]])
	  {	  
  
  $busca_cliente="select clie_rucci from app_cliente where clie_id='".$rs_busca_listexiste->fields["clie_id"]."'";
	  $rs_busca_clientenmane = $DB_gogess->executec($busca_cliente,array());
  ?>
  <tr>
   
    <td bgcolor="#DDE9F0"><span class="lista_txtlit"><?php echo utf8_encode($n_formulario)." Code: ".$rs_data->fields["stock_id"]." Paciente:".$rs_busca_clientenmane->fields["clie_rucci"]; ?></span></td>
    <td bgcolor="#DDE9F0"><span class="lista_txtlit"><?php echo $lista_cus[$pide_usuario]["nombre"]; ?></span></td>
	<td bgcolor="#DDE9F0"><span class="lista_txtlit"><?php echo $pide_fecha; ?></span></td>
    <td bgcolor="#DDE9F0"><span class="lista_txtlit"><?php echo $lista_cus[$usuario_despacha]["nombre"]; ?></span></td>
	<td bgcolor="#DDE9F0"><span class="lista_txtlit"><?php echo $fecha_despacha; ?></span></td>
    <td bgcolor="#DDE9F0"><span class="lista_txtlit"><?php echo utf8_encode($concatena_nom); ?></span></td>
    <td bgcolor="#DDE9F0"><span class="lista_txtlit"><?php echo $rs_data->fields["stock_cantidad"]; ?></span></td>
  
  </tr>
 
  <?php
       $total_suma=$total_suma+$rs_data->fields["stock_cantidad"];
       }
	   
	   
  $rs_data->MoveNext();	   
	  }
  }
  ?>
  
   <tr>
    <td bgcolor="#DDE9F0">&nbsp;</td>
    <td bgcolor="#DDE9F0">&nbsp;</td>
    <td bgcolor="#DDE9F0">&nbsp;</td>
    <td bgcolor="#DDE9F0">&nbsp;</td>
    <td bgcolor="#DDE9F0">&nbsp;</td>
    <td bgcolor="#DDE9F0">&nbsp;</td>
    <td bgcolor="#DDE9F0"><?php echo $total_suma; ?></td>
  </tr>
</table>
