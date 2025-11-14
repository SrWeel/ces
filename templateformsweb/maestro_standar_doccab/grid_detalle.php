<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=14000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");
?>
<style type="text/css">
<!--
.txt_titulo {
	font-size: 11px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	border: 1px solid #666666;			
 }
.txt_txt {
	font-size: 11px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	border: 1px solid #666666;			
 }
.Estilo1 {font-size: 10px}
-->
</style>
<?php
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

//echo $_POST["enlace"]."<br>";
//echo $_POST["campoenlace"]."<br>";
//echo $_POST["tablaenlace"]."<br>";


 $lista_detalle="select * from gogess_subgrid where subgri_id=".$_POST["idgrid"]; 
 $rs_detalle = $DB_gogess->executec($lista_detalle,array());
 $split_ncampo=explode(",",$rs_detalle->fields["subgri_camposlista"]);
 
 //busca campos a editar
 
 $split_nedita=explode(",",$rs_detalle->fields["subgri_campoedita"]);
 
 //print_r($split_nedita);
 //busca campos a editar
 
 
  
?>
<table  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
	
<table width="700" border="0" align="center" cellpadding="2" cellspacing="2">
  <tr bgcolor="#DBEDEE">
    <td class="txt_titulo" >&nbsp;</td>
	<?php
	for($i=0;$i<count($split_ncampo);$i++)
	{
	   $campo_val=$gogess_sisfield[$rs_detalle->fields["subgri_nameenlace"]."|".$split_ncampo[$i]];
	   echo '<td class="txt_titulo" >'.$campo_val["fie_title"].'</td>';
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
	  
	  
	  $contador_det++;
	  ?>
	  <tr bgcolor="#EFF8F8">
		<td class="txt_txt" onClick="borrar_item('<?php echo $rs_data->fields[$rs_detalle->fields["subgri_campoidts"]] ?>')" style="cursor:pointer"><div align="center"><img src="images/eliminar.png" width="16" height="16"></div></td>
		
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
		      $num_esctri='onkeyup="this.value = this.value.replace (/[^_0-9-. ]/,'.$comilla_simple.$comilla_simple.');" onkeypress="this.value = this.value.replace (/[^_0-9- ]/,'.$comilla_simple.$comilla_simple.');"';
		      $evento_data=" onChange=actualiza_campo('app_documentodetalle','".$campo_val["fie_name"]."','docdet_id','".$rs_data->fields[$rs_detalle->fields["subgri_campoidts"]]."',$('#val_mod_".$campo_val["fie_name"]."-".$rs_data->fields[$rs_detalle->fields["subgri_campoidts"]]."').val()) ";
			  echo '<td class="txt_titulo" ><div id="'.$campo_val["fie_name"].'_'.$rs_data->fields[$rs_detalle->fields["subgri_campoidts"]].'" ><input name="val_mod_'.$campo_val["fie_name"]."-".$rs_data->fields[$rs_detalle->fields["subgri_campoidts"]].'" type="text" id="val_mod_'.$campo_val["fie_name"]."-".$rs_data->fields[$rs_detalle->fields["subgri_campoidts"]].'" value="'.number_format($rs_data->fields[$campo_val["fie_name"]],2, '.', '').'" size="5" '.$evento_data.' '.$num_esctri.'></div></td>';
		   }
		  else
		   {
	          echo '<td class="txt_titulo" ><div id="'.$campo_val["fie_name"].'_'.$rs_data->fields[$rs_detalle->fields["subgri_campoidts"]].'" >'.number_format($rs_data->fields[$campo_val["fie_name"]],2, '.', '').'</div></td>';
		   }
	   }
	   else
	   {
	       $indice_encontro = array_search($campo_val["fie_name"],$split_nedita);
		   
	       if(!($indice_encontro === false))
		   {
		      $num_esctri='onkeyup="this.value = this.value.replace (/[^_0-9-. ]/,'.$comilla_simple.$comilla_simple.');" onkeypress="this.value = this.value.replace (/[^_0-9- ]/,'.$comilla_simple.$comilla_simple.');"';
			 $evento_data=" onChange=actualiza_campo('app_documentodetalle','".$campo_val["fie_name"]."','docdet_id','".$rs_data->fields[$rs_detalle->fields["subgri_campoidts"]]."',$('#val_mod_".$campo_val["fie_name"]."-".$rs_data->fields[$rs_detalle->fields["subgri_campoidts"]]."').val()) ";
			 echo '<td class="txt_titulo" ><div id="'.$campo_val["fie_name"].'_'.$rs_data->fields[$rs_detalle->fields["subgri_campoidts"]].'" ><input name="val_mod_'.$campo_val["fie_name"]."-".$rs_data->fields[$rs_detalle->fields["subgri_campoidts"]].'" type="text" id="val_mod_'.$campo_val["fie_name"]."-".$rs_data->fields[$rs_detalle->fields["subgri_campoidts"]].'" value="'.$rs_data->fields[$campo_val["fie_name"]].'" size="5" '.$evento_data.'  '.$num_esctri.' ></div></td>';      
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
 $lista_descuentogeneral="select docdet_descuento_general from  app_documentodetalle where ".$rs_detalle->fields["subgri_campoenlace"]."='".$_POST["enlace"]."' limit 1";
  $rs_dgeneral = $DB_gogess->executec($lista_descuentogeneral,array()); 
  $descuento_general=$rs_dgeneral->fields["docdet_descuento_general"];
  
  //totales
 $suma_general=0;
  
 $lista_totales="select sum(docdet_total) as total,app_documentodetalle.tari_codigo,tari_valor from app_documentodetalle inner join app_tarifa on app_documentodetalle.tari_codigo=app_tarifa.tari_codigo where ".$rs_detalle->fields["subgri_campoenlace"]."='".$_POST["enlace"]."' group by tari_codigo";
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
//actualiza_campo('app_documentodetalle','docdet_descuento','docdet_id','1',$('#val_mod_docdet_descuento-1').val())

  $evento_data_dg=" onChange=actualiza_descuentogeneral('app_documentodetalle','docdet_descuento_general','doccab_id','".$_POST["enlace"]."',$('#descuento_g').val())  ";
  //echo $evento_data_dg;
  ?>
  
  
</table></td>
    <td valign="top">
	<div id="lista_total">
	<table width="190" border="0" cellpadding="0" cellspacing="0">
	<?php
	if(@$sutotales[3]["total"])
	{
	
	?>
        <tr >
          <td width="186" class="txt_titulo" ><span class="Estilo1">Sub.Total IVA <?php echo @$sutotales[3]["valor"]; ?>:</span></td>
          <td width="114" class="txt_titulo" ><div id="subtotaliva"><?php echo number_format(@$sutotales[3]["total"], 2, '.', ''); ?></div></td>
        </tr>
   <?php
   }
   else
   {
   ?>		
    <tr >
          <td width="186" class="txt_titulo" ><span class="Estilo1">Sub.Total IVA <?php echo @$sutotales[2]["valor"]; ?>:</span></td>
          <td width="114" class="txt_titulo" ><div id="subtotaliva"><?php echo number_format(@$sutotales[2]["total"], 2, '.', ''); ?></div></td>
        </tr>
   <?php
   }
   ?>
		
        <tr >
          <td class="txt_titulo" ><span class="Estilo1">Sub.Total IVA 0: </span></td>
          <td class="txt_titulo" ><div id="subtotaliva0"><?php echo number_format(@$sutotales[0]["total"], 2, '.', ''); ?></div></td>
        </tr>
        <tr >
          <td class="txt_titulo" ><span class="Estilo1">Sub.Total No obj Impuesto:</span></td>
          <td class="txt_titulo" ><div id="subtotalnoobj"><?php echo number_format(@$sutotales[6]["total"], 2, '.', ''); ?></div></td>
        </tr>
        <tr >
          <td class="txt_titulo" ><span class="Estilo1">Sub.Total Exento IVA: </span></td>
          <td class="txt_titulo" ><div id="subtotalexentoiva"><?php echo number_format(@$sutotales[7]["total"], 2, '.', ''); ?></div></td>
        </tr>
        <tr >
          <td class="txt_titulo">Descuento:</td>
          <td class="txt_titulo" ><input name="descuento_g" type="text" id="descuento_g" value="<?php echo $descuento_general; ?>" size="5" <?php echo $evento_data_dg; ?>  onkeyup="this.value = this.value.replace (/[^_0-9-. ]/,'');" 
onkeypress="this.value = this.value.replace (/[^_0-9- ]/,'');"  >
            $</td>
        </tr>
		<?php
		
		if(@$sutotales[3]["conimpuesto"])
		{
        ?>
		<tr >
          <td class="txt_titulo"><span class="Estilo1">IVA <?php echo $iva_valor; ?>:</span></td>
          <td class="txt_titulo" ><div id="iva"><?php echo number_format(@$sutotales[3]["conimpuesto"], 2, '.', ''); ?></div></td>
        </tr>
		<?php
		}
		else
		{
		?>
		<tr >
          <td class="txt_titulo"><span class="Estilo1">IVA <?php echo $iva_valor; ?>:</span></td>
          <td class="txt_titulo" ><div id="iva"><?php echo number_format(@$sutotales[2]["conimpuesto"], 2, '.', ''); ?></div></td>
        </tr>
		<?php
		}
		?>
        <tr >
          <td class="txt_titulo"><span class="Estilo1">TOTAL:</span></td>
          <td class="txt_titulo"><div id="total"><?php 
		  $total_apagar=$suma_general+@$sutotales[2]["conimpuesto"]+@$sutotales[3]["conimpuesto"]-$descuento_general;
		  echo number_format($total_apagar, 2, '.', '');
		   ?></div></td>
        </tr>
      </table>
	 </div> 
	  
	  </td>
  </tr>
</table>
<?php
//guarda totales en cabecera
if(@$sutotales[3]["total"])
{
$acualiza_cabecera="update app_documentocabecera set doccab_descuento='".$descuento_general."',doccab_subtotaliva='".@$sutotales[3]["total"]."',doccab_subtotalsiniva='".@$sutotales[0]["total"]."',doccab_subtnoobjetoi='".@$sutotales[6]["total"]."',doccab_subtexentoiva='".@$sutotales[7]["total"]."',doccab_iva='".@$sutotales[3]["conimpuesto"]."',doccab_total='".$total_apagar."' where doccab_id='".$_POST["enlace"]."'";
$rs_cabecera = $DB_gogess->executec($acualiza_cabecera,array());
}
else
{
$acualiza_cabecera="update app_documentocabecera set doccab_descuento='".$descuento_general."',doccab_subtotaliva='".@$sutotales[2]["total"]."',doccab_subtotalsiniva='".@$sutotales[0]["total"]."',doccab_subtnoobjetoi='".@$sutotales[6]["total"]."',doccab_subtexentoiva='".@$sutotales[7]["total"]."',doccab_iva='".@$sutotales[2]["conimpuesto"]."',doccab_total='".$total_apagar."' where doccab_id='".$_POST["enlace"]."'";
$rs_cabecera = $DB_gogess->executec($acualiza_cabecera,array());

}

//forma de pago
$busca_existepago="select docfpag_id,docfpag_valor from app_documentoformapago where doccab_id='".$_POST["enlace"]."'";
$rs_existepago = $DB_gogess->executec($busca_existepago,array());
if(!(@$rs_existepago->fields["docfpag_id"]))
{
     $busca_sidata="select docfpag_id,docfpag_valor from app_documentoformapago where frm_id=1 and doccab_id='".$_POST["enlace"]."'";
     $rs_bdata = $DB_gogess->executec($busca_sidata,array());
	 if($rs_bdata->fields["docfpag_id"])
	 {
	   $actualiza="update app_documentoformapago set docfpag_valor=".$total_apagar." where frm_id=1 and doccab_id='".$_POST["enlace"]."'";
	   $rs_actualiza = $DB_gogess->executec($actualiza,array());
	 }
	 else
	 {
	   $inserta="insert into app_documentoformapago (frm_id,doccab_id,docfpag_valor) values (1,'".$_POST["enlace"]."',".$total_apagar.")";
	   $rs_inserta = $DB_gogess->executec($inserta,array());
	 
	 }
}
//forma de pago
?>

<script language="javascript">
<!--
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

//-->
</script>


