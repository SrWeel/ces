<script type="text/javascript">
<!--

function desplegar_grid()
{
   $("#grid_fact1").load("../lector_xls/lector_datos.php",{

  },function(result){  

  });  
  $("#grid_fact1").html("<img src='images/barra_carga.gif' width='220' height='40' />");  

}

//  End -->
</script>

<p>&nbsp;</p>
<div align="center">
<table width="800" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="99" valign="top"><div id="grid_fact1" ><center><input type="button" name="Submit" value="Subir Facturas" onClick="desplegar_grid()" ></center></div></td>
 
  </tr>
</table>
</div>
