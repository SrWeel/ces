
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
$listaordencont="select * from ktkwe_menu where parent_id=".$_POST["parent_id"]." order by rgt desc";
//echo $listaordencont;
$resultnum = $DB_gogess->Execute($listaordencont);	
$valornum=$resultnum->fields["rgt"]+1;

$val1=$resultnum->fields["rgt"]+1;
 $val2=$resultnum->fields["rgt"]+2;
 
 //echo $val1."<br>";
  //echo $val2."<br>";
  
  
  $buscamenu="select * from ktkwe_menu where id=".$_POST["id"];
  
  $resultnumx = $DB_gogess->Execute($buscamenu);
 // echo $resultnumx->fields["rgt"];
  if($resultnumx->fields["rgt"])
  {
  
  }
  else
  {
  
  $actualizacontx="update ktkwe_menu set lft=".$val1.", rgt=".$val2."	 where id=".$_POST["id"];
 // echo $actualizacontx;
  $okval2x= $DB_gogess->Execute($actualizacontx);
  
  }




?>