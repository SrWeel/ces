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

//echo $_POST["ltablas"];
//echo $_POST["lcampos"];
//echo $_POST["vardev_id"];


 $list_data="select * from sth_vddetalle where vardev_id=".$_POST["vardev_id"];
$resultlistat = $DB_gogess->Execute($list_data);

?> 

               <select name="listaag" size="10" id="listaag"  ondblclick="editar_op()" >
                
				<?php
					if($resultlistat)
					{  
					  while (!$resultlistat->EOF) {
					  
					  
					 $es_numero=is_numeric($resultlistat->fields["vardevdet_tabla"]);
                    $nombretabla='';
					$nombrecampo='';
					if($es_numero)
					{
					  
					  
					  $nombretabla=$objformulario->replace_cmb("gogess_virtualtable","virtual_id,virtual_name","where virtual_id =",$resultlistat->fields["vardevdet_tabla"],$DB_gogess);
					  $nombrecampo=str_replace(":","",$objformulario->replace_cmb("gogess_virtualfields","virtfields_id,virtfields_namefield","where virtfields_id=",$resultlistat->fields["vardevdet_campo"],$DB_gogess));
					  
					  if(!($nombrecampo))
					  {
						  
						$nombrecampo=$resultlistat->fields["vardevdet_campo"];
						$nombretabla="Operation";
					  }
					  
					  echo '<option value="'.$resultlistat->fields["vardevdet_id"].'">'.$nombretabla." -- ".$nombrecampo.'</option>';
					  
					}	
					else
					{	 
					 
					  $nombretabla=$objformulario->replace_cmb("gogess_sistable","tab_name,tab_title","where tab_name like ",$resultlistat->fields["vardevdet_tabla"],$DB_gogess);
					  
					  $nombrecampo=str_replace(":","",$objformulario->replace_cmb("gogess_sisfield","fie_name,fie_title","where tab_name ='".$resultlistat->fields["vardevdet_tabla"]."' and fie_name like ",$resultlistat->fields["vardevdet_campo"],$DB_gogess));
					  
					  if(!($nombrecampo))
					  {
						  
						$nombrecampo=$resultlistat->fields["vardevdet_campo"];
						$nombretabla="Operation";
					  }
					  
					  echo '<option value="'.$resultlistat->fields["vardevdet_id"].'">'.$nombretabla." -- ".$nombrecampo.'</option>';
					  
					  
					}  
					  
					  $resultlistat->MoveNext();
					  }
					 } 
				
				?>
				
               </select>

    <?php
	}
	?>          