
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
<?php
$listaordencont="select * from ktkwe_content where catid=".$_POST["catid"]." order by ordering desc";
$resultnum = $DB_gogess->Execute($listaordencont);	
$valornum=$resultnum->fields["ordering"]+1;

$actualizacontx="update ktkwe_content set 	ordering=".$valornum." where id=".$_POST["id"];
$okval2x= $DB_gogess->Execute($actualizacontx);


$buscacategoria="select * from ktkwe_assets where name like '%category.".$_POST["catid"]."'";

//

	$resultadolktr = $DB_gogess->Execute($buscacategoria);	
	if($resultadolktr)
	{  
      while (!$resultadolktr->EOF) {
  
	  $idassent=$resultadolktr->fields["id"];
	  
	  $resultadolktr->MoveNext();
	  }
	 } 

//busca id buscar
$buscalista="select * from ktkwe_assets where parent_id=".$idassent." order by rgt asc";
$resultadolktr1 = $DB_gogess->Execute($buscalista);	
	if($resultadolktr1)
	{  
      while (!$resultadolktr1->EOF) {
  
	  $ordeval=$resultadolktr1->fields["rgt"];
	  
	  $resultadolktr1->MoveNext();
	  }
	 }
	 $num1=$ordeval+1;
	 $num2=$ordeval+2;
//busca id buscar	 
$banderab=0;
//busca articulo en el assent
$buscalistax="select * from ktkwe_assets where name='com_content.article.".$_POST["id"]."' order by rgt asc";
$resultadolktr1x = $DB_gogess->Execute($buscalistax);	
	if($resultadolktr1x)
	{  
      while (!$resultadolktr1x->EOF) {
  
	  $banderab=$resultadolktr1x->fields["id"];
	  
	  $resultadolktr1x->MoveNext();
	  }
	 }

//busca articulo en el assent
if(!($banderab))
{
	//echo $idassent; 
	$parametro='{"core.delete":[],"core.edit":[],"core.edit.state":[]}';
	$sqlasent="INSERT INTO ktkwe_assets ( parent_id, lft, rgt, level, name, title, rules) VALUES (".$idassent.", ".$num1.", ".$num2.", 4, 'com_content.article.".$_POST["id"]."', '".$_POST["title"]."', '".$parametro."');";
	$okval= $DB_gogess->Execute($sqlasent);
	$nuevoidv=$DB_gogess->Insert_ID();
	 $actualizacont="update ktkwe_content set 	asset_id=".$nuevoidv." where id=".$_POST["id"];
	 $okval2= $DB_gogess->Execute($actualizacont);
	//echo $sqlasent;
	}
	else
	{
	  $actualizacont="update ktkwe_content set 	asset_id=".$banderab." where id=".$_POST["id"];
	  
	   $okval2= $DB_gogess->Execute($actualizacont);
	
	}

?>