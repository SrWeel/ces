<?php
$tiempossss=36000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

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
 if (@$table)
  {
  $objtableform->select_templateform(@$table,$DB_gogess);	
  }
$objformulario->sisfield_arr=$gogess_sisfield;
$objformulario->sistable_arr=$gogess_sistable;
$comillasimple="'";




$estadofirmado=$objformulario->replace_cmb("efacfactura_cabecera","efacfaccab_id,efacfaccab_firmado","where efacfaccab_id like",$_POST["enlace"],$DB_gogess);
$estadoautorizado=$objformulario->replace_cmb("efacfactura_cabecera","efacfaccab_id,efacfaccab_estadosri","where efacfaccab_id like",$_POST["enlace"],$DB_gogess);


$cantdetalle_val="";
$listagrid="select * from efacfactura_detalle where efacfaccab_id='".$_POST["enlace"]."'";  
$rs_campos = $DB_gogess->executec($listagrid,array());

?>
<div class="TableScroll_factura"  >	
<div class="cssgrid"  >
<table >
           
             <tr>
			  <?php
			  if(!($estadoautorizado))
               {
			    
			  ?>
			   <td height="40"  >&nbsp;</td>
			   <td >&nbsp;</td>
			   <?php
			    
			   }
			   ?>			   
               <td >Cod</td>          
               <td >Cant</td>
               <td   >Descripci&oacute;n</td>
			    <td>Impuesto</td>
               <td>Precio Unitario </td>
               
               <td>Precio Total </td>
             </tr>
		    
			 <?php
			 while (!$rs_campos->EOF) {
			 $i++;
			 $cantdetalle_val++;
			 ?>
             <tr>
			 
			  <?php
			  if(!($estadoautorizado))
               {
			     
			  ?>
			   <td bgcolor="#FFFFFF" class="css_bordes" style="cursor:pointer" onclick="abrir_pantalla('templateformsweb/maestro_standar_lq/detalle_form.php','editar','divBody_fac','divDialog_extra',700,500,$('#efacfaccab_id').val(),'<?php echo $rs_campos->fields["facturadet_id"] ?>',0,0,0,0,0)" ><img src="templateformsweb/maestro_standar_lq/editarf.png" width="25" height="25" /></td>
			   <td bgcolor="#FFFFFF" class="css_bordes" style="cursor:pointer" onclick="borrar_item('<?php echo $rs_campos->fields["facturadet_id"] ?>')" ><img src="templateformsweb/maestro_standar_lq/borrarf.png" width="25" height="25" /></td>
			   <?php
			   
			   }
			     
$largoMax = 80; // numero maximo de caracteres antes de hacer un salto de linea
$rompeLineas = '</br>n';
$romper_palabras_largas = true; // rompe una palabra si es demacido larga
 //echo wordwrap($rs_campos->fields["facturadet_descripcion"],$largoMax,$rompeLineas,$romper_palabras_largas); 
			   ?>
               
               <td bgcolor="#FFFFFF" class="css_bordes"><?php echo $rs_campos->fields["facturadet_codprincipal"] ?></td>
               <td bgcolor="#FFFFFF" class="css_bordes"><?php echo $rs_campos->fields["facturadet_cantidad"] ?></td>
               <td width="10" bgcolor="#FFFFFF" ><?php echo wordwrap($rs_campos->fields["facturadet_descripcion"],$largoMax,$rompeLineas,$romper_palabras_largas);  ?></td>
			   <td bgcolor="#FFFFFF" class="css_bordes"><?php 
			  
			    
				$nombreimpuesto=$objformulario->replace_cmb("efacsistema_tipoiva","tipiva_codigo,tipiva_nombre","where impv_codigo ='".$rs_campos->fields["facturadet_impuesto"]."' and tipiva_codigo=",$rs_campos->fields["facturadet_ivasino"],$DB_gogess);
			   echo $nombreimpuesto;
			   
			   ?></td>
               <td bgcolor="#FFFFFF" class="css_bordes"><?php echo number_format($rs_campos->fields["facturadet_preciou"], 2, ".", ",") ?></td>
              
               <td bgcolor="#FFFFFF" class="css_bordes"><?php echo number_format($rs_campos->fields["facturadet_total"], 2, ".", ",") ?></td>
             </tr>
			<?php
			  		   
			   $sub_totalval=0;
			   $sub_totalval= ($rs_campos->fields["facturadet_preciou"]*$rs_campos->fields["facturadet_cantidad"]) - $rs_campos->fields["facturadet_descuento"];
			   
			   
			   if ($rs_campos->fields["facturadet_ivasino"]==2)
			   {
			    $valor_total=$valor_total + $sub_totalval;
			   }
			   
			   if ($rs_campos->fields["facturadet_ivasino"]==0)
			   {
			    $valorsiniva_total=$valorsiniva_total+$sub_totalval;
			   }
			   
			   if ($rs_campos->fields["facturadet_ivasino"]==6)
			   {
			    $valornoobj_total=$valornoobj_total+$sub_totalval;
			   }
			   
	           $descuento_val=$descuento_val+$rs_campos->fields["facturadet_descuento"];
			
			  $rs_campos->MoveNext();
			}
			?> 
			 
           </table>
		   
<input name="subtotalsiniva_val" type="hidden" id="subtotalsiniva_val" value="<?php echo $valorsiniva_total ?>" />	 <input name="subtotalnoobj_val" type="hidden" id="subtotalnoobj_val" value="<?php echo $valornoobj_total ?>" />  
<input name="subtotal_val" type="hidden" id="subtotal_val" value="<?php echo $valor_total ?>" />
<input name="cantdetalle_val" type="hidden" id="cantdetalle_val" value="<?php echo $cantdetalle_val ?>" />
<input name="descuento_val" type="hidden" id="descuento_val" value="<?php echo $descuento_val ?>" />



<?php
if(!($_POST["psolover"]))
{
?>
<script language="javascript">
<!--
$('#grid_factura').fixheadertable({

resizeCol: true,  // se puede cambiar el tamaño de la columna
minColWidth : 70 ,
height   : 150,

showhide       : true // esto es para ocultar o mostrar los datos con un clic
});
 //-->
</script>
 </div>
  </div> 
<?php
}
?>