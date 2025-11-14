<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=444500000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");

for($itbl=0;$itbl<count($lista_tbldata);$itbl++)
 {

  include(@$director."libreria/estructura/".$lista_tbldata[$itbl].".php");

 } 

$objformulario= new  ValidacionesFormulario();

$objtableform= new templateform();

 if (@$table)

  {

  $objtableform->select_templateform(@$table,$DB_gogess);	

  }

$objformulario->sisfield_arr=$gogess_sisfield;

$objformulario->sistable_arr=$gogess_sistable;



$guardar_doccab_subtotaliva=0;

$guardar_doccab_subtotalsiniva=0;

$guardar_doccab_subtnoobjetoi=0;

$guardar_doccab_subtexentoiva=0;

$guardar_doccab_iva=0;

$guardar_doccab_descuento=0;

$guardar_doccab_total=0;



$idempresa=$_SESSION['ces1313777_sessid_emp_id'];

$empresa_id_val=$idempresa;	

$objimpuestos->datos_cfg($empresa_id_val,$DB_gogess);



$lista_detalle="select * from gogess_subgrid where subgri_id=".$_POST["idgrid"]; 

$rs_detalle = $DB_gogess->executec($lista_detalle,array());

$split_ncampo=explode(",",$rs_detalle->fields["subgri_camposlista"]);



 //busca campos a editar

$split_nedita=explode(",",$rs_detalle->fields["subgri_campoedita"]);

//busca si ya fue autorizado

$busca_exixtenciax="select doccab_estadosri from beko_documentocabecera where doccab_id='".$_POST["enlace"]."'";
$rs_exixtenx = $DB_gogess->executec($busca_exixtenciax,array());



//busca si ya fue autorizado

?>



<table  border="0" cellpadding="0" cellspacing="0">

  <tr>

    <td valign="top">



<div class="TableScroll_factura">

<table width="800" border="0" align="center" cellpadding="2" cellspacing="2">

  <tr bgcolor="#DBEDEE">

    <td class="txt_titulo" >&nbsp;</td>

	<?php

	for($i=0;$i<count($split_ncampo);$i++)

	{

	   $campo_val=$gogess_sisfield[$rs_detalle->fields["subgri_nameenlace"]."|".$split_ncampo[$i]];

	   echo '<td class="txt_titulo" ><b>'.$campo_val["fie_title"].'</b></td>';

	}

	

	?>

  </tr>

  <?php

  $contador_det=0;

 $lista_data="select * from ".$rs_detalle->fields["subgri_nameenlace"]." where ".$rs_detalle->fields["subgri_campoenlace"]."='".$_POST["enlace"]."'";

 $rs_data = $DB_gogess->executec($lista_data,array());

 if($rs_data)

 {

	  while (!$rs_data->EOF) {	

$busca_preciot="select * from app_usuario where usua_id='".$rs_data->fields["usuaat_id"]."'";
$rs_preciot= $DB_gogess->executec($busca_preciot,array());


	  $contador_det++;
      $link_borrar='';
	  $comilla_simple="'";
	  $imageb_borrar='';
	  if($rs_exixtenx->fields["doccab_estadosri"]=='AUTORIZADO')
	  {	     
		 $link_borrar='';
		 $imageb_borrar='';
		 
	  }
	  else
	  {
	  
	    $link_borrar='onClick="borrar_item('.$comilla_simple.$rs_data->fields[$rs_detalle->fields["subgri_campoidts"]].$comilla_simple.')" style="cursor:pointer"';
		$imageb_borrar='<img src="images/eliminar.png" width="16" height="16">';
	  
	  }

	  ?>

	  <tr bgcolor="#EFF8F8">

		<td class="txt_txt" <?php echo $link_borrar; ?> ><div align="center"><?php echo $imageb_borrar; ?><?php echo $rs_preciot->fields["usua_formaciondelprofesional"]; ?></div></td>

		

		<?php

		$indice_encontro ='';

		$campo_data='';

		$evento_data='';

		$comilla_simple="'";

	for($i=0;$i<count($split_ncampo);$i++)

	{

	  $indice_encontro ='';

	  $campo_data='';

	  $evento_data='';

	   $campo_val=$gogess_sisfield[$rs_detalle->fields["subgri_nameenlace"]."|".$split_ncampo[$i]];

	   if($campo_val["fie_name"]=='docdet_total')

	   {

	      $indice_encontro = array_search($campo_val["fie_name"],$split_nedita);

		  

		  

		   if(!($indice_encontro === false))

		   {

		      $num_esctri='onkeyup="this.value = this.value.replace (/[^_0-9-. ]/,'.$comilla_simple.$comilla_simple.');" onkeypress="this.value = this.value.replace (/[^_0-9-. ]/,'.$comilla_simple.$comilla_simple.');"';

		      $evento_data=" onChange=actualiza_campo('beko_documentodetalle','".$campo_val["fie_name"]."','docdet_id','".$rs_data->fields[$rs_detalle->fields["subgri_campoidts"]]."',$('#val_mod_".$campo_val["fie_name"]."-".$rs_data->fields[$rs_detalle->fields["subgri_campoidts"]]."').val()) ";


 if($rs_exixtenx->fields["doccab_estadosri"]=='AUTORIZADO')
	  {	   
	  
	       echo '<td class="txt_titulo" ><div id="'.$campo_val["fie_name"].'_'.$rs_data->fields[$rs_detalle->fields["subgri_campoidts"]].'" >'.number_format($rs_data->fields[$campo_val["fie_name"]],$objimpuestos->cgfe_decimales, '.', '').'</div></td>';
	      
	  }
	  else
	  {
			  echo '<td class="txt_titulo" ><div id="'.$campo_val["fie_name"].'_'.$rs_data->fields[$rs_detalle->fields["subgri_campoidts"]].'" ><input name="val_mod_'.$campo_val["fie_name"]."-".$rs_data->fields[$rs_detalle->fields["subgri_campoidts"]].'" type="text" id="val_mod_'.$campo_val["fie_name"]."-".$rs_data->fields[$rs_detalle->fields["subgri_campoidts"]].'" value="'.number_format($rs_data->fields[$campo_val["fie_name"]],$objimpuestos->cgfe_decimales, '.', '').'" autocomplete="off" size="5" '.$evento_data.' '.$num_esctri.'></div></td>';
		
	  }	  

		   }

		  else

		   {

	          echo '<td class="txt_titulo" ><div id="'.$campo_val["fie_name"].'_'.$rs_data->fields[$rs_detalle->fields["subgri_campoidts"]].'" >'.number_format($rs_data->fields[$campo_val["fie_name"]],$objimpuestos->cgfe_decimales, '.', '').'</div></td>';

		   }

	   }

	   else

	   {

	       $indice_encontro = array_search($campo_val["fie_name"],$split_nedita);

		   

	       if(!($indice_encontro === false))

		   {

		   $signo_data='';

		   

		   if($campo_val["fie_name"]=='docdet_descuento')

		   {

		    $signo_data='$';

		   }

		      $num_esctri='onkeyup="this.value = this.value.replace (/[^_0-9-. ]/,'.$comilla_simple.$comilla_simple.');" onkeypress="this.value = this.value.replace (/[^_0-9-. ]/,'.$comilla_simple.$comilla_simple.');"';

			 $evento_data=" onChange=actualiza_campo('beko_documentodetalle','".$campo_val["fie_name"]."','docdet_id','".$rs_data->fields[$rs_detalle->fields["subgri_campoidts"]]."',$('#val_mod_".$campo_val["fie_name"]."-".$rs_data->fields[$rs_detalle->fields["subgri_campoidts"]]."').val()) ";


       if($rs_exixtenx->fields["doccab_estadosri"]=='AUTORIZADO')
	  {
	  
	    echo '<td class="txt_titulo" ><div id="'.$campo_val["fie_name"].'_'.$rs_data->fields[$rs_detalle->fields["subgri_campoidts"]].'" >'.$rs_data->fields[$campo_val["fie_name"]].' '.$signo_data.'</div></td>';
		
	  }
	  else
	  {
			 echo '<td class="txt_titulo" ><div id="'.$campo_val["fie_name"].'_'.$rs_data->fields[$rs_detalle->fields["subgri_campoidts"]].'" ><input name="val_mod_'.$campo_val["fie_name"]."-".$rs_data->fields[$rs_detalle->fields["subgri_campoidts"]].'" type="text" id="val_mod_'.$campo_val["fie_name"]."-".$rs_data->fields[$rs_detalle->fields["subgri_campoidts"]].'" value="'.$rs_data->fields[$campo_val["fie_name"]].'" autocomplete="off" size="5" '.$evento_data.'  '.$num_esctri.' >'.$signo_data.'</div></td>';
		}	       

		   }

	      else

		  {

	       echo '<td class="txt_titulo" ><div id="'.$campo_val["fie_name"].'_'.$rs_data->fields[$rs_detalle->fields["subgri_campoidts"]].'" >'.$rs_data->fields[$campo_val["fie_name"]].'</div></td>';   

		  }

		  

	   }

	}

	

	?>

		

	  </tr>

	  <?php

	  

	  

	  $rs_data->MoveNext();	   

	  }

  }

  

  $descuento_general=0;

  //saca descuento general

 $lista_descuentogeneral="select docdet_descuento_general from  beko_documentodetalle where ".$rs_detalle->fields["subgri_campoenlace"]."='".$_POST["enlace"]."' limit 1";

  $rs_dgeneral = $DB_gogess->executec($lista_descuentogeneral,array()); 

  $descuento_general=$rs_dgeneral->fields["docdet_descuento_general"];

  

  //totales

 $suma_general=0;

  $iva_valor=0;

  

 $lista_totales="select sum(docdet_total) as total,beko_documentodetalle.tari_codigo,tari_valor from beko_documentodetalle inner join beko_tarifa on beko_documentodetalle.tari_codigo=beko_tarifa.tari_codigo where ".$rs_detalle->fields["subgri_campoenlace"]."='".$_POST["enlace"]."' group by tari_codigo";

 $rs_totales = $DB_gogess->executec($lista_totales,array());

 if($rs_totales)

 {

	  while (!$rs_totales->EOF) {	

	  

	  $sutotales[$rs_totales->fields["tari_codigo"]]["total"]=$rs_totales->fields["total"];

	  $sutotales[$rs_totales->fields["tari_codigo"]]["valor"]=$rs_totales->fields["tari_valor"];

	  $sutotales[$rs_totales->fields["tari_codigo"]]["conimpuesto"]=($rs_totales->fields["total"]*$rs_totales->fields["tari_valor"])/100;

	  $suma_general+=$rs_totales->fields["total"];

	  

	  if($rs_totales->fields["tari_valor"]>0)

	  {

	     $iva_valor=$rs_totales->fields["tari_valor"];

	  }

	  

	  

	  

	 $rs_totales->MoveNext();	

	  }

  }	  



//actualiza_descuentogeneral(tabla,campo,idtabla,id_detalle,valor)

//actualiza_campo('beko_documentodetalle','docdet_descuento','docdet_id','1',$('#val_mod_docdet_descuento-1').val())



  $evento_data_dg=" onChange=actualiza_descuentogeneral('beko_documentodetalle','docdet_descuento_general','doccab_id','".$_POST["enlace"]."',$('#descuento_g').val())  ";

  //echo $evento_data_dg;

  ?>

  

  

</table>

</div>





</td>

    <td valign="top">

	<div id="lista_total">

	<table width="190" border="0" cellpadding="0" cellspacing="0">

	<?php

	if(@$sutotales[3]["total"])

	{

	

	?>

        <tr >

          <td width="186" class="txt_titulo" ><span class="Estilo1">Sub.Total IVA <?php echo @$sutotales[3]["valor"]; ?>:</span></td>

		  <td width="186" class="txt_titulo" >&nbsp;</td>

          <td width="114" class="txt_titulo" ><div id="subtotaliva"><?php echo number_format(@$sutotales[3]["total"], $objimpuestos->cgfe_decimales, '.', ''); ?></div></td>

        </tr>

   <?php

       $guardar_doccab_subtotaliva=number_format(@$sutotales[3]["total"], $objimpuestos->cgfe_decimales, '.', '');

   }

   else

   {

   ?>		

    <tr >

          <td width="186" class="txt_titulo" ><span class="Estilo1">Sub.Total IVA <?php echo @$sutotales[2]["valor"]; ?>:</span></td>

		  <td width="186" class="txt_titulo" >&nbsp;</td>

          <td width="114" class="txt_titulo" ><div id="subtotaliva"><?php echo number_format(@$sutotales[2]["total"], $objimpuestos->cgfe_decimales, '.', ''); ?></div></td>

        </tr>

   <?php

      $guardar_doccab_subtotaliva=number_format(@$sutotales[2]["total"], $objimpuestos->cgfe_decimales, '.', '');

   }

   ?>

		

        <tr >

          <td class="txt_titulo" ><span class="Estilo1">Sub.Total IVA 0: </span></td>

		  <td width="186" class="txt_titulo" >&nbsp;</td>

          <td class="txt_titulo" ><div id="subtotaliva0"><?php echo number_format(@$sutotales[0]["total"], $objimpuestos->cgfe_decimales, '.', ''); ?></div></td>

        </tr>

		<?php  $guardar_doccab_subtotalsiniva=number_format(@$sutotales[0]["total"], $objimpuestos->cgfe_decimales, '.', '');  ?>

        <tr >

          <td nowrap="nowrap" class="txt_titulo" ><span class="Estilo1">Sub.Total No obj Impuesto:</span></td>

		  <td width="186" class="txt_titulo" >&nbsp;</td>

          <td class="txt_titulo" ><div id="subtotalnoobj"><?php echo number_format(@$sutotales[6]["total"], $objimpuestos->cgfe_decimales, '.', ''); ?></div></td>

        </tr>

		<?php $guardar_doccab_subtnoobjetoi=number_format(@$sutotales[6]["total"], $objimpuestos->cgfe_decimales, '.', ''); ?>

        <tr >

          <td class="txt_titulo" ><span class="Estilo1">Sub.Total Exento IVA: </span></td>

		  <td width="186" class="txt_titulo" >&nbsp;</td>

          <td class="txt_titulo" ><div id="subtotalexentoiva"><?php echo number_format(@$sutotales[7]["total"], $objimpuestos->cgfe_decimales, '.', ''); ?></div></td>

        </tr>

		<?php $guardar_doccab_subtexentoiva=number_format(@$sutotales[7]["total"], $objimpuestos->cgfe_decimales, '.', ''); ?>

        <tr >

          <td nowrap="nowrap" class="txt_titulo">Descuento:</td>

		  <td width="186" class="txt_titulo" >&nbsp;</td>

          <td class="txt_titulo" nowrap="nowrap" ><input name="descuento_g" type="text" id="descuento_g" value="<?php echo $descuento_general; ?>" size="5" <?php echo $evento_data_dg; ?>  onkeyup="this.value = this.value.replace (/[^_0-9-. ]/,'');" 

onkeypress="this.value = this.value.replace (/[^_0-9-. ]/,'');"  >

            $</td>

        </tr>

		<?php

		

		$guardar_doccab_descuento=$descuento_general;

		

		if(@$sutotales[3]["conimpuesto"])

		{

        ?>

		<tr >

          <td class="txt_titulo"><span class="Estilo1">IVA <?php echo $iva_valor; ?>:</span></td>

		  <td width="186" class="txt_titulo" >&nbsp;</td>

          <td class="txt_titulo" ><div id="iva"><?php echo number_format(@$sutotales[3]["conimpuesto"], $objimpuestos->cgfe_decimales, '.', ''); ?></div></td>

        </tr>

		<?php

		$guardar_doccab_iva=number_format(@$sutotales[3]["conimpuesto"], $objimpuestos->cgfe_decimales, '.', '');

		}

		else

		{

		?>

		<tr >

          <td class="txt_titulo"><span class="Estilo1">IVA <?php echo $iva_valor; ?>:</span></td>

		  <td width="186" class="txt_titulo" >&nbsp;</td>

          <td class="txt_titulo" ><div id="iva"><?php echo number_format(@$sutotales[2]["conimpuesto"], $objimpuestos->cgfe_decimales, '.', ''); ?></div></td>

        </tr>

		<?php

		 $guardar_doccab_iva=number_format(@$sutotales[2]["conimpuesto"], $objimpuestos->cgfe_decimales, '.', '');

		}

		?>

        <tr >

          <td class="txt_titulo"><span class="Estilo1">TOTAL:</span></td>

		  <td width="186" class="txt_titulo" >&nbsp;</td>

          <td class="txt_titulo"><div id="total"><?php 

		  $total_apagar=$suma_general+@$sutotales[2]["conimpuesto"]+@$sutotales[3]["conimpuesto"]-$descuento_general;

		  echo number_format($total_apagar, $objimpuestos->cgfe_decimales, '.', '');

		   ?></div></td>

        </tr>

      </table>

	  <?php $guardar_doccab_total=number_format($total_apagar, $objimpuestos->cgfe_decimales, '.', ''); ?>

	 </div> 

	  

	  </td>

  </tr>

</table>



<?php

//actualiza la data de totales



$busca_exixtencia="select * from beko_documentocabecera where doccab_id='".$_POST["enlace"]."'";
$rs_exixten = $DB_gogess->executec($busca_exixtencia,array());



if($rs_exixten->fields["doccab_id"])

{

  

   if(!($rs_exixten->fields["doccab_xmlfirmado"]))

   {  

   

   $actualiza_valor="update beko_documentocabecera set doccab_subtotaliva='".$guardar_doccab_subtotaliva."',doccab_subtotalsiniva='".$guardar_doccab_subtotalsiniva."',doccab_subtnoobjetoi='".$guardar_doccab_subtnoobjetoi."',doccab_subtexentoiva='".$guardar_doccab_subtexentoiva."',doccab_iva='".$guardar_doccab_iva."',doccab_descuento='".$guardar_doccab_descuento."',doccab_propina=0,doccab_ice=0,doccab_total='".$guardar_doccab_total."' where doccab_id='".$rs_exixten->fields["doccab_id"]."'";

   

   $rs_actcab = $DB_gogess->executec($actualiza_valor,array());

   

   }



}



//actualiza la data de totales





//forma de pago

/*$busca_existepago="select docfpag_id,docfpag_valor from beko_documentoformapago where doccab_id='".$_POST["enlace"]."' and docfpag_valor>0";
$rs_existepago = $DB_gogess->executec($busca_existepago,array());
if(@$rs_existepago->fields["docfpag_valor"]!=$total_apagar)
{

     $busca_sidata="select docfpag_id,docfpag_valor from beko_documentoformapago where frm_id=1 and doccab_id='".$_POST["enlace"]."'";
     $rs_bdata = $DB_gogess->executec($busca_sidata,array());
	 if($rs_bdata->fields["docfpag_id"])
	 {
	   $actualiza="update beko_documentoformapago set docfpag_valor=".$total_apagar." where frm_id=1 and doccab_id='".$_POST["enlace"]."'";
	   $rs_actualiza = $DB_gogess->executec($actualiza,array());
	 }
	 else
	 {
	   $inserta="insert into beko_documentoformapago (frm_id,doccab_id,docfpag_valor) values (1,'".$_POST["enlace"]."',".$total_apagar.")";
	   $rs_inserta = $DB_gogess->executec($inserta,array());

	 }

}*/
//forma de pago

?>

<script language="javascript">
<!--

$('#doccab_subtotaliva').val('<?php echo $guardar_doccab_subtotaliva; ?>');
$('#doccab_subtotalsiniva').val('<?php echo $guardar_doccab_subtotalsiniva; ?>');
$('#doccab_subtnoobjetoi').val('<?php echo $guardar_doccab_subtnoobjetoi; ?>');
$('#doccab_subtexentoiva').val('<?php echo $guardar_doccab_subtexentoiva; ?>');
$('#doccab_iva').val('<?php echo $guardar_doccab_iva; ?>');
$('#doccab_descuento').val('<?php echo $guardar_doccab_descuento; ?>');
$('#doccab_propina').val('0');
$('#doccab_ice').val('0');
$('#doccab_total').val('<?php echo $guardar_doccab_total; ?>');

<?php
if($rs_exixtenx->fields["doccab_estadosri"]=='AUTORIZADO')
{  
?>
 $("#descuento_g").attr('disabled','disabled');
<?php
}
?> 

<?php

if($contador_det==0)

{

?>

$('#doccab_ndet').val('');

<?php

}

else

{

?>

$('#doccab_ndet').val('<?php echo $contador_det; ?>');

<?php

}

?>

calculo_vuelto();

//-->

</script>