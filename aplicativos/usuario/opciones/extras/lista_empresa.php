<?php
header('Content-Type: text/html; charset=UTF-8'); 
include("../../../../cfgclases/sessiontime.php");
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
define("UTF_8", 1);
define("ASCII", 2);
define("ISO_8859_1", 3);


$director="../../../../";
include ("../../../../cfgclases/clases.php");

if($_POST["pusuario_valor"])
{
	 
$listacajas="select distinct factura_empresa.emp_id,emp_nombre from factura_usuariocaja,factura_puntoemision,factura_establecimiento,factura_empresa where factura_usuariocaja.emi_id=factura_puntoemision.emi_id and  factura_puntoemision.estab_id=factura_establecimiento.estab_id and factura_establecimiento.emp_id=factura_empresa.emp_id  and usua_ciruc='".$_POST["pruc_valor"]."' and usca_activo=1 ";	 
$rs_lcajas = $DB_gogess->Execute($listacajas);


?>

<select name="emp_id" class="Estilo3" id="emp_id" onclick="busca_establecimiento()" style="width:150px" >

	      <option value="0">--Seleccionar--</option>
		<?php
		
		
		
		
		 if($rs_lcajas)
	       {
		       while (!$rs_lcajas->EOF) {
			  // $cajanombre=$objformulario->replace_cmb("factura_puntoemision","emi_id,caja_num","where emi_id=",$rs_lcajas->fields["emi_id"],$DB_gogess);
			   //$activo_caja=$objformulario->replace_cmb("factura_puntoemision","emi_id,caja_sino","where emi_id=",$rs_lcajas->fields["emi_id"],$DB_gogess);
			   
			   //$siempresa=$objformulario->replace_cmb("factura_puntoemision","emi_id,emp_id","where emi_id=",$rs_lcajas->fields["emi_id"],$DB_gogess);
			   
			   //$usuarioempresa=$objformulario->replace_cmb("factur_usuarios","usua_ciruc,emp_id","where usua_ciruc like",$rs_lcajas->fields["usua_ciruc"],$DB_gogess);
			   
			   
				  if(trim($siempresa)==$usuarioempresa)
				  {
			   echo '<option value="'.$rs_lcajas->fields["emp_id"].'">'.$rs_lcajas->fields["emp_nombre"].'</option>';
				  }
			   
			  
			    $rs_lcajas->MoveNext();
			   }
		  
		   }
		  
		  ?>
		  
	      </select>
<?php
}
?>		  