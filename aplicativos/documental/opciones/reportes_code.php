<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=144000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

include(@$director."libreria/estructura/aqualis_master.php");
for($itbl=0;$itbl<count($lista_tbldata);$itbl++)
 {
  include(@$director."libreria/estructura/".$lista_tbldata[$itbl].".php");
 } 
$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();
 if (@$table)
  {
  $objtableform->select_templateform(@$table,$DB_gogess);	
  }
$objformulario->sisfield_arr=$gogess_sisfield;
$objformulario->sistable_arr=$gogess_sistable;
$comillasimple="'";

?>
<style type="text/css">
<!--
.css_uno {
	font-size: 11px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	color: #000000;
}
.css_dos {
	font-size: 11px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}

/* standard list style table */
table.adminlist {
	background-color: #FFFFFF;
	margin: 0px;
	padding: 0px;
	border: 1px solid #ddd;
	border-spacing: 0px;
	width: 100%;
	border-collapse: collapse;
}

table.adminlist th {
	margin: 0px;
	padding: 6px 4px 2px 4px;
	height: 25px;
	background-repeat: repeat;
	font-size: 11px;
	color: #000;
}
table.adminlist th.title {
	text-align: left;
}

table.adminlist th a:link, table.adminlist th a:visited {
	color: #c64934;
	text-decoration: none;
}

table.adminlist th a:hover {
	text-decoration: underline;
}

table.adminlist tr.row0 {
	background-color: #F9F9F9;
}
table.adminlist tr.row1 {
	background-color: #FFF;
}
table.adminlist td {
	border-bottom: 1px solid #e5e5e5;
	padding: 6px 4px 2px 15px;
}
table.adminlist tr.row0:hover {
	background-color: #f1f1f1;
}
table.adminlist tr.row1:hover {
	background-color: #f1f1f1;
}
table.adminlist td.options {
	background-color: #ffffff;
	font-size: 8px;
}
select.options, input.options {
	font-size: 8px;
	font-weight: normal;
	border: 1px solid #999999;
}
/* standard form style table */
-->
</style><br /><br />
<div align="center">
<table width="500" align="center" class="adminlist" >
<tr>
 				<th align="left" bgcolor="#D2E2E3">
 					<div align="center"><strong>
					    <b> &nbsp;&nbsp;&nbsp;SELECCIONE EL TIPO DE REPORTE </b>
				    </strong>
 				      </div></th>
 			
  </tr>
<?php
$ilist=1;
$buscareporte="select * from sth_report where rept_activo=1";
   $rs_gogessform = $DB_gogess->executec($buscareporte,array());
 if($rs_gogessform)
 {
     	while (!$rs_gogessform->EOF) {
		
		$armaencrip="ireport=".$rs_gogessform->fields["rept_id"];
		$dataenc=$objformulario->encrypt($armaencrip);	
		
		if($rs_gogessform->fields["rept_archivopersonalizado"])
		{
		  $linkdinamico="aplicativos/reportes/personalizado/panel.php?".$armaencrip;
		}else
		{
		  $linkdinamico="templateformsweb/maestro_standar_report/verreporte.php?".$armaencrip;
		}
		
		$ilist++;		
            $css_fila='';
			if($ilist%2)
			{
			$css_fila='class="row0"';
			}
			else
			{
			$css_fila='class="row1"';
			}
		
	echo '<tr '.$css_fila.' >
    <td ><div class="css_dos"><a href="'.$linkdinamico.'"   target="_blank" >'.$rs_gogessform->fields["rept_nombre"].'</a> </div></td>
  </tr>';

	$rs_gogessform->MoveNext();	
	
	}
 }	
?>
</table></div><br><br><br>
