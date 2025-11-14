<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<script type="text/javascript">
<!--


function activar_desactivar()
{
  if(confirm("Esta seguro, verifico el deposito o transferencia para activar este plan"))
  {
  $("#activa_plan").load("aplicativos/cobros/activa_desactiva.php",{
   pago_id:$('#pago_id').val()
  },function(result){  


 $('#sisu_id').val($('#sisu_idval').val());
 $('#despliegue_sisu_id').html($('#despliegue_sisu_idval').val());
 
 $('#pago_estado').val($('#pago_estadoval').val());
 $('#despliegue_pago_estado').html($('#despliegue_pago_estadoval').val());
 
 $('#pago_fechaaprobado').val($('#pago_fechaaprobadoval').val())
 $('#despliegue_pago_fechaaprobado').html($('#despliegue_pago_fechaaprobadoval').val());
 
 $('#pago_fechafin').val($('#pago_fechafinval').val());
 $('#despliegue_pago_fechafin').html($('#despliegue_pago_fechafinval').val());

  });  

  $("#activa_plan").html("Espere un momento...");  
  }
}


//  End -->
</script>
<?php
$objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");	
$objformulario->sendvar["emp_idx"]=@$_SESSION['ces1313777_sessid_emp_id'];	
$objformulario->sendvar["horax"]=date("H:i:s");
$objformulario->sendvar["usua_idx"]=@$_SESSION['ces1313777_sessid_inicio'];
$objformulario->sendvar["menros_idx"]=$_POST["pVar2"];


$objformulario->generar_formulario(@$submit,$table,1,$DB_gogess); 
$objformulario->generar_formulario(@$submit,$table,2,$DB_gogess); 

      
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

