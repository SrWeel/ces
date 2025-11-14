<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
$director='../';
include($director."cfg/clases.php");


$lista_busca="select * from dns_cuadrobasicocexterno where prod_codigo='99203'";
$rs_buscasi = $DB_gogess->executec($lista_busca,array());
if($rs_buscasi)
 {
     	while (!$rs_buscasi->EOF) {
		
	  
		  $busca_idcli="select * from dns_consultaexterna where conext_enlace='".$rs_buscasi->fields["conext_enlace"]."'";
		  $rs_clie = $DB_gogess->executec($busca_idcli,array());
		  
		  if($rs_clie->fields["centro_id"]>0)
		  {
		  
		  //-------------------------------------------------
		  
		  $busca_centro="select * from dns_centrosalud where centro_id='".$rs_clie->fields["centro_id"]."'";
		  $rs_centro = $DB_gogess->executec($busca_centro,array());
		  
		  $nivel_valor=$rs_centro->fields["permif_id"];
		  
		  
		  $lista_tarifa="select prod_codigo,prod_nombre,prod_precio from efacsistema_producto where prod_nivel='".$nivel_valor."' and prod_codigo='99214'";
          $rs_tarifa = $DB_gogess->executec($lista_tarifa,array());
		  
		  echo $lista_tarifa."<br>";
		  
		  echo $rs_tarifa->fields["prod_codigo"]." -- ".$rs_tarifa->fields["prod_nombre"]." -- ".$rs_tarifa->fields["prod_precio"]."<br>";
		  
		  
		  
		  if(trim($rs_tarifa->fields["prod_codigo"]))
		  {
		  
		  $actualiza_data="update dns_cuadrobasicocexterno set prod_codigo='".trim($rs_tarifa->fields["prod_codigo"])."',prod_descripcion='".utf8_encode(trim($rs_tarifa->fields["prod_nombre"]))."',prod_precio='".trim($rs_tarifa->fields["prod_precio"])."' where cuabas_id='".$rs_buscasi->fields["cuabas_id"]."'";
		  
		  $rs_okac = $DB_gogess->executec($actualiza_data,array());
		  
		  echo $actualiza_data."<br>";
		  //{
		   //  $actualiza_data="update dns_antecedentespersonales set clie_id='".$rs_clie->fields["clie_id"]."' where antep_id=".$rs_buscasi->fields["antep_id"];
		    // $rs_acdat = $DB_gogess->executec($actualiza_data,array());
			 //echo $actualiza_data."<br>";
		  }
		   
		  //-------------------------------------------------
		  
		  } 
		  
		  
		
		$rs_buscasi->MoveNext();
		}
  }		
?>