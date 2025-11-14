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

include("lib_excel.php");

for($itbl=0;$itbl<count($lista_tbldata);$itbl++)
{
  include(@$director."libreria/estructura/".$lista_tbldata[$itbl].".php");
} 


$objformulario= new  ValidacionesFormulario();
$objformulario->sisfield_arr=$gogess_sisfield;
$objformulario->sistable_arr=$gogess_sistable;


$contenid_exl='';
//echo $_GET["insu"];


$contenid_exl= '<style type="text/css">
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
</style>';

$bodega_codigo=0;
$bodega_codigo=$_GET["centro_idb"];

 $ncentro= $objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre"," where centro_id=",$_GET["centro_idb"],$DB_gogess);
 $centro_idb=$_GET["centro_idb"];
 
header('Content-type: application/vnd.ms-excel');
$fechahoy=date("Y-m-d");
header("Content-Disposition: attachment; filename=AJ_".$centro_idb."_".$fechahoy.".xls");
 
if($centro_idb==1)
{
 $busca_prporbd="select distinct cuadrobm_id from dns_principalmovimientoinventario where centro_id='55'";
}
else
{
 $busca_prporbd="select distinct cuadrobm_id from dns_movimientoinventario where centro_id='".$_GET["centro_idb"]."'";
} 

$contenid_exl.= '<center><B>'.$ncentro.'</B></center><br />'.$bodega_codigo;

 $contenid_exl.= '<table border="0" cellpadding="0" cellspacing="0" align="center" style="padding: 2px;"   >
        <tr>
          <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px">
		  
		  <table border="1" align="center" cellpadding="0" cellspacing="1" id="tabla" class="table-hover record_table" >
			 
			  <tr>
			  <td bgcolor="#AEDBE8"><strong>ID</strong></td>
			  <td bgcolor="#AEDBE8"><strong>TIPO</strong></td>
			  <td bgcolor="#AEDBE8"><strong>C&oacute;digo</strong></td>
			  <td bgcolor="#AEDBE8"><strong>C&oacute;digo ISSPOL</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Nombre</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Stock Minimo</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Stock Actual</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Precio Compra</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Precio PVP</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Precio ISSPOL</strong></td>
              <td bgcolor="#AEDBE8"><strong>Precio Plasticos</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Colocar Real</strong></td>
		
				
			  </tr>';
			  
	
		          if($_GET["insu"]>0)
				  {
					  if(@$_GET["txtbusca"]=='' and @$_GET["produ_idip"]=='' and @$_GET["produ_idpp"]=='')
					  {
					   $lista_campor="select * from dns_cuadrobasicomedicamentos_vista where cuadrobm_id in (".$busca_prporbd.") order by  cuadrobm_principioactivo asc";
					  }
					  else
					  {
					   
					   if($_GET["txtbusca"]!='')
					   {
					   $lista_campor="select * from dns_cuadrobasicomedicamentos_vista where  (cuadrobm_codigoatc like '%".$_GET["txtbusca"]."%' or cuadrobm_principioactivo like '%".$_GET["txtbusca"]."%' or cuadrobm_nombrecomercial like '%".$_GET["txtbusca"]."%') and cuadrobm_id in (".$busca_prporbd.") order by  cuadrobm_principioactivo asc";
					   }
					   
					   
					  }
					  	  
				  }
				  else
				  {
				  $lista_campor="select * from dns_cuadrobasicomedicamentos_vista where cuadrobm_id in (".$busca_prporbd.") order by  cuadrobm_principioactivo asc limit 200";
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
						
						if($centro_idb==1)
						{
						//$stockactual="select sum(stock_cantidad*stock_signo) as stactual from dns_stockactual where centro_id=".$_GET["centro_idb"]." and cuadrobm_id=".$rs_listacmp->fields["cuadrobm_id"];
						$stockactual="select round(sum(stock_cantidad*stock_signo),2) as stactual from dns_principalstockactual where centro_id='55' and cuadrobm_id=".$rs_listacmp->fields["cuadrobm_id"];
						$rs_stactua = $DB_gogess->executec($stockactual);
						}
						else
						{
					    $stockactual="select round(sum(stock_cantidad*stock_signo),2) as stactual from dns_stockactual where centro_id=".$_GET["centro_idb"]." and cuadrobm_id=".$rs_listacmp->fields["cuadrobm_id"];
						$rs_stactua = $DB_gogess->executec($stockactual);
                        }
						
						
						
						$colortr='';
						if($cuenta%2 == 0){
                       			$colortr="style='background-color:#CEE2EA'";
						}else{
							    $colortr="style='background-color:#ffffff'";
						}

                        $contar_pasa=1;
						//if($rs_stactua->fields["stactual"]!=0)
						if($contar_pasa==1)
						{
						//===================================
						
						$contenid_exl.= '<tr '.$colortr.' >';
					
						
						$busca_compras="select * from dns_movimientoinventario where cuadrobm_id=".$rs_listacmp->fields[$ide_producto]." order by moviin_id desc limit 1";
						$rs_bcompra = $DB_gogess->executec($busca_compras);
								
						
						$link_borrar="borrar_registro_bu('dns_cuadrobasicomedicamentos','".$ide_producto."','".$rs_listacmp->fields[$ide_producto]."')";
															       
						$cuenta++;	
						$contenid_exl.= '<td>'.$cuenta.'.-</td>';
						$nproducto='';
						if($rs_listacmp->fields["categ_id"]==1)
						{
						$contenid_exl.= '<td>MEDICAMENTO</td>';
						}
						else
						{
						
						
						
						$nproducto=$objformulario->replace_cmb("dns_categoriadns","categ_id,categ_nombre"," where categ_id=",$rs_listacmp->fields["categ_id"],$DB_gogess);
						
						$contenid_exl.= '<td>'.$nproducto.'</td>';
						
						}
						
						$ncampo_val='cuadrobm_codigoatc';
						$contenid_exl.= '<td style=mso-number-format:"@" >'.($rs_listacmp->fields[$ncampo_val]).'</td>';
					
					  	$contenid_exl.= '<td></td>';			 
							  
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
						
						$contenid_exl.= '<td width="310px" >'.($rs_listacmp->fields[$ncampo_val]).' '.($concatena_nom).'</td>';
						//echo '<td><input class="css_select" name="cmb_'.$ncampo_val.$rs_listacmp->fields[$ide_producto].'" type="text" id="cmb_'.$ncampo_val.$rs_listacmp->fields[$ide_producto].'" value="'.$rs_listacmp->fields[$ncampo_val].'" size="20" onblur="guardar_campos('.$tabla_valordata.','.$comulla_simple.$ncampo_val.$comulla_simple.','.$rs_listacmp->fields[$ide_producto].',$('.$comulla_simple.'#cmb_'.$ncampo_val.$rs_listacmp->fields[$ide_producto].$comulla_simple.').val(),'.$comulla_simple.$ide_producto.$comulla_simple.')" /></td>';
						
						
						
						
						$ncampo_val='cuadrobm_stockminimo';
						$contenid_exl.= '<td>'.$rs_listacmp->fields[$ncampo_val].'</td>';						
						
						
						$ncampo_val='produ_stockactual';
						$contenid_exl.= '<td>'.$rs_stactua->fields["stactual"].'</td>';
						
						$busca_preciov="select * from  dns_preciostiempo where cuadrobm_id='".$rs_listacmp->fields["cuadrobm_id"]."'";
						$rs_preciov = $DB_gogess->executec($busca_preciov);
						
						
						//$ncampo_val='cuadrobm_preciotecho';
						$contenid_exl.= '<td>'.$rs_preciov->fields["precio_compra"].'</td>';
						
						//$ncampo_val='cuadrobm_preciomedicamento';
						$contenid_exl.= '<td>'.$rs_preciov->fields["precio_pvp"].'</td>';
						
						//$ncampo_val='cuadrobm_preciodispositivo';
						$contenid_exl.= '<td>'.$rs_preciov->fields["precio_ispol"].'</td>';
						
						$contenid_exl.= '<td>'.$rs_preciov->fields["precio_plasticos"].'</td>';

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
						
						$contenid_exl.= '<td></td>';
							  
			            $contenid_exl.= '</tr>';
						//=========================================== 
						 }
						
						   $rs_listacmp->MoveNext();
						}
				   }
		  
		
		  $contenid_exl.= '</table>
		  
		  
		  </td>
        </tr>
</table>';

echo $contenid_exl;
 
// $nombrexls="AJ_".$centro_idb."_".$fechahoy;
 
 //$obj_xlsx = new  ExcelService();
 //$nombre_file=$obj_xlsx->generateExcel($contenid_exl,$nombrexls);
 
//$obj_xlsx->downloadFile($nombre_file);
 
}
?>