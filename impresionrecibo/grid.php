<?php
$_POST["enlace"]=$rscampos_valor->fields["doccab_id"];

$lista_detalle="select * from gogess_subgrid where subgri_id=2"; 
$rs_detalle = $DB_gogess->executec($lista_detalle,array());
$split_ncampo=explode(",","docdet_cantidad,docdet_descripcion,docdet_preciou,docdet_descuento,docdet_total");
 //busca campos a editar
$split_nedita=explode(",",$rs_detalle->fields["subgri_campoedita"]);

//print_r($gogess_sisfield);
?>

<table  border="0"  cellpadding="1" cellspacing="1" width="298" >
  <tr>
	<?php
	
	for($iz=0;$iz<count($split_ncampo);$iz++)
	    {
		   for($i=0;$i<count($gogess_sisfield);$i++)
	       {
		     
		      if($gogess_sisfield[$i]["fie_name"]==$split_ncampo[$iz])
		      {
		      echo '<td class="css_table" >'.str_replace(":","",$gogess_sisfield[$i]["fie_title"]).'</td>';
		      }
			  
		   }
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
	  <tr  class="css_table" >
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
	   if($split_ncampo[$i]=='docdet_total' or $split_ncampo[$i]=='docdet_preciou')
	   {	      

	          echo '<td class="css_table" ><div id="'.$split_ncampo[$i].'_'.$rs_data->fields[$rs_detalle->fields["subgri_campoidts"]].'" >'.number_format($rs_data->fields[$split_ncampo[$i]],2, '.', '').'</div></td>';


	   }
	   else
	   {	    
	   
	    
		  if($split_ncampo[$i]=='docdet_descripcion')
		  { 
	        echo '<td class="css_table" ><div id="'.$split_ncampo[$i].'_'.$rs_data->fields[$rs_detalle->fields["subgri_campoidts"]].'" >'.$rs_data->fields[$split_ncampo[$i]].'</div></td>';   
			//echo '<td class="css_table" ><div id="'.$split_ncampo[$i].'_'.$rs_data->fields[$rs_detalle->fields["subgri_campoidts"]].'" >'.$rs_data->fields[$split_ncampo[$i]].'<br>'.$rs_data->fields["docdet_detallea"].'</div></td>'; 
		  }
		  else
		  {
		    echo '<td class="css_table" ><div id="'.$split_ncampo[$i].'_'.$rs_data->fields[$rs_detalle->fields["subgri_campoidts"]].'" >'.$rs_data->fields[$split_ncampo[$i]].'</div></td>'; 
		  
		  }

		}

	}

	

	?>	

	  </tr>
	  <?php  

	  $rs_data->MoveNext();	   

	  }

  }

?> 
</table>  
==========================================
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top" class="css_precio"  >
	</td>
    <td>
<table  border="0" align="center" cellpadding="1" cellspacing="1" width="200px">
<?php
  $descuento_general=0;
  //saca descuento general
 $lista_descuentogeneral="select docdet_descuento_general from  beko_recibodetalle where ".$rs_detalle->fields["subgri_campoenlace"]."='".$_POST["enlace"]."' limit 1";

  $rs_dgeneral = $DB_gogess->executec($lista_descuentogeneral,array()); 
  $descuento_general=$rs_dgeneral->fields["docdet_descuento_general"]; 

  //totales
 $suma_general=0; 

$lista_totales="select sum(docdet_total) as total,beko_recibodetalle.tari_codigo,tari_valor from beko_recibodetalle inner join beko_tarifa on beko_recibodetalle.tari_codigo=beko_tarifa.tari_codigo where ".$rs_detalle->fields["subgri_campoenlace"]."='".$_POST["enlace"]."' group by tari_codigo";

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
  ?>
  <?php

	if(@$sutotales[3]["total"])
	{

	?>

  <tr>

  <td></td>

  <td></td>

  <td></td>

  <td class="css_precio" >Sub.T IVA <?php echo @$sutotales[3]["valor"]; ?>:</td>

  <td class="css_precio" ><?php echo number_format(@$sutotales[3]["total"], 2, '.', ''); ?></td>

  </tr>

  <?php

  }

  else

  {

  ?>

  <tr>

  <td></td>

  <td></td>

  <td></td>

  <td class="css_precio" >Sub.T IVA <?php echo @$sutotales[2]["valor"]; ?>:</td>

  <td class="css_precio" ><?php echo number_format(@$sutotales[2]["total"], 2, '.', ''); ?></td>

  </tr>

  <?php

  }

  ?>

  

  <tr>

  <td></td>

  <td></td>

  <td></td>

  <td class="css_precio" >Sub.T IVA 0: </td>

  <td class="css_precio" ><?php echo number_format(@$sutotales[0]["total"], 2, '.', ''); ?></td>

  </tr>





  <tr>

  <td></td>

  <td></td>

  <td></td>

  <td class="css_precio" >Sub.T No obj Impuesto:</td>

  <td class="css_precio" ><?php echo number_format(@$sutotales[6]["total"], 2, '.', ''); ?></td>

  </tr>

 

 

   <tr>

  <td></td>

  <td></td>

  <td></td>

  <td class="css_precio" >Sub.T Exento IVA: </td>

  <td class="css_precio" ><?php echo number_format(@$sutotales[7]["total"], 2, '.', ''); ?></td>

  </tr>

 

 

    <tr>

  <td></td>

  <td></td>

  <td></td>

  <td class="css_precio" >Descuento:</td>

  <td class="css_precio" ><?php echo $descuento_general; ?></td>

  </tr>    

  <?php

		

		if(@$sutotales[3]["conimpuesto"])

		{

        ?>

		

  <tr>

  <td></td>

  <td></td>

  <td></td>

  <td class="css_precio" >IVA <?php echo $iva_valor; ?>:</td>

  <td class="css_precio" ><?php echo number_format(@$sutotales[3]["conimpuesto"], 2, '.', ''); ?></td>

  </tr> 

 <?php

 }

 else

 {

 ?>		

   <tr>

  <td></td>

  <td></td>

  <td></td>

  <td class="css_precio" >IVA <?php echo @$iva_valor; ?>:</td>

  <td class="css_precio" ><?php echo number_format(@$sutotales[2]["conimpuesto"], 2, '.', ''); ?></td>

  </tr> 

  

  <?php

  }

  ?>

   <tr>

  <td></td>

  <td></td>

  <td></td>

  <td class="css_precio" >TOTAL:</td>

  <td class="css_precio" ><?php 

		  $total_apagar=$suma_general+@$sutotales[2]["conimpuesto"]+@$sutotales[3]["conimpuesto"]-$descuento_general;

		  echo number_format($total_apagar, 2, '.', '');

		   ?></td>

  </tr>   

</table></td>
  </tr>
</table>
<br />
<?php
echo '<span style="font-size:11px">'.$atendido_por.$atencion_data."</span>";

?>
<br />
OBSERVACION: <br />
<div style="font-size:11px">

</div>
=================================================
Este documento no tiene valor tributario<br />

<?php
if($nimpresion==1)
{
  echo '<br>IMPRESI&Oacute;N '.$rscampos_valor->fields["doccab_fechaemision_cliente"];
}
else
{
  echo '<br>REIMPRESI&Oacute;N '.date("Y-m-d H:i:s");
}
?>

<div class="css_table" ></div>

<div class="css_table" ><?php echo $usuario_factura; ?></div>
<br />

