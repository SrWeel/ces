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
	  
	  $busca_existe="select plantrai_id from dns_dispositivosodontologia where plantrai_codigo='".$rs_clientes->fields["cuadrobm_codigoatc"]."' and  subsecodont_enlace='".$_POST["subsecodont_enlace"]."'";
	  $rs_bexiste = $DB_gogess->executec($busca_existe,array());
	  
	  
	  
	  if(!($rs_bexiste->fields["plantrai_id"]))
	  {
	     $cuadrobm_codigoatc=$rs_clientes->fields["cuadrobm_codigoatc"];
	     $cuadrobm_nombredispositivo=$rs_clientes->fields["cuadrobm_nombredispositivo"];
	     $cuadrobm_preciodispositivo=$rs_clientes->fields["cuadrobm_preciodispositivo"];
		
		 
		 $calcula_por=($rs_clientes->fields["cuadrobm_preciodispositivo"]*$rs_dttarifario->fields["emp_valorgastosadm"])/100;
         $calcula_iva=($rs_clientes->fields["cuadrobm_preciodispositivo"]*$rs_dttarifario->fields["emp_valoriva"])/100;
		 
		 $plantra_valorplanillax=$rs_clientes->fields["cuadrobm_preciodispositivo"]+$calcula_por+$calcula_iva;
		 
		 
		  $inserta_valor="insert into dns_dispositivosodontologia (plantrai_codigo,plantrai_nombredispositivo,plantrai_precio,plantrai_cantidad,plantrai_indicaciones,plantrai_preciocompra,plantrai_porcentajeadm,plantrai_porcentajeiva,plantrai_valorplanilla,subsecodont_enlace,plantrai_fecharegistro,usua_id) values ('".$cuadrobm_codigoatc."','".$cuadrobm_nombredispositivo."','".$rs_clientes->fields["cuadrobm_preciodispositivo"]."','1','CONSULTA-".$_POST["grupo"]."','".$cuadrobm_preciodispositivo."','".$rs_dttarifario->fields["emp_valorgastosadm"]."','".$rs_dttarifario->fields["emp_valoriva"]."','".$plantra_valorplanillax."','".$_POST["subsecodont_enlace"]."','".date("Y-m-d H:i:s")."','".$_SESSION['ces1313777_sessid_inicio']."')";
		  
		  $rs_okins = $DB_gogess->executec($inserta_valor,array());
		  
		 // echo $inserta_valor."<br>";
	  
	  }
	  
	 
	 
	  
	  $rs_clientes->MoveNext();	
	  }
}	


//echo  $_POST["subsecodont_enlace"];


?>