<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
$director='../';
include($director."cfg/clases.php");

$lista_medicamentosinv="select count(*) as total from dns_cuadrobasicomedicamentos where categ_id=1";
$rs_meicam = $DB_gogess->executec($lista_medicamentosinv,array());
echo "Total:".$rs_meicam->fields["total"]."<br>";

$lista_medicamentosinv="select count(*) as total2 from dns_cuadrobasicomedicamentos where categ_id=1 and cuadrobm_preciomedicamento>0";
$rs_meicam = $DB_gogess->executec($lista_medicamentosinv,array());
echo "Total:".$rs_meicam->fields["total2"]."<br>";


$lista_medicamentosinv="select * from dns_cuadrobasicomedicamentos where categ_id=1 and cuadrobm_preciomedicamento>0";
$rs_meicam = $DB_gogess->executec($lista_medicamentosinv,array());
if($rs_meicam)
	{
		while (!$rs_meicam->EOF) {
		
		//echo "Total:".$rs_meicam->fields["total2"];
		//cuadrobm_preciomedicamento
		$preciotechosin6=0;
		$preciotechoreal=0;
		if($rs_meicam->fields["cuadrobm_preciotecho"]>0)
		{
		
		    $seisporciento=($rs_meicam->fields["cuadrobm_preciotecho"] * 6.5)/100;
			$preciotechoreal=$rs_meicam->fields["cuadrobm_preciotecho"]-$seisporciento;
			
			$preciotechoreal = number_format($preciotechoreal, 6, '.', '');
			
			$ve_data='';
			if(!($preciotechoreal==$rs_meicam->fields["cuadrobm_preciotechomenosporcentaje"]))
			{
			   $ve_data=' Error ';
			}
			
			
			
			$preciotechoadm=0;			
			$preciotechoadm=($rs_meicam->fields["cuadrobm_preciomedicamento"] * 10)/100;
			
			$precioventa=0;
			$precioventa=$preciotechoadm+$rs_meicam->fields["cuadrobm_preciomedicamento"];
			
			$alerta_pasa='';
			if($preciotechoreal<$precioventa)
			{
			 $alerta_pasa='Pasa P.techo...';
			}
			
			echo $rs_meicam->fields["cuadrobm_codigoatc"]." --> <b>P.Techo:</b> ".$preciotechoreal." -- <b>Registrado:</b>".$rs_meicam->fields["cuadrobm_preciotechomenosporcentaje"]." ".$ve_data." <b>Precio Compra:</b>".$rs_meicam->fields["cuadrobm_preciomedicamento"]." <b>Precio Planilla:</b> ".$precioventa." ".$alerta_pasa." <br>";
			
			
			$act_precios="update dns_cuadrobasicomedicamentos set cuadrobm_preciotechomenosporcentaje='".$preciotechoreal."',cuadrobm_valorplanilla='".$precioventa."' where cuadrobm_codigoatc='".$rs_meicam->fields["cuadrobm_codigoatc"]."'";
			$rs_setprecios = $DB_gogess->executec($act_precios,array());
			
			
			
			
			
		}
		else
		{
		
		  echo "Alerta: ".$rs_meicam->fields["cuadrobm_codigoatc"]." no tiene precio techo<br>";
		}
		//cuadrobm_preciotechomenosporcentaje
		//cuadrobm_valorplanilla
		
		$rs_meicam->MoveNext();
		}
	}	


?>