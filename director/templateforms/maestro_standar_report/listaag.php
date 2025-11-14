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
//echo $_POST["rept_id"];

if(@$_POST["rept_id"])
{
   if(@$_POST["ltablas"])
     {
	    if(@$_POST["lcampos"])
		 { 
//----------------------------------------------
$buscasiexiste="select * from sth_reportdetalle where rept_id=".$_POST["rept_id"]." and reptdet_tabla like '".$_POST["ltablas"]."' and reptdet_campo like '".$_POST["lcampos"]."'";
$resultexiste = $DB_gogess->Execute($buscasiexiste);
if($resultexiste->fields["reptdet_id"])
{
  echo "Campo ya fue asignado...";
}
else
{

  $insertdata="insert into sth_reportdetalle (rept_id,reptdet_tabla,reptdet_campo) values (".$_POST["rept_id"].",'".$_POST["ltablas"]."','".$_POST["lcampos"]."')";
  
  
   $DB_gogess->Execute($insertdata);

}
//---------------------------------------------
       }
	 }
   }	   
	   
if(@$_POST["listaag"])
{
 $quitacampos="delete from sth_reportdetalle where  reptdet_id=".$_POST["listaag"];
 $DB_gogess->Execute($quitacampos);

}


 $list_data="select * from sth_reportdetalle where rept_id=".$_POST["rept_id"];
$resultlistat = $DB_gogess->Execute($list_data);

?> 

               <select name="listaag" size="10" id="listaag"  >
                
				<?php
					if($resultlistat)
					{  
					  while (!$resultlistat->EOF) {
					  
					  
					  $nombretabla=$objformulario->replace_cmb("gogess_sistable","tab_name,tab_title","where tab_name like ",$resultlistat->fields["reptdet_tabla"],$DB_gogess);
					  $nombrecampo=str_replace(":","",$objformulario->replace_cmb("gogess_sisfield","fie_name,fie_title","where tab_name ='".$resultlistat->fields["reptdet_tabla"]."' and fie_name like ",$resultlistat->fields["reptdet_campo"],$DB_gogess));
					  
					  echo '<option value="'.$resultlistat->fields["reptdet_id"].'">'.utf8_encode($nombretabla)." -- ".utf8_encode($nombrecampo).'</option>';
					  
					  $resultlistat->MoveNext();
					  }
					 } 
				
				?>
				
               </select>

    <?php
	}
	?>          