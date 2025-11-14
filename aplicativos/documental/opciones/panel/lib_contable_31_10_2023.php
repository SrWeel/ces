<?php
/**
 * Contable Funciones
 * 
 * Este archivo permite obtener funciones standar para el sistema.
 * 
 * @author Franklin Aguas <franklin.aguas@gmail.com>
 * @version 1.0
 * @package util_funciones
 */

class contable_funciones{

var $DB_gogess;

function despliegue_form($namemodulo,$mnupan_id)
{

$contenido='';   
   
$subindice_modulo="_".$namemodulo;
$carpeta_modulo=$namemodulo;

$comill_s="'";
$cliente_valor="";
$linkeditar= 'onClick="ver_formularioenpantalla('.$comill_s.'aplicativos/documental/datos_'.$namemodulo.'.php'.$comill_s.','.$comill_s.'FORMULARIO'.$comill_s.','.$comill_s.'divBody_interno_'.$namemodulo.$comill_s.','.$comill_s.$comill_s.',0,'.$comill_s.$mnupan_id.$comill_s.',0,0,0,0)" style=cursor:pointer';	

$contenido.='<div>';
$contenido.='<button type="button" class="mb-sm btn btn-primary"  '.$linkeditar.'  style="background-color:#000066"  ><span class="glyphicon glyphicon-plus"></span>NUEVO</button>';


$ilistx=1;
$buscareporte="select * from rose_variabledeveloper where rept_publicado=1 and rept_activo=1 and mnupan_id='".$mnupan_id."'";
$rs_gogessform = $this->DB_gogess->executec($buscareporte,array());
if($rs_gogessform)
 {

     	while (!$rs_gogessform->EOF) {		
		    $ilistx++;	
	
$linkeditarbtn=' onclick="ver_reportedatamodulo('.$rs_gogessform->fields["vardev_id"].')" ';

$contenido.='&nbsp;&nbsp;<button type="button" class="mb-sm btn btn-primary"  '.$linkeditarbtn.'  style="background-color:#000066"  ><span class="glyphicon glyphicon-plus"></span>'.$rs_gogessform->fields["vardev_nombre"].'</button>';
		
		
		$rs_gogessform->MoveNext();	
		}
 }		




$contenido.='</div>';
$contenido.='<div id="divBody_interno'.$subindice_modulo.'" ></div><p>&nbsp;</p><div align="center" id="grid'.$subindice_modulo.'" ></div>';	
   
return $contenido;

}


function despliegue_scripts($mnupan_id,$namemodulo)
{

$scritp_valor='';
$scritp_valor.='
function desplegar_grid_'.$namemodulo.'()
{

$("#grid_'.$namemodulo.'").load("aplicativos/documental/opciones/grid/'.$namemodulo.'/grid_'.$namemodulo.'.php",{

  pVar2:"",
  pVar3:"'.$mnupan_id.'",
  indice_grid:"_'.$namemodulo.'",
  namemodulo:"'.$namemodulo.'"

  },function(result){  

  });  

  $("#grid_'.$namemodulo.'").html("Espere un momento");  

}';

$scritp_valor.='
desplegar_grid_'.$namemodulo.'();';

return $scritp_valor;

}



}

?>