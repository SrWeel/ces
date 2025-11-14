<?php
$listab=$objacceso_session->sess_ci;
//$campo="alu_id";
//$obp="num";  
//$table="bec_infoacademica";
include($director."modules/script/script.php");

$objformulario->systemb=$system;
$objformulario->apl=$apl;
$objformulario->seccapl=$seccapl;
$objformulario->sessid=$sessid;
$objformulario->aplweb=$apl;
$objformulario->portalweb=$portal;
$objformulario->tiposis="web";
//se ejecuta despues de validar
$objformulario->funciones_ext=$funciones_externas;
//se ejecuta despues de validar

$objformulario->pathexterno=$director;
$objformulario->pathexternoimp="";
$objformulario->campos_formatoc=$campos_tipo;	

$objformulario->idvalor_validador=$csearch;

include($director."libreria/func_g.php");
include($director."script/edicion.sc");

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
	 
	 include ($director.$template_reemplazo."formulario.php");
   }
   else
   {
    $objtableform->select_templateform($table,$DB_gogess);
	 include ($director.$objtableform->path_templateform."formulario.php"); 
    }  
 
 }
 

	?>	
	
</td>
  </tr>
  <tr>
  <td>
  </td>
  </tr>
</table>

<?php 
 echo $botonenvio;
?>

