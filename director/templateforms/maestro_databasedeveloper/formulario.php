<?php
$fechax='';
$submit='';
$atributos='';
$ancho='';
?>
<script language="javascript">
<!--
function validar_ruc(ruc)
{
   $("#div_ruc").load("templateforms/maestro/ruc.php",{pruc:ruc},function(result){  
    
  });  
  $("#div_ruc").html("Espere un momento...");

}

function ver_tabla()
{
  if($('#virtual_id').val()>0)
  {
	   $("#id_resultado").load("templateforms/maestro_databasedeveloper/table_new.php",{virtual_id:$('#virtual_id').val()},function(result){  
		
	  });  
	  $("#id_resultado").html("Espere un momento...");
  }
  else
  {  
    alert("Please save the record");  
  }

}

function migrar_data()
{

    if($('#virtual_id').val()>0)
  {
	   $("#id_resultado").load("templateforms/maestro_databasedeveloper/migrar.php",{virtual_id:$('#virtual_id').val()},function(result){  
		
	  });  
	  $("#id_resultado").html("Espere un momento...");
  }
  else
  {  
    alert("Please save the record");  
  }

}

//-->
</script>	
<style type="text/css">
#TableScroll_table {
        z-index:99;
		width:300px;
        height:250px;	
        overflow: auto;
      }			
</style>
<div id=div_<?php echo $table ?>></div>
<form id="form_<?php echo $table; ?>" name="form_<?php echo $table; ?>" method="post" action="">
<table border="0" cellpadding="0" cellspacing="3">
  <tr>
    <td><?php $grafico=$objtemplate->path_template."images/new.png";
echo $objopciones_botones->vista_opciones('nuevo',$objacceso_session,$grafico,$table,@$tableant1,@$tableant,@$campoant,@$listab,@$campo,@$obp,@$fimp); ?></td>
    <td><?php $grafico=$objtemplate->path_template."images/save.png";
echo $objopciones_botones->vista_opciones('guardar',$objacceso_session,$grafico,$table,@$tableant1,@$tableant,@$campoant,@$listab,@$campo,@$obp,@$fimp); ?></td>
    <td><?php $grafico=$objtemplate->path_template."images/del.png";
echo $objopciones_botones->vista_opciones('borrar',$objacceso_session,$grafico,$table,@$tableant1,@$tableant,@$campoant,@$listab,@$campo,@$obp,@$fimp); ?></td>
    <td><?php $grafico=$objtemplate->path_template."images/search.png";
echo $objopciones_botones->vista_opciones('buscar',$objacceso_session,$grafico,$table,@$tableant1,@$tableant,@$campoant,@$listab,@$campo,@$obp,@$fimp); ?></td>
    <td><?php $grafico=$objtemplate->path_template."images/print.png";
echo $objopciones_botones->vista_opciones('imprimir',$objacceso_session,$grafico,$table,@$tableant1,@$tableant,@$campoant,@$listab,@$campo,@$obp,@$fimp); ?></td>
   
  </tr>
</table>
<table  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><?php
   if (@$csearch)
				  {
   //////////////////////////////////
	$listalinkstr="select * from gogess_subtablatr where subtr_activo=1 and tab_id=".$objtableform->tab_id;
	
	$resultadolktr = $DB_gogess->Execute($listalinkstr);
	
	if($resultadolktr)
	{
  
      while (!$resultadolktr->EOF) {
	
			$comillsp="'";	
			
			
			
			
			
			
			$dataenc='';
			$armaencrip='geamv=1&table='.$resultadolktr->fields["subtr_nameenlace"].'&listab='.@$objformulario->contenid[$resultadolktr->fields["subtr_campoenlace"]].'&campo='.$resultadolktr->fields["subtr_campoenlace"].'&obp='.$resultadolktr->fields["subtr_tipoenlace"];
			$dataenc=base64_encode($armaencrip);			
			$link_val="index.php?mp=".$dataenc;
			
					
			echo '<input name="botonfactu" type="button" id="botonfactu" value="'.$resultadolktr->fields[maymin("subtr_nombreenlace")].'" onclick="agregar_detalle('.$comillsp.$link_val.$comillsp.','.$comillsp.$resultadolktr->fields[maymin("tab_id")].$comillsp.')" />';
			
			 $resultadolktr->MoveNext();
			//echo "<br>";
			}
	
	}
	//////////////////////////////
	}
	?></td>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
   <td valign="top">
   <div id=div_ruc></div>
   <div id=content_tabla >   
           
<table border="0" cellpadding="0" cellspacing="0">
             <tr>
               <td bgcolor="#F2F2F2"><?php
		   $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");
	
$objformulario->sendvar["horax"]=date("h:i:s");
			 $objformulario->sendvar["sisu_idx"]=$_SESSION['iduser1777'];
			 $objformulario->sendvar["sorload_id"]=0;
			 
$objformulario->generar_formulario($submit,$table,$atributos,$ancho,@$varsend,$sessid,1,$DB_gogess);  
?>
<div class="divider"></div>
<b>&nbsp;&nbsp;Duplicate data in local DB</b>
<div class="divider"></div>


<br />
 &nbsp;&nbsp;<button type="button" class="mb-sm btn btn-primary"  onclick="ver_tabla()"  style="background-color:#000066" >Duplicate</button>  
 
 &nbsp;&nbsp;<button type="button" class="mb-sm btn btn-primary"  onclick="migrar_data()"  style="background-color:#000066" >Migrar Data</button>
 
 <div id="id_resultado" style="height:500px"></div>


</td>
               <td valign="top" bgcolor="#F2F2F2"><?php
		   
$objformulario->generar_formulario($submit,$table,$atributos,$ancho,@$varsend,$sessid,2,$DB_gogess);  
?>			  </td>
             </tr>
           </table>

	</div> 
	 
	 
	 </td>
    <td valign="top"><?php
	$listalinks="select * from gogess_subtabla where sub_activo=1 and tab_id=".$objtableform->tab_id." order by sub_orden asc";

	$resultadolk = $DB_gogess->Execute($listalinks);
	
	if($resultadolk)
	{
	
	   while (!$resultadolk->EOF) 
	   {
 
			$objbotones->table=$resultadolk->fields[maymin("sub_nameenlace")];
			$objbotones->sessid=$sessid;
			$objbotones->listab=$objformulario->contenid[$resultadolk->fields["sub_campoenlace"]];
			$objbotones->campo=$resultadolk->fields[maymin("sub_campoenlace")];
			$objbotones->obp=$resultadolk->fields[maymin("sub_tipoenlace")];
			$objbotones->imagen="pboton.gif";
			$objbotones->csstexto="aquboton";
			$objbotones->target="_top";
			$objbotones->titulo_boton=$resultadolk->fields[maymin("sub_nombreenlace")];
			$objbotones->alt=$resultadolk->fields[maymin("sub_nombreenlace")];
			$objbotones->tablamadre=$table;
			$objbotones->generar_boton(@$csearch,$objtemplate->path_template,@$fimp,$DB_gogess); 
			
			echo "<br>";
			$resultadolk->MoveNext();
		}
	
	}
	?></td>
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
echo $objopciones_botones->vista_opciones('nuevo',$objacceso_session,$grafico,$table,@$tableant1,@$tableant,@$campoant,@$listab,@$campo,@$obp,@$fimp); ?></td>
    <td><?php $grafico=$objtemplate->path_template."images/save.png";
echo $objopciones_botones->vista_opciones('guardar',$objacceso_session,$grafico,$table,@$tableant1,@$tableant,@$campoant,@$listab,@$campo,@$obp,@$fimp); ?></td>
    <td><?php $grafico=$objtemplate->path_template."images/del.png";
echo $objopciones_botones->vista_opciones('borrar',$objacceso_session,$grafico,$table,@$tableant1,@$tableant,@$campoant,@$listab,@$campo,@$obp,@$fimp); ?></td>
    <td><?php $grafico=$objtemplate->path_template."images/search.png";
echo $objopciones_botones->vista_opciones('buscar',$objacceso_session,$grafico,$table,@$tableant1,@$tableant,@$campoant,@$listab,@$campo,@$obp,@$fimp); ?></td>
    <td><?php $grafico=$objtemplate->path_template."images/print.png";
echo $objopciones_botones->vista_opciones('imprimir',$objacceso_session,$grafico,$table,@$tableant1,@$tableant,@$campoant,@$listab,@$campo,@$obp,@$fimp); ?></td>
   
  </tr>
</table>
</form>
<div id=divBody_fac ></div>
<div id=divBody_borrar ></div>
<script type="text/javascript">
$(document).ready(function() {
	$('#content_tabla').corner("round 8px");
});
</script>