<link href="<?php echo @$pathc.$objtableform->path_templateform ?>formatoper.css" rel="stylesheet" type="text/css">
<script src="<?php echo @$pathc.$objtableform->path_templateform ?>selectuser_generar.js"></script>


<div id=div_<?php echo $table ?>></div>

<form id="form_<?php echo $table; ?>" name="form_<?php echo $table; ?>" method="post" action="">
  <table border="0" cellpadding="0" cellspacing="3">
    <tr>
      <td><?php $grafico=$objtemplate->path_template."images/new.png";
echo $objopciones_botones->vista_opciones('nuevo',$objacceso_session,@$grafico,$table,@$tableant1,@$tableant,@$campoant,@$listab,@$campo,@$obp,@$fimp); ?></td>
      <td><?php $grafico=$objtemplate->path_template."images/save.png";
echo $objopciones_botones->vista_opciones('guardar',$objacceso_session,@$grafico,$table,@$tableant1,@$tableant,@$campoant,@$listab,@$campo,@$obp,@$fimp); ?></td>
      <td><?php $grafico=$objtemplate->path_template."images/del.png";
echo $objopciones_botones->vista_opciones('borrar',$objacceso_session,@$grafico,$table,@$tableant1,@$tableant,@$campoant,@$listab,@$campo,@$obp,@$fimp); ?></td>
      <td><?php $grafico=$objtemplate->path_template."images/search.png";
echo $objopciones_botones->vista_opciones('buscar',$objacceso_session,@$grafico,$table,@$tableant1,@$tableant,@$campoant,@$listab,@$campo,@$obp,@$fimp); ?></td>
      <td><?php $grafico=$objtemplate->path_template."images/print.png";
echo $objopciones_botones->vista_opciones('buscar',$objacceso_session,@$grafico,$table,@$tableant1,@$tableant,@$campoant,@$listab,@$campo,@$obp,@$fimp); ?></td>
    </tr>
  </table>
	
<table border="0" cellpadding="3" cellspacing="2">
  <tr>
    <td><?php 
	$objbotones->table="gogess_sistable";
	$objbotones->sessid=$sessid;
	
	$sqlnom = "select * from gogess_sistable where tab_name like '".$listab."'";	
	$resultnom = $DB_gogess->Execute($sqlnom);
	
	if ($resultnom)
	{		 	
	while (!$resultnom->EOF) {
	 
		   $listab_t=$resultnom->fields[maymin("tab_id")];
		    $resultnom->MoveNext();
		}

	}
	
	$objbotones->csearch=@$listab_t;
	$objbotones->imagen="pboton.gif";
	$objbotones->csstexto="aquboton";
	$objbotones->target="_top";
	$objbotones->titulo_boton="Regresar a MENU";
	$objbotones->alt="Regresar a MENU";
	$objbotones->boton_backnivel1(@$csearch,$objtemplate->path_template,@$fimp); 
	?></td>
    <td>
	<?php
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
			$armaencrip='geamv=1&table='.$resultadolktr->fields["subtr_nameenlace"].'&listab='.$objformulario->contenid[$resultadolktr->fields["subtr_campoenlace"]].'&campo='.$resultadolktr->fields["subtr_campoenlace"].'&obp='.$resultadolktr->fields["subtr_tipoenlace"];
			
			$dataenc=base64_encode($armaencrip);			
			$link_val="index.php?mp=".$dataenc;
				
			echo '<input name="botonfactu" type="button" id="botonfactu" value="'.$resultadolktr->fields[maymin("subtr_nombreenlace")].'..." onclick="agregar_detalle('.$comillsp.$link_val.$comillsp.','.$comillsp.$resultadolktr->fields[maymin("tab_id")].$comillsp.')" />';
			
			 $resultadolktr->MoveNext();
			//echo "<br>";
			}
	
	}
	//////////////////////////////
	}

	?>
	
	</td>
  </tr>
</table>
<table width="1200" border="0" align="center" cellpadding="3" cellspacing="0">
  <tr>
    <td valign="top">

            <p>
			 <script>
$(function() {
$( "#tabs" ).tabs();
});
</script>
			<div id="tabs">
<ul>
<li><a href="#tabs-1">Configuracion de Campo</a></li>
<li><a href="#tabs-2">Formato</a></li>
<li><a href="#tabs-3">Despliegue</a></li>
<li><a href="#tabs-4">Listas deplegables</a></li>
<li><a href="#tabs-5">Validaci&oacute;n</a></li>
<li><a href="#tabs-6">Extras</a></li>
<li><a href="#tabs-7">Parametros Grid (Sub tabla)</a></li>
<li><a href="#tabs-8">Archivo ligado</a></li>
</ul>
<div id="tabs-1">
<p>
<?php
$objformulario->sendvar["tab_namex"]=$listab;
$objformulario->sendvar["fie_inactivoftablax"]=0;

$objformulario->generar_formulario(@$submit,$table,@$atributos,@$ancho,@$varsend,@$sessid,1,$DB_gogess);  

?>
</p>
</div>
<div id="tabs-2">
<p>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top"><?php
$objformulario->generar_formulario(@$submit,$table,@$atributos,@$ancho,@$varsend,@$sessid,5,$DB_gogess);  
?></td>
    <td valign="top"><?php
$objformulario->generar_formulario(@$submit,$table,@$atributos,@$ancho,@$varsend,@$sessid,51,$DB_gogess);  
?></td>
  </tr>
</table>
</p>

</div>
<div id="tabs-3">
<p><?php
$objformulario->generar_formulario(@$submit,$table,@$atributos,@$ancho,@$varsend,@$sessid,4,$DB_gogess);  
?></p>
</div>

<div id="tabs-4">
<p>

<?php
$objformulario->generar_formulario(@$submit,$table,@$atributos,@$ancho,@$varsend,@$sessid,3,$DB_gogess);  
?>
          <div align="center">
                            <input type="button" name="Submit" value="Generar Tabla Para el combo" onclick="showUser_generar(0,window.document.fa.fie_tabledb.value,window.document.fa.fie_datadb.value,0,0,0,0,0,0,0,0)" />
							
							&nbsp;							
							<input name="botonfactu" type="button" id="botonfactu" value="Ver datos combo" onclick="agregar_detalle(window.document.fa.fie_tabledb.value,0,0,0)" />
							
							
							<div id=txtHint_generar></div>
          </div>


</p>
</div>

<div id="tabs-5">
<p>
<?php
$objformulario->generar_formulario(@$submit,$table,@$atributos,@$ancho,@$varsend,@$sessid,6,$DB_gogess);  
?>
</p>
</div>

<div id="tabs-6">
<p>

<?php
$objformulario->generar_formulario(@$submit,$table,@$atributos,@$ancho,@$varsend,@$sessid,2,$DB_gogess);  
?>
</p>
</div>


<div id="tabs-7">
<p>
<?php
$objformulario->generar_formulario(@$submit,$table,@$atributos,@$ancho,@$varsend,@$sessid,7,$DB_gogess);  
?>
</p>
</div>

<div id="tabs-8">
<p>
<?php
$objformulario->generar_formulario(@$submit,$table,@$atributos,@$ancho,@$varsend,@$sessid,8,$DB_gogess);  
?>
</p>
</div>

</div>



			
			
              <input name="listab" type="hidden" id="listab" value="<?php echo @$listab; ?>">
              <input name="obp" type="hidden" id="obp" value="str">
              <input name="campo" type="hidden" id="campo" value="tab_name">
              <input name="tableant" type="hidden" id="tableant" value="<?php echo @$tableant; ?>">
              <br>
            </p></td>
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
echo $objopciones_botones->vista_opciones('nuevo',$objacceso_session,@$grafico,$table,@$tableant1,@$tableant,@$campoant,@$listab,@$campo,@$obp,@$fimp); ?></td>
    <td><?php $grafico=$objtemplate->path_template."images/save.png";
echo $objopciones_botones->vista_opciones('guardar',$objacceso_session,@$grafico,$table,@$tableant1,@$tableant,@$campoant,@$listab,@$campo,@$obp,@$fimp); ?></td>
    <td><?php $grafico=$objtemplate->path_template."images/del.png";
echo $objopciones_botones->vista_opciones('borrar',$objacceso_session,@$grafico,$table,@$tableant1,@$tableant,@$campoant,@$listab,@$campo,@$obp,@$fimp); ?></td>
    <td><?php $grafico=$objtemplate->path_template."images/search.png";
echo $objopciones_botones->vista_opciones('buscar',$objacceso_session,@$grafico,$table,@$tableant1,@$tableant,@$campoant,@$listab,@$campo,@$obp,@$fimp); ?></td>
    <td><?php $grafico=$objtemplate->path_template."images/print.png";
echo $objopciones_botones->vista_opciones('buscar',$objacceso_session,@$grafico,$table,@$tableant1,@$tableant,@$campoant,@$listab,@$campo,@$obp,@$fimp); ?></td>
   
  </tr>
</table>

</form>



<div id=divBody_fac ></div>
<div id=divBody_borrar ></div>