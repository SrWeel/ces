<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
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


$ncentro=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre"," where centro_id=",$_GET["centro_idb"],$DB_gogess);

header('Content-type: application/vnd.ms-excel');
$fechahoy=date("Y-m-d");
header("Content-Disposition: attachment; filename=".$ncentro."_".$fechahoy.".xls");
//echo $_GET["insu"];

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
-->
</style>


<center><B><?php echo $ncentro; ?></B></center><br />

 <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="padding: 2px;"   >
        <tr>
          <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px">
		  
		  <table width="100%" border="1" align="center" cellpadding="0" cellspacing="1" id="tabla"  >
			  <tr>
			    <td colspan="10" bgcolor="#AEDBE8"><div align="center" style="font-weight: bold">DATOS</div></td>
				
			 
				
		    </tr>
			  <tr>
			  <td bgcolor="#AEDBE8"><strong>ID</strong></td>
			  <td bgcolor="#AEDBE8"><strong>TIPO</strong></td>
			  <td bgcolor="#AEDBE8"><strong>C&oacute;digo</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Nombre</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Stock Minimo</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Stock Actual</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Precio de compra</strong></td>
			  <td bgcolor="#AEDBE8"><strong>PVP</strong></td>
			  <td bgcolor="#AEDBE8"><strong>P Isspol</strong></td>

	
				
			  </tr>
			  
		  <?php
		          if($_GET["insu"]>0)
				  {
					  if(@$_GET["txtbusca"]=='' and @$_GET["produ_idip"]=='' and @$_GET["produ_idpp"]=='')
					  {
					   $lista_campor="select * from dns_cuadrobasicomedicamentos_vista order by  categ_id asc";
					  }
					  else
					  {
					   
					   if($_GET["txtbusca"]!='')
					   {
					   $lista_campor="select * from dns_cuadrobasicomedicamentos_vista where  (cuadrobm_codigoatc like '%".$_GET["txtbusca"]."%' or cuadrobm_principioactivo like '%".$_GET["txtbusca"]."%' or cuadrobm_nombrecomercial like '%".$_GET["txtbusca"]."%')  order by  cuadrobm_principioactivo asc";
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
						
					    $stockactual="select sum(stock_cantidad*stock_signo) as stactual from dns_stockactual where centro_id=".$_GET["centro_idb"]." and cuadrobm_id=".$rs_listacmp->fields["cuadrobm_id"];
						$rs_stactua = $DB_gogess->executec($stockactual);

						$cuenta++;	
						$colortr='';
						if($cuenta%2 == 0){
                       			$colortr="style='background-color:#CEE2EA'";
						}else{
							    $colortr="style='background-color:#ffffff'";
						}

                       // if($rs_stactua->fields["stactual"]>0)
						//{
						
						echo '<tr '.$colortr.' >';
					
						
						$busca_compras="select * from dns_movimientoinventario where cuadrobm_id=".$rs_listacmp->fields[$ide_producto]." order by moviin_id desc limit 1";
						$rs_bcompra = $DB_gogess->executec($busca_compras);
								
						
						$link_borrar="borrar_registro_bu('dns_cuadrobasicomedicamentos','".$ide_producto."','".$rs_listacmp->fields[$ide_producto]."')";
															       
						
						echo '<td>'.$cuenta.'.-</td>';
						
						if($rs_listacmp->fields["categ_id"]==1)
						{
						echo '<td>MEDICAMENTO</td>';
						}
						else
						{
						echo '<td>INSUMOS</td>';
						}
						
						$ncampo_val='cuadrobm_codigoatc';
						echo '<td style=mso-number-format:"@" >'.utf8_encode($rs_listacmp->fields[$ncampo_val]).'</td>';
							 
							  
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
						echo '<td>'.$rs_listacmp->fields[$ncampo_val].'</td>';
						
						
						
						$ncampo_val='produ_stockactual';

						echo '<td>'.$rs_stactua->fields["stactual"].'</td>';
						
						
						
				

						$clickedit='';
						$clickedit="onclick=abrir_standar('producto/grid_producto_nuevo.php','Producto','divBody_producto','divDialog_producto',995,650,".$rs_listacmp->fields[$ide_producto].",0,0,0,0,0,'".$_GET["insu"]."')";
						 
						$nombre_boton='';
						 if(@$_SESSION['ces1313777_usua_subadm']==1)
						 {
							$nombre_boton='Editar'; 
						 }
						 else
						 {
							 $nombre_boton='Ver';
						 } 
		
						 
					
						
						$clickexistencia='';
						$clickexistencia="onclick=abrir_standar('lista_existencias.php','Producto','divBody_producto','divDialog_producto',800,650,".$rs_listacmp->fields[$ide_producto].",0,0,0,0,0,'".$_GET["insu"]."')";
						
						
						$precios_valores=array();
						$precios_valores=$objBodega->busca_precioproducto($rs_listacmp->fields["cuadrobm_id"],$DB_gogess);
						
						 $precio_c=$objBodega->busca_preciomayorcompra($rs_listacmp->fields["cuadrobm_id"],$DB_gogess);
						
						//echo '<td>'.$precios_valores["pcosto"].'->'.$precio_c.'->'.$rs_listacmp->fields["cuadrobm_id"].'</td>';
						echo '<td>'.$precios_valores["pcosto"].'</td>';
						echo '<td>'.$precios_valores["pvp"].'</td>';
						echo '<td>'.$precios_valores["pisspol"].'</td>';
						  
						
							  
			           echo '</tr>';
						 
						// }
						
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