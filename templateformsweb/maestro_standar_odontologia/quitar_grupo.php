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

$cuadrobm_codigoatc='';
$cuadrobm_nombredispositivo='';
$cuadrobm_preciodispositivo='';
$plantra_valorplanillax=0;
$calcula_por=0;
$calcula_iva=0;

$busca_datostarifario="select * from app_empresa where emp_id=1";
$rs_dttarifario = $DB_gogess->executec($busca_datostarifario,array());

$lista_clientes="select * from dns_cuadrobasicomedicamentos where categ_id=2 and cuadrobm_grupo like '%".$_POST["grupo"]."%'";
$rs_clientes = $DB_gogess->executec($lista_clientes,array());
 if($rs_clientes)
 {
	  while (!$rs_clientes->EOF) {	
	  
	  $busca_existe="delete from dns_dispositivomedicoodontologia where plantrai_despachado='' and plantrai_codigo='".$rs_clientes->fields["cuadrobm_codigoatc"]."' and  odonto_enlace='".$_POST["odonto_enlace"]."'";
	  
	  //echo $busca_existe."<br>";
	  $rs_bexiste = $DB_gogess->executec($busca_existe,array());
	 
	 
	  
	  $rs_clientes->MoveNext();	
	  }
}	


//echo  $_POST["odonto_enlace"];


?>