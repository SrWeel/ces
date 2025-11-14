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

			$armaencrip='geamv=1&table='.@$resultadolktr->fields["subtr_nameenlace"].'&listab='.@$objformulario->contenid[$resultadolktr->fields["subtr_campoenlace"]].'&campo='.$resultadolktr->fields["subtr_campoenlace"].'&obp='.$resultadolktr->fields["subtr_tipoenlace"];

			

			$dataenc=base64_encode($armaencrip);			

			$link_val="index.php?mp=".$dataenc;

				

			echo '<input name="botonfactu" type="button" id="botonfactu" value="'.$resultadolktr->fields[maymin("subtr_nombreenlace")].'..." onclick="agregar_detalle('.$comillsp.$link_val.$comillsp.','.$comillsp.$resultadolktr->fields[maymin("tab_id")].$comillsp.')" />';

			

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

   <td valign="top"><table border="0" cellspacing="0" cellpadding="3" >

       <tr>

         <td>

		 <div id=content_tabla >

		    <table border="0" cellpadding="0" cellspacing="0">

             <tr>

               <td valign="top"><?php

			   

		  $campoenc=@$campo."x";



		  

$objformulario->sendvar[@$campoenc]=@$listab;



$objformulario->sendvar["fechax"]=date("Y-m-d h:i:s");

$objformulario->sendvar["horax"]=date("h:i:s");

			 $objformulario->sendvar["sisu_idx"]=$_SESSION['iduser1777'];

$objformulario->generar_formulario(@$submit,$table,@$atributos,@$ancho,@$varsend,@$sessid,1,$DB_gogess);  

?></td>

               <td valign="top"><?php 

			   $objformulario->generar_formulario(@$submit,@$table,@$atributos,@$ancho,@$varsend,@$sessid,2,$DB_gogess);  

			   ?></td>

             </tr>

           </table>

		   

		   </div>

           <input name="listab" type="hidden" id="listab" value="<?php echo $listab; ?>" />

           <input name="obp" type="hidden" id="obp" value="=" />

          <input name="campo" type="hidden" id="campo" value="<?php echo  $campo ?>" /></td>

       </tr>

     </table></td>

    <td valign="top"><?php 

	if($objtableform->tab_tablaregreso)

	{

	

	$objbotones->table=$objtableform->tab_tablaregreso;

	$objbotones->sessid=$sessid;

	$objbotones->csearch=$listab;

	$objbotones->imagen="pboton.gif";

	$objbotones->csstexto="aquboton";

	$objbotones->target="_top";

	$objbotones->titulo_boton="Regresar";

	$objbotones->alt="Regresar";

	$objbotones->boton_backnivel1(@$csearch,$objtemplate->path_template,@$fimp,$DB_gogess); 

	

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

<script type="text/javascript">
<!--
$( "#fich_fechanacimiento" ).datepicker({dateFormat: 'yy-mm-dd'});
//  End -->
</script>