<?php
include("../../cfgclases/sessiontime.php");
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
?>
<?php
$table=$_POST["tabla"];
//Llamando objetos
$director="../../";
include_once("../../cfgclases/clases.php");

//

$separa_data=explode(",",@$objtableform->tab_campoprimario);
$separa_tipo=explode(",",@$objtableform->tab_tipocampoprimariio);

$objformulario->essri=@$objtableform->tab_sri;
$objformulario->camposri=@$objtableform->tab_camposecsri;

//echo "holass".$_POST["opcion"];

if($_POST["opcion"]=='actualizar')
{
	for ($i_campo=0;$i_campo<count($separa_data);$i_campo++)
	{
	
	   if($separa_tipo[$i_campo]=='int')
	   {
		  $cocatenafiltro=@$cocatenafiltro.@$separa_data[$i_campo]."=".@$_POST[$separa_data[$i_campo]]." and ";
	   }
	
	   if($separa_tipo[$i_campo]=='string')
	   {
		  $cocatenafiltro=$cocatenafiltro.$separa_data[$i_campo]."='".$_POST[$separa_data[$i_campo]]."' and ";
	   } 
		
	}
	$cocatenafiltro=substr($cocatenafiltro,0,-4);


}

//$buscasiguardo=
//

if($_POST["opcion"]=='actualizar')
{
 $objformulario->formulario_update($_POST["tabla"],$_POST,@$typesql,@$cocatenafiltro,@$varsend,@$listab,@$campo,@$obp,$DB_gogess);
}

if($_POST["opcion"]=='guardar')
{
 $objformulario->formulario_guardar(@$_POST["tabla"],$_POST,@$typesql,@$varsend,@$listab,@$campo,@$obp,$DB_gogess);

}

if($objformulario->okinsertado)
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