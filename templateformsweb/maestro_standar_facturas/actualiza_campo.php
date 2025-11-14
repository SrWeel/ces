<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=5414000;
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


if($_POST["valorp"]>=0)
{

$actualiza="update ".$_POST["tablap"]." set ".$_POST["campop"]."='".$_POST["valorp"]."' where ".$_POST["idtablap"]."=".$_POST["id_detallep"];
$rs_actualiza = $DB_gogess->executec($actualiza);

$saca_total="select ((docdet_cantidad*docdet_preciou)-docdet_descuento) as total_valor, (((docdet_cantidad*docdet_preciou)-docdet_descuento) * (docdet_porcentaje/100)) as valorimp from beko_documentodetalle where docdet_id=".$_POST["id_detallep"];
$rs_totallinea= $DB_gogess->executec($saca_total);



$actualizax="update ".$_POST["tablap"]." set docdet_total='".$rs_totallinea->fields["total_valor"]."',docdet_valorimpuesto='".$rs_totallinea->fields["valorimp"]."' where ".$_POST["idtablap"]."=".$_POST["id_detallep"];
$rs_actualizax = $DB_gogess->executec($actualizax);

echo '<input name="total_linea" type="hidden" id="total_linea" value="'.number_format($rs_totallinea->fields["total_valor"], $objimpuestos->cgfe_decimales, '.', '').'">';


}


$lista_detalle="select * from gogess_subgrid where subgri_id=".$_POST["idgrid"]; 
$rs_detalle = $DB_gogess->executec($lista_detalle,array());
$split_ncampo=explode(",",$rs_detalle->fields["subgri_camposlista"]);
 
 //busca campos a editar
 
$split_nedita=explode(",",$rs_detalle->fields["subgri_campoedita"]);
 
 
 
 $contador_det=0;
 $lista_data="select * from ".$rs_detalle->fields["subgri_nameenlace"]." where ".$rs_detalle->fields["subgri_campoenlace"]."='".$_POST["enlace"]."'";
 $rs_data = $DB_gogess->executec($lista_data,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	  
	  
	  $contador_det++;
	  
	  
        $indice_encontro ='';
		$campo_data='';
		$evento_data='';
		
	for($i=0;$i<count($split_ncampo);$i++)
	{
	  $indice_encontro ='';
	  $campo_data='';
	  $evento_data='';
	   $campo_val=$gogess_sisfield[$rs_detalle->fields["subgri_nameenlace"]."|".$split_ncampo[$i]];
	   if($campo_val["fie_name"]=='docdet_total')
	   {
	      $indice_encontro = array_search($campo_val["fie_name"],$split_nedita);
		  
		   
	   }
	   else
	   {
	       $indice_encontro = array_search($campo_val["fie_name"],$split_nedita);
		   
	       
		  
	   }
	}
	
	
	  
	  
	  $rs_data->MoveNext();	   
	  }
  }
  
  
  
   //totales
 $suma_general=0;
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

  $lista_descuentogeneral="select docdet_descuento_general from  beko_documentodetalle where ".$rs_detalle->fields["subgri_campoenlace"]."='".$_POST["enlace"]."' limit 1";
  $rs_dgeneral = $DB_gogess->executec($lista_descuentogeneral,array()); 
  $descuento_general=$rs_dgeneral->fields["docdet_descuento_general"];


  $total_apagar=($suma_general-$descuento_general)+@$sutotales[2]["conimpuesto"]+@$sutotales[3]["conimpuesto"];

if(@$sutotales[3]["total"])
	{		
     echo '<input name="subtotaliva1" type="hidden" id="subtotaliva1" value="'.number_format(@$sutotales[3]["total"], $objimpuestos->cgfe_decimales, '.', '').'">';
	 $guardar_doccab_subtotaliva=number_format(@$sutotales[3]["total"], $objimpuestos->cgfe_decimales, '.', '');
  }
  else
  {
     echo '<input name="subtotaliva1" type="hidden" id="subtotaliva1" value="'.number_format(@$sutotales[2]["total"], $objimpuestos->cgfe_decimales, '.', '').'">';
     $guardar_doccab_subtotaliva=number_format(@$sutotales[2]["total"], $objimpuestos->cgfe_decimales, '.', '');
  }


echo '<input name="subtotaliva01" type="hidden" id="subtotaliva01" value="'.number_format(@$sutotales[0]["total"], $objimpuestos->cgfe_decimales, '.', '').'">';
$guardar_doccab_subtotalsiniva=number_format(@$sutotales[0]["total"], $objimpuestos->cgfe_decimales, '.', '');

echo '<input name="subtotalnoobj1" type="hidden" id="subtotalnoobj1" value="'.number_format(@$sutotales[6]["total"], $objimpuestos->cgfe_decimales, '.', '').'">';
$guardar_doccab_subtnoobjetoi=number_format(@$sutotales[6]["total"], $objimpuestos->cgfe_decimales, '.', '');

echo '<input name="subtotalexentoiva1" type="hidden" id="subtotalexentoiva1" value="'.number_format(@$sutotales[7]["total"], $objimpuestos->cgfe_decimales, '.', '').'">';
$guardar_doccab_subtexentoiva=number_format(@$sutotales[7]["total"], $objimpuestos->cgfe_decimales, '.', '');

if(@$sutotales[3]["total"])
	{
echo '<input name="iva1" type="hidden" id="iva1" value="'.number_format(@$sutotales[3]["conimpuesto"], $objimpuestos->cgfe_decimales, '.', '').'">';
$guardar_doccab_iva=number_format(@$sutotales[3]["conimpuesto"], $objimpuestos->cgfe_decimales, '.', '');
}
else
{
echo '<input name="iva1" type="hidden" id="iva1" value="'.number_format(@$sutotales[2]["conimpuesto"], $objimpuestos->cgfe_decimales, '.', '').'">';
$guardar_doccab_iva=number_format(@$sutotales[2]["conimpuesto"], $objimpuestos->cgfe_decimales, '.', '');

}

echo '<input name="total1" type="hidden" id="total1" value="'.number_format($total_apagar, $objimpuestos->cgfe_decimales, '.', '').'">';
$guardar_doccab_total=number_format($total_apagar, $objimpuestos->cgfe_decimales, '.', '');


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
?>

