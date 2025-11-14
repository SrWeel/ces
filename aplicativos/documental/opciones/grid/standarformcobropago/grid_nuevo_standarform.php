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

$doccab_id=$_POST["doccab_id"];
$tipo=$_POST["tipo"];
$id=$_POST["id"];
$crb_id=0;

if($tipo==1)
{
$obtine_data="select * from lpin_cobropago where doccab_id='".$doccab_id."'";
$rs_obtdata = $DB_gogess->executec($obtine_data,array());
}

if($tipo==2)
{
$obtine_data="select * from lpin_cobropago where compra_id='".$doccab_id."'";
$rs_obtdata = $DB_gogess->executec($obtine_data,array());

$compra_id=$doccab_id;

}

if($id>0)
{
 $crb_id=$id;
}
else
{
//$crb_id=$rs_obtdata->fields["crb_id"];
}

if(!($crb_id))
{
  
  if($tipo==1)
   {
     $busca_pagosdetalles="select * from lpin_cobropago inner join lpin_cobropagodetalle on lpin_cobropago.crb_enlace=lpin_cobropagodetalle.crb_enlace where doccabcp_id='".$doccab_id."'";
	 $rs_obtdata = $DB_gogess->executec($busca_pagosdetalles,array());   
   }
   
   if($tipo==2)
   {
     $busca_pagosdetalles="select * from lpin_cobropago inner join lpin_cobropagodetalle on lpin_cobropago.crb_enlace=lpin_cobropagodetalle.crb_enlace where compracp_id='".$doccab_id."'";
	 $rs_obtdata = $DB_gogess->executec($busca_pagosdetalles,array());   
   }
   
   if($id>0)
   {
   $crb_id=$id;
   }
  

}

$table='lpin_cobropago';
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
	if($crb_id>0)
	{
    $client_idy=$crb_id;
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
	 //<input type="image" name="imageField" src="images/aceptar.png" />
		 $botonenvio='<div align="center">
<table border="0" cellpadding="0" cellspacing="3">
			  <tr>
				<td onclick="guarda_datapagocobro()"  style="cursor:pointer" >
				<img src="images/aceptar.png" width="115" height="34" />				
				</td>
			    <td>&nbsp;</td>
			    <td onClick="funcion_cerrar_pop('.$comillasimple.'divDialog_cobropago'.$comillasimple.')"  style="cursor:pointer" ><img src="images/cancelar.png" ></td>
			  </tr>
			</table>
</div>';	

$mensajege='<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#006600;" >Registro guardado con exito...</span>';


//busca conciliacion
if(@$csearch>0)
{
$busca_consi="select count(*) as totalcon from lpin_comprobantecontable inner join lpin_detallecomprobantecontable on lpin_comprobantecontable.comcont_enlace=lpin_detallecomprobantecontable.comcont_enlace where comcont_tabla='lpin_cobropago' and comcont_idtabla='".$csearch."' and detcc_conciliacion=1";

$rs_consi = $DB_gogess->executec($busca_consi,array());

}





     //$funciones_cuandoguarda="$('#".$divresultado."').html('".$mensajege."')";

if(@$rs_consi->fields["totalcon"]>0)
{
  $botonenvio='';
  if($client_idy)
		{
		$funcionextrag="
		 
		 desplegar_grid_cp();
		 //actualizadata_cmb('".$client_idy."');";
		}
		else
		{
		$funcionextrag="
		
		 desplegar_grid_cp();
		 //actualizadata_cmb(result_insertado);";		
		}

}
else
{		
		if($client_idy)
		{
		$funcionextrag="
		 genera_asientocobropago();
		 desplegar_grid_cp();
		 //actualizadata_cmb('".$client_idy."');";
		}
		else
		{
		$funcionextrag="
		 genera_asientocobropago();
		 desplegar_grid_cp();
		 //actualizadata_cmb(result_insertado);";		
		}
}		
		
  		$template_reemplazo='templateformsweb/maestro_standar_cobropagopl/';			  

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

 <?php
 if(@$rs_consi->fields["totalcon"]>0)
{
echo "<b>ALERTA: ASIENTO YA FUEN CONCILIADO EN BANCOS NO SE PUEDE MODIFICAR</b><br>";
?>
 <fieldset disabled>
 <?php
}
 ?>
 
 
 <form id="form_<?php echo $table; ?>" name="form_<?php echo $table; ?>" method="post" action=""> 
<table width="100%" border="0" cellpadding="4" cellspacing="0">
  <tr>
    
    <td valign="top"><?php		
		include("../../../tablascellform.php");
		
?></td>
    </tr>
</table>

</form>	

<?php
 if(@$rs_consi->fields["totalcon"]>0)
{
?>
  </fieldset>
 <?php 
  }
?>
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


function genera_asientocobropago()
{
 
   var urlasiento;
   urlasiento='';
    if($('#ttra_id').val()=='1')
	{
	   urlasiento='aplicativos/documental/asientos/ventas/ejecuta_cobro.php';	
	}
	
	if($('#ttra_id').val()=='2')
	{
	   urlasiento='aplicativos/documental/asientos/compras/ejecuta_pago.php';	
	}

   $("#asiento_ccobropago").load(urlasiento,{
      valor_id:$('#crb_id').val(),
	  nombre_campoid:'crb_id',
	  tabla:'lpin_cobropago',
	  mnupan_id:'183'

  },function(result){  
     
     
  });  
  $("#asiento_ccobropago").html("Espere un momento");  


}



function guarda_datapagocobro()
{

  if($('#num_registros').val()=='0')
  {
  
   alert("Documento debe tener minimo un registro...");
   return false;
  
  }
  
  
  <?php
    $comillasimple="'";
    echo 'enviar_formulario('.$comillasimple.'form_'.$table.$comillasimple.')';
   ?>

}


//-->
</script>

<div id="asiento_ccobropago"></div>
