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
$listatablas="select * from gogess_sistable where instan_id=5";
$resultlistat = $DB_gogess->Execute($listatablas);


					if($resultlistat)
					{  
					  while (!$resultlistat->EOF) {
					  
					  $lista_concatenada.='<option value="'.$resultlistat->fields["tab_name"].'">'.$resultlistat->fields["tab_title"].'</option>';
					  
					  $resultlistat->MoveNext();
					  }
					 } 


$lista_tablas_virtuales="select * from gogess_virtualtable where virtual_activo=1";
$result_virtual = $DB_gogess->Execute($lista_tablas_virtuales);

	                if($result_virtual)
					{  
					  while (!$result_virtual->EOF) {
					  
					  $lista_concatenada.='<option value="'.$result_virtual->fields["virtual_id"].'">'.$result_virtual->fields["virtual_name"].'</option>';
					  
					  $result_virtual->MoveNext();
					  }
					 } 				 

?> 

              <select name="ltablas" size="10" id="ltablas" onclick="lista_campos()" >
                
				<?php
					echo $lista_concatenada;
				
				?>
				
                </select>
		
<?php







}
?>				