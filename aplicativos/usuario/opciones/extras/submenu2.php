<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
include("../../../../cfgclases/sessiontime.php");
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director="../../../../";
include ("../../../../cfgclases/clases.php");
?>

<select name="nivel3_val" class="Estilo2" id="nivel3_val">
		  <?php
	          printf("<option value=''>---Seleccionar--</option>");  
			  $objformulario->fill_cmb("ktkwe_menu","id,title",$nivel3_val," where level=3 and component_id in(22,2) and menutype='mainmenu' and parent_id=".$_POST["nivel2_val"]." and published=1 order by lft asc",$DB_gogess);
           ?>
        </select>
	