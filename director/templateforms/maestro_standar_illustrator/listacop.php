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

$listatablas="select * from sth_vddetalle where vardev_id='".$_POST["ltablas"]."' order by vardev_id asc";
$resultlistat = $DB_gogess->Execute($listatablas);
$lista_campos='';
if($resultlistat)
		{  
			while (!$resultlistat->EOF) {
					  
                if(is_numeric(trim($resultlistat->fields["vardevdet_campo"])))
					  {
                         $lista_virtualc="select * from gogess_virtualfields where virtfields_id=".trim($resultlistat->fields["vardevdet_campo"]);
						 $result_camposc = $DB_gogess->Execute($lista_virtualc);
						 $nombre_campo=$result_camposc->fields["virtfields_namefield"];

					  }
					else
					{
                       $nombre_campo=$resultlistat->fields["vardevdet_campo"];

					}	
				
				 $lista_campos.='<option value="'.$resultlistat->fields["vardevdet_id"].'">'.$nombre_campo.'</option>';
					  
				$resultlistat->MoveNext();
			}
		} 
	
	
?> 

              <select name="lcamposop" size="10" id="lcamposop" >
                
				<?php					
				echo $lista_campos;
				?>
				
                </select>
<?php
}
?>				