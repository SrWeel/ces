<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
if(@$_SESSION['ces1313777_sessid_inicio'])
{

$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");

$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();

$usua_idtur=$_SESSION['ces1313777_sessid_inicio'];
?>
<style type="text/css">
<!--
.st_ccsturno {
	font-size: 10px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
}
.st_ccsturnotitulo {
	font-size: 9px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
}
-->
</style>

<div align="left">
  <input type="button" name="Button" value="ACTUALIZAR" onclick="verl_turno();" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px" />

<table width="600" border="1" cellpadding="0" cellspacing="1" class="table-hover record_table" id="tabla" >
			  <tr>
			    <td bgcolor="#A3D6E4"></td>
			    <td bgcolor="#A3D6E4"></td>
			    <td bgcolor="#A3D6E4"><span class="st_ccsturno">PACIENTE</span></td>
				<td bgcolor="#A3D6E4"><span class="st_ccsturno">ESPECIALIDAD</span></td>
				<td bgcolor="#A3D6E4"><span class="st_ccsturno">DESCRIPCION</span></td>
				<td bgcolor="#A3D6E4"><span class="st_ccsturno">MEDICO</span></td>
			    <td bgcolor="#A3D6E4"><span class="st_ccsturno">TURNO</span></td>				
		     </tr>
		  <?php
		  
		  $contador=0;
		  //echo $_SESSION['ces1313777_usua_especi_id'];	     
		         // if($_SESSION['ces1313777_usua_especi_id']==39)
				  // {
				     $lista_campor="select * from cesdb_arextension.dns_gridturnos where gridtur_fecha='".date("Y-m-d")."' and centro_id='".$_SESSION['ces1313777_centro_id']."'  order by especi_id,gridtur_turno asc";
				 //  }
				 //  else
				  // {
				 //    $lista_campor="select * from cesdb_arextension.dns_gridturnos where gridtur_fecha='".date("Y-m-d")."' and centro_id='".$_SESSION['ces1313777_centro_id']."' and especi_id='".$_SESSION['ces1313777_usua_especi_id']."'  order by especi_id,gridtur_turno desc";
				 // }

		           $cuenta=0;
			       $rs_listacmp = $DB_gogess->executec($lista_campor);
                   if($rs_listacmp)
				   {
						while (!$rs_listacmp->EOF) {	
						
						//busca factura del cliente
						
						$busca_ci="select * from app_cliente where clie_id='".$rs_listacmp->fields["clie_id"]."'";
						$rs_bci = $DB_gogess->executec($busca_ci);					
						
						$fecha_hoy=date("Y-m-d");	
						
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
						
						
						
						$busca_medicoas="select * from app_usuario where usua_id='".$rs_listacmp->fields["usuaat_id"]."'";
						$rs_medicoas = $DB_gogess->executec($busca_medicoas);
						
						$nmedico='';
						$nmedico=$rs_medicoas->fields["usua_nombre"]." ".$rs_medicoas->fields["usua_apellido"];
						
						//busca factura del cliente
						
						$link_directo='';
						$link_directo='<table border="0" cellspacing="0" cellpadding="0" ><tr><td onclick="ver_formularioenpantalla(\'aplicativos/documental/datos_pacientes.php\',\'Editar\',\'divBody_ext\','.$rs_listacmp->fields["clie_id"].',\''.$_POST["pVar2"].'\',0,0,0,0,0)" style=cursor:pointer ><center><img src="images/editar.png"  /></center></td></tr></table>';
						
						$comulla_simple="'";	
						$tabla_valordata="";
						$campo_valor="";	
						$tabla_valordata="'dns_gridturnos'";
						$campo_valor="'gridtur_id'";
						$ide_producto='gridtur_id';						

						$cuenta++;	
						$colortr='';
						if($cuenta%2 == 0){
                       			$colortr="style='background-color:#CEE2EA'";
						}else{
							    $colortr="style='background-color:#ffffff'";
						}

						if($usua_idtur==$rs_listacmp->fields["usuaat_id"] and $valida_facturasiexiste==1)
						{
						
						$busca_producto="select * from beko_documentodetalle where doccab_id='".$rs_listacmp->fields["doccab_id"]."' and usuaat_id='".$rs_listacmp->fields["usuaat_id"]."'";
						$rs_bproducto = $DB_gogess->executec($busca_producto);
						
						
						$contador++;
						echo '<tr '.$colortr.' >';					
						
						$busca_cliente="select clie_nombre,clie_apellido from app_cliente where clie_id=".$rs_listacmp->fields["clie_id"]."";
						$rs_bclie = $DB_gogess->executec($busca_cliente);	
						$link_borrar="borrar_registro_bu('dns_gridturnos','".$ide_producto."','".$rs_listacmp->fields[$ide_producto]."')";
						echo '<td><img src="images/notificacionicon.png" width="30"></td>';
						
						
						echo '<td>'.$link_directo.'</td>';

						echo '<td class="st_ccsturnotitulo" >'.$rs_bclie->fields["clie_nombre"].' '.$rs_bclie->fields["clie_apellido"].'</td>';
						
						
						$busca_ESPE="select especi_nombre from dns_especialidad where especi_id=".$rs_listacmp->fields["especi_id"]."";
						$rs_bcESPE = $DB_gogess->executec($busca_ESPE);	
						
						echo '<td class="st_ccsturnotitulo" ><b><center>'.$rs_bcESPE->fields["especi_nombre"].'</center></b></td>';
						echo '<td class="st_ccsturnotitulo" ><b><center>'.$rs_bproducto->fields["docdet_descripcion"].'</center></b></td>';
						
						
						echo '<td class="st_ccsturnotitulo" ><b><center>'.$nmedico.'</center></b></td>';
						
						$ncampo_val='gridtur_turno';
						//$rs_listacmp->fields[$ncampo_val];
						echo '<td><b><center>'.$contador.'</center></b></td>';
	 
						echo '
							  
			             </tr>';
						 
						 }
						 
						
						   $rs_listacmp->MoveNext();
						}
				   }
		  
?>
</table>
</div>
<?php
}
?>
