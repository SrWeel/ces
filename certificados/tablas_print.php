<?php
require_once(@$director."libreria/script/script.php");
$objformulario->systemb=@$system;
$objformulario->apl=@$apl;
$objformulario->seccapl=@$seccapl;
$objformulario->sessid=@$sessid;
$objformulario->aplweb=@$apl;
$objformulario->portalweb=@$portal;
$objformulario->tiposis="web";
$objformulario->imprpt=1;
//se ejecuta despues de validar
$objformulario->funciones_ext=@$funciones_externas;
//se ejecuta despues de validar

$objformulario->pathexterno=@$director;
$objformulario->pathexternoimp=@$director;
$objformulario->campos_formatoc=@$campos_tipo;	
$objformulario->idvalor_validador=@$csearch;


require_once(@$director."libreria/func_g.php");
require_once(@$director."libreria/edicion.php");

if ($table)
 {    

   if($template_reemplazo)
   {

     //$objtableform->select_templateform($table,$DB_gogess);

	 $objformulario->formulario_path=$template_reemplazo;

	 require_once (@$director.$template_reemplazo."formulario.php");

	 

   }

   else

   {

    $objtableform->select_templateform($table,$DB_gogess);

	 $objformulario->formulario_path=$objtableform->path_templateform;

	 require_once ($director.$objtableform->path_templateform."formulario.php"); 

	

    }  

 

 }



?>

<p>&nbsp;</p>

<p>&nbsp;</p>