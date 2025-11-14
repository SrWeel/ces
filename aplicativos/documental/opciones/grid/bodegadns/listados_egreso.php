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

$objUtil->campostxt="egrec_id";
$objUtil->camposlike="centro_nombre,egrec_nmemo";
$sqlconcatenado='';
$sqlconcatenado=$objUtil->genera_sqlbusqueda($_POST["txtbusca"],'OR');

$sql2='';
if($_POST["centro_idbu"])
{
	$sql2=" and dns_egresocentros.centrod_id='".$_POST["centro_idbu"]."' ";
	
}

//echo $_POST["insu"];

$concatena_v='';
$busca_sindespachar="select * from dns_egresocentros where egrec_procesado=0 and egrec_tipo=1";
$rs_sindespachar = $DB_gogess->executec($busca_sindespachar);
if($rs_sindespachar)
	   {
			while (!$rs_sindespachar->EOF) {
			
			   $concatena_v.=$rs_sindespachar->fields["egrec_id"].",";
            
				$rs_sindespachar->MoveNext(); 						
			}
	   }

if($concatena_v)
{	   
echo "<center><div style='color:#FF0000'><b>Alerta: ";	 
echo $concatena_v;  		
echo " Sin Despachar</b></div></center>";
}

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
<center>
<?php
echo $nombre_medic;

?></center>
		  	  
		  <table border="1" align="center" cellpadding="0" cellspacing="1" id="tabla" class="table-hover record_table" >
			  <tr>
			  <td bgcolor="#AEDBE8"><strong></strong></td>
			  <td bgcolor="#AEDBE8"><strong>No. Comprobante:</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Memo</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Tipo</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Motivo</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Destino</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Otros Destino</strong></td>
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
		  
  $busca_compras='';
   $sql_cp='';
   if($atc_val)
   {
		 $busca_compras="select dns_egresocentros.egrec_id  from dns_egresocentros inner join dns_temporaldespacho on dns_egresocentros.egrec_id=dns_temporaldespacho.egrec_id inner join dns_cuadrobasicomedicamentos on dns_temporaldespacho.cuadrobm_id=dns_cuadrobasicomedicamentos.cuadrobm_id where cuadrobm_codigoatc='".$atc_val."'";
		 
		 $sql_cp=" and dns_egresocentros.egrec_id in (".$busca_compras.") ";
	}
	
		          
				   //$lista_campor="select * from dns_egresocentros where categ_id='".$_POST["insu"]."' and  dns_compras.emp_id='".@$_SESSION['ces1313777_sessid_emp_id']."'  order by  compra_fecha desc";	  
				   if($sqlconcatenado)
				   { 
				   $lista_campor="select * from dns_egresocentros left join dns_centrosalud on  dns_egresocentros.centrod_id=dns_centrosalud.centro_id where ".$sqlconcatenado." and dns_egresocentros.emp_id='".@$_SESSION['ces1313777_sessid_emp_id']."' and tipom_id=2  and egrec_tipo=1 ".$sql2." ".$sql_cp." order by  egrec_id desc";
				   }
				   else
				   {
				   $lista_campor="select * from dns_egresocentros left join dns_centrosalud on  dns_egresocentros.centrod_id=dns_centrosalud.centro_id where  dns_egresocentros.emp_id='".@$_SESSION['ces1313777_sessid_emp_id']."' and tipom_id=2 and egrec_tipo=1 ".$sql2." ".$sql_cp." order by  egrec_id desc";
				   }
				  
				 // echo $lista_campor;
		           $cuenta=0;
			       $rs_listacmp = $DB_gogess->executec($lista_campor);
                   if($rs_listacmp)
				   {
						while (!$rs_listacmp->EOF) {	
						
						
						//genera alerta			
						$bprincipal='';
						$bprincipal=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre"," where centro_id=",$rs_listacmp->fields["centro_id"],$DB_gogess);
						
						$bdestino='';
						$bdestino=$objformulario->replace_cmb("cmb_destino_vista","centro_id,centro_nombre"," where centro_id=",$rs_listacmp->fields["centrod_id"],$DB_gogess);
						
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
						$link_borrar="borrar_registro_bucontrol('dns_egresocentros','".$ide_producto."','".$rs_listacmp->fields[$ide_producto]."')";						
						echo '<td onclick="'.$link_borrar.'" style="cursor:pointer" ><img src="borrar.png" ></td>';
						}
											    
						$sining='';	
						
						$compra_nsec='';
						$compra_nsec=str_pad($rs_listacmp->fields["egrec_id"], 10, "0", STR_PAD_LEFT);
											
						echo '<td>'.$compra_nsec.'</td>';		
						
						$texto_wrap='';
						$texto_wrap=wordwrap($rs_listacmp->fields["egrec_nmemo"], 40, "<br />\n",true);	
							
						echo '<td>'.$texto_wrap.'</td>';				
						
						
						$ntipo='';
						$ntipo=$objformulario->replace_cmb("dns_motivomovimiento","tipomov_id,tipomov_nombre"," where tipomov_id=",$rs_listacmp->fields["tipomov_id"],$DB_gogess);
						echo '<td>'.$ntipo.'</td>';			
						
						$texto_wrap2='';
						$texto_wrap2=wordwrap($rs_listacmp->fields["egrec_motivo"], 40, "<br />\n",true);				
						
						echo '<td>'.$texto_wrap2.'</td>';	
						
						echo '<td>'.$bdestino.'</td>';
						
						
						$ncampo_val='egrec_otrosdestino';
						echo '<td nowrap="nowrap">'.$rs_listacmp->fields[$ncampo_val].'</td>';	
						
						$ncampo_val='egrec_fecha';
						echo '<td nowrap="nowrap">'.$rs_listacmp->fields[$ncampo_val].'</td>';	
						
						$ncampo_val='egrec_responsableentrega';
						echo '<td>'.$rs_listacmp->fields[$ncampo_val].'</td>';	
						
						$ncampo_val='egrec_personalrecibe';
						echo '<td>'.$rs_listacmp->fields[$ncampo_val].'</td>';	
						
						$ncampo_val='egrec_fecharegistro';
						echo '<td>'.$rs_listacmp->fields[$ncampo_val].'</td>';
						
						echo '<td>'.$busuario.'</td>';
												
						
						$clickedit='';
						
						if($_POST["insu"]==1)
						{
						$clickedit="onclick=abrir_standar('egresovarios/grid_egresovarios_nuevo.php','Factura_Medicamentos','divBody_producto','divDialog_producto',800,600,".$rs_listacmp->fields[$ide_producto].",0,0,0,0,0,'".$_POST["insu"]."')";
						 }
						 else
						 {
						 $clickedit="onclick=abrir_standar('egresovarios/grid_egresovarios_nuevo.php','Factura_Dispositivos','divBody_producto','divDialog_producto',800,600,".$rs_listacmp->fields[$ide_producto].",0,0,0,0,0,'".$_POST["insu"]."')";
						 
						 }
						 
						 
						$clickverl="onclick=tablas_verlista('egresovarios/verlista.php','".base64_encode($rs_listacmp->fields["egrec_id"])."')"; 
						 
						if($rs_listacmp->fields["egrec_procesado"]==1)
						{
						echo '<td>Procesado</td>'; 
						}
						else
						{
						 
						echo '<td><input type="button" name="Submit" value="Agregar Productos para Despacho" onclick="compras_prkprod('.$comulla_simple.$rs_listacmp->fields[$ide_producto].$comulla_simple.')" /></td>'; 
						}
						
						
						echo '<td><input type="button" name="Submit" value="Ver" '.$clickverl.' /></td>';						 
						echo '<td><input type="button" name="Submit" value="Editar" '.$clickedit.' /></td>';						
							
										
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

//  End -->
</script>
<?php
}
?>