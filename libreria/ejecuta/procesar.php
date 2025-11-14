<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=445544000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director='../../';
@$table=$_POST["tabla"];

$file = fopen("tnlprueba".date("Y-m-d")."_".@$_SESSION['ces1313777_centro_id'].".txt", "a+");
fwrite($file, @$table . PHP_EOL);
fclose($file);	

//leer con json
$lista_tbldata=array('gogess_sisfield','gogess_sistable');
$contenido = file_get_contents(@$director."jason_files/tablas/".$table.".json");
$gogess_sistable = json_decode($contenido, true);
$contenido = file_get_contents(@$director."jason_files/estructura/".$table.".json");
$gogess_sisfield = json_decode($contenido, true);
//leer con json 


//Llamando objetos
include_once("../../cfg/clases.php");
include_once("../../cfg/declaracion.php");
$objtableform= new templateform();
$objtableform->select_templateform($table,$DB_gogess);
$objformulario= new  ValidacionesFormulario();
$objformulario->sisfield_arr=$gogess_sisfield;
$objformulario->sistable_arr=$gogess_sistable;
//

//echo $objtableform->tab_tipocampoprimariio;
$separa_data=explode(",",$objtableform->tab_campoprimario);
$separa_tipo=explode(",",$objtableform->tab_tipocampoprimariio);
$objformulario->essri=$objtableform->tab_sri;
$objformulario->tab_historialmedico=$objtableform->tab_historialmedico;
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

 


    if($_POST["tabla"]=='dns_compras' and @$_POST["tipdoc_id"]=='19')
	{
	   $objformulario->formulario_guardarlq($_POST["tabla"],$_POST,@$typesql,@$listab,@$campo,@$obp,$DB_gogess);  
	   //$sql_1x='LQ'; 
	   //$file = fopen("envio".date("Y-m-d")."_".@$_SESSION['ces1313777_centro_id'].".txt", "a+");
       //fwrite($file,$_SESSION['ces1313777_sessid_inicio']."-->".$sql_1x."-->".date("Y-m-d H:i:s"). PHP_EOL);
       //fclose($file);

	}
	else
	{
  //------------------------------------------------   

	   $objformulario->formulario_guardar($_POST["tabla"],$_POST,@$typesql,@$listab,@$campo,@$obp,$DB_gogess); 
	   //$sql_1x='NORMAL'; 
	  //$file = fopen("envio".date("Y-m-d")."_".@$_SESSION['ces1313777_centro_id'].".txt", "a+");
      //fwrite($file,$_SESSION['ces1313777_sessid_inicio']."-->".$sql_1x."-->".date("Y-m-d H:i:s"). PHP_EOL);
      //fclose($file);


  //------------------------------------------------
   }
  

  

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