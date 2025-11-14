<script type="text/javascript">
<!--
function despues_guardar()
{
 $("#acceso_registro").load("aplicativos/registro/opciones/grid/envio_reg.php",{
 usua_usuario:$('#usua_usuario').val()
  },function(result){  


  });  

  $("#acceso_registro").html("Espere un momento...");  

}

function falla_guardado()
{
alert("El usuario o el correo ya existen...");

}
//  End -->
</script>

<style type="text/css">
<!--
.titulo_suscripcion {font-size: 13px; font-family: Arial, Verdana; font-weight: bold; }
.espacio_css {
	font-size: 7px;
	font-family: Arial, Helvetica, sans-serif;
}
-->
</style>

<table width="600" border="0" align="center" cellpadding="4" cellspacing="2">  
  <tr>
    <td valign="top"><div align="center">
      <?php
	 
		    $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");	
			$objformulario->sendvar["emp_idx"]=@$_SESSION['ces1313777_sessid_emp_id'];	
            $objformulario->sendvar["horax"]=date("H:i:s");
			$objformulario->sendvar["sisu_idx"]=@$_SESSION['iduser'];
			$objformulario->sendvar["usr_tpingx"]=0;
			 
			$objformulario->sendvar["emp_idx"]=1;
			$objformulario->sendvar["anoactualx"]=date("Y");
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