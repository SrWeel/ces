<?php
header('Content-Type: text/html; charset=UTF-8');
$tiempossss="4445000";
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

/*echo $_POST["tabla"]."<br>";
echo $_POST["campo"]."<br>";
echo $_POST["id"]."<br>";
echo $_POST["valor"]."<br>";*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>

<SCRIPT LANGUAGE=javascript>
<!--

function compilar_app()
{

$("#campo_compilar").load("../../../compilador/index.php",{


 },function(result){       

  });  

$("#campo_compilar").html("Espere un momento...");


}

function guardar_campos(tabla,campo,id,valor)
{

$("#campo_valor").load("guarda_campo.php",{

tabla:tabla,
campo:campo,
id:id,
valor:valor

 },function(result){       

  });  

$("#campo_valor").html("Espere un momento...");



}

//-->
</SCRIPT>

<style type="text/css">
<!--
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
}
-->
</style></head>

<body>
<?php
if($_SESSION['sessidadm1777_pichincha'])
{
$director="../../";
include ("../../cfgclases/clases.php");
?>

<link type="text/css" href="../../css/smoothness/jquery-ui-1.10.4.custom.css" rel="stylesheet" />	

<script type="text/javascript" src="../../js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="../../js/jquery-ui-1.10.4.custom.min.js"></script>
<script language="javascript" type="text/javascript" src="../../js/jquery.corner.js"></script>
<script language="javascript" type="text/javascript" src="../../js/ui.mask.js"></script>
<script type="text/javascript" src="../../js/jquery.timer2.js"></script> 
<script type="text/javascript" src="../../js/jquery.validate.js"></script>
<script type="text/javascript" src="../../js/additional-methods.js"></script>
<script type="text/javascript" src="../../js/jquery.form.js"></script>
<script type="text/javascript" src="../../js/jquery.fixheadertable.js"></script>
<script src="../../js/jquery.pwstrength.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="../../ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="../../ckeditor/adapters/jquery.js"></script>


<link type="text/css" href="../../css/jquery.dataTables.min.css" rel="stylesheet" />	
<script type="text/javascript" src="../../js/jquery.dataTables.min.js"></script> 

<link rel="stylesheet" href="../../css/bootstrap/css/bootstrap.min.css" type="text/css">
<br />

<table width="400" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="111"><input type="button" name="Submit" value="COMPILAR" onclick="compilar_app()" /></td>
    <td width="289"><div id="campo_compilar"></div></td>
  </tr>
</table>

 <table border="0" cellpadding="0" cellspacing="0" align="center">
        <tr>
          <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px">
		  
		  <table border="1" align="center" cellpadding="0" cellspacing="1">
			  <tr>
			  <td><strong>Nombre</strong></td>
			  <td><strong>Titulo</strong></td>
			   <td><strong>Tipo Campo</strong></td>
			  <td><strong>Tipo</strong></td>
			  <td><strong>Tipo Web</strong></td>
			  <td><strong>Grupo</strong></td>
			  <td><strong>Orden</strong></td>
			  <td><strong>Grupo print</strong></td>
			  <td><strong>Orden Grid</strong></td>
			  <td><strong>Ancho CP</strong></td>
			  <td><strong>Tabla Subgrid</strong></td>
			  <td><strong>Enlace Subgrid</strong></td>
			  
			  <td><strong>Variable externa</strong></td>
			  
			  <td><strong>Archivo Subgrid</strong></td>
			  <td><strong>Guardar</strong></td>
			  </tr>
			  
		  <?php
		  
		           $lista_campor="select * from gogess_sisfield where tab_name='".$_GET["iddibujo"]."' order by fie_group,fie_orden asc";
			       $rs_listacmp = $DB_gogess->Execute($lista_campor);
                   if($rs_listacmp)
				   {
						while (!$rs_listacmp->EOF) {	
						
						//fie_group
						//fie_orden
						//fie_groupprint
						//fie_anchocolomna
							//fie_id
						$comulla_simple="'";	
						$tabla_valordata="";
						$campo_valor="";	
						$tabla_valordata="'gogess_sisfield'";
						$campo_valor="'fie_id'";
						
						
							
						echo '<tr>						       
							  <td>'.$rs_listacmp->fields["fie_name"].'</td>
							 
							  
							  <td><input name="cmb_fie_title'.$rs_listacmp->fields["fie_id"].'" type="text" id="cmb_fie_title'.$rs_listacmp->fields["fie_id"].'" value="'.$rs_listacmp->fields["fie_title"].'" size="25" onblur="guardar_campos('.$tabla_valordata.','.$comulla_simple.'fie_title'.$comulla_simple.','.$rs_listacmp->fields["fie_id"].',$('.$comulla_simple.'#cmb_fie_title'.$rs_listacmp->fields["fie_id"].$comulla_simple.').val())" /></td>
							  
							  
							   <td><input name="cmb_field_type'.$rs_listacmp->fields["fie_id"].'" type="text" id="cmb_field_type'.$rs_listacmp->fields["fie_id"].'" value="'.$rs_listacmp->fields["field_type"].'" size="25" onblur="guardar_campos('.$tabla_valordata.','.$comulla_simple.'field_type'.$comulla_simple.','.$rs_listacmp->fields["fie_id"].',$('.$comulla_simple.'#cmb_field_type'.$rs_listacmp->fields["fie_id"].$comulla_simple.').val())" /></td>
							  
							  
							  <td><select style="width:200px" id="cmb_fie_type'.$rs_listacmp->fields["fie_id"].'" name="cmb_fie_type'.$rs_listacmp->fields["fie_id"].'"  onChange="guardar_campos('.$tabla_valordata.','.$comulla_simple.'fie_type'.$comulla_simple.','.$rs_listacmp->fields["fie_id"].',$('.$comulla_simple.'#cmb_fie_type'.$rs_listacmp->fields["fie_id"].$comulla_simple.').val())" >
                              <option value="" >--Tipo--</option>';

                               $objformulario->fill_cmb('gogess_typecmp','tyc_value,tyc_etiqueta',$rs_listacmp->fields["fie_type"],'',$DB_gogess);
 
                        echo '</select></td>
						
						  <td><select style="width:200px" id="cmb_fie_typeweb'.$rs_listacmp->fields["fie_id"].'" name="cmb_fie_typeweb'.$rs_listacmp->fields["fie_id"].'"  onChange="guardar_campos('.$tabla_valordata.','.$comulla_simple.'fie_typeweb'.$comulla_simple.','.$rs_listacmp->fields["fie_id"].',$('.$comulla_simple.'#cmb_fie_typeweb'.$rs_listacmp->fields["fie_id"].$comulla_simple.').val())" >
                              <option value="" >--Tipo--</option>';

                               $objformulario->fill_cmb('gogess_typecmp','tyc_value,tyc_etiqueta',$rs_listacmp->fields["fie_typeweb"],'',$DB_gogess);
 
                        echo '</select></td>
							
						
							  
                              <td><input name="cmb_fie_group'.$rs_listacmp->fields["fie_id"].'" type="text" id="cmb_fie_group'.$rs_listacmp->fields["fie_id"].'" value="'.$rs_listacmp->fields["fie_group"].'" size="4" onblur="guardar_campos('.$tabla_valordata.','.$comulla_simple.'fie_group'.$comulla_simple.','.$rs_listacmp->fields["fie_id"].',$('.$comulla_simple.'#cmb_fie_group'.$rs_listacmp->fields["fie_id"].$comulla_simple.').val())" /></td>
							  
			                  <td><input name="cmb_fie_orden'.$rs_listacmp->fields["fie_id"].'" type="text" id="cmb_fie_orden'.$rs_listacmp->fields["fie_id"].'" value="'.$rs_listacmp->fields["fie_orden"].'" size="4" onblur="guardar_campos('.$tabla_valordata.','.$comulla_simple.'fie_orden'.$comulla_simple.','.$rs_listacmp->fields["fie_id"].',$('.$comulla_simple.'#cmb_fie_orden'.$rs_listacmp->fields["fie_id"].$comulla_simple.').val())" /></td>
							  
			                  <td><input name="cmb_fie_groupprint'.$rs_listacmp->fields["fie_id"].'" type="text" id="cmb_fie_groupprint'.$rs_listacmp->fields["fie_id"].'" value="'.$rs_listacmp->fields["fie_groupprint"].'" size="4" onblur="guardar_campos('.$tabla_valordata.','.$comulla_simple.'fie_groupprint'.$comulla_simple.','.$rs_listacmp->fields["fie_id"].',$('.$comulla_simple.'#cmb_fie_groupprint'.$rs_listacmp->fields["fie_id"].$comulla_simple.').val())" /></td>
							  
							  
							  <td><input name="cmb_fie_ordengrid'.$rs_listacmp->fields["fie_id"].'" type="text" id="cmb_fie_ordengrid'.$rs_listacmp->fields["fie_id"].'" value="'.$rs_listacmp->fields["fie_ordengrid"].'" size="4" onblur="guardar_campos('.$tabla_valordata.','.$comulla_simple.'fie_ordengrid'.$comulla_simple.','.$rs_listacmp->fields["fie_id"].',$('.$comulla_simple.'#cmb_fie_ordengrid'.$rs_listacmp->fields["fie_id"].$comulla_simple.').val())" /></td>
							  
			                  <td><input name="cmb_fie_anchocolomna'.$rs_listacmp->fields["fie_id"].'" type="text" id="cmb_fie_anchocolomna'.$rs_listacmp->fields["fie_id"].'" value="'.$rs_listacmp->fields["fie_anchocolomna"].'" size="4" onblur="guardar_campos('.$tabla_valordata.','.$comulla_simple.'fie_anchocolomna'.$comulla_simple.','.$rs_listacmp->fields["fie_id"].',$('.$comulla_simple.'#cmb_fie_anchocolomna'.$rs_listacmp->fields["fie_id"].$comulla_simple.').val())" /></td>
							  
							  <td>'.$rs_listacmp->fields["fie_tablasubgrid"].'</td>
							  <td>'.$rs_listacmp->fields["fie_campoenlacesub"].'</td>
							  <td>'.$rs_listacmp->fields["fie_sendvar"].'</td>
							  <td>'.$rs_listacmp->fields["fie_archivogrid"].'</td>
							  
							  <td><input type="button" name="Submit" value="Aceptar" /></td>
							  
			             </tr>';
						
						   $rs_listacmp->MoveNext();
						}
				   }
		  
		  ?>
		  </table>
		  
		  
		  </td>
        </tr>
</table>
	   <div id="campo_valor"></div>
	   <br />
<?php
}
?>
</body>
</html>