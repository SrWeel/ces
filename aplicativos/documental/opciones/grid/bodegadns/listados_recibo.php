xxxx<?php
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

$atc_val=$_POST["atc_val"];

for($itbl=0;$itbl<count($lista_tbldata);$itbl++)
{
  include(@$director."libreria/estructura/".$lista_tbldata[$itbl].".php");
} 


$objformulario= new  ValidacionesFormulario();
$objformulario->sisfield_arr=$gogess_sisfield;
$objformulario->sistable_arr=$gogess_sistable;


$objUtil=new util_funciones();
$objUtil->campostxt="compra_fecha,compra_fechaaprobacion";
$objUtil->camposlike="compra_nfactura,provee_nombre";
$sqlconcatenado='';
$sqlconcatenado=$objUtil->genera_sqlbusqueda($_POST["txtbusca"],'OR');
//echo $_POST["insu"];

if($atc_val)
{

$busca_nmedic="select * from dns_cuadrobasicomedicamentos where cuadrobm_codigoatc='".$atc_val."'";
$rs_nmedic= $DB_gogess->executec($busca_nmedic);
$nom1='';					
if($rs_nmedic->fields["cuadrobm_nombrecomercial"])
{
   $nom1=$rs_nmedic->fields["cuadrobm_nombrecomercial"].' ';
}

$nom2='';					
if($rs_nmedic->fields["cuadrobm_primerniveldesagregcion"])
{
   $nom2=$rs_nmedic->fields["cuadrobm_primerniveldesagregcion"].' ';
}

$nom3='';					
if($rs_nmedic->fields["cuadrobm_tercerniveldesagregcion"])
{
   $nom3=$rs_nmedic->fields["cuadrobm_tercerniveldesagregcion"].' ';
}
 
$nom4='';					
if($rs_nmedic->fields["cuadrobm_concentracion"])
{
   $nom4=$rs_nmedic->fields["cuadrobm_concentracion"].' ';
}

$nom5='';					
if($rs_nmedic->fields["cuadrobm_nombredispositivo"])
{
   $nom5=$rs_nmedic->fields["cuadrobm_nombredispositivo"].' ';
}


$concatena_nom=$nom1.$nom2.$nom3.$nom4.$nom5;
$nombre_medic='';
$nombre_medic=$rs_nmedic->fields["cuadrobm_codigoatc"].' '.utf8_encode($rs_nmedic->fields["cuadrobm_principioactivo"]).' '.utf8_encode($concatena_nom);


}

?>
<div id="div_procesar"></div>
<center>
<?php
echo $nombre_medic;

?></center>		  
		  <table border="1" align="center" cellpadding="0" cellspacing="1" id="tabla" class="table-hover record_table" >
			  <tr>
			  <td bgcolor="#AEDBE8"></td>
			  <td bgcolor="#AEDBE8"><strong>No</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Categor&iacute;a</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Fecha Documento</strong></td>
			  <td bgcolor="#AEDBE8"><strong>N&uacute;mero Documento</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Valor Factura $</strong></td>	 
			  <td bgcolor="#AEDBE8"><strong>Alerta $</strong></td>
			  <td bgcolor="#AEDBE8"><strong>No. Reg</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Empresa</strong></td>	   
			  <td bgcolor="#AEDBE8"><strong>Fecha Ingreso</strong></td>	
              <td bgcolor="#A3D6E4"><strong>Ver Listado</strong></td>
			  <td bgcolor="#A3D6E4"><strong></strong></td>
			  <td bgcolor="#A3D6E4"><strong></strong></td>
			  <td bgcolor="#A3D6E4"><strong></strong></td>


			  </tr>
			  
		  <?php
   $busca_compras='';
   $sql_cp='';
   if($atc_val)
   {
		 $busca_compras="select dns_varioscompras.compra_id from dns_varioscompras inner join dns_temporalovimientoinventario on dns_varioscompras.compra_id=dns_temporalovimientoinventario.compra_id inner join dns_cuadrobasicomedicamentos on dns_temporalovimientoinventario.cuadrobm_id=dns_cuadrobasicomedicamentos.cuadrobm_id where cuadrobm_codigoatc='".$atc_val."'";
		 
		 $sql_cp=" and dns_varioscompras.compra_id in (".$busca_compras.") ";
	}
		
		  
		  
		          if($sqlconcatenado)
				   { 
				   $lista_campor="select * from dns_varioscompras left join app_proveedor on dns_varioscompras.proveevar_id=app_proveedor.provee_id where ".$sqlconcatenado." and  dns_varioscompras.emp_id='".@$_SESSION['ces1313777_sessid_emp_id']."' and tipom_id=1 and compra_tipo=1 ".$sql_cp." order by  compra_id desc";	
				   
				   }
				   else
				   {
				    $lista_campor="select * from dns_varioscompras left join app_proveedor on dns_varioscompras.proveevar_id=app_proveedor.provee_id where dns_varioscompras.emp_id='".@$_SESSION['ces1313777_sessid_emp_id']."' and tipom_id=1 and compra_tipo=1 ".$sql_cp." order by  compra_id desc";
				   
				   }  
				  
				  //echo $lista_campor;
		           $cuenta=0;
			       $rs_listacmp = $DB_gogess->executec($lista_campor);
                   if($rs_listacmp)
				   {
						while (!$rs_listacmp->EOF) {	
						
						
						//genera alerta
						
						$busca_dataalerta="select sum((centrorecibe_cantidad*moviin_preciocompra)) as total from dns_varioscompras inner join dns_temporalovimientoinventario on dns_varioscompras.compra_id=dns_temporalovimientoinventario.compra_id where dns_varioscompras.compra_id='".$rs_listacmp->fields["compra_id"]."'";						
						$rs_dataalerta = $DB_gogess->executec($busca_dataalerta);
						
						//=================================================================
						
						$busca_datosexiste="select count(*) as numreg from dns_varioscompras inner join dns_temporalovimientoinventario on dns_varioscompras.compra_id=dns_temporalovimientoinventario.compra_id where dns_varioscompras.compra_id='".$rs_listacmp->fields["compra_id"]."'";						
						$rs_dataexiste = $DB_gogess->executec($busca_datosexiste);
						
						
						//genera alerta
						
						$comulla_simple="'";	
						$tabla_valordata="";
						$campo_valor="";	
						$tabla_valordata="'dns_varioscompras'";
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
						$grafico_url='';
						$link_borrar="borrar_registro_bu('dns_varioscompras','".$ide_producto."','".$rs_listacmp->fields[$ide_producto]."')";	
                        $link_borrar="";
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
						
						$ncategoria='';
						$ncategoria=$objformulario->replace_cmb("dns_categoriadns","categ_id,categ_nombre"," where categ_id=",$rs_listacmp->fields["categ_id"],$DB_gogess);
						echo '<td>'.$ncategoria.'</td>';
						
						$ncampo_val='compra_fecha';
						echo '<td>'.$rs_listacmp->fields[$ncampo_val].'</td>';							
						
						
					    $ncampo_val='compra_ndocumento';
						echo '<td>'.$rs_listacmp->fields[$ncampo_val].'</td>';
						
						$ncampo_val='compra_valorfactura';
						echo '<td>'.$rs_listacmp->fields[$ncampo_val].'</td>';	
						
						$rest_va=0;
						$bandera_pruba=0;
						
						
					$busca_sihayreg="select count(*) as totalreg from dns_temporalovimientoinventario_vista where compra_id='".$rs_listacmp->fields[$ide_producto]."'";
						$rs_sihayreg = $DB_gogess->executec($busca_sihayreg);
						
						
						if($rs_sihayreg->fields["totalreg"]>0)
						{
						//busca alertas
						$busca_dataalerta="select count(*) as totalalerta from dns_temporalovimientoinventario_vista where compra_id='".$rs_listacmp->fields[$ide_producto]."' and 	centrorecibe_observacion!=''";
						$rs_dataalerta = $DB_gogess->executec($busca_dataalerta);
						
						$busca_noverificados="select count(*) as totalnv from dns_temporalovimientoinventario_vista where compra_id='".$rs_listacmp->fields[$ide_producto]."' and 	moviin_verificado='0'";
						$rs_noverificados = $DB_gogess->executec($busca_noverificados);
						
						if($rs_dataalerta->fields["totalalerta"]>0)
						{
						    if($rs_noverificados->fields["totalnv"]>0)
							{
							 echo '<td style="color: #FFFFFF" ><center><b><img src="sinverificar.png"  /></b></center></td>'; 
							}
							else
							{
						     echo '<td style="color: #FFFFFF" ><center><b><img src="alerta.png"  /></b></center></td>'; 
							} 						
						}
						else
						{
						   if($rs_noverificados->fields["totalnv"]>0)
						   {
						    echo '<td style="color: #FFFFFF" ><center><b><img src="sinverificar.png"  /></b></center></td>'; 
						   }
						   else
						   {
						    echo '<td></td>';	
						    $bandera_pruba=1;
						   }					
						}
						//busca alertas		
						}
						else
						{
						  echo '<td style="color: #FFFFFF" ><center><b><img src="sinreg.png"  /></b></center></td>';						
						}				
						
						echo '<td>'.$rs_sihayreg->fields["totalreg"].'</td>';
						
						$ncampo_val='provee_nombrecomercial';
						echo '<td>'.$rs_listacmp->fields[$ncampo_val].'</td>';
						
						$ncampo_val='compra_fechaaprobacion';
						echo '<td>'.$rs_listacmp->fields[$ncampo_val].'</td>';
						
						
						$clickedit='';
						
						if($_POST["insu"]==1)
						{
						$clickedit="onclick=abrir_standar('variosingresos/grid_ingresos_nuevo.php','Ingresos','divBody_producto','divDialog_producto',800,600,".$rs_listacmp->fields[$ide_producto].",0,0,0,0,0,'".$_POST["insu"]."')";
						 }
						 else
						 {
						 $clickedit="onclick=abrir_standar('variosingresos/grid_ingresos_nuevo.php','Ingresos','divBody_producto','divDialog_producto',800,600,".$rs_listacmp->fields[$ide_producto].",0,0,0,0,0,'".$_POST["insu"]."')";
						 
						 }
						 
						 
						$clickverl="onclick=tablas_verlista('variosingresos/verlista.php','".base64_encode($rs_listacmp->fields["compra_id"])."')"; 
						 
						echo '<td><input type="button" name="Submit" value="Ver" '.$clickverl.' /></td>';						 
						echo '<td><input type="button" name="Submit" value="Editar" '.$clickedit.' /></td>';						
						echo '<td><input type="button" name="Submit" value="Movimientos" onclick="ingresos_prkprod('.$comulla_simple.$rs_listacmp->fields[$ide_producto].$comulla_simple.')" /></td>';
						
						$lins_procesra="onclick=procesar_compra('".$rs_listacmp->fields["compra_id"]."')";
							
						if($bandera_pruba==1)
						{
						  if($rs_listacmp->fields["compra_procesado"]==1)
						  {
						    
							
						   $busuario='';
						   $busuario=$objformulario->replace_cmb("app_usuario","usua_id,usua_nombre,usua_apellido"," where usua_id=",$rs_listacmp->fields["compra_usprocesa"],$DB_gogess);
						   
						   //reversar
						  // $btn_reverso='';
						   //$lins_revproc="onclick=reversar_compra('".$rs_listacmp->fields["compra_id"]."')";
						  // $btn_reverso='<input type="button" name="Submit" value="Reversar Proceso"  '.$lins_revproc.' />';						   
						   //reversar
							
							echo '<td>Procesado Fecha:'.$rs_listacmp->fields["compra_fechaprocesado"].' '.$busuario.'<br>'.$btn_reverso.'</td>';
						  }
						  else
						  {
						   echo '<td><input type="button" name="Submit" value="Procesar Aprobar"  '.$lins_procesra.' /></td>';	
						   }
						
						}
						else
						{
						echo '<td>Pendiente Probaci&oacute;n</td>';	
						
						}					
						echo '
					  
			             </tr>';						
						
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


function tablas_verlista(link_url,id) {

myWindow4=window.open(link_url+'?aleat='+id,'ventana_lista','width=990,height=700,scrollbars=YES');
myWindow4.focus();

}

function procesar_compra(compra_id)
{
  if (confirm("Esta seguro que desea Procesar esta factura ?"))
	 { 

   $("#div_procesar").load("movimiento_variosingresos/procesa_ingreso.php",{
    compra_id:compra_id
  },function(result){ 
     listado_facturas();
  });  

  $("#div_procesar").html("Espere un momento...");
  
  }

}


function reversar_compra(compra_id)
{

if (confirm("Esta seguro que desea Reversar esta factura ?"))
	 { 

   $("#div_procesar").load("movimiento_variosingresos/reversar_ingreso.php",{
    compra_id:compra_id
  },function(result){ 
     listado_facturas();
  });  

  $("#div_procesar").html("Espere un momento...");
  
  }

}

//  End -->
</script>
<?php
}
?>