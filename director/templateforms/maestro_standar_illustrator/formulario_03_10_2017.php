<style type="text/css">
<!--
.titulo_suscripcion {font-size: 13px; font-family: Arial, Verdana; font-weight: bold; }
.espacio_css {
	font-size: 7px;
	font-family: Arial, Helvetica, sans-serif;
}
.borde_tabla{ 

border:solid; 
border-width:1px;
border-color:#000;
text-align:center;
	
	
}

.texto-vertical-2{
    writing-mode: vertical-lr;
    transform: rotate(180deg);
	}
-->
</style>
<script language="javascript">
<!--
function lista_tablas()
{
  $("#div_listat").load("templateforms/maestro_standar_illustrator/listat.php",{},function(result){  
    
  });  
  $("#div_listat").html("Wait a moment...");

}

function lista_campos()
{

  $("#div_listac").load("templateforms/maestro_standar_illustrator/listac.php",{ltablas:$('#ltablas').val()},function(result){  
    
	
  });  
  $("#div_listac").html("Wait a moment...");

}

function agrega_campos()
{
   
    if($('#lcampos').val()==null)
	{
	  alert("Por favor seleccione el campo");
	  return false;
	}
	
	if($('#vardev_id').val()=='')
	{
	  alert("Por favor guarde el registro para continuar con el proceso...");
	  return false;
	
	}
	
    $("#div_listaag").load("templateforms/maestro_standar_illustrator/listaag.php",{ltablas:$('#ltablas').val(),lcampos:$('#lcampos').val(),vardev_id:$('#vardev_id').val()},function(result){  
    
	
	
     });  
    $("#div_listaag").html("Wait a moment...");

}

function quitar_campos()
{

    if($('#listaag').val()==null)
	{
	  alert("Seleccione el campo a quitar");
	  return false;
	}
	
  
    $("#div_listaag").load("templateforms/maestro_standar_illustrator/listaag.php",{listaag:$('#listaag').val(),vardev_id:$('#vardev_id').val()},function(result){  
    
	 
	
     });  
    $("#div_listaag").html("Wait a moment...");
}

function ver_reporte(irep)
{
   myWindow3=window.open('templateforms/maestro_standar_illustrator/verreporte.php?ireport='+irep,'ventana_reporte','width=750,height=500,scrollbars=YES');
   myWindow3.focus();

}


function ver_actualizacampos(idcampo)
{
	
	
	$("#actualizaCampo").load("templateforms/maestro_standar_illustrator/actualizaCampo.php",{rptenlc_id:idcampo,campoa:$('#campoa_' + idcampo).val(),campob:$('#campob_'+idcampo).val()},function(result){  
    
     });  
    $("#actualizaCampo").html("Wait a moment...");
	
}

function panel_oper()
{
//alert("Holas");
abrir_pantalla("templateforms/maestro_standar_illustrator/operation.php","OPERACION","divBody_op","divDialog_op",600,300,$('#vardev_id').val(),0,0,0,0,0,1);

}

function agregar_campo_op()
{
  if($('#nfield').val()=='')
  {
	  alert("Fill in the title field");
	  return false;
  }
  
  
  $("#guardar_campo").load("templateforms/maestro_standar_illustrator/guardar_op.php",{
	  
	  vardev_id:$('#vardev_id').val(),
	  textarea_op:$('#textarea_op').val(),
	  nfield:$('#nfield').val()
  
  },function(result){  
        listar_ag();
     });  
    $("#guardar_campo").html("Wait a moment...");

}




function listar_ag()
{
	 $("#div_listaag").load("templateforms/maestro_standar_illustrator/listaop.php",{
		 
		 ltablas:$('#ltablas').val(),lcampos:$('#lcampos').val(),vardev_id:$('#vardev_id').val()
	 
	 },function(result){  
    
	 ver_enlace();
	
     });  
    $("#div_listaag").html("Wait a moment...");
	
}

function editar_op()
{
	var dato_val=$('#listaag option:selected').html();
	
	var res_valor = dato_val.split("--");
	
	if(res_valor[0].trim()=='Operation')
	{
	abrir_pantalla("templateforms/maestro_standar_illustrator/operation.php","OPERACION","divBody_op","divDialog_op",600,300,$('#vardev_id').val(),$('#listaag').val(),0,0,0,0,2);
	}
	
}

function agrega_camposX()
{
	
	if($('#lcampos').val()==null)
	{
	  alert("Por favor seleccione el campo");
	  return false;
	}
	if($('#varillu_id').val()=='')
	{
	  alert("Por favor guarde el registro para continuar con el proceso...");
	  return false;
	
	}
	
	var dato_val=$('#lcampos option:selected').html();
	var id_val=$('#lcampos option:selected').val();
	
	$('#x_campo').html(dato_val);
	$('#x_campo_id').val(id_val);
	
}


function agrega_groupX()
{
   if($('#lcampos').val()==null)
	{
	  alert("Por favor seleccione el campo");
	  return false;
	}
	if($('#varillu_id').val()=='')
	{
	  alert("Por favor guarde el registro para continuar con el proceso...");
	  return false;
	
	}
	
	var dato_val=$('#x_group').html();
	var id_val=$('#x_group_id').val();
	
	dato_val=dato_val+$('#lcampos option:selected').html()+",";
	id_val=id_val+$('#lcampos option:selected').val()+",";
	
	$('#x_group').html(dato_val);
	$('#x_group_id').val(id_val);

}

function quitar_groupX()
{
	$('#x_group').html('');
	$('#x_group_id').val('');
	
}

function agrega_camposY()
{
	
	if($('#lcampos').val()==null)
	{
	  alert("Please, select the field");
	  return false;
	}
	if($('#varillu_id').val()=='')
	{
	  alert("Save the record to continue the process...");
	  return false;
	
	}
	
	var dato_val=$('#lcampos option:selected').html();
	var id_val=$('#lcampos option:selected').val();
	
	$('#y_campo').html(dato_val);
	$('#y_campo_id').val(id_val);
	
}

function quitar_camposX()
{
	$('#x_campo').html('');
	$('#x_campo_id').val('');
	
}

function quitar_camposY()
{
	$('#y_campo').html('');
	$('#y_campo_id').val('');
	
}


function ver_grafico()
{
	if($('#typeg_name').val()=='0')
	{
		 alert("Select the type of chart");
		 return false;
		
	}
	abrir_pantalla("templateforms/maestro_standar_illustrator/panel_grafico.php","GRAPH","divBody_grafico","divDialog_grafico",800,500,$('#x_campo_id').val(),$('#y_campo_id').val(),$('#typeg_name').val(),$('#script_data').val(),$('#x_group_id').val(),0,0);
	
	
}


function ver_grafico_eject(x_campo_id,y_campo_id,typeg_name,x_group_id)
{
	abrir_pantalla("templateforms/maestro_standar_illustrator/panel_grafico.php","GRAPH","divBody_grafico","divDialog_grafico",800,500,x_campo_id,y_campo_id,typeg_name,'',x_group_id,0,0);
	
}

function activar_descativar(id)
{
	$("#div_ac"+id).load("templateforms/maestro_standar_illustrator/activa.php",{		 
	 id:id
	 },function(result){  
    
	
     });  
    $("#div_ac"+id).html("...");
	
}

//-------------------------------------------

function grid_graph(opcion,graph_id)
{
	
	if(opcion==1)
	{
		
		if($('#ltablas').val()=='null')
		{
			alert("Select Table");
			return false;
			
		}
		
		if($('#x_campo_id').val()=='')
		{
			alert("Select X");
			return false;
			
		}
		
		if($('#y_campo_id').val()=='')
		{
			alert("Select Y");
			return false;
			
		}

		if($('#typeg_name').val()=='0')
		{
			
			alert("Select type graphics");
			return false;
		}
		
	}
	
	if(opcion==2)
	{
		if(!confirm("Are you sure to delete the record?")) {
			
			return false;
			
		 } 

	}
	//alert($('#x_group_id').val());
	
	 $("#guardar_graphic").load("templateforms/maestro_standar_illustrator/grid_graphic.php",{
	 
	 opcion:opcion,
	 varillu_id:$('#varillu_id').val(),
	 ltablas:$('#ltablas').val(),
	 x_campo_id:$('#x_campo_id').val(),
	 y_campo_id:$('#y_campo_id').val(),
	 typeg_name:$('#typeg_name').val(),
	 graph_id:graph_id,
	 x_group_id:$('#x_group_id').val()
  
  },function(result){  
     
     });  
    $("#guardar_graphic").html("Wait a moment...");
	
}

function seleccion_graph(seleccion,on,nombre)
{
	$('#typeg_name').val(seleccion);
	<?php
	$opcion_item="select * from rose_typegraph where typeg_activo=1";
						  $rs_opcion = $DB_gogess->Execute($opcion_item);
						  $comills="'";
						  if($rs_opcion)
	                      {  
						     while (!$rs_opcion->EOF){
							
							echo "$('#".$rs_opcion->fields["typeg_name"]."').attr('src','../archivo/".$rs_opcion->fields["typeg_graficooff"]."'); ";	 
								
								$rs_opcion->MoveNext(); 
							 }
						  }
	
	?>
	
	
	$('#'+nombre).attr('src','../archivo/'+on);
	
}

//-------------------------------------------

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

<td width="30px">&nbsp;</td>

<td>
 <?php
	 
		    $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");	
			@$objformulario->sendvar["id_empresax"]=$id_empresa_val;	
            $objformulario->sendvar["horax"]=date("h:i:s");
			$objformulario->sendvar["sisu_idx"]=$_SESSION['iduser1777'];
			
			//aleatorio busqueda
			 $valoralet=mt_rand(1,500);
			@$aletorioid=$_SESSION['datafrank_sessid_cedula'].date("Ymdhis").$valoralet;
			 @$objformulario->sendvar["codex"]=$aletorioid;
			//aleatorio busqueda
			
			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['sessidadm1777_pichincha'];
			
			 
$objformulario->generar_formulario(@$submit,@$table,@$atributos,@$ancho,@$varsend,@$sessid,1,$DB_gogess);  
?>
</td>
<td width="30px">&nbsp;</td>
<td><?php
$objformulario->generar_formulario(@$submit,@$table,@$atributos,@$ancho,@$varsend,@$sessid,2,$DB_gogess);  

?></td>
<td width="30px">&nbsp;</td>
<td><?php
$objformulario->generar_formulario(@$submit,@$table,@$atributos,@$ancho,@$varsend,@$sessid,3,$DB_gogess);  

?></td>
<td>&nbsp;</td>

  </tr>
</table>


	<div id="tabs">
  <ul>
    <li><a href="#tabs-1">ILLUSTRATOR</a></li>
    <li><a href="#tabs-2">LIST GRAPHS</a></li>
  </ul>
  <div id="tabs-1">
    <p>
    

      
      
      <div id=div_panelprint >
        <?php
	if(@$csearch)
{
	?>
        <table width="700px" border="0" cellpadding="2" cellspacing="1">
          <tr>
            <td bgcolor="#E4F1EE"></td>
            </tr>
          <tr>
            <td>
              
              <table width="700px" border="0" cellpadding="0" cellspacing="2">    
                <tr>
                  <td valign="top"><input type="button" name="Submit" value="See tables" onclick="lista_tablas()" /></td>
                  <td valign="top">&nbsp;</td>
                  <td valign="top">&nbsp;</td>
                  <td valign="top">&nbsp;</td>
                  <td width="292" rowspan="2" valign="top">
                    
                    <div id=div_listaag >
                      <table width="350" height="226" border="0" cellpadding="2" cellspacing="2">
                        <tr>
                          <td height="25" colspan="3" bgcolor="#FFFFFF" class="borde_tabla" >
                          
                          <?php
						  echo '<table  border="0" cellpadding="0" cellspacing="0"><tr>';
						  $opcion_item="select * from 	rose_typegraph where typeg_activo=1";
						  $rs_opcion = $DB_gogess->Execute($opcion_item);
						  $comills="'";
						  if($rs_opcion)
	                      {  
						     while (!$rs_opcion->EOF){
								  
								$link_valor='onclick="seleccion_graph('.$comills.$rs_opcion->fields["typeg_name"].$comills.','.$comills.$rs_opcion->fields["typeg_grafico"].$comills.','.$comills.$rs_opcion->fields["typeg_name"].$comills.')" style="cursor:pointer"'; 
								echo '<td '.$link_valor.' ><img id="'.$rs_opcion->fields["typeg_name"].'" src="../archivo/'.$rs_opcion->fields["typeg_graficooff"].'" width="30" height="27" /></td><td width="3px">&nbsp;</td>';
								  
								  $rs_opcion->MoveNext();
							  }
						  }
						  echo '</tr></table>';
						  ?>
                          
                          
                          </td>
                        </tr>
                        <tr>
                          <td width="30" height="25" bgcolor="#FFFFFF" class="borde_tabla" >&nbsp;</td>
                          <td width="224" bgcolor="#FFFFFF" class="borde_tabla" ><input name="x_group_id" type="hidden" id="x_group_id" value="" /><div id="x_group"></div> </td>
                          <td width="26" bgcolor="#FFFFFF" class="borde_tabla" >&nbsp;</td>
                          </tr>
                        <tr>
                          <td height="146" bgcolor="#FFFFFF" class="borde_tabla" ><input name="y_campo" type="hidden" id="y_campo_id" value="" /><div id="y_campo" class="texto-vertical-2" ></div></td>
                          <td bgcolor="#FFFFFF" class="borde_tabla" >
                            
                            
                            <input name="script_data" type="hidden" id="script_data" value="" />
                            
                            <input type="button" name="button" id="button" value="SEE GRAPH" onclick="ver_grafico()" />
                          <br />
                          <br />
                           <input type="button" name="button" id="button" value="SAVE GRAPH" onclick="grid_graph('1',0)" />
                          
                          </td>
                          <td bgcolor="#FFFFFF" class="borde_tabla" >&nbsp;</td>
                          </tr>
                        <tr>
                          <td height="20" bgcolor="#FFFFFF" class="borde_tabla" >&nbsp;</td>
                          <td height="20" bgcolor="#FFFFFF" class="borde_tabla" ><input name="x_campo_id" type="hidden" id="x_campo_id" value="" />
                            <div id="x_campo"></div>
                            </td>
                          <td height="20" bgcolor="#FFFFFF" class="borde_tabla" >&nbsp;</td>
                          </tr>
                        </table>
                      </div>  
                    
                    </td>
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
                  <td width="39" valign="top">
                    
                      <input id="typeg_name"  name="typeg_name" type="hidden" value="0" />
                    <br />
                    <input type="button" name="Submit2" value="Add [X]" onclick="agrega_camposX()" style="width:100px" />
                    <br />
                    <input type="button" name="Submit2" value="Add [Y]" onclick="agrega_camposY()" style="width:100px" />
                    <br />
                    <input type="button" name="Submit2" value="Add [Y] Ope" onclick="agrega_camposYop()" style="width:100px" />
                    <br />
                    <input type="button" name="Submit2" value="Remove [X]" onclick="quitar_camposX()" style="width:100px" />
                    <br />
                    <input type="button" name="Submit2" value="Remove [Y]" onclick="quitar_camposY()" style="width:100px"/>
                    <br />
                    <input type="button" name="Submit2" value="Add group [X]" onclick="agrega_groupX()" style="width:100px" />
                    <br />
                    <input type="button" name="Submit2" value="Remove group [X]" onclick="quitar_groupX()" style="width:100px" />
                    <br />
                    
                    
                    <td width="39" valign="top">&nbsp;</td>
                  </tr>
                </table>
              
              <table  border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td>
                    <div id="actualizaCampo" ></div>
                    <div id="listEnlace" >&nbsp;</div></td>
                  </tr>
                </table>
              
              
              
              </td>
            </tr>
          </table>
         
        <?php
}
	?>
        </div>
    
    </p>
  </div>
  <div id="tabs-2">
    <p> <div id="guardar_graphic" ></div></p>
  </div>
  
</div>
<?php
if(@$csearch)
{
?>	

<script language="javascript">
<!-- 
  grid_graph(0,0);
  lista_tablas();
		  
-->
</script>
 <?php
}
 ?>         

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
<div id="divBody_op"></div>
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

<div id="divBody_grafico" ></div>

<script>
  $( function() {
    $( "#tabs" ).tabs();
  } );
  </script>
