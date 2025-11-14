<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
include("../../cfgclases/sessiontime.php");
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if(isset($_SESSION['sessidadm1777_pichincha']))
{
?>

<?php
//Llamando objetos
$director="../../";
include("../../cfgclases/clases.php");

$listatablas="select * from gogess_sisfield where tab_name like '".$_POST["ltablas"]."' order by fie_id asc";
$resultlistat = $DB_gogess->Execute($listatablas);
	
?> 

              <select name="lcampos" size="10" id="lcampos" >
                
				<?php
					if($resultlistat)
					{  
					  while (!$resultlistat->EOF) {
					  
					  echo '<option value="'.$resultlistat->fields["fie_name"].'">'.utf8_encode($resultlistat->fields["fie_title"]).'</option>';
					  
					  $resultlistat->MoveNext();
					  }
					 } 
				
				?>
				
                </select>
<?php
}
?>				