<style type="text/css">
<!--

.TableScroll_factu {
	z-index:99;
	width:100%;
	height:120px;
	overflow: auto;
	border: 1px solid #000000;
      }

-->
</style>
<?php
            //---ENLACE
			$valoralet=mt_rand(1,50000);
			$aletorioid=$_SESSION['ces1313777_sessid_cedula'].date("Ymdhis").$valoralet;
			//----

	        $enlace_general=$rs_datosmenu->fields["mnupan_campoenlace"]."x";
			$objformulario->sendvar["cierr_fechax"]=date("Y-m-d");	
		    $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");	
		    $objformulario->sendvar[$enlace_general]=@$_SESSION['ces1313777_sessid_emp_id'];	
            $objformulario->sendvar["horax"]=date("H:i:s");
			$objformulario->sendvar["usua_idx"]=@$_SESSION['ces1313777_sessid_inicio'];
			$objformulario->sendvar["usr_tpingx"]=0;
            $objformulario->sendvar["centro_idx"]=$_SESSION['ces1313777_centro_id'];
			$objformulario->sendvar["cierr_enlacex"]=$aletorioid;
			$objformulario->bloqueo_cierre=$bloque_registro;	

			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['ces1313777_sessid_inicio'];

			

		
$objformulario->generar_formulario_bootstrap(@$submit,$table,1,$DB_gogess); 

?>
LISTA DOCUMENTOS
<?php
if($bloque_registro==0)
{
?>
<button type="button" class="mb-sm btn btn-primary" onclick="lista_facturas()"> LISTAR </button> &nbsp;&nbsp;<button type="button" class="mb-sm btn btn-primary" onclick="procesar_facturas()"> PROCESAR </button>
<?php
}
?>

FACTURAS
<div id="lista_fac" class="TableScroll_factu">


</div>
<br />
ANULADAS
<div id="lista_facanuladas" class="TableScroll_factu">


</div>
<div id="proceso_fac" style="height:20px"></div>

<br />
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,2,$DB_gogess); 
?>
<br />
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,3,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,4,$DB_gogess); 
?>
<div id="data_alerta"></div>
<?php
$objformulario->generar_formulario_bootstrap(@$submit,$table,5,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,6,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,7,$DB_gogess); 

 ?>    
<div id="calcula_proceso" style="height:20px" ></div>

<?php
if($csearch)
{
 $valoropcion='actualizar';
}
else
{
 $valoropcion='guardar';
}


echo "<input name='csearch' type='hidden' value=''>
<input name='idab' type='hidden' value=''>
<input name='opcion_".$table."' type='hidden' value='".$valoropcion."' id='opcion_".$table."' >
<input name='table' type='hidden' value='".$table."'>";
?>

<div id=div_<?php echo $table ?> > </div>
<script type="text/javascript">
<!--
//$( "#usua_fechaingrero" ).datepicker({dateFormat: 'yy-mm-dd'});
//$( "#horae_desde" ).datepicker({dateFormat: 'yy-mm-dd'});
//$( "#horae_hasta" ).datepicker({dateFormat: 'yy-mm-dd'});

<?php
echo $rs_tabla->fields["tab_codigo"];
?>

//  End -->
</script>
<?php
echo $objformulario->generar_formulario_cfechas($table,$DB_gogess);
?>


<script language="javascript">
<!--

function procesar_facturas()
{

$("#proceso_fac").load("templateformsweb/maestro_standar_multiplecierrecaja/procesa_facturas.php",{
centro_id:$('#centro_id').val(),
usua_id:$('#usua_id').val(),
cierr_fecha:$('#cierr_fecha').val(),
cierr_enlace:$('#cierr_enlace').val(),
ctpc_id:$('#ctpc_id').val()

 },function(result){       
			

			 
  });  
  $("#proceso_fac").html("Espere un momento...");

}

function lista_facturas()
{

	
$("#lista_fac").load("templateformsweb/maestro_standar_multiplecierrecaja/lista_facturas.php",{
centro_id:$('#centro_id').val(),
usua_id:$('#usua_id').val(),
cierr_fecha:$('#cierr_fecha').val(),
ctpc_id:$('#ctpc_id').val()

 },function(result){       
			
    lista_facturasanuadas();
			 
  });  
  $("#lista_fac").html("Espere un momento...");



}



function lista_facturasanuadas()
{
	
$("#lista_facanuladas").load("templateformsweb/maestro_standar_multiplecierrecaja/lista_facturasanuladas.php",{
centro_id:$('#centro_id').val(),
usua_id:$('#usua_id').val(),
cierr_fecha:$('#cierr_fecha').val(),
ctpc_id:$('#ctpc_id').val()

 },function(result){       
			

			 
  });  
  $("#lista_facanuladas").html("Espere un momento...");


}



function ver_pdf(idfactura,opcion)
{
    
    
	if(opcion=='01')
	{
			 window.location.href='multiplepdffacturas/pdf.php?xml=' + idfactura;
	}
			 
     if(opcion=='04')
	{
			 window.location.href='pdfcredito/pdf.php?xml=' + idfactura;
	}
	 if(opcion=='05')
	{
			 window.location.href='pdfdebito/pdf.php?xml=' + idfactura;
	}
	
	 if(opcion=='06')
	{
			 window.location.href='pdfguia/pdf.php?xml=' + idfactura;
	}
	 if(opcion=='07')
	{
			 window.location.href='pdfsretencion/pdf.php?xml=' + idfactura;
	}

}


function ver_pdfrecibo(idfactura,opcion)
{
    
	
    
	if(opcion=='01')
	{
			 window.location.href='pdfrecibos/pdf.php?xml=' + idfactura;
	}
			 
     if(opcion=='04')
	{
			 window.location.href='pdfcredito/pdf.php?xml=' + idfactura;
	}
	 if(opcion=='05')
	{
			 window.location.href='pdfdebito/pdf.php?xml=' + idfactura;
	}
	
	 if(opcion=='06')
	{
			 window.location.href='pdfguia/pdf.php?xml=' + idfactura;
	}
	 if(opcion=='07')
	{
			 window.location.href='pdfsretencion/pdf.php?xml=' + idfactura;
	}

}


$('#cierr_ntransacciones').attr('readonly', true);
$('#cierr_cheque').attr('readonly', true);
$('#cierr_credito').attr('readonly', true);
$('#cierr_otros').attr('readonly', true);
$('#cierr_efectivo').attr('readonly', true);
$('#cierr_tarjetacredito').attr('readonly', true);
$('#cierr_transferencia').attr('readonly', true);
$('#cierr_total').attr('readonly', true);
$('#cierr_totaldinero').attr('readonly', true);
$('#cierr_anulados').attr('readonly', true);
$('#cierr_valoranulado').attr('readonly', true);

<?php

if(@$objformulario->contenid["cierr_id"]>0 and $bloque_registro==0)
{
   echo "lista_facturas();
   procesar_facturas();";
   
   

}

if(@$objformulario->contenid["cierr_id"]>0 and $bloque_registro==1)
{
   echo "lista_facturas();";

}
?>

$( "#tmoned_idx" ).change(function() {
   calcula_valormoenda();
});

$( "#ingefec_cantidadx" ).change(function() {
  calcula_valormoenda();
});

function calcula_valormoenda()
{

    $("#calcula_proceso").load("templateformsweb/maestro_standar_multiplecierrecaja/valor_moneda.php",{

       tmoned_id:$('#tmoned_idx').val(),
	   ingefec_cantidad:$('#ingefec_cantidadx').val()

	 },function(result){       
	

	  });  	

	  $("#calcula_proceso").html("Espere un momento...");

}


//ingefec_valorx

//-->
</script>