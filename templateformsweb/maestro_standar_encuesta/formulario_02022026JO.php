<?php
	  

	        $enlace_general=$rs_datosmenu->fields["mnupan_campoenlace"]."x";
		    $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");	
		    $objformulario->sendvar[$enlace_general]=@$_SESSION['ces1313777_sessid_emp_id'];	
            $objformulario->sendvar["horax"]=date("H:i:s");
			$objformulario->sendvar["usua_idx"]=@$_SESSION['ces1313777_sessid_inicio'];
			$objformulario->sendvar["usr_tpingx"]=0;
            $objformulario->sendvar["centro_idx"]=$_SESSION['ces1313777_centro_id'];
			$objformulario->sendvar["partop_estadox"]=1;
			
			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['ces1313777_sessid_inicio'];
			
			
			
		    $codig_unicovalor='';
			$unico_number='';
			$unico_number=strtoupper(uniqid());			
			$codig_unicovalor=date("Y-m-d").$_SESSION['ces1313777_sessid_inicio'].$unico_number;					
			$objformulario->sendvar["partop_codex"]=$codig_unicovalor;		
			 

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
<div id="divBody_buscadorgeneral"></div>

<script type="text/javascript">
<!--


function buscar_dataform(id)
{

abrir_standar('templateformsweb/maestro_standar_encuesta/buscadorform/busca_data.php','Buscador','divBody_buscadorgeneral','divDialog_buscadorgeneral',550,500,id,0,0,0,0,0,0);

}

function crear_dataform(id,valor)
{

abrir_standar('templateformsweb/maestro_standar_encuesta/crearform/formulario.php','New','divBody_buscadorgeneral','divDialog_buscadorgeneral',550,500,id,valor,0,0,0,0,0);

}



//$( "#usua_fechaingrero" ).datepicker({dateFormat: 'yy-mm-dd'});
//$( "#horae_desde" ).datepicker({dateFormat: 'yy-mm-dd'});
//$( "#horae_hasta" ).datepicker({dateFormat: 'yy-mm-dd'});

<?php
echo $rs_tabla->fields["tab_codigo"];
?>


//  End -->
</script>
<?php
echo $objformulario->generar_formulario_nfechas($table,$DB_gogess);

?>



<?php
if($table=='lpin_plancuentas')
{
//===================================

if($csearch)
{

$busca_usado="select count(*) as total from lpin_detallecomprobantecontable_vista where detcc_cuentacontable='".$objformulario->contenid["planc_codigoc"]."'";
$rs_busado = $DB_gogess->executec($busca_usado);

echo "Usado en: ".$rs_busado->fields["total"];

if($rs_busado->fields["total"]>0)
{
?>

<script type="text/javascript">
<!--


$('#boton_guardarformdata').hide();
$('#boton_guardarformdata2').hide();

//  End -->
</script>


<?php
}


}


//==================================
}

?>

<script type="text/javascript">
<!--

$( "#planc_codigoc" ).on( "change", function() {

ver_sitienevalor();

} );

function ver_sitienevalor()
{
    
	  $("#valida_cuenta").load("templateformsweb/maestro_standar_encuesta/valida_cuenta.php",{
        planc_codigoc:$('#planc_codigoc').val()
	  },function(result){  
	
	
	  });  
	  $("#valida_cuenta").html("Espere un momento..."); 	  

}

//  End -->
</script>

<div id="valida_cuenta"></div>