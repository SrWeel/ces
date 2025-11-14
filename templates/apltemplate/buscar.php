<link href="styles/formato.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="borde">
  <tr> 
    <td width="82">&nbsp; 
    </td>
    <td width="616">
      <?php
		     $objcontenido->desplegar_tema("histo");
		  ?>
    </td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="2" cellpadding="2">
<tr>
    <td bgcolor="#B6D8E9" class="titulohome">Resultado </td>
  </tr>
      <?php	  
	  	$sql = "SELECT * FROM kyradm_contenido where codigob like '%$buscar%' or con_contenido like '%$buscar%' or con_detalle like '%$buscar%'";
 		$result = mysql_query($sql);   
	 	while($row = mysql_fetch_array($result))
		{		
			printf ("<tr><td class='txtb'><p><span class='tituloar'>%s</span><br>",$row[con_titulo]);
            printf ("<span class='texto'>%s</span><br>",$row[con_detalle]);
            printf ("<a href='index.php?secc=1&ar=%s&tema=%s&con_pag=%s&seccionp=%s&sessid=%s&system=%s' class=linkart><b>Ver artículo...</b></a></p>",$row[con_id],$row[con_tema],$row[con_pag],$row[secp_id],$sessid,$system);
            printf ("</td></tr>");
		}	
		mysql_free_result ($result);
		
	  ?>
</table>
<p class="titulob">&nbsp;</p>
