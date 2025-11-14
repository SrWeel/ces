<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
header('Content-Type: text/html; charset=UTF-8');
$tiempossss="44450000";
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


$categ_id=$_POST["categ_id"];
$codigo_pr=$_POST["codigo_pr"];



if(@$_SESSION['ces1313777_sessid_inicio'])
{
$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");
$sqltotal="";

$objformulario= new  ValidacionesFormulario();

$busca_nmedic="select * from dns_cuadrobasicomedicamentos where cuadrobm_codigoatc='".$codigo_pr."'";
$rs_nmedic= $DB_gogess->executec($busca_nmedic);


$per_activo=0;
$per_activo=$objformulario->replace_cmb("dns_periodobodega","perio_activo,perio_anio"," where perio_activo=",1,$DB_gogess);

?>
  <select name="lote_pr" id="lote_pr" style="font-size:11px; width:120px" >
          <?php
	          printf("<option value=''>---Categorias--</option>");  
			  $busca_lotes="select distinct moviin_nlote from dns_movimientoinventario where cuadrobm_id='".$rs_nmedic->fields["cuadrobm_id"]."' and perioac_id='".$per_activo."' and centro_id='".$_POST["centro_id"]."'";
			  $rs_lote= $DB_gogess->executec($busca_lotes);
			  if($rs_lote)
				{
					while (!$rs_lote->EOF) {
			         
					   echo '<option value="'.$rs_lote->fields["moviin_nlote"].'">'.$rs_lote->fields["moviin_nlote"].'</option>';
			           
			  
					   $rs_lote->MoveNext();
				 }
			 }
           ?>
      </select>
<?php

}
?>