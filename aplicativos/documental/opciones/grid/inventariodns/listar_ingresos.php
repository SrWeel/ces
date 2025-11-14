<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
header('Content-Type: text/html; charset=UTF-8');
$tiempossss="54445000";
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_SESSION['ces1313777_sessid_inicio'])
{

$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");
$sqltotal="";

$objformulario= new  ValidacionesFormulario();
$objUtil=new util_funciones();
$sqlconcatenado='';

$lista_usv="select * from app_usuario where usua_id='".$_SESSION['ces1313777_sessid_inicio']."'";
$rs_usv= $DB_gogess->executec($lista_usv,array());
$centrousuario_id=$rs_usv->fields['centro_id'];
$usua_enlace=$rs_usv->fields["usua_enlace"];

$lista_centr='';

$lista_extra="select * from dns_gridcentros inner join dns_centrosalud on  dns_gridcentros.centro_id=dns_centrosalud.centro_id where usua_enlace='".$usua_enlace."'";
			 $rs_lx = $DB_gogess->executec($lista_extra,array());
			 if($rs_lx)
			 {
				while (!$rs_lx->EOF) { 
				
				$lista_centr.=$rs_lx->fields["centro_id"].",";
				
				$rs_lx->MoveNext();
				}
			 }	
			 
//echo $lista_centr;			 
?>
<style type="text/css">
<!--
.TableScroll_data1 {
    z-index: 99;
    width: 100%;
    height: 350px;
    overflow: auto;
}

.TableScroll_data2 {
    z-index: 99;
    width: 100%;
    height: 350px;
    overflow: auto;
}

-->
</style>

<br />
<center><b>ORIGEN BODEGA PRINCIPAL</b></center>
<br />
<div class="TableScroll_data1" >
<table border="1" align="center" cellpadding="0" cellspacing="1" id="tabla" class="table-hover record_table" >
			  <tr>
			  <td bgcolor="#AEDBE8"></td>
			  <td bgcolor="#AEDBE8"><strong>ID</strong></td>
			  <td bgcolor="#AEDBE8"><strong>N. Comprobante</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Memo</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Sub-bodega Destino</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Fecha</strong></td>	 
			  <td bgcolor="#AEDBE8"><strong>Responsable Entrega</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Personal Recibe</strong></td>	   
			  <td bgcolor="#AEDBE8"><strong>Fecha Registro</strong></td>	
              <td bgcolor="#A3D6E4"><strong>Usuario Registra</strong></td>
			  <td bgcolor="#A3D6E4"><strong></strong></td>
			  <td bgcolor="#A3D6E4"><strong></strong></td>
			  <td bgcolor="#A3D6E4"><strong></strong></td>
			  </tr>	
			  
			  <?php
		          
				   //$lista_campor="select * from dns_egresocentros where categ_id='".$_POST["insu"]."' and  dns_compras.emp_id='".@$_SESSION['ces1313777_sessid_emp_id']."'  order by  compra_fecha desc";	  
				   if($sqlconcatenado)
				   { 
				   $lista_campor="select * from dns_egresocentros inner join dns_centrosalud on  dns_egresocentros.centrod_id=dns_centrosalud.centro_id where ".$sqlconcatenado." and dns_egresocentros.emp_id='".@$_SESSION['ces1313777_sessid_emp_id']."' and centrod_id in (".$lista_centr.$_SESSION['ces1313777_centro_id'].") order by  egrec_id desc";
				   }
				   else
				   {
				   $lista_campor="select * from dns_egresocentros inner join dns_centrosalud on  dns_egresocentros.centrod_id=dns_centrosalud.centro_id where  dns_egresocentros.emp_id='".@$_SESSION['ces1313777_sessid_emp_id']."' and egrec_procesado=1 and centrod_id in (".$lista_centr.$_SESSION['ces1313777_centro_id'].") order by  egrec_id desc";
				   }
				  
				  //echo $lista_campor;
				  
		           $cuenta=0;
			       $rs_listacmp = $DB_gogess->executec($lista_campor);
                   if($rs_listacmp)
				   {
						while (!$rs_listacmp->EOF) {	
						
						
						//genera alerta			
						$bprincipal='';
						$bprincipal=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre"," where centro_id=",$rs_listacmp->fields["centro_id"],$DB_gogess);
						
						$bdestino='';
						$bdestino=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre"," where centro_id=",$rs_listacmp->fields["centrod_id"],$DB_gogess);
						
						$busuario='';
						$busuario=$objformulario->replace_cmb("app_usuario","usua_id,usua_nombre,usua_apellido"," where usua_id=",$rs_listacmp->fields["usua_id"],$DB_gogess);
						
						//genera alerta
						
						$comulla_simple="'";	
						$tabla_valordata="";
						$campo_valor="";	
						$tabla_valordata="'dns_egresocentros'";
						$campo_valor="'egrec_id'";
						$ide_producto='egrec_id';
											

						$cuenta++;	
						$colortr='';
						if($cuenta%2 == 0){
                       			$colortr="style='background-color:#CEE2EA'";
						}else{
							    $colortr="style='background-color:#ffffff'";
						}

						
						echo '<tr '.$colortr.' >';	
						
						if($rs_listacmp->fields["egrec_procesado"]==1)
						{
						echo '<td></td>';
						}
						else
						{
						$link_borrar="borrar_registro_bu('dns_egresocentros','".$ide_producto."','".$rs_listacmp->fields[$ide_producto]."')";						
						echo '<td onclick="'.$link_borrar.'" style="cursor:pointer" ><img src="borrar.png" ></td>';
						}
											    
						$sining='';						
						echo '<td>'.$cuenta.'.-'.$sining.'</td>';			
							
                        $compra_nsec='';
						$compra_nsec=str_pad($rs_listacmp->fields["egrec_id"], 10, "0", STR_PAD_LEFT);
                        
						echo '<td>'.$compra_nsec.'</td>';		
						echo '<td>'.utf8_encode($rs_listacmp->fields["egrec_nmemo"]).'</td>';				
						echo '<td>'.$bdestino.'</td>';
						
						$ncampo_val='egrec_fecha';
						echo '<td>'.$rs_listacmp->fields[$ncampo_val].'</td>';	
						
						$ncampo_val='egrec_responsableentrega';
						echo '<td>'.$rs_listacmp->fields[$ncampo_val].'</td>';	
						
						$ncampo_val='egrec_personalrecibe';
						echo '<td>'.$rs_listacmp->fields[$ncampo_val].'</td>';	
						
						$ncampo_val='egrec_fecharegistro';
						echo '<td>'.$rs_listacmp->fields[$ncampo_val].'</td>';
						
						echo '<td>'.$busuario.'</td>';
												
						
						$clickedit='';
						
						
						 
						 
						$clickverl="onclick=tablas_verlista('aplicativos/documental/opciones/grid/bodegadns/egresocentros/verlista.php','".base64_encode($rs_listacmp->fields["egrec_id"])."')"; 
						 
						if($rs_listacmp->fields["egrec_procesado"]==1)
						{
						echo '<td>Procesado</td>'; 
						}
						else
						{
						 
						echo '<td></td>'; 
						}
						
						$clickedit="onclick=abrir_standarv2('aplicativos/documental/opciones/grid/inventariodns/recibir.php','Ingreso','divBody_producto','divDialog_producto',800,600,".$rs_listacmp->fields[$ide_producto].",0,0,0,0,0,0)";
						
						
						echo '<td><input type="button" name="Submit" value="Ver" '.$clickverl.' /></td>';	
						
						if($rs_listacmp->fields["egrec_recibido"]==1)
						{	
						echo '<td>Recibido</td>';
						}
						else
						{			 
						echo '<td><input type="button" name="Submit" value="Recibir Comprobante"  '.$clickedit.' /></td>';						
						}	
										
						echo '
					  
			             </tr>';						
						
						   $rs_listacmp->MoveNext();
						}
				   }
		  
		  ?>	
		  
		   <tr>
				<td bgcolor="#AEDBE8"></td>
			    <td colspan="4" bgcolor="#AEDBE8"><div align="center" style="font-weight: bold"><b>TOTAL COMPROBANTES: </b><?php echo $cuenta; ?></div></td>
				
			    <td bgcolor="#A3D6E4">&nbsp;</td>
			    <td bgcolor="#A3D6E4">&nbsp;</td>
			    <td bgcolor="#A3D6E4">&nbsp;</td>
				<td bgcolor="#A3D6E4">&nbsp;</td>
				<td bgcolor="#A3D6E4">&nbsp;</td>
			    <td bgcolor="#A3D6E4">&nbsp;</td>
				<td bgcolor="#A3D6E4">&nbsp;</td>
				<td bgcolor="#A3D6E4">&nbsp;</td>
		    </tr>
			  
</table>	
</div>
<br />
<center><b>ORIGEN SUB-BODEGAS</b></center>
<br />
<div class="TableScroll_data2" >
<table border="1" align="center" cellpadding="0" cellspacing="1" id="tabla" class="table-hover record_table" >
			  <tr>
			  <td bgcolor="#AEDBE8"></td>
			  <td bgcolor="#AEDBE8"><strong>ID</strong></td>
			  <td bgcolor="#AEDBE8"><strong>N. Comprobante</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Memo</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Origen</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Sub-bodega Destino</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Fecha</strong></td>	 
			  <td bgcolor="#AEDBE8"><strong>Responsable Entrega</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Personal Recibe</strong></td>	   
			  <td bgcolor="#AEDBE8"><strong>Fecha Registro</strong></td>	
              <td bgcolor="#A3D6E4"><strong>Usuario Registra</strong></td>
			  <td bgcolor="#A3D6E4"><strong></strong></td>
			  <td bgcolor="#A3D6E4"><strong></strong></td>
			  <td bgcolor="#A3D6E4"><strong></strong></td>
			  </tr>	
			  
			  <?php		          
				   //$lista_campor="select * from dns_egresocentros where categ_id='".$_POST["insu"]."' and  dns_compras.emp_id='".@$_SESSION['ces1313777_sessid_emp_id']."'  order by  compra_fecha desc";	  
				   if($sqlconcatenado)
				   { 
				   $lista_campor="select *,dns_invegresosvarios.centro_id as centroor_id from dns_invegresosvarios inner join cmb_destinocentro_vista on  dns_invegresosvarios.centrod_id=cmb_destinocentro_vista.centro_id where ".$sqlconcatenado." and dns_invegresosvarios.emp_id='".@$_SESSION['ces1313777_sessid_emp_id']."' and centrod_id='".$_SESSION['ces1313777_centro_id']."' order by  egrec_fechaprocesa desc";
				   }
				   else
				   {
				  $lista_campor="select *,dns_invegresosvarios.centro_id as centroor_id from dns_invegresosvarios inner join cmb_destinocentro_vista on  dns_invegresosvarios.centrod_id=cmb_destinocentro_vista.centro_id where  dns_invegresosvarios.emp_id='".@$_SESSION['ces1313777_sessid_emp_id']."' and egrec_procesado=1 and centrod_id='".$_SESSION['ces1313777_centro_id']."' order by  egrec_fechaprocesa desc";
				   //$lista_campor="select *,dns_invegresosvarios.centro_id as centroor_id from dns_invegresosvarios inner join cmb_destinocentro_vista on  dns_invegresosvarios.centrod_id=cmb_destinocentro_vista.centro_id where  dns_invegresosvarios.emp_id='".@$_SESSION['ces1313777_sessid_emp_id']."' and egrec_procesado=1  order by  egrec_fechaprocesa desc";
				   
				   }
				  
				  //echo $lista_campor;
		           $cuenta=0;
			       $rs_listacmp = $DB_gogess->executec($lista_campor);
                   if($rs_listacmp)
				   {
						while (!$rs_listacmp->EOF) {	
						
						
						//genera alerta			
						$bprincipal='';
						$bprincipal=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre"," where centro_id=",$rs_listacmp->fields["centro_id"],$DB_gogess);
						
						$bdestino='';
						$bdestino=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre"," where centro_id=",$rs_listacmp->fields["centrod_id"],$DB_gogess);
						
						$borigen='';
						$borigen=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre"," where centro_id=",$rs_listacmp->fields["centroor_id"],$DB_gogess);
						
						$busuario='';
						$busuario=$objformulario->replace_cmb("app_usuario","usua_id,usua_nombre,usua_apellido"," where usua_id=",$rs_listacmp->fields["usua_id"],$DB_gogess);
						
						//genera alerta
						
						$comulla_simple="'";	
						$tabla_valordata="";
						$campo_valor="";	
						$tabla_valordata="'dns_invegresosvarios'";
						$campo_valor="'egrec_id'";
						$ide_producto='egrec_id';
											

						$cuenta++;	
						$colortr='';
						if($cuenta%2 == 0){
                       			$colortr="style='background-color:#CEE2EA'";
						}else{
							    $colortr="style='background-color:#ffffff'";
						}

						
						echo '<tr '.$colortr.' >';	
						
						if($rs_listacmp->fields["egrec_procesado"]==1)
						{
						echo '<td></td>';
						}
						else
						{
						$link_borrar="borrar_registro_bu('dns_invegresosvarios','".$ide_producto."','".$rs_listacmp->fields[$ide_producto]."')";						
						echo '<td></td>';
						}
											    
						$sining='';						
						echo '<td>'.$cuenta.'.-'.$sining.'</td>';			
							
                        $compra_nsec=str_pad($rs_listacmp->fields["egrec_id"], 10, "0", STR_PAD_LEFT);
                        
						echo '<td>'.$compra_nsec.'</td>';		
						echo '<td>'.utf8_encode($rs_listacmp->fields["egrec_nmemo"]).'</td>';	
						
						echo '<td>'.$borigen.'</td>';			
						echo '<td>'.$bdestino.'</td>';
						
						$ncampo_val='egrec_fecha';
						echo '<td>'.$rs_listacmp->fields[$ncampo_val].'</td>';	
						
						$ncampo_val='egrec_responsableentrega';
						echo '<td>'.utf8_encode($rs_listacmp->fields[$ncampo_val]).'</td>';	
						
						$ncampo_val='egrec_personalrecibe';
						echo '<td>'.$rs_listacmp->fields[$ncampo_val].'</td>';	
						
						$ncampo_val='egrec_fecharegistro';
						echo '<td>'.$rs_listacmp->fields[$ncampo_val].'</td>';
						
						echo '<td>'.$busuario.'</td>';
												
						
						$clickedit='';
						
						
						 
						 
						$clickverl="onclick=tablas_verlista('aplicativos/documental/opciones/grid/inventariocentros/egresovarios/verlista.php','".base64_encode($rs_listacmp->fields["egrec_id"])."')"; 
						 
						if($rs_listacmp->fields["egrec_procesado"]==1)
						{
						echo '<td>Procesado</td>'; 
						}
						else
						{
						 
						echo '<td></td>'; 
						}
						
						$clickedit="onclick=abrir_standarv2('aplicativos/documental/opciones/grid/inventariodns/recibircen.php','Ingreso','divBody_producto','divDialog_producto',800,600,".$rs_listacmp->fields[$ide_producto].",0,0,0,0,0,0)";
						
						
						echo '<td><input type="button" name="Submit" value="Ver" '.$clickverl.' /></td>';	
						
						if($rs_listacmp->fields["egrec_recibido"]==1)
						{	
						echo '<td>Recibido</td>';
						}
						else
						{			 
						echo '<td><input type="button" name="Submit" value="Recibir Comprobante"  '.$clickedit.' /></td>';						
						}	
										
						echo '
					  
			             </tr>';						
						
						   $rs_listacmp->MoveNext();
						}
				   }
		  
		  ?>	
		  
		   <tr>
				<td bgcolor="#AEDBE8"></td>
			    <td colspan="4" bgcolor="#AEDBE8"><div align="center" style="font-weight: bold"><b>TOTAL COMPROBANTES: </b><?php echo $cuenta; ?></div></td>
				
			    <td bgcolor="#A3D6E4">&nbsp;</td>
			    <td bgcolor="#A3D6E4">&nbsp;</td>
			    <td bgcolor="#A3D6E4">&nbsp;</td>
				<td bgcolor="#A3D6E4">&nbsp;</td>
				<td bgcolor="#A3D6E4">&nbsp;</td>
				<td bgcolor="#A3D6E4">&nbsp;</td>
			    <td bgcolor="#A3D6E4">&nbsp;</td>
				<td bgcolor="#A3D6E4">&nbsp;</td>
				<td bgcolor="#A3D6E4">&nbsp;</td>
		    </tr>
			  
</table>	
</div>

<script type="text/javascript">
<!--
function tablas_verlista(link_url,id) {

myWindow4=window.open(link_url+'?aleat='+id,'ventana_lista','width=990,height=700,scrollbars=YES');
myWindow4.focus();

}	



//  End -->
</script>
<?php
}

?>