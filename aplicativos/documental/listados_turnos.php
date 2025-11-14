<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
header('Content-Type: text/html; charset=UTF-8');
$tiempossss="4445000";
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_SESSION['ces1313777_sessid_inicio'])
{
$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");
$sqltotal="";


for($itbl=0;$itbl<count($lista_tbldata);$itbl++)
{
  //include(@$director."libreria/estructura/".$lista_tbldata[$itbl].".php");
} 


$objformulario= new  ValidacionesFormulario();
//$objformulario->sisfield_arr=$gogess_sisfield;
//$objformulario->sistable_arr=$gogess_sistable;

$usua_idtur=$_SESSION['ces1313777_sessid_inicio'];

//echo $_POST["insu"];

?>


		  
		  <table border="1" align="center" cellpadding="0" cellspacing="1" id="tabla" class="table-hover record_table" >
			  <tr>
			    <td bgcolor="#A3D6E4">NOMBRE</td>
			    <td bgcolor="#A3D6E4">TURNO</td>
			    <td bgcolor="#A3D6E4">ATENDIDO</td>
				<td bgcolor="#A3D6E4"></td>
		     </tr>
		  <?php
		          
 //$lista_campor="select gridtur_id,app_cliente.clie_id,gridtur_estado,gridtur_turno,clie_nombre,clie_apellido from cesdb_arextension.dns_gridturnos inner join cesdb_aroriginal.dns_atencion on cesdb_arextension.dns_gridturnos.atenc_enlace=dns_atencion.atenc_enlace inner join cesdb_aroriginal.app_cliente on cesdb_aroriginal.app_cliente.clie_id=cesdb_aroriginal.dns_atencion.clie_id  where especi_id=".$_POST["pVar1"]." and gridtur_fecha='".date("Y-m-d")."' and cesdb_aroriginal.dns_atencion.centro_id=".$_POST["pVar2"]." order by gridtur_turno desc";
 $lista_campor="select gridtur_id,app_cliente.clie_id,gridtur_estado,gridtur_turno,clie_nombre,clie_apellido,doccab_id,gridtur_tipo from cesdb_arextension.dns_gridturnos inner join cesdb_aroriginal.app_cliente on cesdb_aroriginal.app_cliente.clie_id=cesdb_arextension.dns_gridturnos.clie_id where especi_id=".$_POST["pVar1"]." and gridtur_fecha='".date("Y-m-d")."' and cesdb_arextension.dns_gridturnos.centro_id=".$_POST["pVar2"]." and  usuaat_id='".$usua_idtur."' order by gridtur_turno desc";
		          
				  $cuenta=0;
			       $rs_listacmp = $DB_gogess->executec($lista_campor);
                   if($rs_listacmp)
				   {
						while (!$rs_listacmp->EOF) {	
						
						
						$comulla_simple="'";	
						$tabla_valordata="";
						$campo_valor="";	
						$tabla_valordata="'cesdb_arextension.dns_gridturnos'";
						$campo_valor="'gridtur_id'";
						$ide_producto='gridtur_id';
						
						

						$cuenta++;	
						$colortr='';
						if($cuenta%2 == 0){
                       			$colortr="style='background-color:#CEE2EA'";
						}else{
							    $colortr="style='background-color:#ffffff'";
						}



                        $valida_facturasiexiste=1;				
						
						if($rs_listacmp->fields["doccab_id"]!='')
						{						
						
							if($rs_listacmp->fields["gridtur_tipo"]==1)
							{						
							$busca_facthoy="select * from beko_documentocabecera where doccab_id='".$rs_listacmp->fields["doccab_id"]."'";
							}
							
							if($rs_listacmp->fields["gridtur_tipo"]==2)
							{						
							$busca_facthoy="select * from beko_recibocabecera where doccab_id='".$rs_listacmp->fields["doccab_id"]."'";
							}
							
							$rs_bfactuhoy = $DB_gogess->executec($busca_facthoy);
							if($rs_bfactuhoy->fields["doccab_anulado"]==1)
							{
							  $valida_facturasiexiste=0;
							}
						
						}

						if($valida_facturasiexiste==1)
						{
						
						echo '<tr '.$colortr.' >';				
						
						//$busca_cliente="select * from app_cliente where clie_id=".$rs_listacmp->fields["clie_id"]."";
						//$rs_bclie = $DB_gogess->executec($busca_cliente);	
						//$link_borrar="borrar_registro_bu('cesdb_arextension.dns_gridturnos','".$ide_producto."','".$rs_listacmp->fields[$ide_producto]."')";

						echo '<td>'.utf8_encode($rs_listacmp->fields["clie_nombre"].' '.$rs_listacmp->fields["clie_apellido"]).'</td>';
						
						$ncampo_val='gridtur_turno';
						echo '<td>'.$rs_listacmp->fields[$ncampo_val].'</td>';


						
						$ncampo_val='gridtur_estado';	  
						echo '<td><select style="width:120px" id="cmb_'.$ncampo_val.$rs_listacmp->fields[$ide_producto].'" name="cmb_'.$ncampo_val.$rs_listacmp->fields[$ide_producto].'"  onChange="guardar_campos('.$tabla_valordata.','.$comulla_simple.$ncampo_val.$comulla_simple.','.$rs_listacmp->fields[$ide_producto].',$('.$comulla_simple.'#cmb_'.$ncampo_val.$rs_listacmp->fields[$ide_producto].$comulla_simple.').val(),'.$comulla_simple.$ide_producto.$comulla_simple.')" >
                              <option value="" >--Tipo--</option>';
                               $objformulario->fill_cmb('gogess_sino','value,etiqueta',$rs_listacmp->fields[$ncampo_val],'',$DB_gogess);
                        echo '</select></td>';
						
	 
						echo '<td><input type="button" name="Submit" value="Guardar" /></td>
							  
			             </tr>';
						 
						 }
						 
						
						   $rs_listacmp->MoveNext();
						}
				   }
		  
		  ?>
		  </table>
		  

<?php
}
?>
<div id="campo_valor"></div>
<SCRIPT LANGUAGE=javascript>
<!--

function guardar_campos(tabla,campo,id,valor)
{

$("#campo_valor").load("aplicativos/documental/guarda_campo.php",{

tabla:tabla,
campo:campo,
id:id,
valor:valor

 },function(result){       

  });  

$("#campo_valor").html("Espere un momento...");



}

//-->
</SCRIPT>