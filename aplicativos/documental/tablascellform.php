<?php
require_once(@$director."libreria/script/scriptcellform.php");
$objformulario->systemb=@$system;
$objformulario->apl=@$apl;
$objformulario->seccapl=@$seccapl;
$objformulario->sessid=@$sessid;
$objformulario->aplweb=@$apl;
$objformulario->portalweb=@$portal;
$objformulario->tiposis="web";
//se ejecuta despues de validar
$objformulario->funciones_ext=@$funciones_externas;
//se ejecuta despues de validar
$objformulario->pathexterno=@$director;
$objformulario->pathexternoimp="";
$objformulario->campos_formatoc=$campos_tipo;	
$objformulario->idvalor_validador=@$csearch;
require_once(@$director."libreria/func_g.php");
require_once(@$director."libreria/edicioncellform.php");
?>
<style type="text/css">
<!--
.Estilo1 {
	font-size: 11px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
-->
</style>
<table border="0" align="center" cellpadding="2" cellspacing="2">
  <tr>
    <td>   

<?php	
if ($table)
 {    

   if($template_reemplazo)
   {
     //$objtableform->select_templateform($table,$DB_gogess); 

	 require_once (@$director.$template_reemplazo."formulario.php");
   }
   else
   {
    $objtableform->select_templateform($table,$DB_gogess);
	 require_once ($director.$objtableform->path_templateform."formulario.php"); 
    }
 }
?>	
</td>
  </tr>
</table>
<?php 
 echo $botonenvio;
?>