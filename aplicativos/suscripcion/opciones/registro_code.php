<?php
$subindice='_usuario';
$subcarpeta='usuario';

?>
<script type="text/javascript">
<!--
function resgistrado(usvalor)
{
 
  
  $("#div_idformulario").load("aplicativos/suscripcion/opciones/envio_code.php",{
    usua_usuario:usvalor
  },function(result){  

	
  });  
  $("#div_idformulario").html("Espere un momento..."); 


}

function ver_formularioreg(urlpantalla,titulopantalla,divBody,variable1,variable2,variable3,variable4,variable5,variable6,variable7)
{
    $("#"+divBody).load(urlpantalla,{
	pVar1:variable1,
	pVar2:variable2,
	pVar3:variable3,
	pVar4:variable4,
	pVar5:variable5,
	pVar6:variable6,
	pVar7:variable7
  },function(result){  
      
  });  
  $("#"+divBody).html("Espere un momento...");  

}

-->
</script>
<center><div id='div_idformulario' ></div></center>
<script type="text/javascript">
<!--
ver_formularioreg('aplicativos/suscripcion/opciones/grid/usuario/grid_usuario_nuevo.php','REGISTRO','div_idformulario',0,0,0,0,0,0,'<?php echo $variables_ext["tiporeg"]; ?>');
-->
</script>