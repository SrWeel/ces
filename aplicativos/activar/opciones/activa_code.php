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

<style type="text/css">
<!--
.activa_css1 {
	font-size: 11px;
	font-family: Arial, Helvetica, sans-serif;
	font-style: italic;
	color: #006600;
}
.activa_css2 {
	font-size: 12px;
	font-family: Arial, Helvetica, sans-serif;
	font-style: italic;
	color: #003366;
	font-weight: bold;
}
.activa_css3 {
	font-family: Arial, Helvetica, sans-serif;
	color: #003366;
	font-size: 12px;
	font-weight: bold;
}
-->
</style>
<?php

$selecTabla="select * from  app_usuario where usua_id=? and  usua_estado='0'";    
$rs_aplopciones = $DB_gogess->executec($selecTabla,array(@$variables_ext["idactv"]));
$usua_ide=$rs_aplopciones->fields["usua_id"];

			
	if ($usua_ide)
	{
			  $sqlc="update app_usuario set usua_estado='1' where usua_id=?";
			  $resultadoac = $DB_gogess->executec($sqlc,array($usua_ide));
			
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><p align="center" class="activa_css1">&nbsp;</p>
      <p align="center" class="activa_css1">&nbsp;</p>
      <p align="center" class="activa_css2">SU CUENTA ESTA ACTIVA.</p>
      <p align="center" class="activa_css3">Bienvenido</p>
    <p align="center" class="activa_css3">INGRESE CON SU USUARIO Y CLAVE.</p>
    <p align="center" class="activa_css1">&nbsp;</p>
    <p align="center" class="activa_css1">&nbsp;</p></td>
	<meta http-equiv="refresh" content="2;URL=index.php?snp=WVhCc1BURTVKbk5sWTJNOU55WnpaV05qYVc5dWNEMHo=348">
  </tr>
</table>

<?php
}
else
{
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><p align="center" class="activa_css1">&nbsp;</p>
        <p align="center" class="activa_css3">CODIGO DE ACTIVACION YA EXPIRO..</p>
        <p align="center" class="activa_css1">&nbsp;</p>
      <p align="center" class="activa_css1">&nbsp;</p>
	 
    </td>
  </tr>
</table>
<?php
}
?>
