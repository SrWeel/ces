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
<!--
//$( "#usua_fecha_uingreso" ).datepicker({dateFormat: 'yy-mm-dd'});

function genera_serial()
{

$("#div_serial").load("templateformsweb/maestro_standar_producto/genera_serial.php",{

  },function(result){  

$('#produ_codigoserial').val($('#val_serial').val());

  });  
  $("#div_serial").html("Espere un momento...");  

}
//  End -->
</script>
<table border="0" align="center" cellpadding="4" cellspacing="2">  
  <tr>
    <td valign="top"><div align="center">
      <?php
	 
		    $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");	
			$objformulario->sendvar["emp_idx"]=@$_SESSION['ces1313777_sessid_emp_id'];	
            $objformulario->sendvar["horax"]=date("H:i:s");
			$objformulario->sendvar["usua_idx"]=@$_SESSION['ces1313777_sessid_inicio'];

			$objformulario->sendvar["emp_idx"]=@$_POST['pVar2'];
			
			// $objformulario->sendvar["usr_tpingx"]=0;
			
			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['ces1313777_sessid_inicio'];
			
			 
$objformulario->generar_formulario(@$submit,$table,1,$DB_gogess); 
?>
    </div></td>
 
    <td valign="top">&nbsp;</td>
    <td valign="top"><?php
    $objformulario->generar_formulario(@$submit,$table,2,$DB_gogess); 
	?></td>
    
  </tr>
</table>

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

<?php
if(!(@$objformulario->contenid["emp_id"]))
{
?>
<script type="text/javascript">
<!--

showUser_combog('bode_id',$('#emp_id').val(),'divbode_id','emp_id','app_producto','',0,0,0,0,0);

//  End -->

</script>
<?php
}
?>
