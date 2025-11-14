<?php
ini_set('display_errors',0);
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

if($_POST["emp_id"])
{

$listacajas="select distinct efacsistema_establecimiento.estab_id,estab_codigo from efacsistema_puntoemision,efacsistema_establecimiento where  efacsistema_puntoemision.estab_id=efacsistema_establecimiento.estab_id and estab_estado=1 and emp_id=".$_POST["emp_id"]." and efacsistema_establecimiento.centro_id=".$_SESSION['ces1313777_centro_id'];	 

$rs_lcajas = $DB_gogess->executec($listacajas,array());

//echo $listacajas;
?>

<select name="estab_id" class="Estilo3" id="estab_id"  onclick="busca_caja()"  >
	      <option value="0">--Seleccionar--</option>

		<?php
		 if($rs_lcajas)
	       {
		       while (!$rs_lcajas->EOF) {

				  if(trim($siempresa)==$usuarioempresa)
				  {

			   echo '<option value="'.$rs_lcajas->fields["estab_id"].'">'.$rs_lcajas->fields["estab_codigo"].'</option>';

				  }

			    $rs_lcajas->MoveNext();

			   }

		   }

		
		  ?>

	      </select>

<?php

}

?>		  