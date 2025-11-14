
<script language="javascript">
<!--


function subir_clientes()
{

  $("#div_subir").load("../lector_xls/lectura_contactos.php",{},function(result){  
     
  });  
  $("#div_subir").html("<img src='images/barra_carga.gif' width='220' height='40' />");


}


function subir_facturas()
{

  $("#div_subir").load("../lector_xls/lector_datos.php",{},function(result){  
     
  });  
  $("#div_subir").html("<img src='images/barra_carga.gif' width='220' height='40' />");


}

//-->
</script>
<p></p>
<div align="center">
<table width="700" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><div align="center">
	<div id=div_subir >
      <input type="button" name="Submit" value="Clientes" onClick="subir_clientes()" >
	  </div>
    </div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</div>

