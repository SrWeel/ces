<?php
$tiempossss=455550000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_SESSION['ces1313777_sessid_inicio'])
{
$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");
$sqltotal="";


$objformulario= new  ValidacionesFormulario();



	         echo '<select name="proveevar_id" id="proveevar_id" class="form-control" >
			 <option value="">---Seleccionar--</option>';

			 $objformulario->fill_cmb('app_proveedor','provee_id,provee_nombre','','order by provee_nombre asc',$DB_gogess);			 

			 echo '</select>';


}
?>