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
include("../../cfgclases/clases.php");
//


$separa_data=explode(",",$objtableform->tab_campoprimario);
$separa_tipo=explode(",",$objtableform->tab_tipocampoprimariio);




if($_POST["opcion"]=='actualizar')
{
	for ($i_campo=0;$i_campo<count($separa_data);$i_campo++)
	{
	
	   if(trim($separa_tipo[$i_campo])=='int')
	   {
		  $cocatenafiltro=$cocatenafiltro.$separa_data[$i_campo]."=".$_POST[$separa_data[$i_campo]]." and ";
	   }
	
	   if(trim($separa_tipo[$i_campo])=='string')
	   {
		  $cocatenafiltro=$cocatenafiltro.$separa_data[$i_campo]."='".$_POST[$separa_data[$i_campo]]."' and ";
	   } 
		
	}
	$cocatenafiltro=substr($cocatenafiltro,0,-4);


}
//echo $cocatenafiltro;
//$buscasiguardo=
//


if($_POST["opcion"]=='actualizar')
{
 $objformulario->formulario_update($_POST["tabla"],$_POST,$typesql,$cocatenafiltro,$varsend,$listab,$campo,$obp,$DB_gogess);
}

if($_POST["opcion"]=='guardar')
{
 

  //------------------------------------------------
  
  switch ($_POST["tabla"]) {
    case 'comprobante_fac_cabecera':
        {
		   $objformulario->formulario_guardar_factura($_POST["tabla"],$_POST,$typesql,$varsend,$listab,$campo,$obp,$DB_gogess);
		}
        break;
    case 'comprobante_credito_cab':
        {
		   $objformulario->formulario_guardar_credito($_POST["tabla"],$_POST,$typesql,$varsend,$listab,$campo,$obp,$DB_gogess);
		}
        break;

   case 'comprobante_retencion_cab':
        {
		   $objformulario->formulario_guardar_retencion($_POST["tabla"],$_POST,$typesql,$varsend,$listab,$campo,$obp,$DB_gogess);
		}
        break;

    default:
       {
	      $objformulario->formulario_guardar($_POST["tabla"],$_POST,$typesql,$varsend,$listab,$campo,$obp,$DB_gogess);
	   }
}
  
  //------------------------------------------------
  
  
}

if($objformulario->okinsertado)
{
    echo " var result_global = '1'; ";
	echo " var result_lote = '".$objformulario->mensajelote."'; ";
}
else
{
   echo " var result_global = '0'; ";
   echo " var result_lote = '".$objformulario->mensajelote."'; ";
   

}
?>