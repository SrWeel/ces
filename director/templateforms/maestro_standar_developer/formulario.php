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
  $("#div_listat").load("templateforms/maestro_standar_developer/listat.php",{},function(result){  
    
  });  
  $("#div_listat").html("Espere un momento...");

}

function lista_campos()
{

  $("#div_listac").load("templateforms/maestro_standar_developer/listac.php",{ltablas:$('#ltablas').val()},function(result){  
    
	
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
	
	if($('#vardev_id').val()=='')
	{
	  alert("Por favor guarde el registro para continuar con el proceso...");
	  return false;
	
	}
	
    $("#div_listaag").load("templateforms/maestro_standar_developer/listaag.php",{ltablas:$('#ltablas').val(),lcampos:$('#lcampos').val(),vardev_id:$('#vardev_id').val()},function(result){  
    
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
	
  
    $("#div_listaag").load("templateforms/maestro_standar_developer/listaag.php",{listaag:$('#listaag').val(),vardev_id:$('#vardev_id').val()},function(result){  
    
	 ver_enlace();
	
     });  
    $("#div_listaag").html("Espere un momento...");
}

function ver_reporte(irep)
{
   myWindow3=window.open('templateforms/maestro_standar_developer/panel_developer.php?ireport='+irep,'ventana_reporte','width=750,height=500,scrollbars=YES');
   myWindow3.focus();

}

function ver_enlace()
{
	
	
	$("#listEnlace").load("templateforms/maestro_standar_developer/listenlace.php",{vardev_id:$('#vardev_id').val()},function(result){  
    
     });  
    $("#listEnlace").html("Espere un momento...");
	
}


function ver_actualizacampos(idcampo)
{
	
	
	$("#actualizaCampo").load("templateforms/maestro_standar_developer/actualizaCampo.php",{rptenlc_id:idcampo,campoa:$('#campoa_' + idcampo).val(),campob:$('#campob_'+idcampo).val()},function(result){  
    
     });  
    $("#actualizaCampo").html("Espere un momento...");
	
}

function panel_oper()
{
//alert("Holas");
abrir_pantalla("templateforms/maestro_standar_developer/operation.php","OPERACION","divBody_op","divDialog_op",600,300,$('#vardev_id').val(),0,0,0,0,0,1);

}

function agregar_campo_op()
{
  if($('#nfield').val()=='')
  {
	  alert("Fill in the title field");
	  return false;
  }
  
  
  $("#guardar_campo").load("templateforms/maestro_standar_developer/guardar_op.php",{
	  
	  vardev_id:$('#vardev_id').val(),
	  textarea_op:$('#textarea_op').val(),
	  nfield:$('#nfield').val()
  
  },function(result){  
        listar_ag();
     });  
    $("#guardar_campo").html("Espere un momento...");

}


function listar_ag()
{
	 $("#div_listaag").load("templateforms/maestro_standar_developer/listaop.php",{
		 
		 ltablas:$('#ltablas').val(),lcampos:$('#lcampos').val(),vardev_id:$('#vardev_id').val()
	 
	 },function(result){  
    
	 ver_enlace();
	
     });  
    $("#div_listaag").html("Espere un momento...");
	
}

function editar_op()
{
	var dato_val=$('#listaag option:selected').html();
	
	var res_valor = dato_val.split("--");
	
	if(res_valor[0].trim()=='Operation')
	{
	abrir_pantalla("templateforms/maestro_standar_developer/operation.php","OPERACION","divBody_op","divDialog_op",600,300,$('#vardev_id').val(),$('#listaag').val(),0,0,0,0,2);
	}
	
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




<table width="200px" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>
	<div align="center">
        <?php
	 
		    $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");	
			@$objformulario->sendvar["id_empresax"]=$id_empresa_val;	
            $objformulario->sendvar["horax"]=date("h:i:s");
			$objformulario->sendvar["sisu_idx"]=$_SESSION['iduser1777'];
			
			//aleatorio busqueda
			 $valoralet=mt_rand(1,500);
			 
			 $data_val=uniqid();
			 
			@$aletorioid=$data_val.date("Ymdhis").$valoralet;
			 @$objformulario->sendvar["vardev_aleatunicox"]=$aletorioid;
			//aleatorio busqueda
			
			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['sessidadm1777_pichincha'];
			
			 
$objformulario->generar_formulario(@$submit,@$table,@$atributos,@$ancho,@$varsend,@$sessid,1,$DB_gogess);  
?>
      </div>	</td>
  </tr>
  <tr>
    <td>
	
	
	<div id=div_panelprint >
    <?php
	if(@$csearch)
{
	?>
	<table width="700px" align="center" border="0" cellpadding="2" cellspacing="1">
      <tr>
        <td bgcolor="#E4F1EE"> </td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellpadding="0" cellspacing="2">
            
            <tr>
              <td valign="top"><input type="button" name="Submit" value="See tables" onclick="lista_tablas()" /></td>
              <td valign="top">&nbsp;</td>
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
              <td width="39" valign="top">
              <br />
              <br />
              <input type="button" name="Submit2" value="Add" onclick="agrega_campos()" />
              <br />
              <br />
              <input type="button" name="button" id="button" value="Add operation" onclick="panel_oper()" />
                <br />
                <br />
                <input type="button" name="Submit3" value="Remove" onclick="quitar_campos()" /></td>
              <td width="39" valign="top">&nbsp;</td>
              <td width="292" valign="top">
			  <div id=div_listaag >
			  <?php
			  $list_data="select * from sth_vddetalle where vardev_id=".$objformulario->contenid["vardev_id"]." order by vardevdet_id asc";
              $resultlistat = $DB_gogess->Execute($list_data);
			  
			  $objformulario->fie_sqlorder='';
			  ?>
			  <select name="listaag" size="10" id="listaag"  ondblclick="editar_op()" >
			  <?php
					if($resultlistat)
					{  
					  while (!$resultlistat->EOF) {
					  
					$es_numero=is_numeric($resultlistat->fields["vardevdet_tabla"]);
					//$resultlistat->fields["vardevdet_tabla"];
                    $nombretabla='';
					$nombrecampo='';
					if($es_numero)
					{
					  
					  
					  $nombretabla=$objformulario->replace_cmb("gogess_virtualtable","virtual_id,virtual_name"," where virtual_id =",trim($resultlistat->fields["vardevdet_tabla"]),$DB_gogess);
					  $nombrecampo=str_replace(":","",$objformulario->replace_cmb("gogess_virtualfields","virtfields_id,virtfields_namefield"," where virtfields_id=",trim($resultlistat->fields["vardevdet_campo"]),$DB_gogess));
					  
					  if(!($nombrecampo))
					  {
						  
						$nombrecampo=$resultlistat->fields["vardevdet_campo"];
						$nombretabla="Operation";
					  }
					  
					  echo '<option value="'.$resultlistat->fields["vardevdet_id"].'">'.$nombretabla." -- ".$nombrecampo.'</option>';
					  
					}	
					else
					{	 
					 
					  $nombretabla=$objformulario->replace_cmb("gogess_sistable","tab_name,tab_title","where tab_name like ",$resultlistat->fields["vardevdet_tabla"],$DB_gogess);					  
					  $nombrecampo=str_replace(":","",$objformulario->replace_cmb("gogess_sisfield","fie_name,fie_title","where tab_name ='".$resultlistat->fields["vardevdet_tabla"]."' and fie_name like ",$resultlistat->fields["vardevdet_campo"],$DB_gogess));
					  
					  if(!($nombrecampo))
					  {
						  
						$nombrecampo=$resultlistat->fields["vardevdet_campo"];
						$nombretabla="Operation";
					  }
					  
					  echo '<option value="'.$resultlistat->fields["vardevdet_id"].'">'.$nombretabla." -- ".$nombrecampo.'</option>';
					  
					  
					}  
					  
					  $resultlistat->MoveNext();
					  }
					 } 
				
				?>
              </select>
			  </div>
              </td>
            </tr>
        </table>
          
          <br />
          <table border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td onclick="ver_reporte($('#vardev_id').val())" style="cursor:pointer"><img src="<?php echo $objtableform->path_templateform ?>images/verreporte.png"  /></td></tr>
          </table>
          </td>
      </tr>
    </table>
    <?php
}
	
	?>
	</div>
	
	
	
	
	</td>
  </tr>
  <tr>
    <td>
<br /><br />			  
<div class="container" align="center">
  <div class="row">
    <div class="col-md-6">
        <?php
			  $objformulario->generar_formulario(@$submit,@$table,@$atributos,@$ancho,@$varsend,@$sessid,2,$DB_gogess); 
		?>
    </div>
    <div class="col-md-6">
      <?php
			  $objformulario->generar_formulario(@$submit,@$table,@$atributos,@$ancho,@$varsend,@$sessid,3,$DB_gogess); 
		?>
    </div>
  </div>
</div>	  
<div id="actualizaCampo" ></div>
<div id="listEnlace" >&nbsp;</div>	  
	
	
	</td>
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



<script language="javascript">
<!--

 ver_enlace();
//-->
</script>
