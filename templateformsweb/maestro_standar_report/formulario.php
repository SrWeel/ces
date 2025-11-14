<style type="text/css">
<!--
.titulo_suscripcion {font-size: 13px; font-family: Arial, Verdana; font-weight: bold; }
.espacio_css {
	font-size: 7px;
	font-family: Arial, Helvetica, sans-serif;
}
-->
</style>
<script language="javascript">
<!--
function lista_tablas()
{
  $("#div_listat").load("templateforms/maestro_standar_report/listat.php",{},function(result){  
    
  });  
  $("#div_listat").html("Espere un momento...");

}

function lista_campos()
{

  $("#div_listac").load("templateforms/maestro_standar_report/listac.php",{ltablas:$('#ltablas').val()},function(result){  
    
	
  });  
  $("#div_listac").html("Espere un momento...");

}

function agrega_campos()
{
   
    if($('#lcampos').val()==null)
	{
	  alert("Por favor seleccione el campo");
	  return false;
	}
	
	if($('#rept_id').val()=='')
	{
	  alert("Por favor guarde el registro para continuar con el proceso...");
	  return false;
	
	}
	
    $("#div_listaag").load("templateforms/maestro_standar_report/listaag.php",{ltablas:$('#ltablas').val(),lcampos:$('#lcampos').val(),rept_id:$('#rept_id').val()},function(result){  
    
	 ver_enlace();
	
     });  
    $("#div_listaag").html("Espere un momento...");

}

function quitar_campos()
{

    if($('#listaag').val()==null)
	{
	  alert("Seleccione el campo a quitar");
	  return false;
	}
	
  
    $("#div_listaag").load("templateforms/maestro_standar_report/listaag.php",{listaag:$('#listaag').val(),rept_id:$('#rept_id').val()},function(result){  
    
	 ver_enlace();
	
     });  
    $("#div_listaag").html("Espere un momento...");
}

function ver_reporte(irep)
{
   myWindow3=window.open('templateforms/maestro_standar_report/verreporte.php?ireport='+irep,'ventana_reporte','width=750,height=500,scrollbars=YES');
   myWindow3.focus();

}

function ver_enlace()
{
	
	
	$("#listEnlace").load("templateforms/maestro_standar_report/listenlace.php",{rept_id:$('#rept_id').val()},function(result){  
    
     });  
    $("#listEnlace").html("Espere un momento...");
	
}


function ver_actualizacampos(idcampo)
{
	
	
	$("#actualizaCampo").load("templateforms/maestro_standar_report/actualizaCampo.php",{rptenlc_id:idcampo,campoa:$('#campoa_' + idcampo).val(),campob:$('#campob_'+idcampo).val()},function(result){  
    
     });  
    $("#actualizaCampo").html("Espere un momento...");
	
}

//-->
</script>	
<div id=div_<?php echo $table ?>></div>
<form id="form_<?php echo $table; ?>" name="form_<?php echo $table; ?>" method="post" action="">
<table border="0" cellpadding="0" cellspacing="3">
  <tr>
    <td><?php $grafico=$objtemplate->path_template."images/new.png";
echo $objopciones_botones->vista_opciones('nuevo',@$objacceso_session,@$grafico,@$table,@$tableant1,@$tableant,@$campoant,@$listab,@$campo,@$obp,@$fimp); ?></td>
    <td><?php $grafico=$objtemplate->path_template."images/save.png";
echo $objopciones_botones->vista_opciones('guardar',@$objacceso_session,@$grafico,@$table,@$tableant1,@$tableant,@$campoant,@$listab,@$campo,@$obp,@$fimp); ?></td>
    <td><?php $grafico=$objtemplate->path_template."images/del.png";
echo $objopciones_botones->vista_opciones('borrar',@$objacceso_session,@$grafico,@$table,@$tableant1,@$tableant,@$campoant,@$listab,@$campo,@$obp,@$fimp); ?></td>
    <td><?php $grafico=$objtemplate->path_template."images/search.png";
echo $objopciones_botones->vista_opciones('buscar',@$objacceso_session,@$grafico,@$table,@$tableant1,@$tableant,@$campoant,@$listab,@$campo,@$obp,@$fimp); ?></td>
    <td><?php $grafico=$objtemplate->path_template."images/print.png";
echo $objopciones_botones->vista_opciones('imprimir',@$objacceso_session,@$grafico,@$table,@$tableant1,@$tableant,@$campoant,@$listab,@$campo,@$obp,@$fimp); ?></td>
   
  </tr>
</table>
<table width="700" border="0" align="center" cellpadding="0" cellspacing="2" bgcolor="#FFFFFF">
  
  <tr>
    <td colspan="2"><span class="espacio_css">&nbsp;</span>      <div align="center">
        <?php
	 
		    $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");	
			@$objformulario->sendvar["id_empresax"]=$id_empresa_val;	
            $objformulario->sendvar["horax"]=date("H:i:s");
			$objformulario->sendvar["sisu_idx"]=$_SESSION['sessidadm_frank'];
			
			//aleatorio busqueda
			 $valoralet=mt_rand(1,500);
			@$aletorioid=$_SESSION['ces1313777_sessid_cedula'].date("Ymdhis").$valoralet;
			 @$objformulario->sendvar["rept_aleatunicox"]=$aletorioid;
			//aleatorio busqueda
			
			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['sessidadm_frank'];
			
			 
$objformulario->generar_formulario(@$submit,@$table,@$atributos,@$ancho,@$varsend,@$sessid,1,$DB_gogess);  
?>
      </div></td>
  </tr>
  
  <tr>
    <td colspan="2" valign="top">
	
	<div id=div_panelprint >
	<table width="100%" border="0" cellpadding="2" cellspacing="1">
      <tr>
        <td bgcolor="#E4F1EE">Reporte standar </td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellpadding="0" cellspacing="2">
            
            <tr>
              <td valign="top"><input type="button" name="Submit" value="Ver tablas" onclick="lista_tablas()" /></td>
              <td valign="top">&nbsp;</td>
              <td valign="top">&nbsp;</td>
              <td valign="top">&nbsp;</td>
            </tr>
            <tr>
              <td width="227" valign="top">
			   <div id=div_listat >
			   <select name="ltablas" size="10" id="ltablas">
                </select>
				</div>                </td>
              <td width="185" valign="top">
			  <div id=div_listac >
			  <select name="lcampos" size="10" id="lcampos">
              </select>
			  </div>
              </td>
              <td width="80" valign="top"><input type="button" name="Submit2" value="Agregar" onclick="agrega_campos()" />
                <br />
                <input type="button" name="Submit3" value="Quitar" onclick="quitar_campos()" /></td>
              <td width="292" valign="top">
			  <div id=div_listaag >
			  <?php
			  $list_data="select * from sth_reportdetalle where rept_id=".$objformulario->contenid["rept_id"];
              $resultlistat = $DB_gogess->Execute($list_data);
			  ?>
			  <select name="listaag" size="10" id="listaag">
			  <?php
					if($resultlistat)
					{  
					  while (!$resultlistat->EOF) {
					  
					  $nombretabla=$objformulario->replace_cmb("gogess_sistable","tab_name,tab_title","where tab_name like ",$resultlistat->fields["reptdet_tabla"],$DB_gogess);
					  
					  $nombrecampo=str_replace(":","",$objformulario->replace_cmb("gogess_sisfield","fie_name,fie_title","where tab_name ='".$resultlistat->fields["reptdet_tabla"]."' and fie_name like ",$resultlistat->fields["reptdet_campo"],$DB_gogess));
					  
					  echo '<option value="'.$resultlistat->fields["reptdet_id"].'">'.$nombretabla." -- ".$nombrecampo.'</option>';
					  
					  $resultlistat->MoveNext();
					  }
					 } 
				
				?>
              </select>
			  </div>
              </td>
            </tr>
        </table>
          <table width="700" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td>
              <div id="actualizaCampo" ></div>
              <div id="listEnlace" >&nbsp;</div></td>
            </tr>
          </table>
          <br />
          <table border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td onclick="ver_reporte($('#rept_id').val())" style="cursor:pointer"><img src="<?php echo $objtableform->path_templateform ?>images/verreporte.png" width="115" height="34" /></td>
            </tr>
          </table>
          </td>
      </tr>
    </table>
	</div>
	
	&nbsp;</td>
  </tr>
</table>
<?php       
if(@$csearch)
{
 $valoropcion='actualizar';
}
else
{
 $valoropcion='guardar';
}

echo "<input name='csearch' type='hidden' value=''>
<input name='idab' type='hidden' value=''>
<input name='opcion_".$table."' type='hidden' value='".$valoropcion."' id='opcion_".$table."' >
<input name='table' type='hidden' value='".$table."'>";

?>
<table border="0" cellpadding="0" cellspacing="3">
  <tr>
    <td><?php $grafico=$objtemplate->path_template."images/new.png";
echo $objopciones_botones->vista_opciones('nuevo',@$objacceso_session,@$grafico,@$table,@$tableant1,@$tableant,@$campoant,@$listab,@$campo,@$obp,@$fimp); ?></td>
    <td><?php $grafico=$objtemplate->path_template."images/save.png";
echo $objopciones_botones->vista_opciones('guardar',@$objacceso_session,@$grafico,@$table,@$tableant1,@$tableant,@$campoant,@$listab,@$campo,@$obp,@$fimp); ?></td>
    <td><?php $grafico=$objtemplate->path_template."images/del.png";
echo $objopciones_botones->vista_opciones('borrar',@$objacceso_session,@$grafico,@$table,@$tableant1,@$tableant,@$campoant,@$listab,@$campo,@$obp,@$fimp); ?></td>
    <td><?php $grafico=$objtemplate->path_template."images/search.png";
echo $objopciones_botones->vista_opciones('buscar',@$objacceso_session,@$grafico,@$table,@$tableant1,@$tableant,@$campoant,@$listab,@$campo,@$obp,@$fimp); ?></td>
    <td><?php $grafico=$objtemplate->path_template."images/print.png";
echo $objopciones_botones->vista_opciones('imprimir',@$objacceso_session,@$grafico,@$table,@$tableant1,@$tableant,@$campoant,@$listab,@$campo,@$obp,@$fimp); ?></td>
   
  </tr>
</table>
</form>



<script language="javascript">
<!--

 ver_enlace();
//-->
</script>
