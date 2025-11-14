<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=144000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director='../../../';
include(@$director."libreria/estructura/aqualis_master.php");
for($itbl=0;$itbl<count($lista_tbldata);$itbl++)
 {
  include(@$director."libreria/estructura/".$lista_tbldata[$itbl].".php");
 } 
 
$table=$_POST["tabla"];
//Llamando objetos

include("../../../cfg/clases.php");
include("../../../cfg/declaracion.php");
$objtableform= new templateform();
$objtableform->select_templateform($table,$DB_gogess);
$objformulario= new  ValidacionesFormulario();
$objformulario->sisfield_arr=$gogess_sisfield;
$objformulario->sistable_arr=$gogess_sistable;
//


$separa_data=explode(",",$objtableform->tab_campoprimario);
$separa_tipo=explode(",",$objtableform->tab_tipocampoprimariio);

$objformulario->essri=$objtableform->tab_sri;
$objformulario->camposri=$objtableform->tab_camposecsri;


if($_POST["opcion"]=='actualizar')
{
	for ($i_campo=0;$i_campo<count($separa_data);$i_campo++)
	{
	
	   if(trim($separa_tipo[$i_campo])=='int')
	   {
		  @$cocatenafiltro=$cocatenafiltro.$separa_data[$i_campo]."=".$_POST[$separa_data[$i_campo]]." and ";
	   }
	
	   if(trim($separa_tipo[$i_campo])=='string')
	   {
		  @$cocatenafiltro=$cocatenafiltro.$separa_data[$i_campo]."='".$_POST[$separa_data[$i_campo]]."' and ";
	   } 
		
	}
	@$cocatenafiltro=substr($cocatenafiltro,0,-4);


}
//echo $cocatenafiltro;
//$buscasiguardo=
//


if($_POST["opcion"]=='actualizar')
{
 $objformulario->formulario_update($_POST["tabla"],@$_POST,@$typesql,@$cocatenafiltro,@$listab,@$campo,@$obp,$DB_gogess);
}

if($_POST["opcion"]=='guardar')
{
 

  //------------------------------------------------   
	      $objformulario->formulario_guardar($_POST["tabla"],$_POST,@$typesql,@$listab,@$campo,@$obp,$DB_gogess);
	  
  //------------------------------------------------
  
  
}


if(@$objformulario->okinsertado)
{
    echo " var result_global = '1'; ";
	echo " var result_lote = '".@$objformulario->mensajelote."'; ";
	echo " var result_insertado = '".@$objformulario->nuevoid."'; ";
	
}
else
{
   echo " var result_global = '0'; ";
   echo " var result_lote = '".@$objformulario->mensajelote."'; ";
   echo " var result_insertado = '0'; ";
   

}
?>