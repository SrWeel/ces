<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
define("UTF_8", 1);
define("ASCII", 2);
define("ISO_8859_1", 3);



$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");

$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();

if($_POST["pestab_id"])
{

	
$listacajas="select distinct efacsistema_puntoemision.pemision_id,pemision_num from efacsistema_puntoemision,efacsistema_establecimiento where   efacsistema_puntoemision.estab_id=efacsistema_establecimiento.estab_id and 	pemision_sino=1 and efacsistema_establecimiento.estab_id=".$_POST["pestab_id"];	 

$rs_lcajas = $DB_gogess->executec($listacajas,array());


?>
<select name="pemision_id" class="Estilo3" id="pemision_id"  >
	      <option value="0">--Seleccionar--</option>

		<?php


		 if($rs_lcajas)
	       {
		       while (!$rs_lcajas->EOF) {		   

			   echo '<option value="'.$rs_lcajas->fields["pemision_id"].'">'.$rs_lcajas->fields["pemision_num"].'</option>';

 

			    $rs_lcajas->MoveNext();

			   }

		  

		   }

		  ?>
	      </select>
<?php

}

?>		  