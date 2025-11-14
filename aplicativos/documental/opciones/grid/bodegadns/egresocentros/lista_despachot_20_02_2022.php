<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=44450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_SESSION['ces1313777_sessid_inicio'])
{

$director='../../../../../../';
include("../../../../../../cfg/clases.php");
include("../../../../../../cfg/declaracion.php");
$sqltotal="";

$objformulario= new  ValidacionesFormulario();
$egrec_id=$_POST["egrec_id"];


$insu_val=1;
?>
<table border="1" align="center" cellpadding="0" cellspacing="1" id="tabla" class="table-hover record_table" >
			  
			  <tr>
			  <td bgcolor="#AEDBE8"><strong></strong></td>
			  <td bgcolor="#AEDBE8"><strong>CUM</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Nombre Generico</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Nombre Comercial</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Forma Farmaceutica</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Concentraci&oacute;n</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Presentaci&oacute;n</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Lote</strong></td>
	          <td bgcolor="#AEDBE8"><strong>Fecha Caducidad</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Cantidad(Unidades)</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Valor Unitario (USD)</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Valor Total (USD)</strong></td>
			  </tr>
			  
		  <?php

				  $lista_campor="select *,dns_temporaldespacho.tempdsp_id as tempdsp_idborr from dns_temporaldespacho inner join dns_cuadrobasicomedicamentos on dns_temporaldespacho.cuadrobm_id=dns_cuadrobasicomedicamentos.cuadrobm_id inner join dns_principalmovimientoinventario on dns_temporaldespacho.moviin_id=dns_principalmovimientoinventario.moviin_id where dns_temporaldespacho.egrec_id='".$egrec_id."' order by dns_temporaldespacho.tempdsp_id desc";
				  //echo $lista_campor;
		           $cuenta=0;
			       $rs_listacmp = $DB_gogess->executec($lista_campor);
                   if($rs_listacmp)
				   {
						while (!$rs_listacmp->EOF) {	
						
						$link_borrar="";
						$link_borrar="borrar_registro_temp('dns_temporaldespacho','tempdsp_id','".$rs_listacmp->fields["tempdsp_idborr"]."')";
						echo '<td onclick="'.$link_borrar.'" style="cursor:pointer" ><img src="borrar.png" ></td>';
						
						$ncampo_val='cuadrobm_codigoatc';						
						echo '<td>'.utf8_encode($rs_listacmp->fields[$ncampo_val]).'</td>';
						
						
						$ncampo_val='cuadrobm_principioactivo';
						echo '<td>'.utf8_encode($rs_listacmp->fields[$ncampo_val].' '.$rs_listacmp->fields["cuadrobm_nombredispositivo"]).'</td>';
						
						$ncampo_val='cuadrobm_nombrecomercial';
						echo '<td>'.utf8_encode($rs_listacmp->fields[$ncampo_val]).'</td>';						
					    
					  	$ncampo_val='cuadrobm_primerniveldesagregcion';
						echo '<td>'.utf8_encode($rs_listacmp->fields[$ncampo_val]).'</td>';		
						
						$ncampo_val='cuadrobm_concentracion';
						echo '<td>'.utf8_encode($rs_listacmp->fields[$ncampo_val]).'</td>';	
									 
						echo '<td></td>';	
							  
						$ncampo_val='moviin_nlote';
						echo '<td>'.utf8_encode($rs_listacmp->fields[$ncampo_val]).'</td>';	
			            
						
						$ncampo_val='moviin_fechadecaducidad';					
						echo '<td>'.$rs_listacmp->fields[$ncampo_val].'</td>';						
						
						$ncampo_val='cantidad_val';					
						echo '<td>'.$rs_listacmp->fields[$ncampo_val].'</td>';					
						
						$ncampo_val='moviin_preciocompra';					
						echo '<td>'.$rs_listacmp->fields[$ncampo_val].'</td>';
						
						$total_cal=0;
						$total_cal=$rs_listacmp->fields["cantidad_val"]*$rs_listacmp->fields["moviin_preciocompra"];
						
		                echo '<td>'.$total_cal.'</td>';
							  
			             echo '</tr>';
	
						 
						
						   $rs_listacmp->MoveNext();
						}
				   }
		  
		  ?>
</table>
<?php
}
?>
		  