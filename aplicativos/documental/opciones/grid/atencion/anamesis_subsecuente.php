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

echo '<table border="1" cellpadding="0" cellspacing="0" align="center" >';

echo '<tr>
			<td bgcolor="#B6D5DE" ><b>Hiatoria Cl&iacute;nica</b></td>
			<td bgcolor="#B6D5DE" ><b>Fecha</b></td>
			<td bgcolor="#B6D5DE" ><b>Hora</b></td>
			<td bgcolor="#B6D5DE" ><b>Notas de Evoluci&oacute;n</b></td>
			<td bgcolor="#B6D5DE" ><b>Prescripciones</b></td>
		  </tr>';


$lista_tablaspop="select * from dns_consultaexterna where anam_id='".$_POST["pVar1"]."'";
$rs_tablastop = $DB_gogess->executec($lista_tablaspop,array());

if($rs_tablastop)
	{
		while (!$rs_tablastop->EOF) {
		
				
		 echo '<tr>
			<td>'.$rs_tablastop->fields["conext_hc"].'</td>
			<td>'.$rs_tablastop->fields["conext_fechar"].'</td>
			<td>'.$rs_tablastop->fields["conext_horar"].'</td>
			<td>'.$rs_tablastop->fields["conext_notasdeevolucion"].'</td>
			<td>'.$rs_tablastop->fields["conext_prescripciones"].'</td>
		  </tr>';
		
		 $rs_tablastop->MoveNext();
		}
	}	



}

echo '</table>';

?>
