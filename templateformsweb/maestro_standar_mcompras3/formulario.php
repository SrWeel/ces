<?php
      //echo $insu_valorx;
	  //echo $tipomov_idx;
	   $per_activo=0;
       $per_activo=$objformulario->replace_cmb("dns_periodobodega","perio_activo,perio_anio"," where perio_activo=",1,$DB_gogess);
	  
	        $enlace_general=@$rs_datosmenu->fields["mnupan_campoenlace"]."x";
		    $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");	
		    $objformulario->sendvar[$enlace_general]=@$_SESSION['ces1313777_sessid_emp_id'];	
            $objformulario->sendvar["horax"]=date("H:i:s");
			$objformulario->sendvar["usua_idx"]=@$_SESSION['ces1313777_sessid_inicio'];
			$objformulario->sendvar["usr_tpingx"]=0;
            $objformulario->sendvar["centro_idx"]=55;
			$objformulario->filtro_m=" where cuadrobm_historial=0 and categ_id='".$insu_valorx."'";
			$objformulario->filtro_m="";
			$tipom_idx=$objformulario->replace_cmb("dns_varioscompras","compra_id,tipom_id"," where compra_id=",$compra_id,$DB_gogess);
			$tipomov_idx=$objformulario->replace_cmb("dns_varioscompras","compra_id,tipomov_id"," where compra_id=",$compra_id,$DB_gogess);
			
			$objformulario->sendvar["tipom_idx"]=$tipom_idx;
			$objformulario->sendvar["tipomov_idx"]=$tipomov_idx;
            $objformulario->sendvar["compra_idx"]=$compra_id;
			
			$objformulario->sendvar["perioac_idx"]=$per_activo;
			
			//busca si es red publica
			//echo $compra_id;
			$moviin_redpublicax=$objformulario->replace_cmb("dns_varioscompras","compra_id,compra_redpublica"," where compra_id=",$compra_id,$DB_gogess);
			$objformulario->sendvar["moviin_redpublicax"]=$moviin_redpublicax;
			
			$moviin_laboratoriox=$objformulario->replace_cmb("dns_varioscompras","compra_id,moviin_laboratorio"," where compra_id=",$compra_id,$DB_gogess);
			$objformulario->sendvar["moviin_laboratoriox"]=$moviin_laboratoriox;
			
			//busca si es red publica
			


		//	$objformulario->sendvar["cuadrobm_idx"]=$_POST["pVar7"];
			$objformulario->pathext="../../../../../";
			
			
			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['ces1313777_sessid_inicio'];

?>
<style type="text/css">
<!--
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
-->
</style>


<table  border="0" cellpadding="0" cellspacing="0">
     <tr>
       <td><?php
	   
//$objformulario->generar_formulario(@$submit,$table,1,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,1,$DB_gogess);
	   
	   ?>         <?php
	   
//$objformulario->generar_formulario(@$submit,$table,2,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,2,$DB_gogess);
	   
	   ?></td>
     </tr>
     <tr>
       <td bgcolor="#70AADA"><div align="center"><span class="style1">ALMACENAMIENTO Y CONSUMO </span></div></td>
     </tr>
     <tr>
       <td><?php
	   
//$objformulario->generar_formulario(@$submit,$table,3,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,5,$DB_gogess);
	   
	   ?></td>
     </tr>
     
     <tr>
       <td>
	   
	   <br /><table width="400" border="1" align="center" cellpadding="0" cellspacing="0">
         <tr>
             <td width="94">En cada : </td>
           <td width="78"><b><div id="medida_unidad">&nbsp;</div></b></td>
           <td width="45">Existe: </td>
           <td width="150"><?php
	   
//$objformulario->generar_formulario(@$submit,$table,3,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,6,$DB_gogess);
	   
	   ?></td>
           <td width="21"><b><div id="medida_descargo">&nbsp;</div></b></td>
         </tr>
         </table><br />
		 
	<div id="r_calculo_alerta"></div>
	<?php
	   
//$objformulario->generar_formulario(@$submit,$table,3,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,7,$DB_gogess);
	   
	   ?>
	   	 
		 
	   </td>
     </tr>
     <tr>
       <td bgcolor="#70AADA"><div align="center"><span class="style1">&nbsp;</span></div></td>
     </tr>
     <tr>
       <td><?php
	   
//$objformulario->generar_formulario(@$submit,$table,3,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,3,$DB_gogess);
	   
	   ?></td>
     </tr>
   </table>

<div id="transferencia_div">   
 <table>
 <tr>
       <td bgcolor="#70AADA"><div align="center" class="style1">TRANSFERENCIAS</div></td>
    </tr>
     <tr>
       <td><?php
	   
//$objformulario->generar_formulario(@$submit,$table,3,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,4,$DB_gogess);
	   
	   ?></td>
     </tr>
 </table>  
</div>
<div id="divBody_lista" ></div>

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

  $( "#centrorecibe_cantidad" ).change(function() {
  
   
	  multiplica();
	  
  });
  
  $( "#moviin_cantidadunidadconsumo" ).change(function() {
  

	  multiplica();
	  
  });
  
  $( "#moviin_preciocompra" ).change(function() { 

	  calcula_t();
	  
  });
  

  
  function multiplica()
  {
      var valor1=parseFloat($( "#centrorecibe_cantidad" ).val());
	  var valor2=parseFloat($( "#moviin_cantidadunidadconsumo" ).val());
	  var im=valor1*valor2;
	  var num = im;
	  
	  $( "#moviin_totalenunidadconsumo" ).val(num);
	  
	  calcula_t();
  }
  
  $('#transferencia_div').hide();
  
  $( "#moviin_fechadecaducidad" ).datepicker({dateFormat: 'yy-mm-dd'});
  $( "#moviin_fechadeelaboracion" ).datepicker({dateFormat: 'yy-mm-dd'});
  
  
  function calcula_t()
  {
      var precio=parseFloat($( "#moviin_preciocompra" ).val());
	  var cantidad=parseFloat($( "#centrorecibe_cantidad" ).val());
	  var total_c=0;
	  
	  if(precio>0 && cantidad>0)
	  {
	     total_c=precio*cantidad;		 
	     $('#moviin_total').val(total_c);
		 $('#despliegue_moviin_total').html(total_c);
	  }

  }
   
<?php
if($busca_cierre==0)
{
?>   
$('#cuadrobm_id_despliegue').html("<table cellspacing='2' border='0'><tbody><tr><td onclick='buscar_producto()' style='cursor:pointer'><img src='images/searchbu.png' width='20' height='18'></td></tr> </tbody></table>");
<?php
}
?>  
  
function buscar_producto()
{
   
abrir_standar("../../../../../templateformsweb/maestro_standar_mcompras3/buscar_producto.php","Buscar","divBody_producto","divDialog_producto",750,450,0,0,0,0,0,0,0);
	 
}


function busca_contexto()
  {
	  $("#lista_buc").load("../../../../../templateformsweb/maestro_standar_mcompras3/lista_bu.php",{
        bu_txtproducto:$('#bu_txtproducto').val(),
		categ_id:'<?php echo $insu_valorx; ?>'

	  },function(result){  
	
	
	  });  
	
	  $("#lista_buc").html("Espere un momento...");  
  
  }	
 
function lista_sugerencias()
{
    
	$("#lista_bucsuge").load("../../../../../templateformsweb/maestro_standar_mcompras3/lista_busuge.php",{
        moviin_descext:$('#moviin_descext').val()

	  },function(result){  
	
	
	  });  
	
	  $("#lista_bucsuge").html("Espere un momento...");  


}  
 
 
 
function selecciona_p(valor,precio,codeb)
{
  $('#cuadrobm_id').val(valor);
  $('#moviin_preciocontable').val(precio);
  $('#moviin_codigoproveedor').val(codeb);
  
  funcion_cerrar_pop('divDialog_producto');
} 
  
 
function colocar_medidas()
 {
    	
    $('#medida_unidad').html($('#unid_id option:selected').html());
	$('#medida_descargo').html($('#uniddesg_id option:selected').html());
	
	if($('#unid_id option:selected').html()=='---Seleccionar--')
	{
	   $('#medida_unidad').html('');
	}
	
	if($('#uniddesg_id option:selected').html()=='---Seleccionar--')
	{
	   $('#medida_descargo').html('');
	}
	
 
 } 
 
 
$( "#unid_id" ).change(function() {
  
colocar_medidas();
	  
});

$( "#uniddesg_id" ).change(function() {
  
colocar_medidas();
	  
});
 

colocar_medidas(); 




//============
//centrorecibe_cantidad
//moviin_preciocompra

function calcula_data()
{

if($('#cuadrobm_id').val()=='')
{
 alert("Por favor seleccione el producto antes de este campo...verifique que el producto este bien seleccionado");
 $('#cuadrobm_id').focus();
 $('#moviin_cantidadunidadconsumo').val(0);
 return false;
 

}


$("#r_calculo").load("../../../../../templateformsweb/maestro_standar_mcompras3/calculo.php",{
        centrorecibe_cantidad:$('#centrorecibe_cantidad').val(),
		moviin_preciocontable:$('#moviin_preciocontable').val(),
		moviin_cantidadunidadconsumo:$('#moviin_cantidadunidadconsumo').val(),
		cuadrobm_id:$('#cuadrobm_id').val()

	  },function(result){  
	
		
	  });  
	
$("#r_calculo").html("Espere un momento...");  

}




$( "#centrorecibe_cantidad" ).change(function() {
 calcula_data();	  
});

$( "#moviin_preciocontable" ).change(function() {
 calcula_data();	  
});

$( "#moviin_cantidadunidadconsumo" ).change(function() {
 calcula_data();	  
});


function actualiza_unidad()
{
  
$("#ac_unidad").load("../../../../../templateformsweb/maestro_standar_mcompras3/acuidad.php",{
        prcomp_id:$('#prcomp_id').val(),
		unid_id:$('#unid_id').val(),
        cuadrobm_id:$('#cuadrobm_id').val(),
		centrorecibe_cantidad:$('#centrorecibe_cantidad').val(),
		moviin_preciocontable:$('#moviin_preciocontable').val(),
		moviin_total:$('#moviin_total').val(),
		centrorecibe_observacion:$('#centrorecibe_observacion').val()
	  },function(result){  
	
	
	  });  
	
$("#ac_unidad").html("Espere un momento...");  

}


<?php
if($moviin_redpublicax==1)
{
?>
$("#moviin_redpublica").val("1"); 
$("#despliegue_moviin_redpublica").html("SI"); 
<?php
}
?>
  
$("#moviin_totalenunidadconsumo").attr('readonly', 'readonly');  
$("#moviin_preciocompra").attr('readonly', 'readonly');  
  
//  End -->
</script>

<div id="divBody_producto"></div>
<div id="r_calculo"></div>
<div id="ac_unidad"></div>
<?php
//echo $objformulario->generar_formulario_cfechas($table,$DB_gogess);
?>fff