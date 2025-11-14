<?php
  

	        $enlace_general=$rs_datosmenu->fields["mnupan_campoenlace"]."x";
		    $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");
			$objformulario->sendvar["solofechax"]=date("Y-m-d");
		    $objformulario->sendvar[$enlace_general]=@$_SESSION['ces1313777_sessid_emp_id'];
            $objformulario->sendvar["horax"]=date("H:i:s");
			$objformulario->sendvar["usua_idx"]=@$_SESSION['ces1313777_sessid_inicio'];
			$objformulario->sendvar["usr_tpingx"]=0;
            $objformulario->sendvar["centro_idx"]=$_SESSION['ces1313777_centro_id'];
			$objformulario->sendvar["emp_idx"]=$_SESSION['ces1313777_sessid_emp_id'];		
			
			$objformulario->sendvar["ttra_idx"]=1;
			
			
			$objformulario->sendvar["tipom_idx"]=1;
			$objformulario->sendvar["tipomov_idx"]=17;
			
			$codig_unicovalor='';
			$unico_number='';
			$unico_number=strtoupper(uniqid());			
			$codig_unicovalor=date("Y-m-d").$_SESSION['ces1313777_sessid_inicio'].$unico_number;
					
			$objformulario->sendvar["compra_numeroprocesox"]=$codig_unicovalor;					
			$objformulario->sendvar["anti_enlacex"]=$codig_unicovalor;
			
			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['ces1313777_sessid_inicio'];
	 
$objformulario->generar_formulario_bootstrap(@$submit,$table,1,$DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit,$table,2,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,3,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,4,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,5,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,6,$DB_gogess); 

$objformulario->generar_formulario_bootstrap(@$submit,$table,7,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,8,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,9,$DB_gogess); 

$objformulario->generar_formulario_bootstrap(@$submit,$table,10,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,11,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,12,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,13,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,14,$DB_gogess); 

?>



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

<div id="divBody_proveedor"></div>

<div id="divBody_listadetalles"></div>

<script type="text/javascript">
<!--
//$( "#usua_fechaingrero" ).datepicker({dateFormat: 'yy-mm-dd'});
//$( "#horae_desde" ).datepicker({dateFormat: 'yy-mm-dd'});
//$( "#horae_hasta" ).datepicker({dateFormat: 'yy-mm-dd'});

<?php
echo $rs_tabla->fields["tab_codigo"];
?>


function leer_xml()
{
	if($('#compra_xml').val()=='')
	{
	  alert("Subir xml al sistema para procesar");
	  return false;
	}

	  $("#procesa_xml").load("templateformsweb/maestro_standar_compras/procesa_xml.php",{
        compra_xml:$('#compra_xml').val()
	  },function(result){  
	
	
	  });  
	
	  $("#procesa_xml").html("Espere un momento..."); 

}



$('#proveevar_id_despliegue').html("<table cellspacing='2' border='0'><tbody><tr><td onclick='buscar_proveedor_actualizar()' style='cursor:pointer'><img src='images/moreedit.png' width='20' height='18'></td></tr> </tbody></table>");


function buscar_proveedor_actualizar()
{
   
abrir_standar("templateformsweb/maestro_standar_compras/proveedor_d/grid_nuevo_proveedor.php","Proveedor","divBody_proveedor","divDialog_proveedor",750,450,0,$('#proveevar_id').val(),0,0,0,0,0);
	 
}

function verdetalles_xml()
{

abrir_standar("templateformsweb/maestro_standar_compras/detallesxml/panel_lista.php","Proveedor","divBody_listadetalles","divDialog_listadetalles",850,450,0,$('#compra_claveacceso').val(),0,0,0,0,0);
	 
	 
}

function actualiza_despuesg()
{   
   actualiza_cmb1();
   //$('#proveevar_id').val($('#provee_id').val());
}


function actualiza_cmb1()
{
     
	 $("#cmb_proveevar_id").load("templateformsweb/maestro_standar_compras/proveedor_d/cmb_proveedor.php",{

	  },function(result){  
	  //alert($('#provee_id').val());
	     $('#proveevar_id').val($('#provee_id').val());
		    
	  });  
	
	  $("#cmb_proveevar_id").html("...");  

}

 function ocultar_mostrar3(muestra)
  {
  
    $('#productos_id').hide();
	cambio_inactivo('productos_id',0);
    $('#cuentas_id').hide();
	cambio_inactivo('cuentas_id',0);
	$('#fpago_id').hide();
	cambio_inactivo('fpago_id',0);
	
	
	$('#'+muestra).show();
	cambio_inactivo(muestra,1);
  
  }	


  function cambio_inactivo(divdata,opcion)
  {  
    if(opcion==0)
	{
	$('#btn_'+divdata).css('background-color','#C5E0EB');
	$('#btn_'+divdata).css('color','#000000');
	$('#btn_'+divdata).css('border','#000000');
	$('#btn_'+divdata).css('border','solid');
	$('#btn_'+divdata).css('border-width','thin');   
	}
	else
	{
	$('#btn_'+divdata).css('background-color','#000033');
	$('#btn_'+divdata).css('color','#FFFFFF');
	$('#btn_'+divdata).css('border','#000000');
	$('#btn_'+divdata).css('border','solid');
	$('#btn_'+divdata).css('border-width','thin');	
	}
  }
  
  
<?php
if(!($csearch))
{
?> 
  showUser_combog('frocob_id',$('#ttra_id').val(),'divfrocob_id','ttra_id','lpin_cobropago','',0,0,0,0,0);   
  
<?php
}
?>

function cambia_transaccionanticipo()
{

   if($('#ttra_id').val()=='1')
   {   
      $('#bloque_subfp_id').hide();   
   }
   
    if($('#ttra_id').val()=='2')
   {   
      $('#bloque_subfp_id').show();   
   }
   
}
function cambio_fcoanticipo()
{
   var jsLang = $("#detantic_id").val();
  // alert($('#ttra_id').val());  tmv_id

  console.log($("#detantic_id").val());
   
   if($('#movantic_id').val()=='1' || $('#movantic_id').val()=='2'|| $('#movantic_id').val()=='3' || $('#movantic_id').val()=='4')
   {   
    //cobro
	switch (jsLang) 
	{ 
		case '1': 
			{

				$('#bloque_anti_cheque').show();
				$('#bloque_anti_fechacheque').show();
				$('#bloque_anti_ordenpago').show();
				
				$('#bloque_anti_comprobante').hide();
				$('#bloque_anti_ctacobro').hide();
				$('#bloque_anti_lote').hide();

			}
			break;
		case '2': 
			{

				
				$('#bloque_anti_comprobante').show();


				$('#bloque_anti_ctacobro').hide();
				$('#bloque_anti_lote').hide();

				$('#bloque_anti_cheque').hide();
				$('#bloque_anti_fechacheque').hide();
				$('#bloque_anti_ordenpago').hide();

			  
			}
			break;
		case '3': 
			{
	
				
				$('#bloque_anti_comprobante').show();


				$('#bloque_anti_ctacobro').hide();
				$('#bloque_anti_lote').hide();

				$('#bloque_anti_cheque').hide();
				$('#bloque_anti_fechacheque').hide();
				$('#bloque_anti_ordenpago').hide();

			}
			break;
		case '4': 
			{
			
		
				
				$('#bloque_anti_comprobante').show();


				$('#bloque_anti_ctacobro').hide();
				$('#bloque_anti_lote').hide();

				$('#bloque_anti_cheque').hide();
				$('#bloque_anti_fechacheque').hide();
				$('#bloque_anti_ordenpago').hide();
			 
			  
			}
			break;
			case '6': 
			{
			
		
				
				$('#bloque_anti_comprobante').show();
				$('#bloque_anti_ctacobro').show();

				
				$('#bloque_anti_lote').hide();

				$('#bloque_anti_cheque').hide();
				$('#bloque_anti_fechacheque').hide();
				$('#bloque_anti_ordenpago').hide();
			 
			  
			}

		
		default:
			{
			}
	}
   //cobro
   }
   
   
   
   

 
}


$('#bloque_anti_cheque').hide();
$('#bloque_anti_fechacheque').hide();
$('#bloque_anti_ordenpago').hide();

$('#bloque_anti_ctacobro').hide();
$('#bloque_anti_lote').hide();




function buscar_dataform(id)
{

abrir_standar('templateformsweb/maestro_standar_anticiposbancos/buscadorform/busca_data.php','Buscador','divBody_buscadorgeneral','divDialog_buscadorgeneral',550,500,id,$('#frocob_id').val(),0,0,0,0,0);

}

function crear_dataform(id,valor)
{

abrir_standar('templateformsweb/maestro_standar_anticiposbancos/crearform/formulario.php','New','divBody_buscadorgeneral','divDialog_buscadorgeneral',550,500,id,valor,0,0,0,0,0);

}

//  End -->
</script>
<?php
echo $objformulario->generar_formulario_nfechas($table,$DB_gogess);
?>
