<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
header('Content-Type: text/html; charset=UTF-8');
$tiempossss="44450000";
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


$codigo_pr=$_POST["codigo_pr"];
$lote_pr=$_POST["lote_pr"];
$fechai=$_POST["fechai"];
$fechaf=$_POST["fechaf"];
$categ_id=$_POST["categ_id"];

$centro_id=$_POST["centro_id"];
$subcateg_id=$_POST["subcateg_id"];



if(@$_SESSION['ces1313777_sessid_inicio'])
{
$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");
$sqltotal="";

$objformulario= new  ValidacionesFormulario();

$b_periodoac="";
$per_activo=0;
$per_activo=$objformulario->replace_cmb("dns_periodobodega","perio_activo,perio_anio"," where perio_activo=",1,$DB_gogess);

$ncentro=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre"," where centro_id=",$centro_id,$DB_gogess);

$subcateg_id=$_POST["subcateg_id"];

?>
<div align="center">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td><div align="center"><strong>DIRECCION NACIONAL DE ATENCION INTEGRA EN SALUD DE LA POLICIA NACIONAL </strong></div></td>
    </tr>
    <tr>
      <td><div align="center"><strong>Bodega: <?php echo $ncentro; ?> Fecha desde: </strong><?php echo $fechai; ?> Fecha hasta: </strong><?php echo $fechaf; ?></div></td>
    </tr>
    <tr>
      <td><div align="center"></div></td>
    </tr>
  </table>
</div>
<?php

$fechai=$_POST["fechai"];
$fechaf=$_POST["fechaf"];

if($categ_id)
{

$lista_campor="select *,concat(cuadrobm_principioactivo,' ',cuadrobm_nombredispositivo,' ',cuadrobm_primerniveldesagregcion,' ',cuadrobm_presentacion,' ',cuadrobm_concentracion) nombre_med from dns_compras left join app_proveedor on dns_compras.proveevar_id=app_proveedor.provee_id inner join dns_temporalovimientoinventario on dns_compras.compra_id=dns_temporalovimientoinventario.compra_id inner join dns_cuadrobasicomedicamentos on dns_temporalovimientoinventario.cuadrobm_id=dns_cuadrobasicomedicamentos.cuadrobm_id where dns_compras.emp_id='".@$_SESSION['ces1313777_sessid_emp_id']."' and compra_tipo=0 and dns_compras.tipom_id=1 and dns_compras.tipomov_id=17 and (compra_fecha>='".$fechai."' and compra_fecha<='".$fechaf."') and dns_compras.categ_id='".$categ_id."' order by  dns_compras.compra_id desc";	

}
else
{

$lista_campor="select *,concat(cuadrobm_principioactivo,' ',cuadrobm_nombredispositivo,' ',cuadrobm_primerniveldesagregcion,' ',cuadrobm_presentacion,' ',cuadrobm_concentracion) nombre_med from dns_compras left join app_proveedor on dns_compras.proveevar_id=app_proveedor.provee_id inner join dns_temporalovimientoinventario on dns_compras.compra_id=dns_temporalovimientoinventario.compra_id inner join dns_cuadrobasicomedicamentos on dns_temporalovimientoinventario.cuadrobm_id=dns_cuadrobasicomedicamentos.cuadrobm_id where dns_compras.emp_id='".@$_SESSION['ces1313777_sessid_emp_id']."' and compra_tipo=0 and dns_compras.tipom_id=1 and dns_compras.tipomov_id=17 and (compra_fecha>='".$fechai."' and compra_fecha<='".$fechaf."') order by  dns_compras.compra_id desc";	


}
				   
$suma_totalesd=0;
//echo $bu_fcorte;
?>
<br>
<br>

 <table border="1" align="center" cellpadding="0" cellspacing="1" id="tabla" class="table-hover record_table" >
			  <tr>
			  <td bgcolor="#AEDBE8"></td>
			  <td bgcolor="#AEDBE8"><strong>No</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Fecha Factura</strong></td>
			  <td bgcolor="#AEDBE8"><strong>N&uacute;mero Factura</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Valor Factura $</strong></td>	 
			  <td bgcolor="#AEDBE8"><strong>Alerta $</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Empresa</strong></td>	   
			  <td bgcolor="#AEDBE8"><strong>Fecha Ingreso</strong></td>	
			  <td bgcolor="#A3D6E4"><strong></strong></td>
			  
			    <td bgcolor="#AEDBE8" ><b>CUM</b></td>
				<td bgcolor="#AEDBE8" ><b>NOMBRE GENERICO (forma farmac&eacute;utica, concentraci&oacute;n)</b></td>	
				<td bgcolor="#AEDBE8" ><b>No REGISTRO SANITARIO</b></td>	
				<td bgcolor="#AEDBE8" ><b>No Lote</b></td>
				<td bgcolor="#AEDBE8" ><b>Fecha de Caducidad</b></td>
				<td bgcolor="#AEDBE8" ><b>Fecha Elaboraci&oacute;n</b></td>
				<td bgcolor="#AEDBE8" ><b>Cantidad</b></td>
				<td bgcolor="#AEDBE8" ><b>Valor Unitario (USD)</b></td>
				<td bgcolor="#AEDBE8" ><b>Valor Total (USD)</b></td>
				 
				
			  </tr>
			  
			  <?php
  $cuenta=0;
			       $rs_listacmp = $DB_gogess->executec($lista_campor);
                   if($rs_listacmp)
				   {
						while (!$rs_listacmp->EOF) {	
						
						
						//genera alerta
						
						$busca_dataalerta="select sum((centrorecibe_cantidad*moviin_preciocompra)) as total from dns_compras inner join dns_temporalovimientoinventario on dns_compras.compra_id=dns_temporalovimientoinventario.compra_id where dns_compras.compra_id='".$rs_listacmp->fields["compra_id"]."'";						
						$rs_dataalerta = $DB_gogess->executec($busca_dataalerta);
						
						//=================================================================
						
						$busca_datosexiste="select count(*) as numreg from dns_compras inner join dns_temporalovimientoinventario on dns_compras.compra_id=dns_temporalovimientoinventario.compra_id where dns_compras.compra_id='".$rs_listacmp->fields["compra_id"]."'";						
						$rs_dataexiste = $DB_gogess->executec($busca_datosexiste);
						
						
						//genera alerta
						
						$comulla_simple="'";	
						$tabla_valordata="";
						$campo_valor="";	
						$tabla_valordata="'dns_compras'";
						$campo_valor="'compra_id'";
						$ide_producto='compra_id';
											

						$cuenta++;	
						$colortr='';
						if($cuenta%2 == 0){
                       			$colortr="style='background-color:#CEE2EA'";
						}else{
							    $colortr="style='background-color:#ffffff'";
						}


                        $grafico_url='<img src="borrar.png" >';
						$link_borrar="borrar_registro_bu('dns_compras','".$ide_producto."','".$rs_listacmp->fields[$ide_producto]."')";	

                        if($rs_dataexiste->fields["numreg"]>0)
						{
						  $grafico_url='';
						   $link_borrar='';
						}

						
						echo '<tr '.$colortr.' >';	
						
										
						
						echo '<td onclick="'.$link_borrar.'" style="cursor:pointer" >'.$grafico_url.'</td>';
											    
						$sining='';		
						
						$compra_nsec=str_pad($rs_listacmp->fields["compra_id"], 10, "0", STR_PAD_LEFT);
										
						echo '<td>'.$compra_nsec.'</td>';	
						
						
						$ncampo_val='compra_fecha';
						echo '<td>'.$rs_listacmp->fields[$ncampo_val].'</td>';							
						
						
					    $ncampo_val='compra_nfactura';
						echo '<td>'.$rs_listacmp->fields[$ncampo_val].'</td>';
						
						$ncampo_val='compra_valorfactura';
						echo '<td>'.$rs_listacmp->fields[$ncampo_val].'</td>';	
						
						$rest_va=0;
						$bandera_pruba=0;
						
											
						if(number_format($rs_dataalerta->fields["total"], 2, '.', '')==number_format($rs_listacmp->fields[$ncampo_val], 2, '.', ''))
						{
						  echo '<td></td>';
						  $bandera_pruba=1;
						  
						}	
						else
						{
						  if(number_format($rs_dataalerta->fields["total"], 2, '.', '')>number_format($rs_listacmp->fields[$ncampo_val], 2, '.', ''))
						  {
						  $rest_va=number_format($rs_listacmp->fields[$ncampo_val], 2, '.', '')-number_format($rs_dataalerta->fields["total"], 2, '.', '');
						  echo '<td bgcolor="#FF0000" style="color: #FFFFFF" ><center><b>ALERTA Exedente:'.$rest_va.'</b></center></td>'; 
						  }
						  else
						  {
						  //$rest_va=$rs_listacmp->fields[$ncampo_val]-$rs_dataalerta->fields["total"];
						  $rest_va=number_format($rs_listacmp->fields[$ncampo_val], 2, '.', '')-number_format($rs_dataalerta->fields["total"], 2, '.', '');
						  echo '<td bgcolor="#FF0000" style="color: #FFFFFF" ><center><b>ALERTA Faltante:'.$rest_va.'</b></center></td>'; 
						  }
						  
						  
						}	
						
						$ncampo_val='provee_nombrecomercial';
						echo '<td>'.$rs_listacmp->fields[$ncampo_val].'</td>';
						
						$ncampo_val='compra_fechaaprobacion';
						echo '<td>'.$rs_listacmp->fields[$ncampo_val].'</td>';
						
						
						$clickedit='';
						
						if($_POST["insu"]==1)
						{
						$clickedit="onclick=abrir_standar('compras/grid_compras_nuevo.php','Factura_Medicamentos','divBody_producto','divDialog_producto',800,600,".$rs_listacmp->fields[$ide_producto].",0,0,0,0,0,'".$_POST["insu"]."')";
						 }
						 else
						 {
						 $clickedit="onclick=abrir_standar('compras/grid_compras_nuevo.php','Factura_Dispositivos','divBody_producto','divDialog_producto',800,600,".$rs_listacmp->fields[$ide_producto].",0,0,0,0,0,'".$_POST["insu"]."')";
						 
						 }
						 
						 
						$clickverl="onclick=tablas_verlista('compras/verlista.php','".base64_encode($rs_listacmp->fields["compra_id"])."')"; 
						 
				
						
						$lins_procesra="onclick=procesar_compra('".$rs_listacmp->fields["compra_id"]."')";
							
						if($bandera_pruba==1)
						{
						  if($rs_listacmp->fields["compra_procesado"]==1)
						  {
						    
							
						   $busuario='';
						   $busuario=$objformulario->replace_cmb("app_usuario","usua_id,usua_nombre,usua_apellido"," where usua_id=",$rs_listacmp->fields["compra_usprocesa"],$DB_gogess);
						   
						   //reversar
						   $btn_reverso='';
						   $lins_revproc="onclick=reversar_compra('".$rs_listacmp->fields["compra_id"]."')";
						   $btn_reverso='<input type="button" name="Submit" value="Reversar Proceso"  '.$lins_revproc.' />';
						   $btn_reverso='';						   
						   //reversar
							
							echo '<td>Procesado Fecha:'.$rs_listacmp->fields["compra_fechaprocesado"].' '.$busuario.'<br>'.$btn_reverso.'</td>';
						  }
						  else
						  {
						   echo '<td></td>';	
						   }
						
						}
						else
						{
						echo '<td>Pendiente Probaci&oacute;n</td>';	
						
						}					
							
						 
						echo '<td>'.$rs_listacmp->fields["cuadrobm_codigoatc"].'</td>
						<td>'.utf8_encode($rs_listacmp->fields["nombre_med"]).'</td>
						<td>'.$rs_listacmp->fields["moviin_rsanitario"].'</td>
						<td>'.$rs_listacmp->fields["moviin_nlote"].'</td>
						<td>'.$rs_listacmp->fields["moviin_fechadecaducidad"].'</td>
						<td>'.$rs_listacmp->fields["moviin_fechadeelaboracion"].'</td>
						<td>'.$rs_listacmp->fields["centrorecibe_cantidad"].'</td>
						<td>'.number_format($rs_listacmp->fields["moviin_preciocompra"], 4, '.', '').'</td>
						<td>'.number_format($rs_listacmp->fields["moviin_total"], 2, '.', '').'</td>';
						 
						echo '					  
			             </tr>';	
						 
						 $suma_totalesd=$suma_totalesd+	number_format($rs_listacmp->fields["moviin_total"], 2, '.', '');		
						
						   $rs_listacmp->MoveNext();
						}
				   }
		  
		  ?>
		  
		  <tr>
				<td bgcolor="#AEDBE8"></td>
			    <td colspan="4" bgcolor="#AEDBE8"><div align="center" style="font-weight: bold"><b>TOTAL FACTURAS: </b><?php echo $cuenta; ?></div></td>
				
			    <td bgcolor="#A3D6E4">&nbsp;</td>
			    <td bgcolor="#A3D6E4">&nbsp;</td>
			    <td bgcolor="#A3D6E4">&nbsp;</td>
				<td bgcolor="#A3D6E4">&nbsp;</td>
				
				
				<td bgcolor="#A3D6E4">&nbsp;</td>
				<td bgcolor="#A3D6E4">&nbsp;</td>
				<td bgcolor="#A3D6E4">&nbsp;</td>
				<td bgcolor="#A3D6E4">&nbsp;</td>
				<td bgcolor="#A3D6E4">&nbsp;</td>
				<td bgcolor="#A3D6E4">&nbsp;</td>
				<td bgcolor="#A3D6E4">&nbsp;</td>
				<td bgcolor="#A3D6E4">&nbsp;</td>
				<td bgcolor="#A3D6E4"><?php echo $suma_totalesd; ?></td>
				
		    </tr>
		  </table>
<?php
}
?>