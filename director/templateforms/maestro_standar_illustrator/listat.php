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

$listatablas="select * from rose_variabledeveloper";
$resultlistat = $DB_gogess->Execute($listatablas);
	
?> 

              <select name="ltablas" size="10" id="ltablas" onclick="lista_campos()" >
                
				<?php
					if($resultlistat)
					{  
					  while (!$resultlistat->EOF) {
					  
					  echo '<option value="'.$resultlistat->fields["vardev_id"].'">'.$resultlistat->fields["vardev_nombre"].'</option>';
					  
					  $resultlistat->MoveNext();
					  }
					 } 
				
				?>
				
                </select>
		
<?php
}
?>				