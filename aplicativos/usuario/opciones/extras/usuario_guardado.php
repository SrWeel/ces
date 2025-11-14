<?php
include("../../../../cfgclases/sessiontime.php");
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director="../../../../";
include ("../../../../cfgclases/clases.php");

if(isset($_SESSION['ces1313777_sessid_inicio']))
{

$busca_factura="select * from factur_usuarios where usr_cedula='".$_POST["usr_cedula"]."'"; 
$rs_buscaid = $DB_gogess->Execute($busca_factura); 
				  if($rs_buscaid)
				  {
				      while (!$rs_buscaid->EOF) {
					  
					  $usua_id=$rs_buscaid->fields["usua_id"];
					  
					  
					    $rs_buscaid->MoveNext();
					  }
				}	 

}


?>
<input name="idguardado" type="hidden" id="idguardado" value="<?php echo $usua_id ?>" />