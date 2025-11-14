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

$lista_concatenada='';
$listatablas="select * from rose_variabledeveloper";
$resultlistat = $DB_gogess->Execute($listatablas);
if($resultlistat)
	{  
			while (!$resultlistat->EOF) {
					  
					  $lista_concatenada.='<option value="'.$resultlistat->fields["vardev_id"].'">'.$resultlistat->fields["vardev_nombre"].'</option>';
					  
					  $resultlistat->MoveNext();
			}
	} 



	
?> 

              <select name="ltablas_filter" size="10" id="ltablas_filter" onclick="lista_campos_filter()" >
                
				<?php
					echo $lista_concatenada;			
				?>
				
                </select>
		
<?php
}
?>				