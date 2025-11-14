<?php
include("../../cfgclases/sessiontime.php");
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
?>

	<script type="text/javascript">
        jQuery(function($) { $('#clave_nueva').pwstrength(); });
    </script>

<script type="text/javascript">
<!--

function guardar_clave()
{ 
    if ($('#clave_old').val()=='')
	{
	alert('Debe llenar el Campo Clave Anterior:');
	return false;
	}
	
	if ($('#clave_nueva').val()=='')
	{
	alert('Debe llenar el Campo Clave Nueva:');
	return false;
	}
	
	if ($('#clave_nueva').val()!=$('#re_clave_nueva').val())
	{
	alert('Deben ser igual la confirmacion de la clave a la clave:');
	return false;
	}
	
	
   
   $("#guardar_clave").load("aplications/usuario/cambioclave.php",{
    id_valor:'<?php echo $_SESSION['ces1313777_sessid_inicio']; ?>',clave_old:$('#clave_old').val(),clave_nueva:$('#clave_nueva').val(),re_clave_nueva:$('#re_clave_nueva').val()
  },function(result){  

	 if($('#exito_val').val()==1)
	   {
		   setTimeout(function () { location.reload() }, 2000);
	   }

  });  
  $("#guardar_clave").html("Espere un momento...");  

}


//  End -->
</script>
<p>&nbsp;</p>
<p>&nbsp;</p>

<table width="200" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><img src="images/key.png" width="57" height="68" /></td>
    <td><table width="500" border="0" align="center" cellpadding="0" cellspacing="2">
      <tr>
        <td class="cmbforms" ><div align="right">Clave Anterior:</div></td>
        <td><input name="clave_old" type="password" id="clave_old" class="OKcampo" /></td>
      </tr>
      <tr>
        <td class="cmbforms" ><div align="right">Clave Nueva:</div></td>
        <td><input name="clave_nueva" type="password" id="clave_nueva" class="OKcampo"  data-indicator="pwindicator" />
		
		
		</td>
      </tr>
      <tr>
        <td><div align="right"></div></td>
        <td><div id="pwindicator">
                    <div class="bar"></div>
                    <div class="label"></div>
                </div></td>
      </tr>
      <tr>
        <td class="cmbforms" ><div align="right">Confirmaci&oacute;n de Clave: </div></td>
        <td><input name="re_clave_nueva" type="password" id="re_clave_nueva" class="OKcampo" /></td>
      </tr>
    </table></td>
  </tr>
</table>
<div id=guardar_clave >
  <input name="exito_val" type="hidden" id="exito_val" value="0" />
</div>
<p>&nbsp;</p>
<div align="center">
<table border="0" cellpadding="0" cellspacing="3">
			  <tr>
				<td style="cursor:pointer" onclick="guardar_clave()"><img src="images/aceptar.png" ></td>
			    <td>&nbsp;</td>
			    <td onClick="funcion_cerrar_pop('divDialog_extra')"  style="cursor:pointer" ><img src="images/cancelar.png" ></td>
			  </tr>
  </table>
</div>

