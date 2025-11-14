<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
ini_set("session.gc_maxlifetime","14400");
session_start();

$director="../../../../";
include ("../../../../cfgclases/clases.php");

$campos_tipo=Array
(
	'prov_id' => 'hidden3',
	'em_id' => 'hidden3',
	'prov_fechareg' => 'hidden3',
	'sisu_id' => 'hidden3'
	
);




  $table='ca_tipo_situacion';  
			//$em_id_val=0;		
	

	$variableb=0;
			if($_POST["pVar1"]=='undefined')
				  {
					 $variableb=0;
				  }
				  else
				  {
					 $variableb=$_POST["pVar1"];
                     $_REQUEST["opcion_".$table]="buscar";
			         $csearch=$_POST["pVar1"];				 
				  }
		//echo $csearch;		  
	 $comillasimple="'";
		 $botonenvio='<div align="center">
<table border="0" cellpadding="0" cellspacing="3">
			  <tr>
				<td><input type="image" name="imageField" src="images/aceptar.png" /></td>
			    <td>&nbsp;</td>
			    <td onClick="funcion_cerrar_pop('.$comillasimple.'divDialog_tipo_situacion'.$comillasimple.')"  style="cursor:pointer" ><img src="images/cancelar.png" ></td>
			  </tr>
			</table>
</div>';	

$mensajege='<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#006600;" >Registro guardado con exito...</span>';



        //$funciones_cuandoguarda="$('#".$divresultado."').html('".$mensajege."')";
		
		$funcionextrag="desplegar_grid()";
  		$template_reemplazo='templateformsweb/maestro_standar_tipo_situacion/';			  

?>
<?php
//Datos de empresa
$idempresa=$objformulario->replace_cmb("ca_usuario","us_id,em_id","where us_id=",$_SESSION['ces1313777_sessid_inicio'],$DB_gogess);
$nombreempresa=$objformulario->replace_cmb("ca_empresa","em_id,em_nombre","where em_id=",$idempresa,$DB_gogess);
$em_id_val=$idempresa;	
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
        $("#lista_resultado").load("aplications/usuario/opciones/extras/lista_tipo_situacion.php",{
    pbusca_cliente_val:$('#busca_cliente_val').val()
  },function(result){  
      
  });  
  $("#lista_resultado").html("Espere un momento...");  

}
//  End -->
</script>

 <div align="center" >	 
 <form id="form_<?php echo $table; ?>" name="form_<?php echo $table; ?>" method="post" action=""> 

<table border="0" cellpadding="4" cellspacing="0">
  <tr>
    
    <td><?php		
		include("../../tablas.php");
		
?>	</td>
</tr>
</table>

</form>	
</div>

