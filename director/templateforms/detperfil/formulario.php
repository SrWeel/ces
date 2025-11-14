<script src="<?php echo @$pathc.$objtableform->path_templateform ?>selectuser_seleccionar.js"></script>
<script src="<?php echo @$pathc.$objtableform->path_templateform ?>selectuser_imenu.js"></script>
<script src="<?php echo @$pathc.$objtableform->path_templateform ?>selectuser_dperfil.js"></script>
<script language="javascript">
<!--

function asignarmenu() {
window.document.form_gogess_detperfil.detp_codigo.value=window.document.form_gogess_detperfil.detp_codigo.value + "-"+ window.document.form_gogess_detperfil.men_idas.value + "-";
showUser_dperfil(window.document.form_gogess_detperfil.detp_obj.value,window.document.form_gogess_detperfil.detp_codigo.value,0,0,0,0,0,0,0,0,0);
}

function quitarmenu() {
//window.document.form_gogess_detperfil.detp_codigo.value=window.document.form_gogess_detperfil.detp_codigo.value + "-"+ window.document.form_gogess_detperfil.men_idas.value + "-";

var linea = new String();
linea=window.document.form_gogess_detperfil.detp_codigo.value;
linea = linea.replace("-"+ window.document.form_gogess_detperfil.men_idas.value + "-", "");
window.document.form_gogess_detperfil.detp_codigo.value=linea; 
showUser_dperfil(window.document.form_gogess_detperfil.detp_obj.value,window.document.form_gogess_detperfil.detp_codigo.value,0,0,0,0,0,0,0,0,0);

}


function asignarboton() {

window.document.form_gogess_detperfil.detp_codigo.value=window.document.form_gogess_detperfil.detp_codigo.value + "-"+ window.document.form_gogess_detperfil.tab_idas.value+window.document.form_gogess_detperfil.tipobo.value+ "-";
showUser_dperfil(window.document.form_gogess_detperfil.detp_obj.value,window.document.form_gogess_detperfil.detp_codigo.value,0,0,0,0,0,0,0,0,0);
}

function quitarboton() {
//window.document.form_gogess_detperfil.detp_codigo.value=window.document.form_gogess_detperfil.detp_codigo.value + "-"+ window.document.form_gogess_detperfil.men_idas.value + "-";

var linea = new String();

linea=window.document.form_gogess_detperfil.detp_codigo.value;
linea = linea.replace("-"+ window.document.form_gogess_detperfil.tab_idas.value+window.document.form_gogess_detperfil.tipobo.value + "-", "");
window.document.form_gogess_detperfil.detp_codigo.value=linea; 
showUser_dperfil(window.document.form_gogess_detperfil.detp_obj.value,window.document.form_gogess_detperfil.detp_codigo.value,0,0,0,0,0,0,0,0,0);
}




function asignarimenu() {
window.document.form_gogess_detperfil.detp_codigo.value=window.document.form_gogess_detperfil.detp_codigo.value + "-"+ window.document.form_gogess_detperfil.ite_idas.value + "-";
showUser_dperfil(window.document.form_gogess_detperfil.detp_obj.value,window.document.form_gogess_detperfil.detp_codigo.value,0,0,0,0,0,0,0,0,0);
}

function quitarimenu() {
//window.document.form_gogess_detperfil.detp_codigo.value=window.document.form_gogess_detperfil.detp_codigo.value + "-"+ window.document.form_gogess_detperfil.men_idas.value + "-";

var linea = new String();
linea=window.document.form_gogess_detperfil.detp_codigo.value;
linea = linea.replace("-"+ window.document.form_gogess_detperfil.ite_idas.value + "-", "");
window.document.form_gogess_detperfil.detp_codigo.value=linea; 
showUser_dperfil(window.document.form_gogess_detperfil.detp_obj.value,window.document.form_gogess_detperfil.detp_codigo.value,0,0,0,0,0,0,0,0,0);
}



function asignartabla() {
window.document.form_gogess_detperfil.detp_codigo.value=window.document.form_gogess_detperfil.detp_codigo.value + "-"+"rx"+window.document.form_gogess_detperfil.tab_nameas.value + "-";
showUser_dperfil(window.document.form_gogess_detperfil.detp_obj.value,window.document.form_gogess_detperfil.detp_codigo.value,0,0,0,0,0,0,0,0,0);
}

function quitartabla() {
//window.document.form_gogess_detperfil.detp_codigo.value=window.document.form_gogess_detperfil.detp_codigo.value + "-"+ window.document.form_gogess_detperfil.men_idas.value + "-";

var linea = new String();
linea=window.document.form_gogess_detperfil.detp_codigo.value;
linea = linea.replace("-"+ "rx"+window.document.form_gogess_detperfil.tab_nameas.value + "-", "");
window.document.form_gogess_detperfil.detp_codigo.value=linea; 
showUser_dperfil(window.document.form_gogess_detperfil.detp_obj.value,window.document.form_gogess_detperfil.detp_codigo.value,0,0,0,0,0,0,0,0,0);

}


//////////////////////////////////////////////////

function asignarsecc() {
window.document.form_gogess_detperfil.detp_codigo.value=window.document.form_gogess_detperfil.detp_codigo.value + "-"+window.document.form_gogess_detperfil.secp_idas.value + "-";
showUser_dperfil(window.document.form_gogess_detperfil.detp_obj.value,window.document.form_gogess_detperfil.detp_codigo.value,0,0,0,0,0,0,0,0,0);
}

function quitarsecc() {
//window.document.form_gogess_detperfil.detp_codigo.value=window.document.form_gogess_detperfil.detp_codigo.value + "-"+ window.document.form_gogess_detperfil.men_idas.value + "-";

var linea = new String();
linea=window.document.form_gogess_detperfil.detp_codigo.value;
linea = linea.replace("-"+window.document.form_gogess_detperfil.secp_idas.value + "-", "");
window.document.form_gogess_detperfil.detp_codigo.value=linea; 
showUser_dperfil(window.document.form_gogess_detperfil.detp_obj.value,window.document.form_gogess_detperfil.detp_codigo.value,0,0,0,0,0,0,0,0,0);

}



//-->
</script>

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

<table border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top" class="bordeformulario" >
	
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><?php
$objformulario->sendvar["per_idex"]=$listab;
$objformulario->generar_formulario(@$submit,@$table,@$atributos,@$ancho,@$varsend,@$sessid,1,$DB_gogess);  
?>
                <input name="listab" type="hidden" id="listab" value="<?php echo $listab; ?>">
                <input name="obp" type="hidden" id="obp" value="=">
                <input name="campo" type="hidden" id="campo" value="per_id"></td>
              <td>
			  <div id=txtHint_seleccionar></div>
			  
			  </td>
            </tr>
      </table>
          <br>
          <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td>
			  <div id=txtHint_dperfil>
			  <table width="400" border="0" align="center" cellpadding="0" cellspacing="1">
                <tr>
                  <td bgcolor="#D2E1E8"><div align="center" class="cssdetperfil">RESTRINGIDO</div></td>
                  <td bgcolor="#D2E1E8"><div align="center" class="cssdetperfil">ACTIVO</div></td>
                </tr>
                <tr>
                  <td valign="top" bgcolor="#EAF1F2" class="cssdetperfiltxt">
				  
				  <?php	  
			  $q=$objformulario->contenid["detp_obj"];
              $q1=$objformulario->contenid["detp_codigo"];

			
		
	if 	($q=='menu')
	{
	  
	   $listamenu=explode("-",$q1);	
	   for($i=0;$i<=count($listamenu);$i++)
	   {
	      
		  @$nmenu=$objformulario->replace_cmb("gogess_menu","men_id,men_titulo","where men_id=",$listamenu[$i],$DB_gogess);
		  if ($nmenu)
		  {
	         echo $nmenu."<br>";
			 @$listav= $listav.$listamenu[$i].',';
		  }
	   }
	}
	
	
		
	if 	($q=='imenu')
	{
	  
	   $listamenu=explode("-",$q1);	
	   for($i=0;$i<=count($listamenu);$i++)
	   {
	     
		  $inmenu=$objformulario->replace_cmb("gogess_itemmenu","ite_id,ite_titulo","where ite_id=",$listamenu[$i],$DB_gogess);
		  if ($inmenu)
		  {
	         echo $inmenu."<br>";
			 $listav= $listav.$listamenu[$i].',';
		 }
	   }
	}
			
			
	if 	($q=='tabla')
	{
	  
	   $listamenu=explode("-",$q1);	
	   for($i=0;$i<=count($listamenu);$i++)
	   {
	     
		
		$btabla=  trim(str_replace(substr($listamenu[$i],0,2),"",$listamenu[$i]));
		  $ntabla=$objformulario->replace_cmb("gogess_sistable","tab_name,tab_title","where tab_name like",$btabla,$DB_gogess);
		  if ($ntabla)
		  {
	         echo $ntabla."<br>";
			 $listav= $listav."'".$btabla."',";
		 }
	   }
	}  
	@$listav=substr($listav,0,-1);
	
	if(!($listav))
	{
	  $listav=0;
	}
	
		?>				  </td>
                  <td valign="top" bgcolor="#EAF1F2" class="cssdetperfiltxt">
				  <?php
				  if 	($q=='menu')
					{
						//echo $listav;
				    	$listadoc="select * from gogess_menu where men_active=1 and men_id not in(".$listav.")";
						
						$resultdoc = $DB_gogess->Execute($listadoc);
						
						//$resultdoc = mysql_query($listadoc);
						
						while (!$resultdoc->EOF) {
						
						
						 		 $nmenuac=$objformulario->replace_cmb("gogess_menu","men_id,men_titulo","where men_id=",$resultdoc->fields[maymin("men_id")],$DB_gogess);
									 echo $nmenuac."<br>";
									 
									  $resultdoc->MoveNext();
									}
	  				}
				  
				  
				  
				  if 	($q=='imenu')
					  {
					  
					    $listadoc="select * from gogess_itemmenu where ite_active=1 and ite_id not in(".$listav.")";
						$resultdoc = $DB_gogess->Execute($listadoc);						
						//$resultdoc = mysql_query($listadoc);
						while (!$resultdoc->EOF) {						
									 
									 $inmenuac=$objformulario->replace_cmb("gogess_itemmenu","ite_id,ite_titulo","where ite_id=",$resultdoc->fields[maymin("ite_id")],$DB_gogess);
									 echo $inmenuac."<br>";
									 
									 $resultdoc->MoveNext();
									 
									}					  
					  
					  }
					  
					  
				if 	($q=='tabla')
					{
					
					    $listadoc="select * from gogess_sistable where  tab_name not in(".$listav.")";
						//$listadoc="select * from gogess_sistable where instan_id=1 and tab_name not in(".$listav.")";
						//$resultdoc = mysql_query($listadoc);
						$resultdoc = $DB_gogess->Execute($listadoc);
						
						while (!$resultdoc->EOF) {

									 $ntablaac=$objformulario->replace_cmb("gogess_sistable","tab_name,tab_title","where tab_name like",$resultdoc->fields[maymin("tab_name")],$DB_gogess);
									 echo $ntablaac."<br>";
									 
									 $resultdoc->MoveNext();
									}
					
					}
	  
					  
				  
				  ?>				  </td>
                </tr>
              </table>
		  
			  <br />
			  </div>
			  
			  
			  
			  </td>
            </tr>
          </table>
	
	&nbsp;</td>
    <td valign="top"><?php 
	$objbotones->table="gogess_perfil";
	$objbotones->sessid=@$sessid;
    $objbotones->seccionapl=@$seccionapl;
	$objbotones->csearch=@$listab;
	$objbotones->imagen="pboton.gif";
	$objbotones->csstexto="aquboton";
	$objbotones->target="_top";
	$objbotones->titulo_boton="Regresar a PERFIL";
	$objbotones->alt="Regresar a PERFIL";
	$objbotones->boton_backnivel1(@$csearch,$objtemplate->path_template,@$fimp); 
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