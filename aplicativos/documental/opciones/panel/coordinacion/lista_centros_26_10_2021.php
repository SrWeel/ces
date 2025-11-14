<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=44040000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");

if(@$_SESSION['ces1313777_sessid_inicio'])
{
$objformulario= new  ValidacionesFormulario();

?>

  <table width="98%" border="1" align="center" cellpadding="0" cellspacing="1" class="table-hover record_table" id="tabla" >			  
			  <tr>
			  <td bgcolor="#AEDBE8"><strong>ID</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Nombre</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Direcci&oacute;n</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Activar Despachos Medicamentos</strong></td>
			  <td bgcolor="#AEDBE8"><strong>Activar Despachos Dispositivos</strong></td>
			  </tr>	
			  <?php
			  $lista_campor="select * from dns_centrosalud where centro_activosistema=1 order by centro_nombre asc";
			  $cuenta=0;
			  $rs_listacmp = $DB_gogess->executec($lista_campor);
              if($rs_listacmp)
				{
						while (!$rs_listacmp->EOF) {
						
						$comulla_simple="'";
						$tabla_valordata="'dns_centrosalud'";
						$campo_valor="'centro_id'";
						$ide_producto='centro_id';
						
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
						echo '<td>'.$cuenta.'.-</td>';
						$ncampo_val='centro_nombre';
						echo '<td>'.utf8_encode($rs_listacmp->fields[$ncampo_val]).'</td>';
						
						$ncampo_val='centro_direccion';
						echo '<td>'.utf8_encode($rs_listacmp->fields[$ncampo_val]).'</td>';
						
						 $ncampo_val='centro_activodespacho';		
						echo '<td><select class="css_select" style="width:120px" id="cmb_'.$ncampo_val.$rs_listacmp->fields[$ide_producto].'" name="cmb_'.$ncampo_val.$rs_listacmp->fields[$ide_producto].'"  onChange="guardar_campos('.$tabla_valordata.','.$comulla_simple.$ncampo_val.$comulla_simple.','.$rs_listacmp->fields[$ide_producto].',$('.$comulla_simple.'#cmb_'.$ncampo_val.$rs_listacmp->fields[$ide_producto].$comulla_simple.').val(),'.$comulla_simple.$ide_producto.$comulla_simple.')" >
                              <option value="" >--Tipo--</option>';
                               $objformulario->fill_cmb('gogess_sino','value,etiqueta',$rs_listacmp->fields[$ncampo_val],'',$DB_gogess);
                        echo '</select></td>';
						
						
						$ncampo_val='centro_activodispositivos';		
						echo '<td><select class="css_select" style="width:120px" id="cmb_'.$ncampo_val.$rs_listacmp->fields[$ide_producto].'" name="cmb_'.$ncampo_val.$rs_listacmp->fields[$ide_producto].'"  onChange="guardar_campos('.$tabla_valordata.','.$comulla_simple.$ncampo_val.$comulla_simple.','.$rs_listacmp->fields[$ide_producto].',$('.$comulla_simple.'#cmb_'.$ncampo_val.$rs_listacmp->fields[$ide_producto].$comulla_simple.').val(),'.$comulla_simple.$ide_producto.$comulla_simple.')" >
                              <option value="" >--Tipo--</option>';
                               $objformulario->fill_cmb('gogess_sino','value,etiqueta',$rs_listacmp->fields[$ncampo_val],'',$DB_gogess);
                        echo '</select></td>';
							
						
						echo '</tr>';
			  
			
			               $rs_listacmp->MoveNext();
			            }
				  }	
			  ?>	  
  </table>			  

<div id="campo_valor"></div>			  
<SCRIPT LANGUAGE=javascript>
<!--

function guardar_campos(tabla,campo,id,valor,campoidtabla)
{

$("#campo_valor").load("aplicativos/documental/opciones/panel/coordinacion/guarda_campo.php",{

tabla:tabla,
campo:campo,
id:id,
valor:valor,
campoidtabla:campoidtabla

 },function(result){       

  });  

$("#campo_valor").html("Espere un momento...");



}

//-->
</SCRIPT>			  

<?php
}

?>