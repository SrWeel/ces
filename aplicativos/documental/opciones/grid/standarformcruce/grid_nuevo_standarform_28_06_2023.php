<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
$tiempossss=455550000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");

//-----------------------------------------
$compra_total=0;
$doccab_id=$_POST["doccab_id"];
$tipo=$_POST["tipo"];

if($tipo==1)
{
$obtine_data="select * from lpin_crucedocumentos where doccabcr_id='".$doccab_id."'";
$rs_obtdata = $DB_gogess->executec($obtine_data,array());
}

if($tipo==2)
{
$obtine_data="select * from lpin_crucedocumentos where compracr_id='".$doccab_id."'";
$rs_obtdata = $DB_gogess->executec($obtine_data,array());

$obtine_totales="select * from dns_compras where compra_id='".$doccab_id."'";
$rs_obttotales = $DB_gogess->executec($obtine_totales,array());

$compra_total=$rs_obttotales->fields["compra_total"];




$compra_id=$doccab_id;

}

$crudoc_id=$rs_obtdata->fields["crudoc_id"];
$table='lpin_crucedocumentos';
//-----------------------------------------

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
	'caucab_nregistro'=> 'hidden2',
	'ttra_id'=> 'hidden2'

);

			//$id_empresa_val=0;		
	
	//busca cliente para editar
	if($crudoc_id>0)
	{
      $client_idy=$crudoc_id;
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
			    <td onClick="funcion_cerrar_pop('.$comillasimple.'divDialog_cobropago'.$comillasimple.')"  style="cursor:pointer" ><img src="images/cancelar.png" ></td>
			  </tr>
	</table>
</div>';	

$mensajege='<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#006600;" >Registro guardado con exito...</span>';

     //$funciones_cuandoguarda="$('#".$divresultado."').html('".$mensajege."')";
		$funcionextrag="
		genera_asientocruce();
		";
		if($client_idy)
		{
		//$funcionextrag="actualizadata_cmb('".$client_idy."')";
		}
		else
		{
		//$funcionextrag="actualizadata_cmb(result_insertado)";		
		}
		
  		$template_reemplazo='templateformsweb/maestro_standar_crucedocumentospl/';			  

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
 <div align="center" >	 
 <form id="form_<?php echo $table; ?>" name="form_<?php echo $table; ?>" method="post" action=""> 
<table width="100%" border="0" cellpadding="4" cellspacing="0">
  <tr>
    
    <td valign="top"><?php		
		include("../../../tablascellform.php");
		
?></td>
    </tr>
</table>

</form>	
</div>

<script language="javascript">
<!--
function busca_provvedorrepetido()
{

$("#div_buscapacienter").load("templateformsweb/maestro_standar_ventas/buscadorform/busca_pacienterepetido.php",{
 
 provee_cedula:$('#provee_cedula').val(),
 provee_ruc:$('#provee_ruc').val()

 },function(result){       


  }); 
$("#div_buscapacienter").html("Espere un momento...");

}


$( "#provee_ruc" ).change(function() {
  
    busca_provvedorrepetido();
  
});

$( "#provee_cedula" ).change(function() {
  
    busca_provvedorrepetido();
  
});



function genera_asientocruce()
{
 
   var urlasiento;
   urlasiento='';
   
    <?php
   if($tipo==1)
   {
   ?>
	   urlasiento='aplicativos/documental/asientos/cruzeventa/ejecuta_cruze.php';		
	<?php
	}
	?>
   
    <?php
   if($tipo==2)
   {
   ?>
	   urlasiento='aplicativos/documental/asientos/cruze/ejecuta_cruze.php';		
	<?php
	}
	?>

   $("#asiento_ccruze").load(urlasiento,{
      valor_id:$('#crudoc_id').val(),
	  nombre_campoid:'crudoc_id',
	  tabla:'lpin_crucedocumentos',
	  mnupan_id:'197'

  },function(result){  
     
	 genera_asientocrucecuenta();
     
  });  
  $("#asiento_ccruze").html("Espere un momento");  


}

function genera_asientocrucecuenta()
{
 
   var urlasiento;
   urlasiento='';   	
  
   <?php
   if($tipo==1)
   {
   ?>
	   urlasiento='aplicativos/documental/asientos/cruzeventa/ejecuta_cruzecuenta.php';		
	<?php
	}
	?>
  
   
   <?php
   if($tipo==2)
   {
   ?>
	   urlasiento='aplicativos/documental/asientos/cruze/ejecuta_cruzecuenta.php';		
	<?php
	}
	?>

   $("#asiento_ccruzecuenta").load(urlasiento,{
      valor_id:$('#crudoc_id').val(),
	  nombre_campoid:'crudoc_id',
	  tabla:'lpin_crucedocumentos',
	  mnupan_id:'197'

  },function(result){  
     
     
  });  
  $("#asiento_ccruzecuenta").html("Espere un momento");  


}

//-->
</script>
<div id="asiento_ccruze"></div>
<div id="asiento_ccruzecuenta"></div>
