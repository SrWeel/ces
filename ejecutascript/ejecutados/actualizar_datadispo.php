<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
$director='../';
include($director."cfg/clases.php");

$lista_medicamentosinv="select count(*) as total from dns_cuadrobasicomedicamentos where categ_id=2";
$rs_meicam = $DB_gogess->executec($lista_medicamentosinv,array());
echo "Total:".$rs_meicam->fields["total"]."<br>";

$lista_medicamentosinv="select count(*) as total2 from dns_cuadrobasicomedicamentos where categ_id=2 and cuadrobm_preciodispositivo>0";
$rs_meicam = $DB_gogess->executec($lista_medicamentosinv,array());
echo "Total:".$rs_meicam->fields["total2"]."<br>";


$lista_medicamentosinv="select * from dns_cuadrobasicomedicamentos where categ_id=2 and cuadrobm_preciodispositivo>0";
$rs_meicam = $DB_gogess->executec($lista_medicamentosinv,array());
if($rs_meicam)
	{
		while (!$rs_meicam->EOF) {
		
		    $precioiva=0;
			$precioiva=($rs_meicam->fields["cuadrobm_preciodispositivo"] * 12)/100;
			
			
			$preciotechoadm=0;			
			$preciotechoadm=($rs_meicam->fields["cuadrobm_preciodispositivo"] * 10)/100;
			
			$precioventa=0;
			$precioventa=$preciotechoadm+$precioiva+$rs_meicam->fields["cuadrobm_preciodispositivo"];
			
			
			
			echo $rs_meicam->fields["cuadrobm_codigoatc"]." --> <b>Precio Compra:</b> ".$rs_meicam->fields["cuadrobm_preciodispositivo"]." -- <b>Precio Planilla:</b>".$precioventa."  <br>";
			
			
			$act_precios="update dns_cuadrobasicomedicamentos set cuadrobm_valorplanilladispositivos='".$precioventa."' where cuadrobm_codigoatc='".$rs_meicam->fields["cuadrobm_codigoatc"]."'";
			$rs_setprecios = $DB_gogess->executec($act_precios,array());
			
			
		
		//cuadrobm_preciotechomenosporcentaje
		//cuadrobm_valorplanilla
		
		$rs_meicam->MoveNext();
		}
	}	

?>