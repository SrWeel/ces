<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");


$busca_terapia="select * from faesa_terapiasregistro";
$rs_terapia = $DB_gogess->executec($busca_terapia,array());

				$cuenta=0;
				if($rs_terapia)
                   {

	                  while (!$rs_terapia->EOF) {	
					  
					 //clie_id
					  
					   $nombre_cliente="select * from app_cliente where clie_id=".$rs_terapia->fields["clie_id"];
					   $rs_centrocliente = $DB_gogess->executec($nombre_cliente,array());
					  
					     echo $rs_terapia->fields["terap_id"]." - ".$rs_terapia->fields["atenc_hc"]." - ".$rs_terapia->fields["centro_id"]." - ".$rs_centrocliente->fields["centro_id"]."<br>";
						 
						 //$actualiza="update  faesa_terapiasregistro set centro_id=".$rs_centrocliente->fields["centro_id"]." where terap_id=".$rs_terapia->fields["terap_id"];
						 //$rs_act = $DB_gogess->executec($actualiza,array());
					  
					    $rs_terapia->MoveNext();
					  }
				  }	  

?>