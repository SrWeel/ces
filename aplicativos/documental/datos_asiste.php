<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=144000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

//echo @$_SESSION['ces1313777_sessid_inicio'];
if(@$_SESSION['ces1313777_sessid_inicio'])
{
//echo $_POST["pVar1"];
//Llamando objetos
$table='app_cliente';  
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
 if ($table)
  {
  $objtableform->select_templateform(@$table,$DB_gogess);	
  }
$objformulario->sisfield_arr=$gogess_sisfield;
$objformulario->sistable_arr=$gogess_sistable;
$comillasimple="'";



     
	
	$em_id_val=0;	
		

	$variableb=0;
			if($_POST["pVar1"]=='undefined')
				  {
					 $variableb=0;
				  }
				  else
				  {
					 $variableb=$_POST["pVar1"];
					 $_REQUEST["opcion_".$table]="buscar";
			         $csearch=$_POST["pVar1"];				 
				  }


if($csearch)
{
$busca_datosus="select * from app_cliente where clie_id=?";
$rs_usuarios = $DB_gogess->executec($busca_datosus,array(@$csearch));
}	



}
?>

<style type="text/css">

<!--

.css_texto {
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:11px;


}

-->

</style>

<table width="300" border="1" align="center" cellpadding="0" cellspacing="0">

<?php


$busca_evento="select * from app_eventos where even_activo=? and emp_id=?";
$rs_evento = $DB_gogess->executec($busca_evento,array(1,$_SESSION['ces1313777_sessid_emp_id']));
if($rs_evento)
	       {
		       while (!$rs_evento->EOF) {
			   
			   
			   
			   $busca_regi="select * from app_clienteeventos where clie_id=".@$csearch." and even_id=".$rs_evento->fields["even_id"];
               $rs_regi = $DB_gogess->executec($busca_regi,array());
			   $chequea='';
			   if($rs_regi->fields["clieve_activo"]==1)
			    {
				
				 $chequea='checked="checked"';
				}
				else
				{
				
				 $chequea='';
				}
                

			   
			   $link_ejecuta="onclick=guardar_chek('app_clienteeventos','clieve_activo','".$rs_evento->fields["even_id"]."','check_activadesactiva','".@$csearch."')";
			   
			  echo' <tr>
    <td class="css_texto" >'.utf8_encode($rs_evento->fields["even_nombre"]).'</td>
    <td><input name="check_'.$rs_evento->fields["even_id"].'" type="checkbox" id="check_'.$rs_evento->fields["even_id"].'" value="1" '.$link_ejecuta.' '.$chequea.' /></td>
  </tr>';   
				 
				 $rs_evento->MoveNext(); 
			   }
			}   

?>
 
</table>
<div id="check_activadesactiva"></div>
