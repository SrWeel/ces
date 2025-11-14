<table width="100" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><strong>Motivo</strong></td>
    <td colspan="2"><input name="motivo_an" type="text" id="motivo_an" size="30"></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td><div align="center">
    <input type="button" name="Button" value="Anular" onClick="anular_registro()">  
    </div></td>
    <td>&nbsp;</td>
    <td>
 <input type="button" name="Button2" value="Quitar Anulado" onClick="qanular_registro()"> 
	
	</td>
  </tr>
</table>

<div id="grid_anu" ></div>

<script type="text/javascript">
<!--

function anular_registro()
{



if (confirm("Esta seguro que desea anular esta factura?"))
{ 


   $("#grid_anu").load("templateformsweb/maestro_standar_compras/xmlpdf/anular.php",{

    compretcab_id:'<?php echo $_POST["pVar1"]; ?>',
	motivo_an:$('#motivo_an').val()

  },function(result){  

   lista_retencion();

  });  

  $("#grid_anu").html("Espere un momento...");  


}




}



function qanular_registro()
{



if (confirm("Esta seguro que desea quitar la anulacion?"))
{ 


   $("#grid_anu").load("templateformsweb/maestro_standar_compras/xmlpdf/qanular.php",{

    compretcab_id:'<?php echo $_POST["pVar1"]; ?>',
	motivo_an:$('#motivo_an').val()

  },function(result){  


    lista_retencion();

  });  

  $("#grid_anu").html("Espere un momento...");  


}




}

//  End -->
</script>
