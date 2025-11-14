<script language="javascript">
<!--

function vaciar_automatico(archivo,auto_id)
{
   if (confirm("Esta seguro que desea vaciar esta carga?"))
	 { 
	   
  $("#div_vaciar_automatico").load("aplications/usuario/opciones/extras/automatico/vaciar_automatico.php",{parchivo:archivo,pauto_id:auto_id},function(result){  
    grid_automatico($("#auto_id").val());
	
  });  
  $("#div_vaciar_automatico").html("<img src='images/barra_carga.gif' width='220' height='40' />");
	   
	} 

}

function ejecutar_automatico()
{

  $("#div_automatico").load("automatico/ejecutar.php",{},function(result){  
     
	 grid_automatico($('#auto_id').val());
  });  
  $("#div_automatico").html("<img src='images/barra_carga.gif' width='220' height='40' />");

}

function grid_automatico(auto_id)
{

  $("#div_listaautomatico").load("aplications/usuario/opciones/extras/automatico/grid/grid.php",{pauto_id:auto_id,cd_aut:$('#cd_aut').val()},function(result){  
     
	 
	 
  });  
  $("#div_listaautomatico").html("<img src='images/barra_carga.gif' width='220' height='40' />");

}


function firmar_documentos(archivo,nlotes,cantidapl,estado,clvfirma,tipo,cargaid)
{


if($("#clave_firma_v").val()=="")
{
 alert("Ingrese la clave para la firma...");
 return false;
}

//alert(cargaid);
  $("#div_firmar").load("aplications/usuario/opciones/extras/automatico/firmando.php",{parchivo:archivo,pnlotes:nlotes,pcantidapl:cantidapl,pclvfirma:$("#clave_firma_v").val(),ptipo:tipo,pcargaid:cargaid},function(result){  
    
	grid_automatico($('#auto_id').val());
	
  });  
  $("#div_firmar").html("<img src='images/barra_carga.gif' width='220' height='40' />");


}



function lista_sri()
{

  $("#div_listasriaut").load("aplications/usuario/opciones/extras/automatico/sri_factura.php",{},function(result){  
     auto_id:$('#auto_id').val(),cd_aut:$('#cd_aut').val()
  });  
  $("#div_listasriaut").html("<img src='images/barra_carga.gif' width='220' height='40' />");


}

//-->
</script>
<style type="text/css">
<!--
.Estilo1 {	font-size: 11px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
}
.TableScroll {
        z-index:99;
		width:680px;
        height:250px;	
        overflow: auto;
      }
	  
-->
</style>


<table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="498" valign="top"><div align="center">
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td onclick="ejecutar_automatico()"><img src="images/subir_comprobante.png" width="128" height="128"></td>
  </tr>
</table>

<div id=div_automatico ></div>


<table width="400" border="0" align="center" cellpadding="5" cellspacing="2">
  <tr>
    <td width="341" bgcolor="#CBDFE7"><div align="center" class="Estilo1">OPCIONES DE CARGA </div></td>
    </tr>
  <tr>
    <td valign="top" bgcolor="#F7F9F9"><div align="center">
      <select name="auto_id" id="auto_id">
        <option value="0">--Seleccionar--</option>
        <?php
	   $selecTabla="select * from kyradm_automatico where auto_activo='1'";   
  
		  $rs_gogessform = $DB_gogess->Execute($selecTabla);
		  if($rs_gogessform)
		  {
				while (!$rs_gogessform->EOF) {	
				
				echo '<option value="'.$rs_gogessform->fields["auto_id"].'">'.$rs_gogessform->fields["auto_titulo"].'</option>';
				
				$rs_gogessform->MoveNext();	   
				}
		  }		
	  ?>
      </select>
      <label for="cd_aut"></label>
      <select name="cd_aut" id="cd_aut">
        <option value="" selected="selected">PENDIENTE</option>
        <option value="AUTORIZADO">AUTORIZADO</option>
      </select>
      <input type="button" name="Submit" value="Activar automatico" onclick="lista_sri()">
    </div></td>
  </tr>
  <tr>
    <td valign="top"><p class="Estilo1">Lista Lotes Cargados </p>
	<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td>Clave firma:</td>
    <td>  <input name="clave_firma_v" type="password" id="clave_firma_v" value="" size="15" /></td>
  </tr>
</table>
	
	<div id=div_vaciar_automatico></div>
	<div class="TableScroll">  
        <div id=div_listaautomatico ></div>
		</div>
		<div id=div_firmar ></div></td>
  </tr>
</table>
</div></td>
    <td width="402" valign="top">
	
	<div id=div_listasriaut >	</div>
	
	
	</td>
  </tr>
</table>
<br><br>


