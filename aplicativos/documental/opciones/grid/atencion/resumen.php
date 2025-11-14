<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=444456000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if(@$_SESSION['ces1313777_sessid_inicio'])
{
$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");

echo '<table border="1" cellpadding="0" cellspacing="0">';

$lista_aten="select * from dns_atencion where atenc_id='".$_POST["pVar1"]."'";
$rs_taten = $DB_gogess->executec($lista_aten,array());


$lista_tablaspop="select * from gogess_sistable where tab_sysmedico=1";
$rs_tablastop = $DB_gogess->executec($lista_tablaspop,array());

if($rs_tablastop)
	{
		while (!$rs_tablastop->EOF) {
		
		$busca_hc="select fie_name  from  gogess_sisfield where tab_name='".$rs_tablastop->fields["tab_name"]."' and fie_group=44";
		$rs_hc = $DB_gogess->executec($busca_hc,array());
		
		//echo $rs_tablastop->fields["tab_title"]."<br>";
		$busca_registros="select count(*) as total from ".$rs_tablastop->fields["tab_name"]." where ".$rs_hc->fields["fie_name"]."='".$rs_taten->fields["atenc_hc"]."' limit 1";
		$rs_reg = $DB_gogess->executec($busca_registros,array());
		
		
		$imagen_check='';
		
		if($rs_reg->fields["total"]>0)
		{
		  $imagen_check='<img src="images/check.jpg" width="40" height="37">';
		}
		
		
		 echo '<tr>
			<td>'.utf8_encode($rs_tablastop->fields["tab_title"]).'</td>
			<td>'.$imagen_check.'</td>
		  </tr>';
		
		 $rs_tablastop->MoveNext();
		}
	}	



}

echo '</table>';

?>
