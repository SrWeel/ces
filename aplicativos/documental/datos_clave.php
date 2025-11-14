<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=444000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
if(@$_SESSION['ces1313777_sessid_inicio'])
{
?>



	<script type="text/javascript">

     //   jQuery(function($) { $('#clave_nueva').pwstrength(); });

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

	

	

   

   $("#guardar_clave").load("aplicativos/documental/cambioclave.php",{

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



<div class="container" style="padding-top: 1em; padding-right:1em; padding-left:1em; max-width:900px;">

<div class="panel panel-default">

  <div class="panel-heading">

    <h3 class="panel-title" style="color:#006600" >Desea cambiar su clave?</h3>

  </div>

  <div class="panel-body">

  

  <div class="row" align="center">

  

  

  <div class="form-group">

   <label class="col-sm-2 control-label">Clave Anterior:</label>

   <div class="col-xs-10">

   <input name="clave_old" type="password" id="clave_old" class="form-control" />

   </div> 

  </div>

  <br>

  <div class="form-group">

   <label class="col-sm-2 control-label">Clave Nueva:</label>

   <div class="col-xs-10">

   <input name="clave_nueva" type="password" id="clave_nueva" class="form-control" data-indicator="pwindicator"   />

   </div>

  </div>

  <br>

  <div class="form-group">

   <label class="col-sm-2 control-label">Confirmaci&oacute;n de Clave:</label>

   <div class="col-xs-10">

   <input name="re_clave_nueva" type="password" id="re_clave_nueva" class="form-control"  />

   </div>

  </div>

  

  <div id="pwindicator">

   <div class="bar"></div>

   <div class="label"></div>

  </div>

  

   </div>

</div>

</div>



<div id=guardar_clave >

  <input name="exito_val" type="hidden" id="exito_val" value="0" />

</div>

<p>&nbsp;</p>

<div align="center">

<table border="0" cellpadding="0" cellspacing="3">

			  <tr>

				<td ><button type="button" onclick="guardar_clave()"  class="btn btn-primary">Cambiar clave</button> </td>

			  <!--  <td>&nbsp;</td>

			    <td><button type="button" class="mb-sm btn btn-danger" onclick="funcion_cerrar_pop('divDialog_ext')">Cancelar</button></td> -->

			  </tr>

  </table>

</div>

<?php
}
else
{
 echo '<div style="font-family:11px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#FF0000" align="center" >Sesi&oacute;n de usuario ha terminado porfavor de clic en F5 para continuar...</div>';
 
}	
?>