<?php
@$tiempossss=445544000;
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









if($_POST["opcion"]==1)

{

 

 $objformulario->formulario_guardar($_POST["tabla"],$_POST,$typesql,$varsend,$listab,$campo,$obp,$DB_gogess);



}







if($_POST["opcion"]==2)

{

 

 //$objformulario->formulario_guardar($_POST["tabla"],$_POST,$typesql,$varsend,$listab,$campo,$obp,$DB_gogess);

   $idab=$_POST["idv"]."=".$_POST[$_POST["idv"]];

   $objformulario->formulario_update($_POST["tabla"],$_POST,$typesql,$idab,$varsend,$listab,$campo,$obp,$DB_gogess);



}





if($objformulario->okinsertado)

{

    echo " var result_global = '1'; ";

	echo " var result_lote = '".$objformulario->mensajelote."'; ";

	echo " var result_insertado = '".$objformulario->nuevoid."'; ";

	

}

else

{

   echo " var result_global = '0'; ";

   echo " var result_lote = '".$objformulario->mensajelote."'; ";

   echo " var result_insertado = '0'; ";

   



}



//$buscasiguardo=

//



?>