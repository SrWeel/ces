<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
$tiempossss=455550000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../../';
include("../../../cfg/clases.php");
include("../../../cfg/declaracion.php");

$table='app_proveedor'; 
$subindice='_proveedor';

$client_idy='undefined';
$provee_nombre='';

$lista_tbldata=array('gogess_sisfield','gogess_sistable');
$contenido = file_get_contents(@$director."jason_files/tablas/".$table.".json");
$gogess_sistable = json_decode($contenido, true);

$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();

$contenido = file_get_contents(@$director."jason_files/estructura/".$table.".json");
$gogess_sisfield = json_decode($contenido, true);

 if ($table)
  {
  $objtableform->select_templateform(@$table,$DB_gogess);	
  }

$objformulario->sisfield_arr=$gogess_sisfield;
$objformulario->sistable_arr=$gogess_sistable;
$comillasimple="'";

$campos_tipo=Array
(
	'usua_id'=> 'hidden3',
	'tare_id'=> 'hidden3',
	'caucab_id'=> 'hidden3',
	'caucab_nregistro'=> 'hidden2'

);

			//$id_empresa_val=0;		
	
	//busca cliente para editar
  $buscacliente="select * from app_proveedor where provee_id='".$_POST["pVar2"]."'";  
  $rs_bcliente = $DB_gogess->executec($buscacliente);
  if($rs_bcliente)
  {
     	while (!$rs_bcliente->EOF) {
		
		
		$client_idy=$rs_bcliente->fields["provee_id"];
		$provee_nombre=$rs_bcliente->fields["provee_nombre"];

		
		$rs_bcliente->MoveNext();
		}
		
   }	
	//busca cliente para editar	
	
	
	$variableb=0;
			if($client_idy=='undefined')
				  {
					 $variableb=0;
				  }
				  else
				  {
					 $variableb=$client_idy;
                     $_REQUEST["opcion_".$table]="buscar";
			         $csearch=$client_idy;				 
				  }
				  
	 $comillasimple="'";
		 $botonenvio='<div align="center">
<table border="0" cellpadding="0" cellspacing="3">
			  <tr>
				<td><input type="image" name="imageField" src="images/aceptar.png" /></td>
			    <td>&nbsp;</td>
			    <td onClick="funcion_cerrar_pop('.$comillasimple.'divDialog_proveedor'.$comillasimple.')"  style="cursor:pointer" ><img src="images/cancelar.png" ></td>
			  </tr>
			</table>
</div>';	

$mensajege='<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#006600;" >Registro guardado con exito...</span>';



        //$funciones_cuandoguarda="$('#".$divresultado."').html('".$mensajege."')";
		
		$funcionextrag="actualiza_despuesg()";
  		$template_reemplazo='templateformsweb/maestro_standar_proveedor2/';			  

?>
<?php
//Datos de empresa
$idempresa=1;
$id_empresa_val=$idempresa;	
?>
<style type="text/css">
<!--
.borde_css {
	font-size: 11px;
	font-family: Arial, Helvetica, sans-serif;
	border: 1px solid #CCCCCC;
}
.TableScroll_buscar {
        z-index:99;
		width:380px;
        height:300px;	
        overflow: auto;
      }
-->
</style>
<script type="text/javascript">
<!--
function buscar_masdetenidamente()
{
        $("#lista_resultado").load("templateformsweb/maestro_standar_compras/proveedor_d/lista_proveedores.php",{
    pbusca_cliente_val:$('#busca_cliente_val').val()
  },function(result){  
      
  });  
  $("#lista_resultado").html("Espere un momento...");  

}
//  End -->
</script>


 <form id="form_<?php echo $table; ?>" name="form_<?php echo $table; ?>" method="post" action=""> 
<table width="550" border="0" cellpadding="4" cellspacing="0">
  <tr>
    
    <td valign="top"><?php		
		include("../../../aplicativos/documental/tablas.php");
		
		echo  $botonenvio;
?></td>
<td valign="top"><table width="200" border="0" align="center" cellpadding="0" cellspacing="1">
    <tr>
      <td bgcolor="#FFFFFF"><div align="center" class="borde_css">Buscar cliente </div></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF"><div align="center">
        <input name="busca_cliente_val" type="text" id="busca_cliente_val" value="<?php echo $provee_nombre; ?>" />
        <input type="button" name="Submit" value="Buscar" onclick="buscar_masdetenidamente()"  />
      </div></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF"><div class="TableScroll_buscar"><div id=lista_resultado ></div></div></td>
    </tr>
  </table></td>

    </tr>
</table>

</form>	


