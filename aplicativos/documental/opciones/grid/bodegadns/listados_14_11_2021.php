<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
header('Content-Type: text/html; charset=UTF-8');
$tiempossss="44450000";
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if(@$_SESSION['ces1313777_sessid_inicio'])
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



$insu=$_POST["insu"];

$subcateg_id=$_POST["subcateg_idx"];

?>
<style type="text/css">
<!--
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.css_select
{
font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;

}
.Estilo1 {
	font-size: 10px;
	font-weight: bold;
}
.Estilo2 {font-size: 10px}
-->
</style>

 <table width="972" border="1" cellpadding="0" cellspacing="0">
            <tr>
              <td width="389"><span class="Estilo1">Ultimo Precio Inventario Inicial (Dispositivos)</span></td>
              <td width="577"><span class="Estilo2">Es el precio mas comun en todos los centros </span></td>
            </tr>
            <tr>
              <td><span class="Estilo2"><strong>Alerta Precio Diferente Inventario Inicial (Medicamentos)</strong></span></td>
              <td><span class="Estilo2">Si alg&uacute;n centro tiene un precio diferente ahi lo muestra con otro color (ver en [VER SEGUIMIENTO])</span></td>
            </tr>
            <tr>
              <td><span class="Estilo2"><strong>Ultimo Precio Compra (Dispositivos)</strong></span></td>
              <td><span class="Estilo2">&Uacute;ltimo precio de compra en bodega principal, en este periodo </span></td>
            </tr>
            <tr>
              <td><span class="Estilo2"><strong>Mayor Precio Compra(Dispositivos)</strong></span></td>
              <td><span class="Estilo2">Mayor precio de compra en este periodo </span></td>
            </tr>
            <tr>
              <td><span class="Estilo2"><strong>Menor Precio Compra (Dispositivos)</strong></span></td>
              <td><span class="Estilo2">Menor precio de compra en este periodo </span></td>
            </tr>
</table>
		  
		  <table border="1" align="center" cellpadding="0" cellspacing="1" id="tabla" class="table-hover record_table" >
			  
			  <tr>
			  <td bgcolor="#AEDBE8"></td>
			  <td bgcolor="#AEDBE8"><strong>ID</strong></td>
			  <?php
			  if($_POST["insu"]==2)
			  {
			  ?>
			  <td bgcolor="#AEDBE8"><strong>CUDIM</strong></td>
			  <?php
			  }
			  else
			  {
			  ?>
			  <td bgcolor="#AEDBE8"><strong>CUM</strong></td>
			  
			  <?php
			  }
			  ?>
			  
			   <?php
			  if($_POST["insu"]==2)
			  {
			  ?>
			  	<td bgcolor="#AEDBE8"><strong>CATEGORIA</strong></td>
			  <?php
			  }
			  ?>
			  
			  <?php
			  if($insu==1)
			  {
			  ?>
			  <td bgcolor="#AEDBE8"><strong>C&oacute;digo ISSPOL</strong></td>
			  <?php
			  }
			  ?>
			  <td bgcolor="#AEDBE8"><strong>Nombre</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Stock Minimo</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Stock Actual</strong></td>
			  <?php
			  if($insu==1)
			  {
			  ?>
			  <td bgcolor="#AEDBE8"><strong>Precio Techo(Medicamentos)</strong></td>
			  <?php
			  }
			  ?>
			  
			  <?php
			  if($insu==1)
			  {
			  ?>
			  <td bgcolor="#AEDBE8"><strong>Ultimo Precio Inventario Inicial (Medicamentos)</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Alerta Precio Diferente Inventario Inicial (Medicamentos)</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Ultimo Precio Compra (Medicamentos)</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Mayor Precio Compra(Medicamentos)</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Menor Precio Compra (Medicamentos)</strong></td>
			  <?php
			  }
			  else
			  {
			  ?>
			  <td bgcolor="#AEDBE8"><strong>Ultimo Precio Inventario Inicial (Dispositivos)</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Alerta Precio Diferente Inventario Inicial (Dispositivos)</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Ultimo Precio Compra (Dispositivos)</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Mayor Precio Compra(Dispositivos)</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Menor Precio Compra (Dispositivos)</strong></td>
			  <?php
			  }
			  ?>
              <td bgcolor="#AEDBE8"><strong>Detalle Movimientos</strong></td>
			  <td bgcolor="#A3D6E4"><strong></strong></td>
			  
			  <td bgcolor="#A3D6E4"><strong></strong></td>
			 

			    <td bgcolor="#A3D6E4"><strong></strong></td>

			  </tr>
			  
		  <?php
		  
		  $sqlnu='';
		  if($subcateg_id)
		  {
		    $sqlnu=" subcateg_id='".$subcateg_id."' and ";
		  
		  }
		  
		  
		          if($_POST["insu"]>0)
				  {
					  if(@$_POST["txtbusca"]=='' and @$_POST["produ_idip"]=='' and @$_POST["produ_idpp"]=='')
					  {
					   $lista_campor="select * from dns_cuadrobasicomedicamentos_vista where ".$sqlnu."  categ_id=".$_POST["insu"]." order by  cuadrobm_principioactivo asc";
					  }
					  else
					  {
					   
					   if($_POST["txtbusca"]!='')
					   {
					   $lista_campor="select * from dns_cuadrobasicomedicamentos_vista where ".$sqlnu."  categ_id=".$_POST["insu"]." and (cuadrobm_codigoatc like '%".$_POST["txtbusca"]."%' or cuadrobm_principioactivo like '%".$_POST["txtbusca"]."%' or cuadrobm_nombrecomercial like '%".$_POST["txtbusca"]."%')  order by  cuadrobm_principioactivo asc";
					   }
					   
					   
					  }
					  	  
				  }
				  else
				  {
				  $lista_campor="select * from dns_cuadrobasicomedicamentos_vista order by  cuadrobm_principioactivo asc limit 200";
				  $lista_campor="";
				  }
				  
				  //echo $lista_campor;
		           $cuenta=0;
			       $rs_listacmp = $DB_gogess->executec($lista_campor);
                   if($rs_listacmp)
				   {
						while (!$rs_listacmp->EOF) {	
						
						
						$comulla_simple="'";	
						$tabla_valordata="";
						$campo_valor="";	
						$tabla_valordata="'dns_cuadrobasicomedicamentos'";
						$campo_valor="'cuadrobm_id'";
						$ide_producto='cuadrobm_id';
						
						$stockactual="select sum(stock_cantidad*stock_signo) as stactual from dns_principalstockactual where centro_id=".$_POST["centro_idb"]." and cuadrobm_id=".$rs_listacmp->fields["cuadrobm_id"];
						$rs_stactua = $DB_gogess->executec($stockactual);

						$cuenta++;	
						$colortr='';
						$grafico_gif='';
						if($cuenta%2 == 0){
                       			$colortr="style='background-color:#CEE2EA'";								
								$grafico_gif='alert_gif2.gif';
						}else{
							    $colortr="style='background-color:#ffffff'";
								$grafico_gif='alert_gif.gif';
						}

						
						echo '<tr '.$colortr.' >';
					
						
						$busca_compras="select * from dns_principalmovimientoinventario where cuadrobm_id=".$rs_listacmp->fields[$ide_producto]." and  centro_id=".$_POST["centro_idb"]." order by moviin_id desc limit 1";
						$rs_bcompra = $DB_gogess->executec($busca_compras);
								
						
						//$link_borrar="borrar_registro_bu('dns_cuadrobasicomedicamentos','".$ide_producto."','".$rs_listacmp->fields[$ide_producto]."')";
						
						if($rs_bcompra->fields["moviin_id"]>0)
						{
						echo '<td></td>';
						}
						else
						{
						  if(@$_SESSION['ces1313777_usua_subadm']==1)
						  {
						     //echo '<td onclick="'.$link_borrar.'" style="cursor:pointer" ><img src="borrar.png" ></td>';
							 echo '<td></td>';
						  }
						  else
						  {
						     echo '<td></td>';
						  } 
						}

									       
						
						echo '<td>'.$cuenta.'.-</td>';
						
						$ncampo_val='cuadrobm_codigoatc';
						echo '<td>'.utf8_encode($rs_listacmp->fields[$ncampo_val]).'</td>';
						
						if($_POST["insu"]==2)
			            {
						
						$buncategoria="select * from dns_subcategorias where subcateg_id='".$rs_listacmp->fields["subcateg_id"]."'";
						$rs_buc= $DB_gogess->executec($buncategoria);
						
						$ncampo_val='subcateg_id';
						echo '<td>'.utf8_encode($rs_buc->fields['subcateg_nombre']).'</td>'; 
						
						}
						
						
						if($insu==1)
			            {
						$ncampo_val='cuadrobm_codigoispol';
						echo '<td>'.utf8_encode($rs_listacmp->fields[$ncampo_val]).'</td>';
					    }
					    //$ncampo_val='categ_id';		
						/*echo '<td><select class="css_select" style="width:120px" id="cmb_'.$ncampo_val.$rs_listacmp->fields[$ide_producto].'" name="cmb_'.$ncampo_val.$rs_listacmp->fields[$ide_producto].'"  onChange="guardar_campos('.$tabla_valordata.','.$comulla_simple.$ncampo_val.$comulla_simple.','.$rs_listacmp->fields[$ide_producto].',$('.$comulla_simple.'#cmb_'.$ncampo_val.$rs_listacmp->fields[$ide_producto].$comulla_simple.').val(),'.$comulla_simple.$ide_producto.$comulla_simple.')" >
                              <option value="" >--Tipo--</option>';
                               $objformulario->fill_cmb('dns_categoriadns','categ_id,categ_nombre',$rs_listacmp->fields[$ncampo_val],'',$DB_gogess);
                        echo '</select></td>';*/
							 
							  
						$ncampo_val='cuadrobm_principioactivo';
						$nom1='';					
						if($rs_listacmp->fields["cuadrobm_nombrecomercial"])
						{
						   $nom1=$rs_listacmp->fields["cuadrobm_nombrecomercial"].' ';
						}
						
						$nom2='';					
						if($rs_listacmp->fields["cuadrobm_primerniveldesagregcion"])
						{
						   $nom2=$rs_listacmp->fields["cuadrobm_primerniveldesagregcion"].' ';
						}
						
						$nom3='';					
						if($rs_listacmp->fields["cuadrobm_tercerniveldesagregcion"])
						{
						   $nom3=$rs_listacmp->fields["cuadrobm_tercerniveldesagregcion"].' ';
						}
						 
						$nom4='';					
						if($rs_listacmp->fields["cuadrobm_concentracion"])
						{
						   $nom4=$rs_listacmp->fields["cuadrobm_concentracion"].' ';
						}
	                    
						$concatena_nom=$nom1.$nom2.$nom3.$nom4;
						
						echo '<td width="310px" >'.utf8_encode($rs_listacmp->fields[$ncampo_val]).' '.utf8_encode($concatena_nom).'</td>';
						//echo '<td><input class="css_select" name="cmb_'.$ncampo_val.$rs_listacmp->fields[$ide_producto].'" type="text" id="cmb_'.$ncampo_val.$rs_listacmp->fields[$ide_producto].'" value="'.$rs_listacmp->fields[$ncampo_val].'" size="20" onblur="guardar_campos('.$tabla_valordata.','.$comulla_simple.$ncampo_val.$comulla_simple.','.$rs_listacmp->fields[$ide_producto].',$('.$comulla_simple.'#cmb_'.$ncampo_val.$rs_listacmp->fields[$ide_producto].$comulla_simple.').val(),'.$comulla_simple.$ide_producto.$comulla_simple.')" /></td>';
						
						
						
						
						$ncampo_val='cuadrobm_stockminimo';
						//echo '<td><input class="css_select" name="cmb_'.$ncampo_val.$rs_listacmp->fields[$ide_producto].'" type="text" id="cmb_'.$ncampo_val.$rs_listacmp->fields[$ide_producto].'" value="'.$rs_listacmp->fields[$ncampo_val].'" size="5" onblur="guardar_campos('.$tabla_valordata.','.$comulla_simple.$ncampo_val.$comulla_simple.','.$rs_listacmp->fields[$ide_producto].',$('.$comulla_simple.'#cmb_'.$ncampo_val.$rs_listacmp->fields[$ide_producto].$comulla_simple.').val(),'.$comulla_simple.$ide_producto.$comulla_simple.')" /></td>';
						echo '<td>'.$rs_listacmp->fields[$ncampo_val].'</td>';
						
						
						$ncampo_val='produ_stockactual';
						
						$alerta_data='';
						if($rs_stactua->fields["stactual"]<=$rs_listacmp->fields["cuadrobm_stockminimo"])
						{
						  $alerta_data='<img src="../../../../../images/'.$grafico_gif.'" width="25" height="24" />';
						}

						echo '<td>'.$rs_stactua->fields["stactual"].' '.$alerta_data.'</td>';		
						
						
						if($insu==1)
			            {
						$ncampo_val='cuadrobm_preciotecho';
						echo '<td>'.$rs_listacmp->fields[$ncampo_val].'</td>';
						}
						
						
						$precioinicial_data=array();
						$precioinicial_data=$objBodega->saca_precio_inicialgeneral($rs_listacmp->fields["cuadrobm_id"],$objformulario,$DB_gogess);				
						
						$precio_data=array();
						$precio_data=$objBodega->saca_precio_comprabp($rs_listacmp->fields["cuadrobm_id"],$objformulario,$DB_gogess);
						
						if($insu==1)
			            {		
						
						$ncampo_val='cuadrobm_preciomedicamento';
						echo '<td>'.$precioinicial_data["ultimo"].'</td>';
						$color_alerta='';
						if($precioinicial_data["diferente"]!='')
						{
						  $color_alerta='bgcolor="#FFE1E1"';
						}
						echo '<td '.$color_alerta.' >'.$precioinicial_data["diferente"].'</td>';
						echo '<td>'.$precio_data["ultimo"].'</td>';
						echo '<td>'.$precio_data["mayor"].'</td>';
						echo '<td>'.$precio_data["menor"].'</td>';
						}
						else
						{
						
						
						$ncampo_val='cuadrobm_preciodispositivo';
						echo '<td>'.$precioinicial_data["ultimo"].'</td>';
						$color_alerta='';
						if($precioinicial_data["diferente"]!='')
						{
						  $color_alerta='bgcolor="#FFE1E1"';
						}
						echo '<td '.$color_alerta.' >'.$precioinicial_data["diferente"].'</td>';
						echo '<td>'.$precio_data["ultimo"].'</td>';
						echo '<td>'.$precio_data["mayor"].'</td>';
						echo '<td>'.$precio_data["menor"].'</td>';
                        }
						
						
						
						/*if($insu==1)
			            {
						$ncampo_val='cuadrobm_valorplanilla';
						echo '<td>'.$rs_listacmp->fields[$ncampo_val].'</td>';
						}
						else
						{
						$ncampo_val='cuadrobm_valorplanilladispositivos';
						echo '<td>'.$rs_listacmp->fields[$ncampo_val].'</td>';
						
						}*/
						
						$clickseguimiento='';
						$clickseguimiento="onclick=abrir_standar('producto/seguimiento.php','Seguimiento','divBody_producto','divDialog_producto',995,650,".$rs_listacmp->fields[$ide_producto].",0,0,0,0,0,'".$_POST["insu"]."')";
						
						echo '<td><input type="button" name="Submit" value="Ver Seguimiento" '.$clickseguimiento.' /></td>';	
						
						
						$clickedit='';
						$clickedit="onclick=abrir_standar('producto/grid_producto_ver.php','Producto','divBody_producto','divDialog_producto',995,650,".$rs_listacmp->fields[$ide_producto].",0,0,0,0,0,'".$_POST["insu"]."')";
						 $nombre_boton='';
						 if(@$_SESSION['ces1313777_usua_subadm']==1)
						 {
							$nombre_boton='Ver'; 
						 }
						 else
						 {
							 $nombre_boton='Ver';
						 }
						echo '<td></td>';
						 
						echo '<td><input type="button" name="Submit" value="'.$nombre_boton.'" '.$clickedit.' /></td>';	
						//echo '<td><input type="button" name="Submit" value="Movimientos" onclick="compras_prk('.$comulla_simple.$rs_listacmp->fields[$ide_producto].$comulla_simple.','.$_POST["centro_idb"].')" /></td>';  

							  
			             echo '</tr>';
						
						   $rs_listacmp->MoveNext();
						}
				   }
		  
		  ?>
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