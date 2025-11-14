<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
header('Content-Type: text/html; charset=UTF-8');
$tiempossss="44450000";
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


$categ_id=$_POST["categ_id"];



if(@$_SESSION['ces1313777_sessid_inicio'])
{
$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");
$sqltotal="";

$objformulario= new  ValidacionesFormulario();

?>
  <select name="codigo_pr" id="codigo_pr" style="font-size:11px; width:120px" onchange="ver_listalotes()" >
          <?php
	          printf("<option value=''>---Categorias--</option>");  
			  $objformulario->fill_cmb("cmb_dns_cuadrobasicomedicamentos","cuadrobm_codigoatc,nombre_med",""," where categ_id='".$categ_id."' order by nombre_med asc",$DB_gogess);
           ?>
      </select>
<?php

}
?>