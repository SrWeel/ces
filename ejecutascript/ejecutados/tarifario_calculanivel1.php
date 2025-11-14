<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
$director='../';
include($director."cfg/clases.php");



//verifica valor primer nivel menos 10%

$lista_actualiza="select * from cesdb_arextension.dns_tarifariomigrar where 	tarif_valor1=0";
$rslac = $DB_gogess->executec($lista_actualiza,array());
if($rslac)
	{
		while (!$rslac->EOF) {
		
		  $valordiez=($rslac->fields["tarif_valor2"]*10)/100;
		  $valor_nivel1=$rslac->fields["tarif_valor2"]-$valordiez;
		  
		  
		  $actualiza="update cesdb_arextension.dns_tarifariomigrar set tarif_sinvalorac='1',tarif_valor1='".number_format($valor_nivel1, 2, '.', '')."' where tarif_id='".$rslac->fields["tarif_id"]."'";
		  $rsac_data = $DB_gogess->executec($actualiza,array());
		  
		  
		
		$rslac->MoveNext();
		}
	}	
		


?>