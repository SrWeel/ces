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
$nombre_medic=$rs_nmedic->fields["cuadrobm_codigoatc"].' '.$rs_nmedic->fields["cuadrobm_principioactivo"].' '.$concatena_nom;


}

?>
<div id="div_procesar"></div>
<center>
<?php
echo @$nombre_medic;

?></center>		  
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
              <td bgcolor="#A3D6E4"><strong>Ver ingreso contabilidad</strong></td>
			  <td bgcolor="#A3D6E4"><strong>Ver Listado</strong></td>
			  <td bgcolor="#A3D6E4"><strong>Procesar a</strong></td>
			  <td bgcolor="#A3D6E4"><strong></strong></td>
			  <td bgcolor="#A3D6E4"><strong></strong></td>
			  <td bgcolor="#A3D6E4"><strong></strong></td>
			  <td bgcolor="#A3D6E4"><strong></strong></td>


			  </tr>
			  
		  <?php
   $busca_compras='';
   $sql_cp='';
   if($atc_val)
   {
		 $busca_compras="select dns_compras.compra_id from dns_compras inner join dns_temporalovimientoinventario on dns_compras.compra_id=dns_temporalovimientoinventario.compra_id inner join dns_cuadrobasicomedicamentos on dns_temporalovimientoinventario.cuadrobm_id=dns_cuadrobasicomedicamentos.cuadrobm_id where compra_laborat=0 and cuadrobm_codigoatc='".$atc_val."'";
		 
		 $sql_cp=" and dns_compras.compra_id in (".$busca_compras.") ";
	}
		  
		  
		          if($sqlconcatenado)
				   { 
				   $lista_campor="select * from dns_compras left join app_proveedor on dns_compras.proveevar_id=app_proveedor.provee_id where ".$sqlconcatenado." and  compra_laborat=0 and  dns_compras.emp_id='".@$_SESSION['ces1313777_sessid_emp_id']."' and compra_tipo=0 and tipom_id=1 and tipomov_id=17 and tipdoc_id not in (8,9,10) and compra_parainv=1 ".$sql_cp." order by  compra_id desc limit 200";	
				   
				   }
				   else
				   {
				    $lista_campor="select * from dns_compras left join app_proveedor on dns_compras.proveevar_id=app_proveedor.provee_id where   compra_laborat=0 and  dns_compras.emp_id='".@$_SESSION['ces1313777_sessid_emp_id']."' and compra_tipo=0 and tipom_id=1 and tipomov_id=17 and tipdoc_id not in (8,9,10) and compra_parainv=1 ".$sql_cp." order by  compra_id desc limit 200";
				   
				   }  
				  
				  //echo $lista_campor;
		           $cuenta=0;
			       $rs_listacmp = $DB_gogess->executec($lista_campor);
                   if($rs_listacmp)
				   {
						while (!$rs_listacmp->EOF) {	
						
						
						//busca si tiene nota de credito
						$tnc=0;
						$nregnc=0;
						$busca_ncx="select count(*) as tnc from dns_compras nc where (nc.tipdoc_id = 9) and (nc.compra_nummodif = '".$rs_listacmp->fields["compra_nfactura"]."') and (nc.proveevar_id='".$rs_listacmp->fields["proveevar_id"]."' )";
						$rsbunc = $DB_gogess->executec($busca_ncx);
						$tnc=$rsbunc->fields["tnc"];
						
						
						$busca_siesproductoNC="select compra_enlace from dns_compras nc where (nc.tipdoc_id = 9) and (nc.compra_nummodif = '".$rs_listacmp->fields["compra_nfactura"]."') and (nc.proveevar_id='".$rs_listacmp->fields["proveevar_id"]."' )";
						
						$completa_bulistaNCX="select count(*) as nregnc from lpin_productocompra where compra_enlace in (".$busca_siesproductoNC.")";
						$rs_siespnc = $DB_gogess->executec($completa_bulistaNCX);
						$nregnc=$rs_siespnc->fields["nregnc"];						
						
						//bisca si tiene nota de credito
						
						$busca_siesproducto="select count(*) as nreg from lpin_productocompra where compra_enlace='".$rs_listacmp->fields["compra_enlace"]."'";
						$rs_siesp = $DB_gogess->executec($busca_siesproducto);
						
						$nreg=$rs_siesp->fields["nreg"];	
						
						if($nreg>0 and $nregnc==0)
						{
						  $tnc=0;
						}
						
						
						if($rs_siesp->fields["nreg"]>0)
						{
						//lista registros///
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
                 
				        
						$compra_redpublica=$rs_listacmp->fields["compra_redpublica"];
				        if($compra_redpublica==1)
						{
						$colortr="style='background-color:#87DAA8'";
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
						 						
						$clickverl="onclick=tablas_verlista('compras/verlistac.php','".base64_encode($rs_listacmp->fields["compra_id"])."')";		
						
						$link_equ="<input type='button' name='Submit' value='VER EQ' onclick='verdetalles_xml(".$rs_listacmp->fields["compra_id"].")' class='btn btn-default'>";
						$link_equ="";
						
						echo '<td><input type="button" name="Submit" value="Ver" '.$clickverl.' class="btn btn-default" />&nbsp;&nbsp;'.$link_equ.'</td>';	
						
						
						 
						$clickverl="onclick=tablas_verlista('compras/verlista.php','".base64_encode($rs_listacmp->fields["compra_id"])."')";		 
						echo '<td><input type="button" name="Submit" value="Ver" '.$clickverl.' class="btn btn-default" /></td>';	
						
						$enviaa='';
						$enviaa = $objformulario->replace_cmb("dns_centrosalud", "centro_id,centro_nombre", " where centro_id=", $rs_listacmp->fields["centroenvia_id"], $DB_gogess);
						echo '<td>'.$enviaa.'</td>';	
						
						
						
						if($tnc>0)
						{
					     echo '<td></td>';	
						 echo '<td><input type="button" name="Submit" value="Compras" onclick="compras_prkprod('.$comulla_simple.$rs_listacmp->fields[$ide_producto].$comulla_simple.')"  class="btn btn-default" /></td>';
						 echo '<td></td>';
						 echo '<td>No puede ser procesada tiene NC '.$nreg.'->'.$nregnc.'</td>';
						}
						else
						{
						//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++					 
						echo '<td><input type="button" name="Submit" value="Editar" '.$clickedit.' class="btn btn-default" /></td>';						
						echo '<td><input type="button" name="Submit" value="Compras" onclick="compras_prkprod('.$comulla_simple.$rs_listacmp->fields[$ide_producto].$comulla_simple.')"  class="btn btn-default" /></td>';
						
						//echo '<td><input type="button" name="Submit" value="Compras Lista" onclick="compras_prkprodlistado('.$comulla_simple.$rs_listacmp->fields[$ide_producto].$comulla_simple.')"  class="btn btn-default" /></td>';
						echo '<td></td>';
						
						$lins_procesra="onclick=procesar_compra('".$rs_listacmp->fields["compra_id"]."','".$rs_listacmp->fields["centroenvia_id"]."')";
							
						if($bandera_pruba==1)
						{
						  if($rs_listacmp->fields["compra_procesado"]==1)
						  {
						    
							
						   $busuario='';
						   $busuario=$objformulario->replace_cmb("app_usuario","usua_id,usua_nombre,usua_apellido"," where usua_id=",$rs_listacmp->fields["compra_usprocesa"],$DB_gogess);
						   
						   //reversar
						   $btn_reverso='';
						   $lins_revproc="onclick=reversar_compra('".$rs_listacmp->fields["compra_id"]."')";
						   $btn_reverso='<input type="button" name="Submit" value="Reversar Proceso"  '.$lins_revproc.'  class="btn btn-default" />';
						   $btn_reverso='';						   
						   //reversar
							
							echo '<td>Procesado Fecha:'.$rs_listacmp->fields["compra_fechaprocesado"].' '.$busuario.'<br>'.$btn_reverso.'</td>';
						  }
						  else
						  {
						   echo '<td><input type="button" name="Submit" value="Procesar Aprobar"  '.$lins_procesra.'  class="btn btn-default" /></td>';	
						   }
						
						}
						else
						{
						
						echo '<td>Pendiente Probaci&oacute;n';	
						if($busuario)
						  {
						  echo '<br>Procesado pero con uno pendiente:'.$rs_listacmp->fields["compra_fechaprocesado"].' '.$busuario.'<br>'.$btn_reverso.'';
						  }
						echo '</td>';
						
						}	
						
						//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
						}
										
						echo '						
					  
			             </tr>';	
						 
						 
						 
						
						 //lista registros///	
						  }				
						
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


function procesar_compra(compra_id,centroenvia_id)
{

var path_procesa;
if(centroenvia_id>0)
{
  path_procesa='procesa_compraotbd.php';
}
else
{
  path_procesa='procesa_compra.php';
}

//alert(path_procesa);

  if (confirm("Esta seguro que desea Procesar esta factura ?"))
  {
  
   $("#div_procesar").load("movimiento_compras/"+path_procesa,{
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

   $("#div_procesar").load("movimiento_compras/reversar_compra.php",{
    compra_id:compra_id
  },function(result){ 
     listado_facturas();
  });  

  $("#div_procesar").html("Espere un momento...");
  
  }

}


function verdetalles_xml(compra_id)
{

abrir_standar("eq/panel_lista.php","Proveedor","divBody_listadetalles","divDialog_listadetalles",850,450,0,compra_id,0,0,0,0,0);
	 
	 
}

//  End -->
</script>
<div id="divBody_listadetalles"></div>

<?php
}
?>