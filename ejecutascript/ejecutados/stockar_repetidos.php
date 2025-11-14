<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
$director='../';
include($director."cfg/clases.php");

$busca_rept="SELECT count(stock_idtbla) cuenta,stock_idtbla,centro_id,stock_tabla FROM dns_stockactual where stock_idtbla!=0 group by stock_idtbla,centro_id,stock_tabla  
ORDER BY count(stock_idtbla)  DESC";

$rs_meicam = $DB_gogess->executec($busca_rept,array());

if($rs_meicam)
	{
		while (!$rs_meicam->EOF) {
		
		if($rs_meicam->fields["cuenta"]>1)
		{
		
		echo $rs_meicam->fields["cuenta"]." --> ".$rs_meicam->fields["stock_idtbla"]." --> ".$rs_meicam->fields["centro_id"]." --> ".$rs_meicam->fields["stock_tabla"]." <br>";
		
		$busca_listar="select * from dns_stockactual where centro_id='".$rs_meicam->fields["centro_id"]."' and stock_tabla='".$rs_meicam->fields["stock_tabla"]."' and stock_idtbla='".$rs_meicam->fields["stock_idtbla"]."' order by stock_id desc limit 1 ";
		$rs_buscal = $DB_gogess->executec($busca_listar,array());
		
		
		echo $rs_buscal->fields["stock_id"]."<br>";
		
		$busrra_reoetidos="delete from dns_stockactual where centro_id='".$rs_meicam->fields["centro_id"]."' and stock_tabla='".$rs_meicam->fields["stock_tabla"]."' and stock_idtbla='".$rs_meicam->fields["stock_idtbla"]."' and stock_id!='".$rs_buscal->fields["stock_id"]."'";
		
		$rs_borrab = $DB_gogess->executec($busrra_reoetidos,array());
		
		echo $busrra_reoetidos."<br>";
		
		}
		
		$rs_meicam->MoveNext();
		}
	}	



?>