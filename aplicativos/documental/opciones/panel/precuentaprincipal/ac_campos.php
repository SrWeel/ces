<?php
header('Content-Type: text/html; charset=UTF-8');
$tiempossss=44450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

/*echo $_POST["tabla"]."<br>";
echo $_POST["campo"]."<br>";
echo $_POST["id"]."<br>";
echo $_POST["valor"]."<br>";*/

if($_SESSION['ces1313777_sessid_inicio'])
{
$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");

$sqltotal="";

$lista_precuentas="select * from dns_detalleprecuentaprincipal"; 
$okvalor=$DB_gogess->executec($lista_precuentas); 
 
 if($okvalor)
 {
	  while (!$okvalor->EOF) {
	  
	  $busca_cliente="select * from app_cliente where clie_id='".$okvalor->fields["clie_id"]."'";
      $rs_bcliente = $DB_gogess->executec($busca_cliente,array());	  
      $conve_id=$rs_bcliente->fields["conve_id"];
	  
	  $pvp_enformula=0;
      $pvp_enformula=$objFormulascontable->formulas_pvp($conve_id,$okvalor->fields["detapre_precio"],$DB_gogess);
	  
	  $actualiza_data="update dns_detalleprecuentaprincipal set detapre_precioventa='".$pvp_enformula."',conve_id='".$conve_id."' where detapre_id='".$okvalor->fields["detapre_id"]."'";
      $ac_data=$DB_gogess->executec($actualiza_data); 
	  
	  
	  $okvalor->MoveNext();
	  }
 }	  



}
?>