<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
?>
<SCRIPT LANGUAGE=javascript>
<!--
function agregarcampos(tb)
{
   window.document.getElementById('opcionejecutardiv3').style.display = 'block';
}


function guardar_campos(tabla,campo,id,valor)
{

$("#campo_valor").load("<?php echo $objtableform->path_templateform ?>guarda_campo.php",{

tabla:tabla,
campo:campo,
id:id,
valor:valor

 },function(result){       

  });  

$("#campo_valor").html("Espere un momento...");



}

//-->
</SCRIPT>

<script language="javascript">
<!--

function dibujar(iddibujo) {

myWindow4=window.open('<?php echo $objtableform->path_templateform ?>dibujo.php?iddibujo='+iddibujo,'ventana_dibujo','width=750,height=500,scrollbars=YES');

myWindow4.focus();

}


function tablas_celdas(iddibujo) {

myWindow4=window.open('<?php echo $objtableform->path_templateform ?>general_total.php?iddibujo='+iddibujo,'ventana_celda','width=750,height=500,scrollbars=YES');

myWindow4.focus();

}

//-->
</script>

<style type="text/css">

<!--

.Estilo1 {color: #FFFFFF}

.Estilo2 {

	font-family: Verdana, Arial, Helvetica, sans-serif;

	font-size: 11px;

}

-->

</style>

<?php
@$ordenval=0;
$objform = new  formulario();
$j2=0;
if (@$opcionb=="agregarcampos")
{

//cantidad campos
$lista_ncampov="select count(*) as numero_campos from gogess_sisfield where tab_name='".$tb."'";
$rs_ncampov = $DB_gogess->Execute($lista_ncampov);

if($rs_ncampov->fields["numero_campos"]>0)
{
  $ordenval=$rs_ncampov->fields["numero_campos"];
}
//cantidad campos


  //Agregando Datos a Aqualis  
    $i2=0;
	$n_registrosAc2=0;
	$selecTablaAc2="select * from ".$tb." limit 1"; 	
	$resultadoAc2 = $DB_gogess->Execute($selecTablaAc2);

	if ($resultadoAc2)
    { 	   

	  $n_registrosAc2 = $resultadoAc2->FieldCount();	   

	  while ($i2 < $n_registrosAc2) 
	  {			

			$fld=$resultadoAc2->FetchField($i2);
	        $nombre_campo=strtolower($fld->name);
			$objform->field_aqualis($tb,$nombre_campo,$DB_gogess);			

			if (!($objform->fie_name==$nombre_campo))
			{

			   $separacampo=explode("_",$nombre_campo);
			   if(@$separacampo[1])
			   {
			     $nombre_campo_n=ucwords($separacampo[1]).":";
			   }
			   else
			   {
			     $nombre_campo_n=$nombre_campo;
			   }			   

			   if(@$separacampo[2])
			   {

			      $buscacfg="select * from gogess_conocimiento where cono_codigo='".$separacampo[2]."'";
			      $rs_gogessformb = $DB_gogess->Execute($buscacfg);
					while (!$rs_gogessformb->EOF) {						

					$field_type=$rs_gogessformb->fields["field_type"];
					$field_flags=$rs_gogessformb->fields["field_flags"];
					$fie_type=$rs_gogessformb->fields["fie_type"];
					$fie_typeweb=$rs_gogessformb->fields["fie_typeweb"];
					$fie_obl=$rs_gogessformb->fields["fie_obl"];
					$fie_attrib=$rs_gogessformb->fields["fie_attrib"];
					$fie_tabledb=$rs_gogessformb->fields["fie_tabledb"];
					$fie_datadb=$rs_gogessformb->fields["fie_datadb"];
					$fie_sql=$rs_gogessformb->fields["fie_sql"];
					$fie_value=$rs_gogessformb->fields["fie_value"];
					$fie_sendvar=$rs_gogessformb->fields["fie_sendvar"];
					$cono_nombre=$rs_gogessformb->fields["cono_nombre"];

					$rs_gogessformb->MoveNext();
					}		  

			   }

			   

			   if(!(@$fie_type))
			   {
			     $fie_type='text';
			   }

			   
			   if(!(@$fie_typeweb))
			   {
			     $fie_typeweb='text';
			   }

			   
			   if(@$cono_nombre)
			   {
			     $nombre_campo_n=$cono_nombre;
			   }

			   if(@$fie_tabledb)
			   {
			     $tb_2=$fie_tabledb;
			   }
			   else
			   {
			     $tb_2=$tb;
			   }

			   

			   switch ($fie_type) {			   

					case 'text':

						$stilocampo='form-control';

						break;

					case 'textarea':

						$stilocampo='form-control';

						break;

					case 'select':

						$stilocampo='form-control';

						break;

					

					case 'selectafecta':

						$stilocampo='form-control';

						break;

						

					case 'selectrecibe':

						$stilocampo='form-control';

						break;		

						

					case 'selectafectarecibe':

						$stilocampo='form-control';

						break;	

							

					case 'selectvalorcero':

						$stilocampo='form-control';

						break;

							

					case 'selectbuscador':

						$stilocampo='form-control';

						break;

						

					default:

					    $stilocampo='form-control';

                        break;

							

						

				}

				

			   @$ordenval++;

			   

			   if(!(@$fie_obl))

			   {

				   $fie_obl=0;

			   }

//if($nombre_campo=='centrocua_id')
//{
			   @$camposnuevos= "insert into gogess_sisfield (fie_name,tab_name,fie_title,fie_type,fie_typeweb,fie_style,fie_tabledb,fie_active,fie_activesearch,fie_obl,fie_group,fie_tactive,fie_lencampo,fie_activelista,fie_activarprt,field_type,field_flags,fie_attrib,fie_datadb,fie_sql,fie_value,fie_sendvar,fie_styleobj,fie_orden,fie_ordengrid) values ('".$nombre_campo."', '".$tb."', '".$nombre_campo_n."','".$fie_type."', '".$fie_typeweb."', 'cmbforms','".$tb_2."',1,1,".$fie_obl.",1,1,25,1,1,'".$field_type."','".$field_flags."','".$fie_attrib."','".$fie_datadb."','".$fie_sql."','".$fie_value."','".$fie_sendvar."','".$stilocampo."','".$ordenval."',0)";			  
//} 
			//echo $camposnuevos."<br><br>";

			   

			   

			   //-------------------------------------------

			   

			   	    $field_type='';
					$field_flags='';
					$fie_type='';
					$fie_typeweb='';
					$fie_obl='';
					$fie_attrib='';
					$fie_tabledb='';
					$fie_datadb='';
					$fie_sql='';
					$fie_value='';
					$fie_sendvar='';
					$cono_nombre='';
			        $nombre_campo_n='';

			   //-------------------------------------------

			   			   

			  $resultadoCn = $DB_gogess->Execute($camposnuevos);			   			   

			  @$k2++;

			}
			else
			{
			  $j2++;
			}
			$i2++;

	  }  

	}  

  //Fin Agregar Datos 

}
?>

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

<table  border="0" align="center" cellpadding="0" cellspacing="0">

  <tr>

    <td valign="top" bgcolor="#F2F5F7" class="bordeformulario" ><?php



$objformulario->sendvar["ot_idx"]=1;

$objformulario->sendvar["tab_datosfx"]=0;

$objformulario->sendvar["tab_formatotablax"]=1;

$objformulario->sendvar["instan_idx"]=2;

$objformulario->generar_formulario(@$submit,$table,@$atributos,@$ancho,@$varsend,@$sessid,1,$DB_gogess);  

?>

      <br />

      <span class="linkper">

      <?php

if (@$csearch)

{

	$sqlnom = "select * from gogess_sistable where tab_id = $csearch";	

	

	$resultnom = $DB_gogess->Execute($sqlnom);

	

	if ($resultnom)

	{		 	

		

		while (!$resultnom->EOF) 

		{ 

		   $tab_namec=$resultnom->fields[maymin("tab_name")];

		   $resultnom->MoveNext();

		}

	

	}





}

?>

      </span>

      <div id="opcionejecutardiv3" style="position: absolute; opacity: 10; display: none; padding-left: 3px; padding-top: 3px; padding-right: 3px; width: 254px; height: 90px; line-height: 30px; border: 1px solid #990000; color: #336699; font-weight: bold; background-color: #ffffff; left: 286px; top: 126px;">

        <?php if ($csearch)

{

?>

        <iframe height="80" width="250" src="<?php printf("bdialog/accesar.php?tb=%s&csearch=%s&sessid=%s&table=%s&vb=%s",$tab_namec,$csearch,$sessid,$table,$objformulario->vatajo); ?>" name="gframe" id="gframe"> </iframe>

        <?php

}

?>

      </div></td>

    <td valign="top"><?php 

	$objbotones->table="gogess_sisfield";
	$objbotones->sessid=@$sessid;
	$objbotones->listab=@$tab_namec;
	$objbotones->campo="tab_name";
	$objbotones->obp="str";
	$objbotones->imagen="pboton.gif";
	$objbotones->csstexto="aquboton";
	$objbotones->target="_top";
	$objbotones->titulo_boton="Campos";
	$objbotones->alt="Campos";
	$objbotones->tablamadre=$table;
	$objbotones->generar_boton(@$csearch,$objtemplate->path_template,@$fimp,$DB_gogess); 
	
	$listalinks="select * from gogess_subtabla where sub_activo=1 and tab_id=".$objtableform->tab_id;

	$resultadolk = $DB_gogess->Execute($listalinks);

	if($resultadolk)
	{   	

	while (!$resultadolk->EOF) 
		{

			

			

			$objbotones->table=$resultadolk->fields[maymin("sub_nameenlace")];

			$objbotones->sessid=$sessid;

			$objbotones->listab=@$csearch;

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

	?>

	

	

      <table border="0" align="center" cellpadding="4" cellspacing="0">

        <tr>

          <td bgcolor="#A5BADA"><div align="center" class="Estilo2 Estilo1"><strong><br>

        Campos no agregados al Sistema<br>

        <br>

          </strong></div></td>

        </tr>

        <tr>

          <td bgcolor="#FFFFFF">

            <?php

	

	$i1=0;

	$j1=0;

	$n_registrosAc=0;

	$selecTablaAc="select * from ".@$tab_namec." limit 1"; 

	$k1=0;

	$resultadoAc = $DB_gogess->Execute($selecTablaAc);



	if ($resultadoAc)

    { 

	 

	   $n_registrosAc= $resultadoAc->FieldCount();

	  

	  echo 	"<div class='Estilo2'>Numerero de Registros de la tabla <b>".$tab_namec."</b>: ".$n_registrosAc."</div>"; 

	  

	  while ($i1 < $n_registrosAc) 

	  {			

			//$nombre_campo  = mysql_field_name($resultadoAc, $i1);

			

			$fld=$resultadoAc->FetchField($i1);

	        $nombre_campo=strtolower($fld->name);

			

			$objform->field_aqualis($tab_namec,$nombre_campo,$DB_gogess);

			

			if (!($objform->fie_name==$nombre_campo))

			{

			  echo "<div  class='Estilo2'>".$nombre_campo."<br></div>";

			  $k1++;

			}

			else

			{

			  $j1++;

			}		

			$i1++;

	  }

	  

	  echo "<div  class='Estilo2'>N&uacute;mero de Registros agregados a Aqualis: <b>".$j1."</b></div>";

	  echo "<div  class='Estilo2'>N&uacute;mero de Registros Pendientes: <b>".$k1."</b></div>";

	}

	else

	{

	    echo "<div  class='Estilo2'>Tabla no existe en la Base de Datos F&iacute;sica</div>";

	}

	

	?>

          </td>

        </tr>

        <tr>

          <td bgcolor="#A5BADA"><div align="center"> <br>

                  <?php

		if (@$k1)

		{

		?>

                  <table width="200" border="0" cellpadding="0" cellspacing="0">

                    <tr>

                      <td bordercolor="0" bgcolor="#339966" class="mano" onClick="agregarcampos('<?php echo $tab_namec ?>')"><div align="center"><span class="Estilo2 Estilo1"><strong>Desea Agregar los campos?</strong></span></div></td>

                    </tr>

                  </table>

                  <?php

		}

		?>

                  <br>

          </div></td>

        </tr>

      </table>

	  

	  

	  <?php

	 

	if(@$csearch)

	{

	?>

      

	  <table border="0" cellpadding="0" cellspacing="0">

        <tr>

          <td onclick="dibujar('<?php echo $objformulario->contenid["tab_name"]; ?>')" style="cursor:pointer"><img src="<?php echo $objtableform->path_templateform ?>dibujo.png" width="128" height="128" border="0" /></td>

        </tr>

      </table>
	  
	  <br /><br />
	  
	    <table border="0" cellpadding="0" cellspacing="0">

        <tr>

          <td onclick="tablas_celdas('<?php echo $objformulario->contenid["tab_name"]; ?>')" style="cursor:pointer"><img src="<?php echo $objtableform->path_templateform ?>dibujo.png" width="128" height="128" border="0" /></td>

        </tr>

      </table>
	 
	  <table border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px">
		  
		  <table border="1" cellpadding="0" cellspacing="1">
			  <tr>
			  <td><strong>Nombre</strong></td>
			  <td><strong>Titulo</strong></td>
			  <td><strong>Grupo</strong></td>
			  <td><strong>Orden</strong></td>
			  <td><strong>Grupo print</strong></td>
			  <td><strong>Ancho CP</strong></td>
			  <td><strong>Tabla Subgrid</strong></td>
			  <td><strong>Enlace Subgrid</strong></td>
			  
			  <td><strong>Variable externa</strong></td>
			  
			  <td><strong>Archivo Subgrid</strong></td>
			  <td><strong>Guardar</strong></td>
			  </tr>
		  <?php
		  
		           $lista_campor="select * from gogess_sisfield where tab_name='".$objformulario->contenid["tab_name"]."' order by fie_group,fie_orden asc";
			       $rs_listacmp = $DB_gogess->Execute($lista_campor);
                   if($rs_listacmp)
				   {
						while (!$rs_listacmp->EOF) {	
						
						//fie_group
						//fie_orden
						//fie_groupprint
						//fie_anchocolomna
							//fie_id
						$comulla_simple="'";	
						$tabla_valordata="";
						$campo_valor="";	
						$tabla_valordata="'gogess_sisfield'";
						$campo_valor="'fie_id'";
						
						
							
						echo '<tr>						       
							  <td>'.$rs_listacmp->fields["fie_name"].'</td>
							  <td>'.utf8_encode($rs_listacmp->fields["fie_title"]).'</td>						  
                              <td><input name="cmb_fie_group'.$rs_listacmp->fields["fie_id"].'" type="text" id="cmb_fie_group'.$rs_listacmp->fields["fie_id"].'" value="'.$rs_listacmp->fields["fie_group"].'" size="4" onblur="guardar_campos('.$tabla_valordata.','.$comulla_simple.'fie_group'.$comulla_simple.','.$rs_listacmp->fields["fie_id"].',$('.$comulla_simple.'#cmb_fie_group'.$rs_listacmp->fields["fie_id"].$comulla_simple.').val())" /></td>
							  
			                  <td><input name="cmb_fie_orden'.$rs_listacmp->fields["fie_id"].'" type="text" id="cmb_fie_orden'.$rs_listacmp->fields["fie_id"].'" value="'.$rs_listacmp->fields["fie_orden"].'" size="4" onblur="guardar_campos('.$tabla_valordata.','.$comulla_simple.'fie_orden'.$comulla_simple.','.$rs_listacmp->fields["fie_id"].',$('.$comulla_simple.'#cmb_fie_orden'.$rs_listacmp->fields["fie_id"].$comulla_simple.').val())" /></td>
							  
			                  <td><input name="cmb_fie_groupprint'.$rs_listacmp->fields["fie_id"].'" type="text" id="cmb_fie_groupprint'.$rs_listacmp->fields["fie_id"].'" value="'.$rs_listacmp->fields["fie_groupprint"].'" size="4" onblur="guardar_campos('.$tabla_valordata.','.$comulla_simple.'fie_groupprint'.$comulla_simple.','.$rs_listacmp->fields["fie_id"].',$('.$comulla_simple.'#cmb_fie_groupprint'.$rs_listacmp->fields["fie_id"].$comulla_simple.').val())" /></td>
							  
			                  <td><input name="cmb_fie_anchocolomna'.$rs_listacmp->fields["fie_id"].'" type="text" id="cmb_fie_anchocolomna'.$rs_listacmp->fields["fie_id"].'" value="'.$rs_listacmp->fields["fie_anchocolomna"].'" size="4" onblur="guardar_campos('.$tabla_valordata.','.$comulla_simple.'fie_anchocolomna'.$comulla_simple.','.$rs_listacmp->fields["fie_id"].',$('.$comulla_simple.'#cmb_fie_anchocolomna'.$rs_listacmp->fields["fie_id"].$comulla_simple.').val())" /></td>
							  
							  <td>'.$rs_listacmp->fields["fie_tablasubgrid"].'</td>
							  <td>'.$rs_listacmp->fields["fie_campoenlacesub"].'</td>
							  <td>'.$rs_listacmp->fields["fie_sendvar"].'</td>
							  <td>'.$rs_listacmp->fields["fie_archivogrid"].'</td>
							  
							  <td><input type="button" name="Submit" value="Aceptar" /></td>
							  
			             </tr>';
						
						   $rs_listacmp->MoveNext();
						}
				   }
		  
		  ?>
		  </table>
		  
		  
		  </td>
        </tr>
      </table>
	   <div id="campo_valor"></div>

	  <?php

	 }

	  ?> 

	  

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



echo "<input name='tb' type='hidden' value=''><input name='opcionb' type='hidden' value=''><input name='csearch' type='hidden' value=''>

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