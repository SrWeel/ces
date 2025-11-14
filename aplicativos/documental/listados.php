<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
header('Content-Type: text/html; charset=UTF-8');
$tiempossss="4445000";
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_SESSION['datafrank797_sessid_inicio'])
{
$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");
$sqltotal="";


for($itbl=0;$itbl<count($lista_tbldata);$itbl++)
{
  include(@$director."libreria/estructura/".$lista_tbldata[$itbl].".php");
} 


$objformulario= new  ValidacionesFormulario();
$objformulario->sisfield_arr=$gogess_sisfield;
$objformulario->sistable_arr=$gogess_sistable;



//echo $_POST["insu"];

?>

 <table border="0" cellpadding="0" cellspacing="0" align="center" style="padding: 2px;"   >
        <tr>
          <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px">
		  
		  <table border="1" align="center" cellpadding="0" cellspacing="1" id="tabla" class="table-hover record_table" >
			  <tr>
				<td bgcolor="#AEDBE8"></td>
			    <td colspan="7" bgcolor="#AEDBE8"><div align="center" style="font-weight: bold">DATOS DEL PRODUCTO </div></td>
				
			    <td bgcolor="#A3D6E4">&nbsp;</td>
			    <td bgcolor="#A3D6E4">&nbsp;</td>
			    <td bgcolor="#A3D6E4">&nbsp;</td>
			    <td bgcolor="#A3D6E4">&nbsp;</td>
				<td bgcolor="#A3D6E4"><strong></strong></td>
		    </tr>
			  <tr>
			  <td bgcolor="#AEDBE8"></td>
			  <td bgcolor="#AEDBE8"><strong>ID</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Tipo</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Categoria</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Nombre</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Stock Minimo</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Stock Actual</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Ultimo Precio de Compra</strong></td>
			   
			  
			  
			  
			  <td bgcolor="#A3D6E4"><strong></strong></td>
			  
			  <td bgcolor="#A3D6E4"><strong></strong></td>
			 
			  <td bgcolor="#A3D6E4"><strong></strong></td>
			    <td bgcolor="#A3D6E4"><strong></strong></td>
				<td bgcolor="#A3D6E4"><strong></strong></td>
			  </tr>
			  
		  <?php
		          if($_POST["insu"]>0)
				  {
					  if(@$_POST["txtbusca"]=='' and @$_POST["produ_idip"]=='' and @$_POST["produ_idpp"]=='')
					  {
					   $lista_campor="select * from beko_producto where catpr_id=".$_POST["insu"]." order by  produ_nombre asc";
					  }
					  else
					  {
					   
					   if($_POST["txtbusca"]!='')
					   {
					   $lista_campor="select * from beko_producto where catpr_id=".$_POST["insu"]." and (produ_nombre like '%".$_POST["txtbusca"]."%' or produ_codigoserial like '%".$_POST["txtbusca"]."%')  order by  produ_nombre asc";
					   }
					   
					   if(@$_POST["produ_idip"]!='')
					   {
					   $lista_campor="select beko_producto.produ_id, emp_id, bode_id, catpr_id, categ_id, produ_codigoserial, produ_nombre, produ_caracteristica, produ_foto, produ_preciocompra, produ_preciogen, produ_porcentajefabricacion, beko_producto.unid_id, produ_activo, produ_fechareg, produ_stokminimo, produ_stockactual, impu_codigo, tari_codigo, produ_pedido, produ_precioventaconiva, impu_codigo1, tari_codigo1, impu_codigo2, tari_codigo2, impu_codigo3, tari_codigo3, unidc_id, produ_comprasinimpuesto, produ_valorimpuesto1, produ_valorimpuesto2, produ_valorimpuesto3 from beko_producto inner join cook_ingrediente on beko_producto.produ_id=cook_ingrediente.produing_id where catpr_id=".$_POST["insu"]." and cook_ingrediente.produ_id = '".$_POST["produ_idip"]."'  order by  produ_nombre asc";
					   }
					   
					   if(@$_POST["produ_idpp"]!='')
					   {
					   
					    $lista_campor="select beko_producto.produ_id, emp_id, bode_id, catpr_id, categ_id, produ_codigoserial, produ_nombre, produ_caracteristica, produ_foto, produ_preciocompra, produ_preciogen, produ_porcentajefabricacion, beko_producto.unid_id, produ_activo, produ_fechareg, produ_stokminimo, produ_stockactual, impu_codigo, tari_codigo, produ_pedido, produ_precioventaconiva, impu_codigo1, tari_codigo1, impu_codigo2, tari_codigo2, impu_codigo3, tari_codigo3, unidc_id, produ_comprasinimpuesto, produ_valorimpuesto1, produ_valorimpuesto2, produ_valorimpuesto3 from beko_producto inner join cook_ingrediente on beko_producto.produ_id=cook_ingrediente.produing_id where catpr_id=".$_POST["insu"]." and cook_ingrediente.produ_id = '".$_POST["produ_idpp"]."'  order by  produ_nombre asc";
					   }
					   
					   
					   
					   
					  }
					  
		  
					  
				  }
				  else
				  {
				  $lista_campor="select * from beko_producto order by  produ_nombre asc";
				  
				  }
		           $cuenta=0;
			       $rs_listacmp = $DB_gogess->executec($lista_campor);
                   if($rs_listacmp)
				   {
						while (!$rs_listacmp->EOF) {	
						
						
						$comulla_simple="'";	
						$tabla_valordata="";
						$campo_valor="";	
						$tabla_valordata="'beko_producto'";
						$campo_valor="'produ_id'";
						$ide_producto='produ_id';
						
						

						$cuenta++;	
						$colortr='';
						if($cuenta%2 == 0){
                       			$colortr="style='background-color:#CEE2EA'";
						}else{
							    $colortr="style='background-color:#ffffff'";
						}

						
						echo '<tr '.$colortr.' >';
					
						
						$busca_compras="select * from beko_movimiento where produ_id=".$rs_listacmp->fields[$ide_producto]." order by movi_id desc limit 1";
						$rs_bcompra = $DB_gogess->executec($busca_compras);
						
						$nombre_udesgloce=$objformulario->replace_cmb("cook_unidad","unid_id,unid_nombre","where unid_id=",$rs_bcompra->fields["unid_id"],$DB_gogess);
						
						
						
						$valorunidad_c=0;
						if($rs_bcompra->fields["movi_cantidadcompra"]>0)
						{
						$valorunidad_c=$rs_bcompra->fields["movi_precio"]/$rs_bcompra->fields["movi_cantidadcompra"];
						
						}
						$valorunidad_c=number_format($valorunidad_c, 2, '.', '');
						if($rs_bcompra->fields["movi_cantidadcompra"]>0)
						{
						$nombre_unidadcompra=$objformulario->replace_cmb("cook_unidad","unid_id,unid_nombre","where unid_id=",$rs_bcompra->fields["unidc_id"],$DB_gogess);
						}
						
						$link_borrar="borrar_registro_bu('beko_producto','".$ide_producto."','".$rs_listacmp->fields[$ide_producto]."')";
						
						if($rs_bcompra->fields["movi_id"]>0)
						{
						echo '<td></td>';
						}
						else
						{
						echo '<td onclick="'.$link_borrar.'" style="cursor:pointer" ><img src="borrar.png" ></td>';
						}

									       
						
						echo '<td>'.$cuenta.'.-</td>';
						
						$ncampo_val='catpr_id';	  
						echo '<td><select style="width:120px" id="cmb_'.$ncampo_val.$rs_listacmp->fields[$ide_producto].'" name="cmb_'.$ncampo_val.$rs_listacmp->fields[$ide_producto].'"  onChange="guardar_campos('.$tabla_valordata.','.$comulla_simple.$ncampo_val.$comulla_simple.','.$rs_listacmp->fields[$ide_producto].',$('.$comulla_simple.'#cmb_'.$ncampo_val.$rs_listacmp->fields[$ide_producto].$comulla_simple.').val(),'.$comulla_simple.$ide_producto.$comulla_simple.')" >
                              <option value="" >--Tipo--</option>';
                               $objformulario->fill_cmb('beko_catgproducto','catpr_id,catpr_nombre',$rs_listacmp->fields[$ncampo_val],'',$DB_gogess);
                        echo '</select></td>';
						
					    $ncampo_val='categ_id';		
						echo '<td><select style="width:120px" id="cmb_'.$ncampo_val.$rs_listacmp->fields[$ide_producto].'" name="cmb_'.$ncampo_val.$rs_listacmp->fields[$ide_producto].'"  onChange="guardar_campos('.$tabla_valordata.','.$comulla_simple.$ncampo_val.$comulla_simple.','.$rs_listacmp->fields[$ide_producto].',$('.$comulla_simple.'#cmb_'.$ncampo_val.$rs_listacmp->fields[$ide_producto].$comulla_simple.').val(),'.$comulla_simple.$ide_producto.$comulla_simple.')" >
                              <option value="" >--Tipo--</option>';
                               $objformulario->fill_cmb('cook_categoria','categ_id,categ_nombre',$rs_listacmp->fields[$ncampo_val],'',$DB_gogess);
                        echo '</select></td>';
							 
							  
						$ncampo_val='produ_nombre';
						echo '<td><input name="cmb_'.$ncampo_val.$rs_listacmp->fields[$ide_producto].'" type="text" id="cmb_'.$ncampo_val.$rs_listacmp->fields[$ide_producto].'" value="'.$rs_listacmp->fields[$ncampo_val].'" size="20" onblur="guardar_campos('.$tabla_valordata.','.$comulla_simple.$ncampo_val.$comulla_simple.','.$rs_listacmp->fields[$ide_producto].',$('.$comulla_simple.'#cmb_'.$ncampo_val.$rs_listacmp->fields[$ide_producto].$comulla_simple.').val(),'.$comulla_simple.$ide_producto.$comulla_simple.')" /></td>';
						
						$ncampo_val='produ_stokminimo';
						echo '<td><input name="cmb_'.$ncampo_val.$rs_listacmp->fields[$ide_producto].'" type="text" id="cmb_'.$ncampo_val.$rs_listacmp->fields[$ide_producto].'" value="'.$rs_listacmp->fields[$ncampo_val].'" size="5" onblur="guardar_campos('.$tabla_valordata.','.$comulla_simple.$ncampo_val.$comulla_simple.','.$rs_listacmp->fields[$ide_producto].',$('.$comulla_simple.'#cmb_'.$ncampo_val.$rs_listacmp->fields[$ide_producto].$comulla_simple.').val(),'.$comulla_simple.$ide_producto.$comulla_simple.')" /></td>';
						
						
						
						$ncampo_val='produ_stockactual';
						if($_POST["insu"]==3)
						{
						echo '<td></td>';
						}
						else
						{
						echo '<td>'.$rs_listacmp->fields[$ncampo_val].' '.$nombre_udesgloce.'</td>';
						}
						
						if($valorunidad_c>0)
						{
						echo '<td>'.$valorunidad_c.'$ cada '.$nombre_unidadcompra.'</td>';
						}
						else
						{
						echo '<td></td>';
						}
						
						
						 $clickedit='';
						 $clickedit="onclick=abrir_standar('producto/grid_producto_nuevo.php','Producto','divBody_producto','divDialog_producto',990,650,".$rs_listacmp->fields[$ide_producto].",0,0,0,0,0,'".$_POST["insu"]."')";
						 
						echo '<td></td>';
						 
						echo '<td><input type="button" name="Submit" value="Editar" '.$clickedit.' /></td>';
						
						echo '<td><input type="button" name="Submit" value="Compras" onclick="compras_prk('.$comulla_simple.$rs_listacmp->fields[$ide_producto].$comulla_simple.')" /></td>';
						if($_POST["insu"]==7 or $_POST["insu"]==3)
			             {
						echo '<td><input type="button" name="Submit" value="Recetas" onclick="preparacion_prk('.$comulla_simple.$rs_listacmp->fields[$ide_producto].$comulla_simple.')" /></td>';
						}
							  
						echo '<td><input type="button" name="Submit" value="Guardar" /></td>
							  
			             </tr>';
						 if($_POST["insu"]==7 or $_POST["insu"]==3)
			             {
						/* echo '<tr>
								<td colspan="17"><B>RECETA</B></td>
							</tr>';
						 echo '<tr>
								<td colspan="17">';
								
								  
								
						 echo '</td>
							</tr>';
							
						*/
						 
							
						 }
						
						   $rs_listacmp->MoveNext();
						}
				   }
		  
		  ?>
		  </table>
		  
		  
		  </td>
        </tr>
</table>

<style type="text/css">
<!--
table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {

    padding: 2px;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid #ddd;

}
-->
</style>
<script type="text/javascript">
<!--
$(document).ready(function () {
    $('.record_table tr td').click(function (event) {
        if (event.target.type !== 'checkbox') {
            $(':checkbox', this).trigger('click');
        }
    });

    $("input[type='checkbox']").change(function (e) {
        if ($(this).is(":checked")) {
            $(this).closest('tr').addClass("highlight_row");
        } else {
            $(this).closest('tr').removeClass("highlight_row");
        }
    });
});	

//  End -->
</script>
<?php
}
?>