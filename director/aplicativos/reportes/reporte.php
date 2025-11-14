<style type="text/css">
<!--
.Estilo1 {
	font-size: 11px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
}
.Estilo2 {
	font-size: 11px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
-->
</style><br /><br />
<table width="700" border="0" align="center" cellpadding="0" cellspacing="2">
<?php
$buscareporte="select * from sth_report where rept_activo=1";
   $rs_gogessform = $DB_gogess->Execute($buscareporte);
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
		  $linkdinamico="templateforms/maestro_standar_report/verreporte.php?".$armaencrip;
		}
	echo '<tr>
    <td bgcolor="#DAE3E7"><div align="center" class="Estilo1">'.$rs_gogessform->fields["rept_nombre"].'</div></td>
    <td bgcolor="#DAE3E7"><div align="center" class="Estilo2"><a href="'.$linkdinamico.'"   target="_blank" >ver reporte</a> </div></td>
  </tr>';
	
	
	$rs_gogessform->MoveNext();	
	
	}
 }	
?>

  
</table>
