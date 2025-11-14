<?php

	  

	        $enlace_general=$rs_datosmenu->fields["mnupan_campoenlace"]."x";
		    $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");	
		    $objformulario->sendvar[$enlace_general]=@$_SESSION['ces1313777_sessid_emp_id'];	
            $objformulario->sendvar["horax"]=date("H:i:s");
			$objformulario->sendvar["usua_idx"]=@$_SESSION['ces1313777_sessid_inicio'];
			$objformulario->sendvar["usr_tpingx"]=0;
            $objformulario->sendvar["centro_idx"]=$_SESSION['ces1313777_centro_id'];
			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['ces1313777_sessid_inicio'];
            $valoralet=mt_rand(1,500);
			$aletorioid='01'.@$_SESSION['ces1313777_sessid_cedula'].$_SESSION['ces1313777_sessid_inicio'].date("Ymdhis").$valoralet;
			$objformulario->sendvar["pp_enlacex"]=$aletorioid;
			

			 

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
<style type="text/css">
<!--
.TableScroll_griddata {
        z-index:99;
		width:100%;
        height:450px;	
        overflow: auto;
      }
-->
</style>

<div id=div_<?php echo $table ?> > </div>


<script>
         $(function() {
            $( "#grdpromo_cie10x" ).autocomplete({
               source: "templateformsweb/maestro_standar_promocion/searchcie.php",
               minLength: 1,
			   select: function( event, ui ) {
				  $('#grdpromo_descripcioncie10x').val(ui.item.descripcion);
					
			   }
            });
         });
		 
		 $(function() {
            $( "#grdpromo_descripcioncie10x" ).autocomplete({
               source: "templateformsweb/maestro_standar_promocion/searchcietexto.php",
               minLength: 1,
			   select: function( event, ui ) {
				  $('#grdpromo_cie10x').val(ui.item.codigo);
					
			   }
            });
         });
		 
		 
		 	  $(function() {
            $( "#grdpromo_tnsx" ).autocomplete({
               source: "templateformsweb/maestro_standar_promocion/searchpro.php",
               minLength: 1,
			   select: function( event, ui ) {
				  $('#grdpromo_descricpionx').val(ui.item.descripcion);
				  $('#grdpromo_valorsolicitadox').val(ui.item.precio);
					
			   }
            });
         });
		 
		 
		  $(function() {
            $( "#grdpromo_descricpionx" ).autocomplete({
               source: "templateformsweb/maestro_standar_promocion/searchprotexto.php",
               minLength: 1,
			   select: function( event, ui ) {
				  $('#grdpromo_tnsx').val(ui.item.codigo);
				  $('#grdpromo_valorsolicitadox').val(ui.item.precio);
					
			   }
            });
         });
		 
		 
		 $( "#grdpromo_cantidadx" ).change(function() {
                   var cantidad=parseFloat($('#grdpromo_cantidadx').val());
				   var precio=parseFloat($('#grdpromo_valorsolicitadox').val());
				   var im=cantidad*precio;
				    var num = im;
				   var n = num.toFixed(2);
				    $('#grdpromo_totalvalorx').val(n);
				});
		 
		  $( "#grdpromo_valorsolicitadox" ).change(function() {
                   var cantidad=parseFloat($('#grdpromo_cantidadx').val());
				   var precio=parseFloat($('#grdpromo_valorsolicitadox').val());
				   var im=cantidad*precio;
				    var num = im;
				   var n = num.toFixed(2);
				    $('#grdpromo_totalvalorx').val(n);
				});
		 
</script>

<?php
echo $objformulario->generar_formulario_cfechas($table,$DB_gogess);
?>