<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
include("../../../../cfgclases/sessiontime.php");
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director="../../../../";
include ("../../../../cfgclases/clases.php");

//$buscapath="select * from ktkwe_menu where id=".$_POST["parent_id"];
////$resultnum = $DB_gogess->Execute($buscapath);	
//$valornum=$resultnum->fields["path"];
//echo $valornum;
?>
<input name="link_valor" type="hidden" id="link_valor" value="<?php echo "index.php?option=com_content&view=article&id=".$_POST["articulo_val"] ?>" />