<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
$director='../';
include($director."cfg/clases.php");


$lista_busca="select * from dns_antecedentesfamiliares";
$rs_buscasi = $DB_gogess->executec($lista_busca,array());
if($rs_buscasi)
 {
     	while (!$rs_buscasi->EOF) {
		
	  
		  $busca_idcli="select * from dns_anamesisexamenfisico where anam_enlace='".$rs_buscasi->fields["anam_enlace"]."'";
		  $rs_clie = $DB_gogess->executec($busca_idcli,array());
		  
		  if($rs_clie->fields["clie_id"])
		  {
		     $actualiza_data="update dns_antecedentesfamiliares set clie_id='".$rs_clie->fields["clie_id"]."' where antef_id=".$rs_buscasi->fields["antef_id"];
		     $rs_acdat = $DB_gogess->executec($actualiza_data,array());
			 //echo $actualiza_data."<br>";
		  }
		   
		  
		  
		
		$rs_buscasi->MoveNext();
		}
  }		
?>