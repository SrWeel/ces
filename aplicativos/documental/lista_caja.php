<?php
header('Content-Type: text/html; charset=UTF-8'); 
include("../../cfg/sessiontime.php");
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
define("UTF_8", 1);
define("ASCII", 2);
define("ISO_8859_1", 3);


$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

include(@$director."libreria/estructura/aqualis_master.php");
for($itbl=0;$itbl<count($lista_tbldata);$itbl++)
 {
  include(@$director."libreria/estructura/".$lista_tbldata[$itbl].".php");
 } 
$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();
 if ($table)
  {
  $objtableform->select_templateform(@$table,$DB_gogess);	
  }
$objformulario->sisfield_arr=$gogess_sisfield;
$objformulario->sistable_arr=$gogess_sistable;
$comillasimple="'";

if($_POST["pusuario_valor"])
{
	 
$listacajas="select * from app_usuario_caja inner join app_usuario on app_usuario_caja.usua_id=app_usuario.usua_id where usua_usuario='".$_POST["pusuario_valor"]."' and usua_estado=1 and fuca_activo=1";	 
$rs_lcajas = $DB_gogess->executec($listacajas,array());


?>

<select name="punto_id" class="Estilo3" id="punto_id" style="width:150px" >

	      <option value="0">--Seleccionar--</option>
		<?php
		
 if($rs_lcajas)
	       {
		       while (!$rs_lcajas->EOF) {
			   
			  
			   $nempresa=$objformulario->replace_cmb("app_empresa","emp_id,emp_nombre","where emp_id=",$rs_lcajas->fields["emp_id"],$DB_gogess);
			   $nestable=$objformulario->replace_cmb("app_establecimiento","estbl_id,estbl_codigo","where estbl_id=",$rs_lcajas->fields["estbl_id"],$DB_gogess);
			   $npunto=$objformulario->replace_cmb("app_puntoemision","punto_id,punto_codigo","where punto_id=",$rs_lcajas->fields["punto_id"],$DB_gogess);
			   
			   echo '<option value="'.$rs_lcajas->fields["punto_id"].'">'.$nempresa."-".$nestable."-".$npunto.'</option>';
				 
			    $rs_lcajas->MoveNext();
			   }
		  
		   }
		  
		  ?>
		  
	      </select>
<?php
}
?>		  