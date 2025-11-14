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

$descuento_gen=0;
if($_POST["valorp"]>=0)
{
	
$descuento_gen=$_POST["valorp"];
	
$actualiza="update ".$_POST["tablap"]." set ".$_POST["campop"]."='".$_POST["valorp"]."' where ".$_POST["idtablap"]."='".$_POST["id_detallep"]."'";
$rs_actualiza = $DB_gogess->executec($actualiza);

	 
$saca_total="select ((docdet_cantidad*docdet_preciou)-docdet_descuento) as total_valor from app_documentodetalle where doccab_id='".$_POST["id_detallep"]."'";
$rs_totallinea= $DB_gogess->executec($saca_total);





$actualizax="update ".$_POST["tablap"]." set docdet_total='".$rs_totallinea->fields["total_valor"]."' where ".$_POST["idtablap"]."='".$_POST["id_detallep"]."'";
$rs_actualizax = $DB_gogess->executec($actualizax);

'<input name="total_linea" type="hidden" id="total_linea" value="'.number_format($rs_totallinea->fields["total_valor"], 2, '.', '').'">';


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
 $lista_totales="select sum(docdet_total) as total,app_documentodetalle.tari_codigo,tari_valor from app_documentodetalle inner join app_tarifa on app_documentodetalle.tari_codigo=app_tarifa.tari_codigo where ".$rs_detalle->fields["subgri_campoenlace"]."='".$_POST["enlace"]."' group by tari_codigo";
 $rs_totales = $DB_gogess->executec($lista_totales,array());
 if($rs_totales)
 {
	  while (!$rs_totales->EOF) {	
	  
	  $sutotales[$rs_totales->fields["tari_codigo"]]["total"]=$rs_totales->fields["total"];
	  $sutotales[$rs_totales->fields["tari_codigo"]]["valor"]=$rs_totales->fields["tari_valor"];
	  $sutotales[$rs_totales->fields["tari_codigo"]]["conimpuesto"]=($rs_totales->fields["total"]*$rs_totales->fields["tari_valor"])/100;
	  $suma_general+=$rs_totales->fields["total"];
	  
	  
	 $rs_totales->MoveNext();	
	  }
  }	  


  $total_apagar=$suma_general+@$sutotales[2]["conimpuesto"]+@$sutotales[3]["conimpuesto"]-$descuento_gen;
  
  
		
echo '<input name="subtotaliva1" type="hidden" id="subtotaliva1" value="'.number_format(@$sutotales[3]["total"], 2, '.', '').'">';
echo '<input name="subtotaliva01" type="hidden" id="subtotaliva01" value="'.number_format(@$sutotales[0]["total"], 2, '.', '').'">';
echo '<input name="subtotalnoobj1" type="hidden" id="subtotalnoobj1" value="'.number_format(@$sutotales[6]["total"], 2, '.', '').'">';
echo '<input name="subtotalexentoiva1" type="hidden" id="subtotalexentoiva1" value="'.number_format(@$sutotales[7]["total"], 2, '.', '').'">';
echo '<input name="iva1" type="hidden" id="iva1" value="'.number_format(@$sutotales[3]["conimpuesto"], 2, '.', '').'">';
echo '<input name="total1" type="hidden" id="total1" value="'.number_format($total_apagar, 2, '.', '').'">';


?>

