<?php  

	        $enlace_general=$rs_datosmenu->fields["mnupan_campoenlace"]."x";
		    $objformulario->sendvar["fechax"]=date("Y-m-d");	
		    $objformulario->sendvar[$enlace_general]=@$_SESSION['ces1313777_sessid_emp_id'];
            $objformulario->sendvar["horax"]=date("H:i:s");
			$objformulario->sendvar["usua_idx"]=@$_SESSION['ces1313777_sessid_inicio'];			
			$objformulario->sendvar["usr_tpingx"]=0;
			$objformulario->sendvar["tipocmp_codigox"]='01';
			$objformulario->sendvar["estaf_idx"]='1';
			$objformulario->sendvar["origenx"]='MANUAL';
			$objformulario->sendvar["tippo_idx"]=3;
			
            
			$valoralet=mt_rand(1,500);
			$nunico=strtoupper(uniqid());
			$aletorioid='01'.$nunico.$_SESSION['ces1313777_sessid_inicio'].date("Ymdhis").$valoralet;
			$objformulario->sendvar["doccab_idx"]=$aletorioid;
			
            $busca_emp="select * from app_empresa where emp_id='".$_SESSION['ces1313777_sessid_emp_id']."'";
            $rs_femp = $DB_gogess->executec($busca_emp,array());
            $rucempresa=$rs_femp->fields["emp_ruc"];
			$objformulario->sendvar["doccab_rucempresax"]=$rucempresa;
			$objformulario->sendvar["ambi_valorx"]=$objimpuestos->ambi_valor;
			$objformulario->sendvar["emis_valorx"]=$objimpuestos->tipoemi_codigo;
			$objformulario->sendvar["tipase_idx"]=10;
			$objformulario->sendvar["centro_idx"]=$_SESSION['ces1313777_centro_id'];
			
			$objformulario->sendvar["facturaxnum"] ="-factura-";
		    //$generafactura= 
			$objformulario->generar_formulario(@$submit,$table,81,$DB_gogess);
			
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


function buscar_dataform(id)
{

abrir_standar('templateformsweb/maestro_standar_ventas/buscadorform/busca_data.php','Buscador','divBody_buscadorgeneral','divDialog_buscadorgeneral',550,500,id,0,0,0,0,0,0);

}

function crear_dataform(id,valor)
{

abrir_standar('templateformsweb/maestro_standar_ventas/crearform/formulario.php','New','divBody_buscadorgeneral','divDialog_buscadorgeneral',550,500,id,valor,0,0,0,0,0);

}

function llena_cliente()
{
   $("#llena_cliente").load("templateformsweb/maestro_standar_ventas/ver_cliente.php",{
    client_id:$('#client_id').val()
  },function(result){  
      
  });  
  $("#llena_cliente").html("Espere un momento...");  

}


$( "#client_id" ).change(function() {
 
 //llena_cliente();
 
});


//  End -->
</script>
<?php
echo $objformulario->generar_formulario_nfechas($table,$DB_gogess);
?>


<div id="divBody_buscadorgeneral"></div>
<div id="llena_cliente"></div>