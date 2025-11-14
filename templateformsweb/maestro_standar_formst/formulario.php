<style type="text/css">
<!--
.titulo_suscripcion {font-size: 13px; font-family: Arial, Verdana; font-weight: bold; }
.espacio_css {
	font-size: 7px;
	font-family: Arial, Helvetica, sans-serif;
}
-->
</style>
<script type="text/javascript">
function asignar_ingreso()
{

   $("#acceso_local").load("templateformsweb/maestro_standar_cliente/ingresar.php",{

clie_id:$('#clie_id').val(),
emp_id:$('#emp_id').val()


  },function(result){  



  });  

  $("#acceso_local").html("Espere un momento...");  

}
</script>


<table width="100%" border="0" align="center" cellpadding="4" cellspacing="2">  
  <tr>
    <td valign="top">
      <?php
	 
		    $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");	
			$objformulario->sendvar["emp_idx"]=@$_SESSION['ces1313777_sessid_emp_id'];	
            $objformulario->sendvar["horax"]=date("H:i:s");
			$objformulario->sendvar["sisu_idx"]=@$_SESSION['ces1313777_sessid_inicio'];
			 $objformulario->sendvar["usr_tpingx"]=0;
			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['ces1313777_sessid_inicio'];

$objformulario->generar_formulario_bootstrap(@$submit,$table,1,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,2,$DB_gogess); 
//$objformulario->generar_formulario(@$submit,$table,2,$DB_gogess); 
?>    </td>
  
    
  </tr>
</table>

<?php       
if(@$csearch)
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

<?php
$obtine_data="select * from gogess_sisfield where fie_id='".$fie_id."'";
$rs_obtdata = $DB_gogess->executec($obtine_data,array());

$fie_name=$rs_obtdata->fields["fie_name"];

$fie_tabledb=$rs_obtdata->fields["fie_tabledb"];
$fie_datadb=$rs_obtdata->fields["fie_datadb"];
$fie_scriptbuscador=$rs_obtdata->fields["fie_scriptbuscador"];

$campo_pid=array();
$campo_pid=explode(",",$fie_datadb);
?>

<script type="text/javascript">
<!--

function actualizadata_cmb(valor)
{
	 $("#cmb_<?php echo $fie_name ?>").load("templateformsweb/maestro_standar_formst/cmb_standar.php",{
           fie_id:'<?php echo $fie_id; ?>'
	  },function(result){  

	     $('#<?php echo $fie_name; ?>').val(valor);
		 
		 <?php
		 echo $fie_scriptbuscador;
		 ?>
		 
		    
	  });  
	
	  $("#cmb_<?php echo $fie_name ?>").html("...");  

}


//  End -->
</script>

<?php
echo $objformulario->generar_formulario_nfechas($table,$DB_gogess);
?>

