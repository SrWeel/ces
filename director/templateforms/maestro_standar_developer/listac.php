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
            if($resultlistat)
					{  
					  while (!$resultlistat->EOF) {					  
					  
					  $lista_campos.='<option value="'.$resultlistat->fields["fie_name"].'">'.$resultlistat->fields["fie_title"].'</option>';
					  
					  $resultlistat->MoveNext();
					  }
					 } 
				

$lista_virtual="select * from gogess_virtualfields where virtual_id=".trim($_POST["ltablas"]);
$result_campos = $DB_gogess->Execute($lista_virtual);
            if($result_campos)
					{  
					  while (!$result_campos->EOF) {					  
					  
					  $lista_campos.='<option value="'.$result_campos->fields["virtfields_id"].'">'.$result_campos->fields["virtfields_namefield"].'</option>';
					  
					  $result_campos->MoveNext();
					  }
					 } 
				
	
?> 

              <select name="lcampos" size="10" id="lcampos" >
                
				<?php
					echo $lista_campos;
				?>
				
               </select>
<?php
}
?>				